<?php

class ClimateApp {
	const URL = "http://api.openweathermap.org/data/2.5/forecast/daily?";
	const APPID = "481e3bc28e5264e5607c2b65b449bfc1";

	private $results;

	public function __construct(){
		$this->results = [];	
	}

	/**
		method : get weather
		params : $city (string), $units (string), $cnt (int), $output (string)
		response : json
	**/
	public function getWeather($city,$units="metric",$cnt=5,$output="json"){

		//validate params
		if(!in_array($units,['metric','imperial','standard'])){
			$this->results = [
				'error_code' => "400",
				"message" => "Bad Request",
				'status' => false
			];

			$this->__genOutput($this->results);
		}

		if(!in_array($output,['json','xml'])){
			$this->results = [
				'error_code' => "400",
				"message" => "Bad Request",
				'status' => false
			];

			$this->__genOutput($this->results);
		}

		if($cnt < 1){
			$this->results = [
				'error_code' => "400",
				"message" => "Bad Request",
				'status' => false
			];

			$this->__genOutput($this->results);
		}

		if(empty($city)){
			$this->results = [
				'error_code' => "400",
				"message" => "Bad Request",
				'status' => false
			];

			$this->__genOutput($this->results);
		}


		//rest to openweather api
		$url = self::URL.'q='.$city.'&units='.$units.'&cnt='.$cnt.'&mode='.$output.'&APPID='.self::APPID;
		$restApi = json_decode(file_get_contents($url),true);


		//set result data from api
		$this->results['city'] = [
				'name' => $restApi['city']['name'],
				'coordinate' => $restApi['city']['coord'],
				'country' => $restApi['city']['country']
			];
		$this->results['data'] = [];

		if(count($restApi['list']) > 0 ){
			foreach($restApi['list'] as $value){
				$weather = [
					'date' => date("Y-m-d",$value['dt']),
					'temperature' => $value['temp']['day'].' '.$this->__getUnitName($units),
					'variance' => round((doubleval($value['temp']['max']) - doubleval($value['temp']['min'])),2).' '.$this->__getUnitName($units)
				];

				array_push($this->results['data'],$weather);
			}
		}

		$this->__genOutput($this->results);			

	}

	private function __genOutput($data){
		header('Content-Type: application/json');
		echo json_encode($data);
		exit();
	}

	private function __getUnitName($unit){
		$res = "";

		switch ($unit) {
			case 'metric':
				$res = "C";
				break;
			case 'imperial':
				$res = "F";
				break;
			case 'standard':
				$res = "K";
		}

		return $res;
	}
}

if(isset($_GET['city'])){
	$city = trim($_GET['city']);

	$cl = new ClimateApp();	
	$cl->getWeather($city);
}
