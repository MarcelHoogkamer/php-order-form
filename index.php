<?php

declare(strict_types=1);
session_start();

const COOKIE_NAME = "saved-orders";
const EXPRESS_DELIVIRY_COST = 5;

$expire = time() + (86400 * 30);

if (isset($_COOKIE[COOKIE_NAME])){
    $totalValue = (float)$_COOKIE[COOKIE_NAME];
}
else {
    $totalValue = 0;
    setcookie(COOKIE_NAME,(string)$totalValue,$expire);
}

$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];
if(isset($_GET["food"]) && $_GET["food"] == 0 ) {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}

$totalValue = 0;

if (isset($_POST['express_delivery'])) {
    $totalValue += EXPRESS_DELIVIRY_COST;
}

if (isset($_POST["products"])) {
    foreach ($_POST["products"] as $i => $price) {
        $totalValue += $products[$i]["price"];
    }
    setcookie(COOKIE_NAME,(string)$totalValue,$expire);
}

if (isset($_POST['express_delivery'])) {
    $delivery_time = date("H:i:s", strtotime("+45 Minutes"));
} else {
    $delivery_time = date("H:i:s", strtotime("+2 Hours"));
}

$isValid = (!empty($_POST["name"])
    && !empty($_POST["email"])
    && !empty($_POST["street"])
    && !empty($_POST["streetnumber"])
    && !empty($_POST["products"])
    && !empty($_POST["city"])
    && !empty($_POST["zipcode"]));

require 'form-view.php';
