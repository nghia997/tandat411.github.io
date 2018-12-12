<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class PagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Shop');
        $this->loadModel('Client');
        $this->loadModel('Item');
        $this->loadModel('Chat');
        $this->loadComponent('RequestHandler');
    }

    /**
     * Method to display view Home page
     * @return void
     */
    public function home()
    {
        $listItem = $this->Item->getAll();
        $this->set(['title' => 'Home', 'items' => $listItem]);
        $this->render('home');
    }

    /**
     * Method to display view Index page
     * @return void
     */
    public function index()
    {
        $groups = $this->Chat->getAllRoom();
        $this->set(['title' => 'Chat Online', 'groups' => $groups]);
        $this->render('index');
    }

    /**
     * Method to display view and create Room chat for client
     * @param int $itemId to create room chat.
     * @return void
     */
    public function room($itemId)
    {
        $this->set('title', 'Chat room');
        $client = $this->request->getSession()->read('Auth.User');
        $item = $this->Item->findItemById($itemId);
        $shop = $this->Shop->get($item->shop);

        if ($item != null) {
            // Create new room id
            $roomId = $client['name'] . $client['id'] . $item->id;
            // Check this Room has exist or not. If not, create new Room
            if (!$this->Chat->getFirstChatInRoom($roomId)) {
                $data = [
                    'itemId' => $item->id ,
                    'shopId' => $item->shop, 
                    'clientId' => $client['id'],
                    'roomId' => $roomId,
                    'message' => '',
                    'messageFrom' => '',
                    'readed' => 0
                ];
                $this->Chat->insert($data);
            }

            $listChat = $this->Chat->getAllChatInRoom($roomId);
            $this->set([
                'item' => $item, 
                'shop' => $shop,
                'client' => $client,
                'chats' => $listChat, 
                'roomId' => $roomId
            ]);
            $this->render('room');
        } else {
            $this->redirect(['controller' => 'Pages', 'action' => 'home']);
        }
    }

    /**
     * Method to display view Login page
     * @return void
     */
    public function login()
    {
        $this->set('title', 'Login');
        $this->render('login');
    }

    /**
     * Method to check login of Client and Shop
     * @return void
     */
    public function postLogin()
    {
        if ($this->request->is('post')) {
            $input = $this->request->getData();
            // Check validate login of input data
            $validate = $this->Client->newEntity($input, ['validate' => 'login']);

            // Check this validate had error or not
            if ($validate->errors()) {
                $this->set($validate->errors());
            // Check login by account of Shop and redirect to Index page if success
            } else if ($shop = $this->Shop->checkLoginForShop($input) != null) {
                // Change to Model Shop to check authenticate.
                $this->Auth->config('authenticate', [
                    'Form' => ['userModel' => 'Shop']
                ]);

                $shop = $this->Auth->identify();
                $this->Auth->setUser($shop);

                return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
            // Check login by account of Client and redirect to Index page if success
            } else if ($client = $this->Auth->identify()) {
                $this->Auth->setUser($client);
                return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
            } else {
                $this->Flash->error('Username or password are not correct..');
            }
            $this->login();
        }
    }

    /**
     * Method to logout account and return to login page
     * @return void
     */
    public function logout()
    {
        $this->Auth->logout();
        $this->login();
    }

    /**
     * Method to display view Register page
     * @return void
     */
    public function register()
    {
        $this->set('title', 'Register');
        $this->render('register');
    }

    /**
     * Method to add a new Client
     * @return void
     */
    public function postRegister()
    {
        if ($this->request->is('post')) {
            $input = $this->request->getData();
            $validate = $this->Client->newEntity($input);

            if ($validate->errors()) {
                $this->set($validate->errors());
            } else {
                $this->Client->insert($input);
                $this->Flash->success('Sign up success');
            }
            $this->register();
        }
    }
}
