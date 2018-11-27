<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TblStaffTable extends Table
{
	/**
     * Method to check validate data of CSV file
     * @param array $data is the input of CSV file data request.
     * @return array $errors
     */
	public function validateImport($data = [])
	{
		$valid = new Validator();
		$valid->maxLength('id', 11, 'The ID length must less than 11 character..')
			->numeric('id', 'This ID is not a number..')
			->email('email', true, 'Email format are not correct..')
			->maxLength('email', 100, 'The Email length must less than 100 character..')
			->notEmpty('fileImport', 'File import cannot be null')
			->add('fileImport', [
	            'wrongExtension' => [
	                'rule' => ['extension', ['csv']],
	                'message' => 'These files extension are allowed: .csv'
	            ]
        	]);
        $errors = $valid->errors($data);
        if (isset($data['email'])) {
        	$findEmail = $this->find('all', [
	            'conditions' => ['email' => $data['email']]
	        ])->toArray();
	        if ($findEmail != null) {
	            $errors['email']['existEmail'] = 'This email was already exist..';
	        }
        }
        return $errors;
	}
}