<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

class UserTable extends Table
{
	public function validationDefault(Validator $validate)
	{
		$validate
			->notEmpty('txtName', 'Your name must not be empty..')
			->notEmpty('email', 'Your email must not be empty..')
			->notEmpty('txtPass', 'Your password must not be empty..')
			->email('email', true, 'Email format are not correct..')
			->minLength('txtPass', 6, 'The length must larger 6 character..')
			->minLength('txtConfirmPass', 6, 'The length must larger 6 character..')
			->add('txtPass', [
                'compare' => [
                    'rule' => ['compareWith', 'txtConfirmPass'],
                    'message' => 'Confirm passwords are not equal..'
                ]
            ])
			->add('email', [
			    'unique' => [
			        'rule' => 'validateUnique',
			        'provider' => 'table',
			        'message' => 'This email was existed..'
			    ]
			]);
		return $validate;
	}
}