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
<?php
  if ($isValid) {
echo "<div class='alert alert-primary' role='alert'><span class='message'>Thank you for your order for a total of <strong>&euro; $totalValue </strong>!<br>
Your order will be with you at: <strong>$delivery_time</strong></span></div>";
  }
  else {
      echo "<div class='alert alert-warning' role='alert'><span class='message'>To complete your order, fill in all the information!</div>";
  }?>


<div class="container">
    <img class="logo" src="img/logo.png" alt="shaz'Ham logo">
    <h1>Place your order</h1>
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
//    $nameErr = $emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";

    function test_input(string $data) : string {
        return trim(htmlspecialchars($data));
    }

    $errors = [];

    if (isset($_POST["email"], $_POST["name"])) {
        if (empty($_POST["name"])) {
            $errors['name'] = "This field is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $errors[] = "* Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $errors[] = "This field is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "* Invalid email format";
            }
        }

        if (empty($_POST["street"])) {
            $errors[] = "This field is required";
        } else {
            $street = test_input($_POST["street"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $street)) {
                $errors[] = "* Only letters please";
            }
        }

        if (empty($_POST["streetnumber"])) {
            $streetnumberErr = "This field is required";
        } else {
            if ((is_numeric($streetnumber)) and (preg_match("/^[0-9]{1,4}$/", $streetnumber))) {
                $streetnumber = test_input($_POST["streetnumber"]);
            } else {
                $streetnumberErr = "* Please enter a maximum of 4 numbers, no letters";
            }
        }

        if (empty($_POST["city"])) {
            $cityErr = "This field is required";
        } else {
            $city = test_input($_POST["city"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
                $cityErr = "* Only letters and white space allowed";
            }
        }

        if (empty($_POST["zipcode"])) {
            $zipcodeErr = "This field is required";
        } else {
            if ((is_numeric($zipcode)) and (preg_match("/^[0-9]{1,4}$/", $zipcode))) {
                $zipcode = test_input($_POST["zipcode"]);
            } else {
                $zipcodeErr = "* Please enter a maximum of 4 numbers, no letters";
            }
        }

        if(count($errors)) {
            die('errors found');
        } else {
            die('your form is valid!');
        }
    }

    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name ?? '';?>" class="form-control"/><span class="error"><?php echo $nameErr;?></span>
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?php echo $email ?? '';?>" class="form-control"/><span class="error"><?php echo $emailErr;?></span>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" value="<?php echo $street ?? '';?>" class="form-control"><span class="error"><?php echo $streetErr;?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" value="<?php echo $streetnumber ?? '';?>" class="form-control"><span class="error"><?php echo $streetnumberErr;?></span>
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
            <input type="checkbox" name="express_delivery" id="express_delivery" value="5" <?php if(isset($_POST['express_delivery'])) echo "checked"; ?> />
            Express delivery (45 minutes, + 5 EUR)
        </label><br>
        <button type="submit" class="btn btn-primary">Order!</button></form>


    <?php echo "Current delivery time is: $delivery_time" ?>


    <br>


    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in this session.</footer>
</div>

</body>
</html>