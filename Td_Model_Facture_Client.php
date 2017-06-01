<?php

include_once "ClassClient.php";
include_once "ClassFacture.php";
include_once "ClassProduit.php";
include_once "ClassDFacture.php";
include_once "ClassClientManager.php";


?>


<?php


	//programme principal
	/*$mClient=new Client(1,"Nom","Prenom","adresse","cp","ville","Pays");

	$mClient->affiche();

	$date = new DateTime();
	 
	$mFacture=new Facture(1,$date->format('Y-m-d'),"CB");

	$mFacture->affiche();

	$mProduit=new Produit(1,"Des",10);

	$mProduit->affiche();

	$mQteProduitsFacture=new DFacture(50);

	$mQteProduitsFacture->affiche();*/

	$date = new DateTime();

	$mClient=new Client(1,"Nom","Prenom","adresse","cp","ville","Pays");

	$mProduit=new Produit(1,"Ecran 4k",400);

	//$qteProd1=new DFacture(10);

	$tProduit=new Produit(2,"test",100);

	$cProduit=new Produit(3,"toto",100);

	//$qteProd2=new DFacture(20);

	//$mProduit->addQteProduits($qteProd1,10);

	//$tProduit->addQteProduits($qteProd2,20);

	/*$arrObj=array();
	$arrObj[]=$mProduit;
	$arrObj[]=$tProduit;
	$arrObj[]=$tProduit;
	$arrObj[]=$tProduit;
	$arrObj[]=$tProduit;
	$arrObj[]=$tProduit;
	$arrObj[]=$tProduit;
	$arrObj[]=$tProduit;
	$arrObj[]=$tProduit;
	$arrObj[]=$tProduit;*/

	$mFacture=new Facture(1,$date->format('Y-m-d'),"CB");

//for($i=0;$i<10;$i++){
		
		$mFacture->addProduits($mProduit,10);
	
	//}

	$mFacture2=new Facture(2,$date->format('Y-m-d'),"cheque");
	
	for($i=0;$i<5;$i++){
		
		$mFacture->addProduits($tProduit,20);
	
	}

		$mFacture->addProduits($cProduit,20);

	//$mFacture->affiche();

	$mClient->addFature($mFacture);

	$mClient->addFature($mFacture2);

	$mFacture2->addProduits($cProduit,20);


	$mClient->affiche();

	$donnees = [
		'idClient' => 16,
		'nom' => 'Kleinclaus',
		'prenom' => 'Florent',
		'adresse' => '1, rue de la Chapelle',
		'cp' => 67100,
		'ville' => 'Strasbourg',
		'pays' => 'France'
	];
	echo ("HYDRATATION CLIENT");
	$mClient->hydrate($donnees);

	$mClient->affiche();

	$donneesProd =[
		'numProduit' => 10,
		'des' => 'rotato',
		'prix' => 50
	];
	echo ("HYDRATATION Produit");
	$mProduit->hydrate($donneesProd);

	$mProduit->affiche();

	$donneesFact =[
		'numFacture' =>10,
		'date' => $date->format('Y-m-d'),
		'reg' => 'CB'
	];

	echo ("Hydratation Facture");
	$mFacture->hydrate($donneesFact);

	$mFacture->affiche();

	echo "TEST MANAGER";

	Try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=facture;charset=utf8','Florent','1234Florent',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	Try
	{
		$mClientManager= new ClientManager($bdd);

		$mClientManager->add($mClient);

		$mClient10=$mClientManager->get(3);

		$mClient10->affiche();

		$ClientList=$mClientManager->getList();
		for ($i=0;$i <sizeof($ClientList);$i++)
		{
			$ClientList[$i]->affiche();
		}
		$mClient10->setVille("Tokyo");
		$mClientManager->update($mClient10);
		$mClientManager->delete($mClient);
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}


	
	
	





















	/*$mClient->addFature($mFacture);

	$mClient->addFature($mFacture2);

	// Affichage des infos factures
  	foreach($mClient->getFactClient() as $valeur) {
 
    	echo $valeur->affiche() ,'<br/>';
  	}
 
	$mClient->affiche(1);*/

	//$mFacture->affiche();



	/*$_collectFacture=array();

	$_collectFacture[]=$mFacture;

	$_collectFacture[]=$mFacture2;

	echo $_collectFacture[0]->getReg();

	echo $_collectFacture[1]->getReg();*/









?>