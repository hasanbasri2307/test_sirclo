<?php

class Cart {
	private $carts;


	public function __construct(){
		$this->carts = [];
	}

	public function addProduct($productCode,$qty){
		if(array_key_exists($productCode,$this->carts)){
			$this->carts[$productCode] += 1;
		}else{
			$this->carts[$productCode] = 1;
		}
	}

	public function removeProduct($productCode){
		if(array_key_exists($productCode,$this->carts)){
			unset($this->carts[$productCode]);
		}
	}

	public function showCart(){
		if(count($this->carts) > 0){
			foreach($this->carts as $key => $value){
				echo $key.' ('.$value.')';
				echo "<br>";
			}
		}else{
			echo "cart masih kosong bro";
		}
	}
}

$cart = new Cart();
$cart->addProduct("baju biru",1);
$cart->addProduct("baju biru",1);
$cart->addProduct("singlet",3);
$cart->removeProduct("singlet");
$cart->addProduct("kaca mata",1);
$cart->removeProduct("jam");
$cart->showCart();