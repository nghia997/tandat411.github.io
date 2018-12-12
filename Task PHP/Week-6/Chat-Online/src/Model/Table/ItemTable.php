<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ItemTable extends Table
{
	/**
     * Method to get all item
     * @return array object
     */
	public function getAll()
	{
		return $this->find('all');
	}

	/**
     * Method to find an exist item
     * @param int $id is the id of item
     * @return object $item if exist else return null
     */
	public function findItemById($id)
	{
		$item = $this->find('all', [
			'conditions' => ['id' => $id]
		])->first();

		return ($item) ? $item : null ;
	}
}