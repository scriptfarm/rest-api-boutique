<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-11
 * Time: 11:41
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/Database.class.php';
include_once '../modeles/Utilisateur.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oUtilisateur = new Utilisateur($oBDD);

// set ID property of product to be edited
$oUtilisateur->idUtilisateur = $_POST['idUtilisateur'];

// set product property values
$oUtilisateur->sCourriel = $_POST['sCourriel'];
$oUtilisateur->sMotDePasse = $_POST['sMotDePasse'];
$oUtilisateur->sNumTelephone = $_POST['sNumTelephone'];
$oUtilisateur->sPrenomUtilisateur = $_POST['sPrenomUtilisateur'];
$oUtilisateur->sNomUtilisateur = $_POST['sNomUtilisateur'];
$oUtilisateur->iNoAdresse = $_POST['iNoAdresse'];

// update the product
if($oUtilisateur->modifier()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Le Utilisateur est mit à jour."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Impossible de modifier ce Utilisateur"));
}
