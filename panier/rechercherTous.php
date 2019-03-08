<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:26
 */

// HEADERS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// INCLUSIONS
include_once '../config/Database.class.php';
include_once '../modeles/Panier.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN Panier
$oPanier = new Panier($oBDD);


// query products
$stmt = $oPanier->rechercherTous();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $products_arr = array();
    $products_arr["Paniers"] = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $product_item=array(
            "idPanier" => $idPanier,
            "sNumPanier" => $sNumPanier,
            "sDateModification" => $sDateModification
        );

        array_push($products_arr["Paniers"], $product_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($products_arr);
}
// no products found will be here
else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
