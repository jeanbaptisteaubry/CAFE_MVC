<?php

function Modele_CentreInteret_Select_Tous($bdd){
    $reqBDD = $bdd->query('SELECT * FROM centreinteret');
    $tableCentre = $reqBDD->fetchAll();
    return $tableCentre;
}

function Modele_Entreprise_Creer($bdd, $denominationSociale, $raisonSociale, $Adresse, $CP,
                          $Ville, $mailContact, $nomGerant, $prenomGerant, $dateNaissanceGerant,
                          $lieuNaissanceGerant, $departementNaissanceGerant):int
{

    $reqTxt = "
    INSERT INTO `entreprise`(`denominationSociale`, `raisonSociale`, `Adresse`, `CP`, `Ville`, `mailContact`, `nomGerant`, `prenomGerant`, `dateNaissanceGerant`, `lieuNaissanceGerant`, `departement`, `dateAcceptationRGPD`) 
    VALUES (                :denominationSociale, :raisonSociale,      :Adresse, :CP, :Ville, :mailContact, 
            :nomGerant, :prenomGerant   ,:dateNaissanceGerant , :lieuNaissanceGerant, :departement      ,:dateAcceptationRGPD)";

//Préparation de la requête
//=> Association d'une variable à chaque paramètre de la requête
//Paramètre d'une requête ? champ changeant de valeur pour pas que la requête soit toujours identique
    $reqBDD = $bdd->prepare($reqTxt);
    $dateAcceptationRGPD = date('Y-m-d H:i:s');
    $etat = $reqBDD->execute(array(
        'denominationSociale' => $denominationSociale,
        'raisonSociale' => $raisonSociale,
        'Adresse' => $Adresse,
        'CP' => $CP,
        'Ville' => $Ville,
        'mailContact' => $mailContact,
        'nomGerant' => $nomGerant,
        'prenomGerant' => $prenomGerant,
        'dateNaissanceGerant' => $dateNaissanceGerant,
        'lieuNaissanceGerant' => $lieuNaissanceGerant,
        'departement' => $departementNaissanceGerant,
        'dateAcceptationRGPD' => $dateAcceptationRGPD,
    ));
    if($etat == true){
        $idGerant = $bdd->lastInsertId();
        return $idGerant;
    }
    else
        return false;
}
function Modele_AvoirCentreInteret_Ajouter($bdd, $centre, $idGerant)
{
    $reqTxt = "INSERT INTO `avoir_centreinteret`(`idCI`, `idEntreprise`) 
            VALUES (:idCI, :idEntreprise)";
//Préparation de la requête
//=> Association d'une variable à chaque paramètre de la requête
//Paramètre d'une requête ? champ changeant de valeur pour pas que la requête soit toujours identique
    $reqBDD = $bdd->prepare($reqTxt);
    $etat = $reqBDD->execute(array(
        'idCI' => $centre,
        'idEntreprise' => $idGerant,
    ));
}