<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UserController extends AppController
{
    public function initialize()
    {
        $this->loadModel('User');
        $this->loadComponent('Flash');
    }

    /**
     * Method to displays a Register view
     * @return void
     */
    public function register()
    {
        $this->set('title', 'Register');
        $this->render('register');
    }

    /**
     * Method to handle form register User
     * @return void
     */
    public function postRegister()
    {
        if ($this->request->is('post')) {
            $input = $this->request->getData();
            $validate = $this->User->newEntity($input);

            if ($validate->errors()) {
                $this->set($validate->errors());
            } else if (empty($input['g-recaptcha-response'])) {
                $this->Flash->error('You must confirm the captcha..');
            } else {
                // Google reCaptcha API URL
                $google_url = 'https://www.google.com/recaptcha/api/siteverify';
                // Captcha secret key
                $secret = '6LeaWoIUAAAAAPWIv2CQZJ8bqFMfmzEFk5ekcu2-';

                //Get verify response data
                $verifyResponse = file_get_contents(
                    $google_url. '?secret=' . $secret . '&response=' . $input['g-recaptcha-response']
                );
                // Convert json data to object
                $responseData = json_decode($verifyResponse);
                
                if ($responseData->success) {
                    $user = $this->User->newEntity();
                    $insert = $this->User->patchEntity($user, [
                        'name' => $input['txtName'],
                        'email' => $input['email'],
                        'password' => $input['txtPass'],
                    ]);
                    $this->User->save($insert);
                    $this->Flash->success('Sign up success..');
                } else {
                    $this->Flash->error('Some error had happened with Captcha..');
                }
            }
        }
        $this->register();
    }
}
