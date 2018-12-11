<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

class ClientTable extends Table
{
	/**
     * Method add new record to table 'Client'
     * @param array $data
     * @return void
     */
	public function insert($data = [])
	{
		$client = $this->newEntity();
		$insert = $this->patchEntity($client, [
			'name' => $data['txtName'],
			'email' => $data['email'],
			'password' => $data['txtPass'],
			'address' => $data['txtAddress'],
			'phone' => $data['txtPhone']
		]);
		$this->save($insert);
	}

	/**
     * Method to check validate login.
     * @param object $validator to make rule of this validate
     * @return object $validator
     */
	public function validationLogin(Validator $validator)
	{
		$validator
			->notEmpty('email', 'Your email must not be empty..')
			->email('email', true, 'Email format are not correct..');
		$validator
			->notEmpty('password', 'Your password must not be empty..')
			->minLength('password', 6, 'The length must larger 6 character..');
		return $validator;
	}

	/**
     * Method to check validate default for all page.
     * @param object $validator to make rule of this validate
     * @return object $validator
     */
	public function validationDefault(Validator $validator)
	{
		$validator->notEmpty('txtName', 'Your name must not be empty..');
		$validator->notEmpty('txtAddress', 'Your email must not be empty..');
		$validator
			->notEmpty('email', 'Your email must not be empty..')
			->email('email', true, 'Email format are not correct..')
			->add('email', [
			    'unique' => [
			        'rule' => 'validateUnique',
			        'provider' => 'table',
			        'message' => 'This email was existed..'
			    ]
			]);
		$validator
			->notEmpty('txtPhone', 'Your email must not be empty..')
			->numeric('txtPhone', 'This is not a number..');
		$validator
			->notEmpty('txtPass', 'Your password must not be empty..')
			->minLength('txtPass', 6, 'The length must larger 6 character..')
			->minLength('txtConfirmPass', 6, 'The length must larger 6 character..')
            ->add('txtPass', [
                'compare' => [
                    'rule' => ['compareWith', 'txtConfirmPass'],
                    'message' => 'Confirm passwords are not equal..'
                ]
            ]);
		return $validator;
	}
}