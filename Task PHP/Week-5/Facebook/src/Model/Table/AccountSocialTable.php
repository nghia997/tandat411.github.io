<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AccountSocialTable extends Table
{
	/**
     * Method to check user with input id of user.
     * @param string $id is data to check in field 'social_id' of table 'account_social'.
     * @return boolean.
     */
	public function checkUser($id)
	{
		$user = $this->find('all', [
            'conditions' => ['social_id' => $id]
        ])->toArray();
        
        return ($user) ? true : false;
	}

    
}