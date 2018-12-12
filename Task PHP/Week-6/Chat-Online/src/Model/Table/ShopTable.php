<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class ShopTable extends Table
{
	/**
     * Method to check account of Shop is exist or not
     * @param array $data is input data email and password.
     * @return object 
     */
	public function checkLoginForShop($data = [])
	{
		$shop = $this->find('all', [
			'conditions' => [
				'email' => $data['email']
			]
		])->first();
		// Check this shop exist or not and compare input password with pass word of shop if exist.
		return ($shop && (new DefaultPasswordHasher)->check($data['password'], $shop->password)) ? $shop : null;
	}
}