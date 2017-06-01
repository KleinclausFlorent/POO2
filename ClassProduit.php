<?php


//Classe Produit
class Produit{


	//Données Membres
	private $_NumProduit;
	private $_Des;
	private $_Puht;
	
	

	
	//Fcts Membres
	public function __construct($mNum,$mDes,$mPrix){

		//echo "Contructeur <br/>";
		$this->_NumProduit=$mNum;
		$this->_Des=$mDes;
		$this->_Puht=$mPrix;
	
	
	}

	public function __destruct(){
	

	}


	//Mutateurs

	public function getNumProduit(){


		return $this->_NumProduit;
	}

	public function getDes(){


		return $this->_Des;
	}

	public function getPrixHt(){


		return $this->_Puht;
	}

	

	public function setNumProduit($mNum){

		$this->_NumProduit=$mNum;

	}

	public function setDes($mDes){

		$this->_Des=$mDes;

	}

	public function setPrix($mPrixHt){

		$this->_Puht=$mPrixHt;

	}

	

	public function affiche(){

		echo $this->_NumProduit."<br/>";
		echo $this->_Des."<br/>";
		echo $this->_Puht."<br/>";
		
	}
	public function hydrate(array $donnees){

		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			} else {
				echo "EXISTE PAS";
			}
		}
	}


	
}




?>