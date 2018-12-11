<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class Client extends Entity
{
	protected function _setPassword($password)
	{
		if (strlen($password) > 0) {
			return (new DefaultPasswordHasher)->hash($password);
		}
	}
}