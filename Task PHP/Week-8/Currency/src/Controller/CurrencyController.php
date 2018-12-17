<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class CurrencyController extends AppController
{
	private $dataGold;
	private $dataCurrency;
	private $dataBitcoin;
	public function initialize()
	{
		parent::initialize();
		$this->loadModel('Currency');
		$this->dataGold = [];
		$this->dataCurrency = [];
		$this->dataBitcoin = [];
	}

	/**
     * Method to show Index view
     * @return void
     */
	public function index()
	{
		$check = $this->Currency->find('all')->first();
		// Check table 'currency' had data or not
		if ($check == null) {
			$listCurrency = $this->getAllCurrency();
		} else {
			// If has already data -> get time of newest record to check with current time
			$currentTime = date('Y-m-d H:i:s');
			$newestTime = $this->getNewestTime();
			$result = strtotime($currentTime) - strtotime($newestTime);
			// If time of current time more than time of newest record 1 hour -> get new data /else get current list currency
			$listCurrency = ($result >= 3600) ? $this->getAllCurrency() : $this->Currency->find('all');
		}

		$this->getDataForChart();
		$this->set([
			'title' => 'List currency', 
			'listCurrency' => $listCurrency, 
			'dataGold' => $this->dataGold,
			'dataBTC' => $this->dataBitcoin,
			'dataEuro' => $this->dataCurrency['euro'],
			'dataGBP' => $this->dataCurrency['gbp'],
			'dataYen' => $this->dataCurrency['yen'],
			'dataUSD' => $this->dataCurrency['usd']
		]);
	}

	/**
     * Method to get time of newest record
     * @return string $firstTime
     */
	private function getNewestTime()
	{
		$listCurrency = $this->Currency->find('all');
		$firstItem = $this->Currency->find('all')->first();
		// Get time of first record
		$firstTime = $firstItem->created_date;
		// Run loop to get newest time
		foreach ($listCurrency as $item) {
			// Check time of this record is more than first record or not
			if ($item->created_date > $firstTime) {
				$firstTime = $item->created_date;
			}
		}
		return $firstTime;
	}

	/**
     * Method to get new price of Gold SJC, Euro, British pound, Japanese Yen, US Dollar and Bitcoin
     * @return array object $listCurrency
     */
	private function getAllCurrency()
	{
		$this->getGoldSJC();
		$this->getCurrency();
		$this->getBitcoin();
		$listCurrency = $this->Currency->find('all');
		return $listCurrency;
	}

	/**
     * Method to get price of gold SJC in HCM and save to table 
     * @return void
     */
	private function getGoldSJC()
	{
		$url = 'http://www.sjc.com.vn/xml/tygiavang.xml';
		$xml = simplexml_load_file($url);
		// Get currency Gold 9999 of Ho CHi Minh
		$hcm = $xml->ratelist->city[0]->item[0];

		$currency = $this->Currency->newEntity();
		$insert = $this->Currency->patchEntity($currency, [
			'name' => 'Gold SJC (9999)',
			'buy' => (float)$hcm['buy'] * 1000000,
			'buy_transfer_type' => '',
			'sell' => (float)$hcm['sell'] * 1000000,
			'created_date' => date('Y-m-d H:i:s')
		]);
		$this->Currency->save($insert);
	}

	/**
     * Method to get price of EUR, GBP, USD, YEN in Vietcombank and save to table 
     * @return void
     */
	private function getCurrency()
	{
		$url = 'https://www.vietcombank.com.vn/exchangerates/ExrateXML.aspx';
		$xml = simplexml_load_file($url);
		
		// Run loop to save data to table
		foreach ($xml as $item) {
			// Check code of this item are EUR, GBP, USD, JPY or not
			if ($item['CurrencyCode'] == 'EUR' || 
				$item['CurrencyCode'] == 'GBP' || 
				$item['CurrencyCode'] == 'JPY' || 
				$item['CurrencyCode'] == 'USD') {
				$currency = $this->Currency->newEntity();
				$insert = $this->Currency->patchEntity($currency, [
					'name' => $item['CurrencyName'],
					'buy' => $item['Buy'],
					'buy_transfer_type' => $item['Transfer'],
					'sell' => $item['Sell'],
					'created_date' => date('Y-m-d H:i:s')
				]);
				$this->Currency->save($insert);
			}
		}
	}

	/**
     * Method to get price of 1 Bitcoin in Coinmarketcap API and save to table 
     * @return void
     */
	private function getBitcoin()
	{
		$json = file_get_contents('https://api.coinmarketcap.com/v1/ticker/bitcoin/'); 
		$bitcoin = json_decode($json);
		// Get price VND of 1 dollar
		$vnd = $this->Currency->find('all', [
			'condition' => ['name' => 'US DOLLAR']
		])->first();
		// price of bitcoint VND = price of 1 BTC in USD * 1 USD in VND
		$price = $bitcoin[0]->price_usd * $vnd->sell;

		$currency = $this->Currency->newEntity();
		$insert = $this->Currency->patchEntity($currency, [
			'name' => '1 Bitcoin (BTC)',
			'buy' => $price,
			'buy_transfer_type' => '',
			'sell' => $price,
			'created_date' => date('Y-m-d H:i:s')
		]);
		$this->Currency->save($insert);
	}

	/**
     * Method to get price and created date for draw chart 
     * @return void
     */
	private function getDataForChart()
	{
		$listCurrency = $this->Currency->find('all');
		// Run loop to save data to an array
		foreach ($listCurrency as $item) {
			if ($item->name == 'Gold SJC (9999)') {
				$this->dataGold[] = ['y' => (float)$item->sell, 'x' => strtotime($item->created_date) * 1000];
			}
			if ($item->name == '1 Bitcoin (BTC)') {
				$this->dataBitcoin[] = ['y' => (float)$item->sell, 'x' => strtotime($item->created_date) * 1000];
			}
			if ($item->name == 'EURO') {
				$this->dataCurrency['euro'][] = ['y' => (float)$item->sell, 'x' => strtotime($item->created_date) * 1000];
			}
			if ($item->name == 'BRITISH POUND') {
				$this->dataCurrency['gbp'][] = ['y' => (float)$item->sell, 'x' => strtotime($item->created_date) * 1000];
			}
			if ($item->name == 'JAPANESE YEN') {
				$this->dataCurrency['yen'][] = ['y' => (float)$item->sell, 'x' => strtotime($item->created_date) * 1000];
			}
			if ($item->name == 'US DOLLAR') {
				$this->dataCurrency['usd'][] = ['y' => (float)$item->sell, 'x' => strtotime($item->created_date) * 1000];
			}
		}
	}
}
