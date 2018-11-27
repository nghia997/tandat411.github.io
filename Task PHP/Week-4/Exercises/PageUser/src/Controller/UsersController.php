<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\EntityInterface;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\I18n\Time;

/**
 * Static content controller
 * This controller will render views from Template/Users/
 */
class UsersController extends AppController
{

    /**
     * Method to display a view of Index page
     * @return void
     */
    public function index()
    {
        $listUser = [];
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'asc']
        ];
        // Check this request is POST or not
        if ($this->request->is('post')) {
            // Get all data request to array $input
            $input = ['txtSearch' => htmlspecialchars($this->request->data('txtSearch'))];
            // Check validate all data request
            $validation = $this->Users->validateSearch($input);
            // Check validate has errors or not
            if ($validation != null) {
                $this->set($validation);
            } else {
                // Format data to return data paginate
                $this->paginate = [
                    'limit' => 20,
                    'order' => ['id' => 'asc'],
                    'conditions' => [
                        'OR' => [
                            'id' => $input['txtSearch'],
                            'name LIKE' => '%' . $input['txtSearch'] . '%',
                            'email LIKE' => '%' . $input['txtSearch'] . '%',
                            'address LIKE' => '%' . $input['txtSearch'] . '%',
                            'sex LIKE' => '%' . $input['txtSearch'] . '%',
                            'status LIKE' => '%' . $input['txtSearch'] . '%'
                        ]
                    ]
                ];
                $users = $this->paginate()->toArray();
                // Run loop for to make every object to array then add to array $listUser
                for ($i = 0; $i < count($users); $i++) {
                    $listUser[] = $users[$i]->toArray();
                }
                $this->set(['users' => $listUser]);
            }
        } else {
            $users = $this->paginate()->toArray();
            for ($i = 0; $i < count($users); $i++) {
                $listUser[] = $users[$i]->toArray();
            }
            $this->set(['users' => $listUser]);
        }
    }

    /**
     * Method to display a view of Login page
     * @return void
     */
    public function login()
    {
        // Check this request is POST or not
        if ($this->request->is('post')) {
            // Get all data request to array $input
            $input = [
                'email' => htmlspecialchars($this->request->data('email')),
                'password' => htmlspecialchars($this->request->data('password'))
            ];
            // Check validate all data request
            $validation = $this->Users->validateLogin($input);
            // Check validate has errors or not
            if ($validation != null) {
                $this->set($validation);
            } else {
                // Find this user with fields email and password
                $user = $this->Auth->identify();
                // Check this user is exist or not
                if ($user) {
                    // Check this account is active or not with value = 0 -> not active
                    if ($user['active'] != 0) {
                        $thisUser = $this->Users->get($user['id']);
                        // Check the first login time is set or not
                        if ($thisUser->first_login_time == null) {
                            $thisUser->first_login_time = date('Y-m-d H:i:s');
                        }
                        $thisUser->last_login_time = date('Y-m-d H:i:s');
                        $thisUser->num_of_login += 1;
                        $thisUser->status = 'online';
                        $this->Users->save($thisUser);
                        $this->Auth->setUser($user);
                        // After login: redirect to welcome page
                        $this->redirect(['controller' => 'Users', 'action' => 'welcome']);
                    } else {
                        $this->Flash->error('This account need to active. 
                            Please, check your email to verification this account..');
                    }
                } else {
                    $this->Flash->error('Username or password are not correct..');
                }
            }
        }
    }

    /**
     * Method to Logout
     * @return void
     */
    public function logout()
    {
        // Get user had logged
        $user = $_SESSION['Auth']['User'];
        $thisUser = $this->Users->get($user['id']);
        $thisUser->status = 'offline';
        $this->Users->save($thisUser);
        $this->Auth->logout();
        // After logout: redirect to login page
        $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Method to display a view of Change Password page
     * @return void
     */
    public function changePassword()
    {
        // Get id of user had logged
        $id = $_SESSION['Auth']['User']['id'];
        $user = $this->Users->get($id);
        // Check this request is POST or not
        if ($this->request->is('post')) {
            // Get all data request to array $input
            $input = [
                'currentPass' => $user->password,
                'txtOldPass' => htmlspecialchars($this->request->data('txtOldPass')),
                'txtNewPass' => htmlspecialchars($this->request->data('txtNewPass')),
                'txtConfirmPass' => htmlspecialchars($this->request->data('txtConfirmPass'))
            ];
            // Check validate all data request
            $validation = $this->Users->validateChangePassword($input);
            // Check validate has errors or not
            if ($validation != null) {
                $this->set($validation);
            } else {
                $user->password = $input['txtNewPass'];
                // Check change password is success or not
                if ($this->Users->save($user)) {
                    $this->Flash->success('Change password success.');
                } else {
                    $this->Flash->error('Cannot change new password. Please, try again.');
                }
            }
        }
    }

    /**
     * Method to display a view of Register page
     * @return void
     */
    public function register()
    {
        // Create a new User
        $user = $this->Users->newEntity();
        // Check this request is POST or not
        if ($this->request->is('post')) {
            // Get all data request to array $input
            $input = [
                'txtAvatar' => $this->request->data('txtAvatar'),
                'txtName' => htmlspecialchars($this->request->data('txtName')),
                'txtSex' => htmlspecialchars($this->request->data('txtSex')),
                'txtAddress' => htmlspecialchars($this->request->data('txtAddress')),
                'txtEmail' => htmlspecialchars($this->request->data('txtEmail')),
                'txtPhone' => htmlspecialchars($this->request->data('txtPhone')),
                'txtPass' => htmlspecialchars($this->request->data('txtPass')),
                'txtConfirmPass' => htmlspecialchars($this->request->data('txtConfirmPass'))
            ];
            // Check validate all data request
            $validation = $this->Users->validateRegister($input);
            // Check validate has errors or not
            if ($validation != null) {
                $this->set($validation);
            } else {
                // Generate random key
                $randomKey = substr(md5(microtime()), 0, 10);
                // Put the key to array $input
                $input['key'] = $randomKey;
                // Create a link to help user active email
                $activeLink = Router::url([
                    "controller" => "Users",
                    "action" => "active/" . $randomKey
                ], true);
                // Move file upload to webroot
                $file = $_FILES['txtAvatar'];
                $fileName = $file['name'];
                move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
                // Bind data to new user
                $insert = $this->Users->patchEntity($user, [
                    'name' => $input['txtName'],
                    'sex' => $input['txtSex'],
                    'email' => $input['txtEmail'],
                    'password' => $input['txtPass'],
                    'avatar' => $fileName,
                    'address' => $input['txtAddress'],
                    'phone' => $input['txtPhone'],
                    'num_of_login' => 0,
                    'status' => 'offline',
                    'active_key' => $input['key'],
                    'active' => 0
                ]);
                // Check insert new user are success or not
                if ($this->Users->save($insert)) {
                    // Send mail to input email of user
                    $email = new Email();
                    $email->transport('gmail');
                    $message = "Dear {$input['txtName']},<br>";
                    $message .= "Thank you for join with us. Your active link below:<br>";
                    $message .= "<a href='" . $activeLink . "'>Verify this account</a>";
                    $email->emailFormat('html')
                        ->from(['1551010024.dat@gmail.com' => 'Tấn Đạt'])
                        ->to($input['txtEmail'])
                        ->subject('Active your account')
                        ->send($message);
                    $this->Flash->success('Sign up success. Please, check your email for this account verification..');
                } else {
                    $this->Flash->error('The user could not be create. Please, try again.');
                }
            }
        }
    }

    /**
     * Method to display a view of Register page
     * @param string $code is the key to active user account.
     * @return void
     */
    public function active($code)
    {
        $key = htmlspecialchars($code);
        $user = $this->Users->find('all', [
            'conditions' => [
                'active_key' => $key,
                'active' => 0
            ]
        ])->toArray();
        // Check this user is exist or not
        if ($user) {
            // Update this user
            $thisUser = $this->Users->get($user[0]['id']);
            $thisUser->active = 1;
            $this->Users->save($thisUser);
        } else {
            // Active fail: redirect to login page
            $this->redirect(['controller' => 'Users', 'action' => 'login']);
            $this->Flash->error('Something has wrong, your email was not active.');
        }
    }

    /**
     * Method to display a view of Edit page
     * @return void
     */
    public function edit()
    {
        $id = htmlspecialchars($this->request->getParam('id'));
        $user = $this->Users->find('all', [
            'conditions' => ['id' => $id]
        ])->toArray();
        // Check this user is exist or not
        if ($user) {
            $user = $this->Users->get($id);
            // Check this request is POST or not
            if ($this->request->is('post')) {
                // Get all data request to array $input
                $input = [
                    'txtAvatar' => $this->request->data('txtAvatar'),
                    'txtName' => htmlspecialchars($this->request->data('txtName')),
                    'txtSex' => htmlspecialchars($this->request->data('txtSex')),
                    'txtAddress' => htmlspecialchars($this->request->data('txtAddress')),
                    'txtEmail' => htmlspecialchars($this->request->data('txtEmail')),
                    'txtPhone' => htmlspecialchars($this->request->data('txtPhone'))
                ];
                // Check validate all data request
                $validation = $this->Users->validateEdit($input);
                // Check validate has errors or not
                if ($validation != null) {
                    $this->set($validation);
                } else {
                    // Check has file input or not
                    if ($input['txtAvatar']['size'] != 0) {
                        // Move file upload to webroot
                        $file = $_FILES['txtAvatar'];
                        $fileName = $file['name'];
                        move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
                        $user->avatar = $fileName;
                    }
                    $user->name = $input['txtName'];
                    $user->sex = $input['txtSex'];
                    $user->address = $input['txtAddress'];
                    $user->email = $input['txtEmail'];
                    $user->phone = $input['txtPhone'];
                    // Check update this user is success or not
                    if ($this->Users->save($user)) {
                        $this->Flash->success('Edit user success.');
                    } else {
                        $this->Flash->error('Cannot edit user. Please, try again.');
                    }
                }
            }
            $this->set(['user' => $user]);
        } else {
            // User not exist: redirect to login page
            $this->redirect('/');
            $this->Flash->error('That page is not exist.');
        }
    }

    /**
     * Method to display a view of Welcome page when user login success
     * @return void
     */
    public function welcome()
    {
    }

    /**
     * Method to display a view of Infomation page
     * @return void
     */
    public function info()
    {
        $id = htmlspecialchars($this->request->getParam('id'));
        $user = $this->Users->find('all', [
            'conditions' => ['id' => $id]
        ])->toArray();
        // Check this user is exist or not
        if ($user) {
            $this->set(['user' => $user[0]]);
        } else {
            // User not exist: redirect to login page
            $this->redirect('/');
            $this->Flash->error('That user is not exist.');
        }
    }

    /**
     * Method to delete a user
     * @return void
     */
    public function delete()
    {
        $id = htmlspecialchars($this->request->getParam('id'));
        $user = $this->Users->find('all', [
            'conditions' => ['id' => $id]
        ])->toArray();
        // Check this user is exist or not
        if ($user) {
            $thisUser = $this->Users->get($id);
            // Check delete this user is success or not
            if ($this->Users->delete($thisUser)) {
                // After delete user: redirect to login page
                $this->redirect('/');
                $this->Flash->success('Delete user success.');
            } else {
                // Delete fail: redirect to login page
                $this->redirect('/');
                $this->Flash->error('Cannot delete this user. Please, try again.');
            }
        } else {
            // User is not exist: redirect to login page
            $this->redirect('/');
            $this->Flash->error('That user is not exist.');
        }
    }
}
