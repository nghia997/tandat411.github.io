<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;
session_start();

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class SocialController extends AppController
{
    private $facebook;

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->facebook = new \Facebook\Facebook([
           'app_id' => FACEBOOK_APP_ID,
           'app_secret' => FACEBOOK_APP_SECRET,
           'default_graph_version' => 'v3.2',
        ]);
    }

    /**
     * Method to display view Login page
     * @return void
     */
    public function login()
    {
        $this->set('title', 'Login with Facebook');
        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = ['email', 'user_friends', 'user_posts', 'user_likes'];
        // Get URL with permissions had set up
        $loginUrl = $helper->getLoginUrl(FACEBOOK_REDIRECT_URI, $permissions);
        // Set this URL for this view
        $this->set('url', $loginUrl);
    }

    /**
     * Method to log in with facebook and insert or update data of user had logged to database
     * @return void
     */
    public function callback()
    {
        $helper = $this->facebook->getRedirectLoginHelper();
        try {
            // Get token
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        // Check Facebook login fail or success
        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
        } else {
            // Save this token
            $_SESSION['token'] = $accessToken;
            // Get infomation of user had logged
            $response = $this->facebook->get(
                '/me?fields=friendlists,id,email,first_name,last_name,picture,posts{created_time,name,likes.limit(0).summary(true)}', 
                $accessToken);
            // Get this User
            $user = $response->getGraphUser();
            
            // Connect to table 'account_social'
            $modelAccount = $this->loadModel('account_social');
            // Connect to table 'post_social'
            $modelPost = $this->loadModel('post_social');
            // Get list post of this User
            $listPost = $user['posts'];
            // Find this User
            $checkUser = $modelAccount->find('all', [
                'conditions' => ['social_id' => $user['id']]
            ])->toArray();
            // Check this User was existed or not
            if (!$checkUser) {
                // If not exist: Insert new User
                $account = $modelAccount->newEntity();
                $insertAccount = $modelAccount->patchEntity($account, [
                    'social_id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'avatar' => $user['picture']['url']
                ]);
                $modelAccount->save($insertAccount);
                // Insert list post of this User
                foreach ($listPost as $post) {
                    $item = $modelPost->newEntity();
                    $likes = $post['likes']->getMetaData();
                    $insertPost = $modelPost->patchEntity($item, [
                        'post_id' => $post['id'],
                        'name' => (isset($post['name'])) ? $post['name'] : '',
                        'created_date' => $post['created_time'],
                        'num_of_like' => $likes['summary']['total_count'],
                        'account_id' => $user['id']
                    ]);
                    $modelPost->save($insertPost);
                }
            } else {
                // If this User had existed: Update list post
                foreach ($listPost as $post) {
                    // Run loop to find every post in list post
                    $checkPost = $modelPost->find('all', [
                        'conditions' => ['post_id' => $post['id']]
                    ])->toArray();
                    // Check this post had existed or not
                    if (!$checkPost) {
                        // If not exist: Insert a new post
                        $item = $modelPost->newEntity();
                        $likes = $post['likes']->getMetaData();
                        $insertPost = $modelPost->patchEntity($item, [
                            'post_id' => $post['id'],
                            'name' => (isset($post['name'])) ? $post['name'] : '',
                            'created_date' => $post['created_time'],
                            'num_of_like' => $likes['summary']['total_count'],
                            'account_id' => $user['id']
                        ]);
                        $modelPost->save($insertPost);
                    }
                }
            }
            $this->redirect(['action' => 'home/', $accessToken]);
        }
    }

    /**
     * Method to display view Home page if login success else redirect to Login page
     * @param string $token is the access token when user log in success.
     * @return void
     */
    public function home($token)
    {
        // Set title for Home page
        $this->set('title', 'Social');
        // Get model for table 'post_social'
        $modelPost = $this->loadModel('post_social');
        // Check this request is POST or not
        if ($this->request->is('post')) {
            // Check button Search by Name is click or not
            if (isset($_POST['btnSearchPostByName'])) {
                // Save this state is Search by Name
                $_SESSION['state'] = 'search-name';
                // Get data input
                $name = htmlspecialchars($this->request->data('txtSearchPostByName'));
                // Save this value for Search by Name
                $_SESSION['name'] = $name;
                // Check input keyword is empty or not
                if (empty($name)) {
                    return $this->Flash->error('Please, enter your keyword to search by name..');
                }
                // Get paginate data in table 'post_social' limit with 5
                $posts = $this->Paginator->paginate(
                    $modelPost->find('all', [
                        'conditions' => ['name LIKE ' => '%' . $name . '%']
                    ]), 
                    ['limit' => 5]
                );
                // Convert array object $posts to array
                $getPosts = $this->getData($posts);
                // Set data for this view
                $this->set(['posts' => $getPosts]);
            // Check button Search by Num of like is click or not
            } else if (isset($_POST['btnSearchPostByLike'])) {
                // Save this state is Search by Num of like
                $_SESSION['state'] = 'search-like';
                // Get data input
                $number = htmlspecialchars($this->request->data('txtSearchPostByLike'));
                // Save this value for Search by Num of like
                $_SESSION['number'] = $number;
                // Check input is a number or not
                if (!is_numeric($number)) {
                    return $this->Flash->error('Please, enter a number to search by num of like..');
                }
                // Get paginate data in table 'post_social' limit with 5
                $posts = $this->Paginator->paginate(
                    $modelPost->find('all', [
                        'conditions' => ['num_of_like' => $number]
                    ]), 
                    ['limit' => 5]
                );
                // Convert array object $posts to array
                $getPosts = $this->getData($posts);
                // Set data for this view
                $this->set(['posts' => $getPosts]);
            } else {
                // Save this state is Search by Date
                $_SESSION['state'] = 'search-date';
                // Get data input
                $from = htmlspecialchars($this->request->data('txtSearchPostFromDate'));
                $to = htmlspecialchars($this->request->data('txtSearchPostToDate'));
                // Save this value for 'Date from'
                $_SESSION['dateFrom'] = $from;
                // Save this value for 'Date to'
                $_SESSION['dateTo'] = $to;
                // Check input 'Date from' and 'Date to' are empty or not
                if (empty($from) || empty($to)) {
                    return $this->Flash->error('The fields of date can not be empty..');
                // Compare input 'Date from' and 'Date to' are correct or not
                } else if ($from > $to) {
                    return $this->Flash->error('Date from can not larger than Date to..');
                } else {
                    // Get paginate data in table 'post_social' limit with 5
                    $posts = $this->Paginator->paginate(
                        $modelPost->find('all')
                        ->where(['created_date >=' => $from, 'created_date <=' => $to]), 
                        ['limit' => 5]
                    );
                    // Convert array object $posts to array
                    $getPosts = $this->getData($posts);
                    // Set data for this view
                    $this->set(['posts' => $getPosts]);
                }   
            }
        // If this request isn't POST: check param $token in URL is correct or not
        } else if (isset($_SESSION['token']) && ($_SESSION['token'] == $token)) {
            // Check session 'state' isn't exists and this URL hasn't variable 'page' 
            if (!isset($_SESSION['state']) || !isset($_GET['page'])) {
                // Save this state is none
                $_SESSION['state'] = 'none';
                // Get paginate data in table 'post_social' limit with 5
                $posts = $this->Paginator->paginate($modelPost->find('all'), ['limit' => 5]);
                // Convert array object $posts to array
                $getPosts = $this->getData($posts);
                // Set data for this view
                $this->set(['posts' => $getPosts]);
            // Check this state is none or searching
            } else if ($_SESSION['state'] != 'none') {
                // Check this state is searching by name or not
                if ($_SESSION['state'] == 'search-name') {
                    // Get paginate data in table 'post_social' limit with 5
                    $posts = $this->Paginator->paginate(
                        $modelPost->find('all', [
                            'conditions' => ['name LIKE ' => '%' . $_SESSION['name'] . '%']
                        ]), 
                        ['limit' => 5]
                    );
                    // Convert array object $posts to array
                    $getPosts = $this->getData($posts);
                    // Set data for this view
                    $this->set(['posts' => $getPosts]);
                // Check this state is searching by num of like or not
                } else if ($_SESSION['state'] == 'search-like') {
                    // Get paginate data in table 'post_social' limit with 5
                    $posts = $this->Paginator->paginate(
                        $modelPost->find('all', [
                            'conditions' => ['num_of_like' => $_SESSION['number']]
                        ]), 
                        ['limit' => 5]
                    );
                    // Convert array object $posts to array
                    $getPosts = $this->getData($posts);
                    // Set data for this view
                    $this->set(['posts' => $getPosts]);
                // Check this state is searching by date or not
                } else if ($_SESSION['state'] == 'search-date') {
                    // Get paginate data in table 'post_social' limit with 5
                    $posts = $this->Paginator->paginate(
                        $modelPost->find('all')
                        ->where([
                            'created_date >=' => $_SESSION['dateFrom'],
                            'created_date <=' => $_SESSION['dateTo']
                        ]), 
                        ['limit' => 5]
                    );
                    // Convert array object $posts to array
                    $getPosts = $this->getData($posts);
                    // Set data for this view
                    $this->set(['posts' => $getPosts]);
                }
            } else {
                // Save this state is none
                $_SESSION['state'] = 'none';
                // Get paginate data in table 'post_social' limit with 5
                $posts = $this->Paginator->paginate($modelPost->find('all'), ['limit' => 5]);
                // Convert array object $posts to array
                $getPosts = $this->getData($posts);
                // Set data for this view
                $this->set(['posts' => $getPosts]);
            }
        } else {
            $this->redirect(['action' => 'login']);
        }
    }

    /**
     * Method to convert every object in array to an array.
     * @param array $data is the array object to convert.
     * @return array $result
     */
    private function getData($data = [])
    {
        $result = [];
        // Run loop to convert object $item to array and add to array $result
        foreach ($data as $item) {
            $result[] = $item->toArray();
        }
        return $result;
    }
}
