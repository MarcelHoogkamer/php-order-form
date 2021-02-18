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
$name = $_POST['name'];
$email = $_POST['email'];
$formcontent = "From: $name";
$recipient = "emailaddress@here.com";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
?>

<div class='result'>
<?php echo "Thank You! <strong>$name</strong><br>";
echo "Your e-mail address is: $email<br>";
echo "You will hear from us shortly regarding your order!<br>";
?>
</div>
</body>
</html>