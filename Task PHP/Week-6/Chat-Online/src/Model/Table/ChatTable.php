<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ChatTable extends Table
{
	/**
     * Method to get all room with not duplicate room id
     * @return array object 
     */
	public function getAllRoom()
	{
		return $this->find('all')->distinct('room_id');
	}

	/**
     * Method to get all chat in room
     * @param string $roomId is the room id to get.
     * @return array object 
     */
	public function getAllChatInRoom($roomId)
	{
		return $this->find('all', [
			'conditions' => ['room_id' => $roomId]
		]);
	}

	/**
     * Method to get first chat in room
     * @param string $roomId is the room id to get.
     * @return object
     */
	public function getFirstChatInRoom($roomId)
	{
		return $room = $this->find('all', [
			'conditions' => ['room_id' => $roomId]
		])->first();
	}

	/**
     * Method to add new room to table 'chat'
     * @param array $data.
     * @return void
     */
	public function insert($data = [])
	{
		$room = $this->newEntity();
		$insert = $this->patchEntity($room, [
			'item' => $data['itemId'],
			'shop' => $data['shopId'],
			'client' => $data['clientId'],
			'room_id' => $data['roomId'],
			'message' => $data['message'],
			'message_from' => $data['messageFrom'],
			'readed' => $data['readed']
		]);
		$this->save($insert);
	}
}