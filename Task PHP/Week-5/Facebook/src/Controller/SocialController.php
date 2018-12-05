<?php

namespace App\Controller;

use App\Model\Table\AccountSocialTable;
use App\Model\Table\PostSocialTable;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
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
    private $session;
    private $listPost;

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AccountSocial');
        $this->loadModel('PostSocial');
        $this->loadComponent('Paginator');
        $this->session = $this->getRequest()->getSession();
        $this->listPost = 
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
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
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
            $this->session->write('token', $accessToken);

            // Get infomation of user had logged
            $response = $this->facebook->get(
                '/me?fields=friendlists,id,email,first_name,last_name,picture,posts{created_time,name,likes.limit(0).summary(true)}', 
                $accessToken);
            // Get this User
            $user = $response->getGraphUser();
            // Get list post of this User
            $listPost = $user['posts'];

            // Check this User was existed or not
            if (!$this->AccountSocial->checkUser($user['id'])) {
                // If not exist: Insert new User
                $account = $this->AccountSocial->newEntity();
                $insertAccount = $this->AccountSocial->patchEntity($account, [
                    'social_id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'avatar' => $user['picture']['url']
                ]);

                $this->AccountSocial->save($insertAccount);
                // Insert list post of this User
                foreach ($listPost as $post) {
                    $item = $this->PostSocial->newEntity();
                    $likes = $post['likes']->getMetaData();
                    $insertPost = $this->PostSocial->patchEntity($item, [
                        'post_id' => $post['id'],
                        'name' => (isset($post['name'])) ? $post['name'] : '',
                        'created_date' => $post['created_time'],
                        'num_of_like' => $likes['summary']['total_count'],
                        'account_id' => $user['id']
                    ]);
                    $this->PostSocial->save($insertPost);
                }
            } else {
                /*
                 * If this User had existed: Update list post
                 * Run loop to find every post in list post
                 */
                foreach ($listPost as $post) {
                    // Check this post had existed or not
                    if (!$this->PostSocial->checkPost($post['id'])) {
                        // If not exist: Insert a new post
                        $item = $this->PostSocial->newEntity();
                        $likes = $post['likes']->getMetaData();
                        $insertPost = $this->PostSocial->patchEntity($item, [
                            'post_id' => $post['id'],
                            'name' => (isset($post['name'])) ? $post['name'] : '',
                            'created_date' => $post['created_time'],
                            'num_of_like' => $likes['summary']['total_count'],
                            'account_id' => $user['id']
                        ]);
                        $this->PostSocial->save($insertPost);
                    }
                }
            }
            $this->redirect(['action' => 'getHome/', $accessToken]);
        }
    }

    /**
     * Method to display view Home page if login success else redirect to Login page
     * @param string $token is the access token when user log in success.
     * @return void
     */
    public function getHome($token)
    {
        // Set title for Home page
        $this->set('title', 'Social');

        // If this request isn't POST: check param $token in URL is correct or not
        if ($this->session->read('token') && ($this->session->read('token') == $token)) {
            // Check session 'state' isn't exists and this URL hasn't variable 'page' 
            if (!isset($_GET['state']) || (!isset($_GET['page']) && $_GET['state'] == 'none')) {
                // Save this state is none
                $_GET['state'] = 'none';
                // Get paginate data in table 'post_social' limit with 5
                $posts = $this->Paginator->paginate(
                    $this->PostSocial->getAll(), 
                    ['limit' => 5]
                );
                // Convert array object $posts to array
                $getPosts = $this->getData($posts);
                $this->set(['posts' => $getPosts]);
            // Check this state is none or searching
            } else if ($_GET['state'] != 'none') {
                // Check this state is searching by name or not
                if ($_GET['state'] == 'search-name' && isset($_GET['name'])) {
                    // Get paginate data in table 'post_social' limit with 5
                    $posts = $this->Paginator->paginate(
                        $this->PostSocial->findByName($_GET['name']), 
                        ['limit' => 5]
                    );
                    // Convert array object $posts to array
                    $getPosts = $this->getData($posts);
                    $this->set(['posts' => $getPosts]);
                // Check this state is searching by num of like or not
                } else if ($_GET['state'] == 'search-like' && isset($_GET['number'])) {
                    // Get paginate data in table 'post_social' limit with 5
                    $posts = $this->Paginator->paginate(
                        $this->PostSocial->findByNumOfLike($_GET['number']), 
                        ['limit' => 5]
                    );
                    // Convert array object $posts to array
                    $getPosts = $this->getData($posts);
                    // Set data for this view
                    $this->set(['posts' => $getPosts]);
                // Check this state is searching by date or not
                } else if ($_GET['state'] == 'search-date' && isset($_GET['dateFrom']) && isset($_GET['dateTo'])) {
                    // Get paginate data in table 'post_social' limit with 5
                    $posts = $this->Paginator->paginate(
                        $this->PostSocial->findByDate($_GET['dateFrom'], $_GET['dateTo']), 
                        ['limit' => 5]
                    );

                    // Convert array object $posts to array
                    $getPosts = $this->getData($posts);
                    $this->set(['posts' => $getPosts]);
                }
            } else {
                // Save this state is none
                $_GET['state'] = 'none';
                // Get paginate data in table 'post_social' limit with 5
                $posts = $this->Paginator->paginate($this->PostSocial->find('all'), ['limit' => 5]);
                // Convert array object $posts to array
                $getPosts = $this->getData($posts);
                $this->set(['posts' => $getPosts]);
            }
            $this->render('home');
        } else {
            $this->redirect(['action' => 'login']);
        }
    }

    /**
     * Method to processing data requirements with HTTP method POST of Home page
     * @return void
     */
    public function postHome()
    {
        if ($this->request->is('post')) {
            // Check button Search by Name is click or not
            if (isset($_POST['btnSearchPostByName'])) {
                $name = htmlspecialchars($this->request->data('txtSearchPostByName'));

                if (empty($name)) {
                    $this->Flash->error('Please, enter your keyword to search by name..');
                }
                // Get paginate data in table 'post_social' limit with 5
                $posts = $this->Paginator->paginate($this->PostSocial->findByName($name), ['limit' => 5]);
                // Convert array object $posts to array
                $getPosts = $this->getData($posts);
                $this->set(['posts' => $getPosts]);

                $this->redirect([
                    'controller' => 'Social', 'action' => 'getHome', 
                    $this->session->read('token'), 
                    'state' => 'search-name',
                    'name' => $name
                ]);
            // Check button Search by Num of like is click or not
            } else if (isset($_POST['btnSearchPostByLike'])) {
                $number = htmlspecialchars($this->request->data('txtSearchPostByLike'));

                // Check input is a number or not
                if (!is_numeric($number)) {
                    $this->Flash->error('Please, enter a number to search by num of like..');
                }
                // Get paginate data in table 'post_social' limit with 5
                $posts = $this->Paginator->paginate($this->PostSocial->findByNumOfLike($number), ['limit' => 5]);
                // Convert array object $posts to array
                $getPosts = $this->getData($posts);
                $this->set(['posts' => $getPosts]);

                $this->redirect([
                    'controller' => 'Social', 'action' => 'getHome', 
                    $this->session->read('token'), 
                    'state' => 'search-like',
                    'number' => $number
                ]);
            } else {
                $from = htmlspecialchars($this->request->data('txtSearchPostFromDate'));
                $to = htmlspecialchars($this->request->data('txtSearchPostToDate'));

                if (empty($from) || empty($to)) {
                    $this->Flash->error('The fields of date can not be empty..');
                } else if ($from > $to) {
                    $this->Flash->error('Date from can not larger than Date to..');
                } else {
                    // Get paginate data in table 'post_social' limit with 5
                    $posts = $this->Paginator->paginate($this->PostSocial->findByDate($from, $to), ['limit' => 5]);

                    // Convert array object $posts to array
                    $getPosts = $this->getData($posts);
                    $this->set(['posts' => $getPosts]);
                }
                $this->redirect([
                    'controller' => 'Social', 'action' => 'getHome', 
                    $this->session->read('token'), 
                    'state' => 'search-date',
                    'dateFrom' => $from,
                    'dateTo' => $to
                ]);
            }
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
