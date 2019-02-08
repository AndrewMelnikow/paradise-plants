<?php
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
?>
<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Piegāde. Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lapa nav atrasta</title>
        <!-- IE6-10 -->
        <link rel="shortcut icon" href="favicon/favicon.ico">
        <!-- Other browsers-->
        <link rel="icon" href="favicon/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/style.css">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
        <!-- jQuery, Popper.js, Bootstrap-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        require_once "html-templates/header.php";
        ?>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Galvenā</a></li>
                <li>Kļūda - 404</li>
            </ul>
            <!-- Image and caption -->    
            <div class="checkout-img">
                <img src="images/404_error.jpg" alt="Attēlu nevarēja ielādēt" style="width:100%;">
                <div class="on-image-text"> 
                    <h1>Lapa nav atrasta :(</h1>
                </div>
            </div>
        </div>
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>