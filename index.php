<?php

declare(strict_types=1);
session_start();

if (!isset($_GET["food"])){

    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];
}

elseif ($_GET["food"] == 1) {

    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];}

else {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];}

$totalValue = 0;

if (isset($_POST['express_delivery'])) {
    $totalValue += 5;
}

if (isset($_POST["products"])) {
    foreach ($_POST["products"] as $i => $price) {
        $totalValue += $products[$i]["price"];
    }
}

if (isset($_POST['express_delivery'])) {
    $delivery_time = date("H:i:s", strtotime("+45 Minutes"));
} else {
    $delivery_time = date("H:i:s", strtotime("+2 Hours"));
}


require 'form-view.php';
