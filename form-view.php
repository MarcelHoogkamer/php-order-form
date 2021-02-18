<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="main.css">
    <title>Order food & drinks</title>
</head>
<body>
<div class="container">
    <img class="logo" src="img/logo.png" alt="shaz'Ham logo">
    <h1>Order your favourite sandwich from "shaz'Ham"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <?php

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

    $nameErr = $emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";
    $name = $email = $street = $streetnumber = $city = $zipcode = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $street = test_input($_POST["street"]);
        $streetnumber = test_input($_POST["streetnumber"]);
        $city = test_input($_POST["city"]);
        $zipcode = test_input($_POST["zipcode"]);
        $formcheck = 0;
        $confirmation_msg = "";
        $delivery_time = date("H:i:s", strtotime("+2 Hours"));
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            $formcheck++;
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "* Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            $formcheck++;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "* Invalid email format";
            }
        }

        if (empty($_POST["street"])) {
            $streetErr = "Street is required";
        } else {
            $street = test_input($_POST["street"]);
            $formcheck++;
            if (!preg_match("/^[a-zA-Z-' ]*$/",$street)) {
                $streetErr = "* Only letters please";
            }
        }

        if (empty($_POST["streetnumber"])) {
            $streetnumberErr = "Number is required";
        } else {
            if ((is_numeric($streetnumber)) and (preg_match("/^[0-9]{1,4}$/",$streetnumber)))  {
                $streetnumber = test_input($_POST["streetnumber"]);
                $formcheck++;
            } else {
                $streetnumberErr = "* Please enter a maximum of 4 numbers, no letters";
            }
        }

        if (empty($_POST["city"])) {
            $cityErr = "City is required";
        } else {
            $city = test_input($_POST["city"]);
            $formcheck++;
            if (!preg_match("/^[a-zA-Z-' ]*$/",$city)) {
                $cityErr = "* Only letters and white space allowed";
            }
        }

        if (empty($_POST["zipcode"])) {
            $zipcodeErr = "Zipcode is required";
        } else {
            if ((is_numeric($zipcode)) and (preg_match("/^[0-9]{1,4}$/",$zipcode)))  {
                $zipcode = test_input($_POST["zipcode"]);
                $formcheck++;
                } else {
                $zipcodeErr = "* Please enter a maximum of 4 numbers, no letters";
            }
        }
        if (isset($_POST['express_delivery'])) {
            $delivery_time = date("H:i:s", strtotime("+45 Minutes"));
        }

        if ($formcheck == 5) {
            $confirmation_msg = "Thank you. Your order has been sent. The delivery time is " . $delivery_time;
        }
    }

    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name;?>" class="form-control"/><span class="error"><?php echo $nameErr;?></span>
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>" class="form-control"/><span class="error"><?php echo $emailErr;?></span>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" value="<?php echo $street;?>" class="form-control"><span class="error"><?php echo $streetErr;?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" value="<?php echo $streetnumber;?>" class="form-control"><span class="error"><?php echo $streetnumberErr;?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="<?php echo $city;?>" class="form-control"><span class="error"><?php echo $cityErr;?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" value="<?php echo $zipcode;?>" class="form-control"><span class="error"><?php echo $zipcodeErr;?></span>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]" /> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        <label>
            <input type="checkbox" name="express_delivery" id="express_delivery" value="yes" <?php if(isset($_POST['express_delivery'])) echo "checked"; ?> />
            Express delivery (45 minutes, + 5 EUR)
        </label><br>
        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <?php echo "Current delivery time is: $delivery_time <br>" ?>

    <br>
    <?php $totalValue = 0;

    if (isset($_POST["products"])){
    foreach ($_POST["products"] AS $i => $price){
    $totalValue += $products[$i]["price"];
    }
    } ?>
    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in this session.</footer>
</div>

</body>
</html>