<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    /**
     * Method to check validate of Index page
     * @param array $data is the input of all data request.
     * @return array $errors
     */
	public function validateSearch($data = [])
	{
		$valid = new Validator();
        $valid->notEmpty('txtSearch', 'Please, enter your keyword..');
        $errors = $valid->errors($data);
        return $errors;
	}

    /**
     * Method to check validate of Login page
     * @param array $data is the input of all data request.
     * @return array $errors
     */
    public function validateLogin($data = [])
    {
        $valid = new Validator();
        $valid
        ->notEmpty('email', 'Your email must not be empty..')
        ->notEmpty('password', 'Your password must not be empty..')
        ->minLength('password', 6, 'The length must larger 6 character..')
        ->email('email', true, 'Email format are not correct..');
        $errors = $valid->errors($data);
        return $errors;
    }

    /**
     * Method to check validate of Register page
     * @param array $data is the input of all data request.
     * @return array $errors
     */
	public function validateRegister($data = [])
	{
		$valid = new Validator();
        $valid
        ->notEmpty('txtAvatar', 'Your avatar must not be empty..')
        ->notEmpty('txtName', 'Your username must not be empty..')
        ->notEmpty('txtAddress', 'Your address must not be empty..')
        ->notEmpty('txtEmail', 'Your email must not be empty..')
        ->notEmpty('txtPhone', 'Your phone must not be empty..')
        ->notEmpty('txtPass', 'Your password must not be empty..')
        ->notEmpty('txtConfirmPass', 'Please, confirm your password..')
        ->email('txtEmail', true, 'Email format are not correct..')
        ->numeric('txtPhone', 'This is not a number..')
        ->minLength('txtPass', 6, 'The length must larger 6 character..')
        ->minLength('txtConfirmPass', 6, 'The length must larger 6 character..')
        ->add('txtPass', [
            'compare' => [
                'rule' => ['compareWith', 'txtConfirmPass'],
                'message' => 'Confirm passwords are not equal..'
            ]
        ])
        ->add('txtAvatar', [
                'wrongExtension' => [
                    'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']], 
                    'message' => 'These files extension are allowed: .png, .jpeg, .jpg, .gif']]);
        $errors = $valid->errors($data);
        $findEmail = $this->find('all', [
            'conditions' => ['email' => $data['txtEmail']]
        ])->toArray();
        if ($findEmail != null) {
            $errors['txtEmail']['existEmail'] = 'This email was already exist..';
        }
        return $errors;
	}

    /**
     * Method to check validate of Edit page
     * @param array $data is the input of all data request.
     * @return array $errors
     */
    public function validateEdit($data = [])
    {
        $valid = new Validator();
        $valid
        ->allowEmpty('txtAvatar')
        ->notEmpty('txtName', 'Your username must not be empty..')
        ->notEmpty('txtAddress', 'Your address must not be empty..')
        ->notEmpty('txtEmail', 'Your email must not be empty..')
        ->notEmpty('txtPhone', 'Your phone must not be empty..')
        ->email('txtEmail', true, 'Email format are not correct..')
        ->numeric('txtPhone', 'This is not a number..')
        ->add('txtAvatar', [
                'wrongExtension' => [
                    'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']], 
                    'message' => 'These files extension are allowed: .png, .jpeg, .jpg, .gif']]);
        $errors = $valid->errors($data);
        // Find input email
        $findEmail = $this->find('all', [
            'conditions' => ['email' => $data['txtEmail']]
        ])->toArray();
        // Check input email are exist or not
        if ($findEmail != null) {
            $errors['txtEmail']['existEmail'] = 'This email was already exist..';
        }
        return $errors;
    }

    /**
     * Method to check validate of Change Password page
     * @param array $data is the input of all data request.
     * @return array $errors
     */
    public function validateChangePassword($data = [])
    {
        $valid = new Validator();
        $valid
        ->notEmpty('txtOldPass', 'Your current password must not be empty..')
        ->notEmpty('txtNewPass', 'Your new password must not be empty..')
        ->notEmpty('txtConfirmPass', 'Please, confirm your new password..')
        ->minLength('txtOldPass', 6, 'The length must larger 6 character..')
        ->minLength('txtNewPass', 6, 'The length must larger 6 character..')
        ->minLength('txtConfirmPass', 6, 'The length must larger 6 character..')
        ->add('txtNewPass', [
            'compare' => [
                'rule' => ['compareWith', 'txtConfirmPass'],
                'message' => 'Confirm new password are not equal..'
            ]
        ]);
        $errors = $valid->errors($data);
        // Compare input old password and current password are equal or not
        if (!password_verify($data['txtOldPass'], $data['currentPass'])) {
            $errors['txtOldPass']['compare'] = 'This password is not current password..';
        }
        return $errors;
    }
}