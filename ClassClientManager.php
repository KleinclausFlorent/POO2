<?php
class ClientManager
{
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Client $mClient)
  {
    /* Préparation de la requête d'insertion. ADRESSECLIENT / CP / NOM /NUMCLIENT / PAYS / PRENOM / VILLE*/
    $q = $this->_db->prepare('INSERT INTO CLIENT(NOM, PRENOM, ADRESSECLIENT, CP, VILLE, PAYS) VALUES (:NOM,:PRENOM,:ADRESSECLIENT,:CP,:VILLE,:PAYS)');
    // Assignation des valeurs
    //$q->bindValue(':NUMCLIENT', $mClient->getId());
    $q->bindValue(':NOM', $mClient->getNom());
    $q->bindValue(':PRENOM', $mClient->getPrenom());
    $q->bindValue(':ADRESSECLIENT', $mClient->getAdresse()); 
    $q->bindValue(':CP', $mClient->getCp());
    $q->bindValue(':VILLE', $mClient->getVille());
    $q->bindValue(':PAYS', $mClient->getPays());
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Client $mClient)
  {
    // Exécute une requête de type DELETE.
    $this->_db->exec('DELETE FROM CLIENT WHERE NUMCLIENT = '.$mClient->getId());

  }

  public function get($mNumClient)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
    $q = $this->_db->query('SELECT NUMCLIENT, NOM, PRENOM, ADRESSECLIENT, CP, VILLE, PAYS FROM CLIENT WHERE NUMCLIENT= '.$mNumClient);
    //PDO::FETCH_ASSOC: retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats
    $donnees = $q->fetch();
    return new Client($donnees['NUMCLIENT'],$donnees['NOM'],$donnees['PRENOM'],$donnees['ADRESSECLIENT'],$donnees['CP'],$donnees['VILLE'],$donnees['PAYS']);

  }

  public function getList()
  {
    // Retourne la liste de tous les personnages.
    $ListClients = [];

    $q = $this->_db->query('SELECT NUMCLIENT, NOM, PRENOM, ADRESSECLIENT, CP, VILLE, PAYS FROM CLIENT');
    while ($donnees = $q->fetch())
    {
      $ListClients[] = new Client($donnees['NUMCLIENT'],$donnees['NOM'],$donnees['PRENOM'],$donnees['ADRESSECLIENT'],$donnees['CP'],$donnees['VILLE'],$donnees['PAYS']);
    }

    return $ListClients;
  }

  public function update(Client $mClient)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE CLIENT SET NOM = :nom, PRENOM = :prenom , ADRESSECLIENT = :adresseClient, CP = :cp, VILLE = :ville , PAYS = :pays WHERE NUMCLIENT = :id');
    // Assignation des valeurs à la requête.
    $q->bindValue(':id', $mClient->getId());
    $q->bindValue(':nom', $mClient->getNom());
    $q->bindValue(':prenom', $mClient->getPrenom());
    $q->bindValue(':adresseClient', $mClient->getAdresse()); 
    $q->bindValue(':cp', $mClient->getCp());
    $q->bindValue(':ville', $mClient->getVille());
    $q->bindValue(':pays', $mClient->getPays());

    // Exécution de la requête.    
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}