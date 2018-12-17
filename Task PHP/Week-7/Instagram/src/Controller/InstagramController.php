<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Instagram\Utility\InstagramClient;
//use Bolandish\Instagram;
//use Andreyco\Instagram\Client;
//use InstagramAPI\Instagram;

class InstagramController extends AppController
{
    private $insta;
    public function initialize()
    {
        $config = [
            'clientId' => '20d91121f31b4cce9bf4ee1d7a915715',
            'clientSecret' => '569c4b6458184bc7b4393107b74bba19',
            'redirectUri' => 'http://localhost' . $this->request->base . '/callback'
        ];
        Configure::write('Instagram.config', $config);
        $this->insta = new InstagramClient(Configure::read('Instagram.config'));

        /*$this->insta = new Client([
			'apiKey'      => '20d91121f31b4cce9bf4ee1d7a915715',
			'apiSecret'   => '569c4b6458184bc7b4393107b74bba19',
			'apiCallback' => 'http://localhost' . $this->request->base . '/callback',
			'scope'       => ['basic', 'public_content', 'follower_list'],
        ]);*/

        /*$this->insta = new Instagram(false, false, [
        	'storage'    => 'mysql',
			'dbhost'     => 'localhost',
			'dbname'     => 'cakephp_instagram',
			'dbusername' => 'root',
			'dbpassword' => ''
        ]);*/
    }

    /**
     * Displays a view
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
    	$urlLogin = $this->insta->getLoginUrl();
    	$this->set(['title' => 'Login', 'url' => $urlLogin]);
        $this->render('login');
    }

    public function callback()
    {
    	/*$code = $_GET['code'];
    	$tag = '一起趣日本吃美食';
    	$data = $this->insta->getOAuthToken($code);
    	$this->insta->setAccessToken($data->access_token);
    	$search = $this->insta->searchTags($tag);
    	echo var_dump($search);*/

    	$respone = $this->insta->getAccessToken(
    		$this->request->query('code'), 
    		'http://localhost' . $this->request->base . '/callback'
    	);
    	$accessToken = $respone->access_token;
    	$this->insta->accessToken($accessToken);
    	$tag = '一起趣日本吃美食';
    	$url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?access_token='.$accessToken.'&&count=2';

    	//$test = Instagram::getMediaByHashtag("nofilter", 10);
    	$photos = $this->getCurl($url);
    	echo var_dump($photos);
        //$this->redirect(['controller' => 'Instagram', 'action' => 'home?code=' . $accessToken]);
        $this->render('home');
    }

    public function getCurl($url)
    {
    	$curl = curl_init(); // initializing
		curl_setopt($curl, CURLOPT_URL, $url); // API URL to connect
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // return the result, do not print
		curl_setopt($curl, CURLOPT_TIMEOUT, 20);
		$result = curl_exec($curl); // connect and get json data
		curl_close($curl); // close connection
		return json_decode($result); // decode and return
		//return $result;
    }

    public function home()
    {
    	/*$this->insta->accessToken($this->request->query('code'));
    	$user = $this->insta->getMedia();
    	echo var_dump($user);*/
    	$this->set('title', 'Home');
        $this->render('home');
    }
}
