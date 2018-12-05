<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PostSocialTable extends Table
{
	/**
     * Method to check post with input id of post.
     * @param string $id is data to check in field 'social_id' of table 'account_social'.
     * @return boolean.
     */
	public function checkPost($id)
	{
		$user = $this->find('all', [
            'conditions' => ['post_id' => $id]
        ])->toArray();
        
        return ($user) ? true : false;
	}

	/**
     * Method to check post with input id of post.
     * @param string $id is data to check in field 'social_id' of table 'account_social'.
     * @return array object.
     */
	public function getAll()
	{
        return $this->find('all');
	}

	/**
     * Method to find name of post.
     * @param string $name is the conditions to check name.
     * @return array object.
     */
	public function findByName($name)
	{
        return $this->find('all', [
        	'conditions' => ['name LIKE ' => '%' . $name . '%']
        ]);
	}

	/**
     * Method to find posts with number of like.
     * @param int $number is the conditions to check number of like.
     * @return array object.
     */
	public function findByNumOfLike($number)
	{
        return $this->find('all', [
        	'conditions' => ['num_of_like ' => $number]
        ]);
	}

	/**
     * Method to find name of post.
     * @param string $from is the condition to check date from.
     * @param string $to is the condition to check date to.
     * @return array object.
     */
	public function findByDate($from, $to)
	{
        return $this->find('all')
            ->where([
                'created_date >=' => $from,
                'created_date <=' => $to
        	]
        );
	}
}