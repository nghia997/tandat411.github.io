<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class AjaxController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadModel('Chat');
		$this->loadModel('Item');
		$this->loadModel('Shop');
		$this->loadModel('Client');
	}

	/**
     * Method to add a new chat
     * @return void
     */
	public function sendMessage()
	{
        if ($this->request->is('ajax')) {
            $data = $this->request->getData();
            $client = $this->Client->get($data['clientId']);
            $item = $this->Item->get($data['itemId']);
            $input = [
                'itemId' => $item->id,
                'shopId' => $item->shop,
                'clientId' => $client->id,
                'roomId' => $data['roomId'],
                'message' => htmlspecialchars($data['message']),
                'messageFrom' => $data['messageFrom'],
                'readed' => ($data['messageFrom'] == 'shop') ? 1 : 0
            ];
            $this->Chat->insert($input);
            // Update message of room chat
            $this->getMessage();
        }
	}

	/**
     * Method to load all message of request from Ajax
     * @return void
     */
	public function getMessage()
	{
		if ($this->request->is('ajax')) {
            $data = $this->request->getData();
            $item = $this->Item->get($data['itemId']);
            $roomId = $data['roomId'];
            $room = $this->Chat->findRoom($roomId);
            $shop = $this->Shop->get($item->shop);
            $user = $this->Client->get($room->client);

            $listChat = $this->Chat->getRoom($roomId);
            // Run loop foreach to show all chat of group
            foreach ($listChat as $row) {
            	if ($row->message_from == 'client') {
            		echo "<div class='text-right border-top'>";
            		echo "<span class='text-info'>" . $user->name . "</span></br>";
            		echo "<p class='btn btn-primary'>" . $row->message . "</p></br>";
            		echo '</div>';
            	} 
            	if ($row->message_from == 'shop') {
            		echo "<hr><div>";
            		echo "<span class='text-info'>" . $shop->name . "</span></br>";
            		echo "<p class='btn btn-danger'>" . $row->message . "</p></br>";
            		echo '</div>';
            	}
            }
            $this->render('client');
        }
	}

	/**
     * Method to load all message of request from Ajax
     * @return void
     */
	public function getGroup()
	{
		if ($this->request->is('ajax')) {
			$data = $this->request->getData();
			$chat = $this->Chat->get($data['groupId']);
			$item = $this->Item->get($chat->item);
			$client = $this->Client->get($chat->client);
			$shop = $this->Shop->get($chat->shop);
			$listChat = $this->Chat->getRoom($chat->room_id);

			$this->set([
				'item' => $item,
				'chats' => $listChat, 
				'roomId' => $chat->room_id,
				'client' => $client,
				'shop' => $shop
			]);
            $this->render('shop');
		}
	}
}
