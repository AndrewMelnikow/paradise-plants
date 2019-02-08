<?php
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
?>
<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Kā nopirkt / Piegāde. Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kā nopirkt / Piegāde</title>
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
                <li>Kā nopirkt / Piegāde</li>
            </ul>

            <div class="row">
                <div class="col-sm-12">
                    <h2 class="underline">Kā nopirkt / Piegāde</h2>
                    <div class="big-text-block">
                        <i class="fa fa-shopping-basket"></i>
                        <h3>1. Pievienojiet grozam preces</h3>
                        <img src="images/help/help1.jpeg" alt="Attēlu nevarēja ielādēt">
                    </div>
                    <div class="big-text-block">
                        <i class="fas fa-check"></i>
                        <h3>2. Noformējiet pasūtījumu</h3>
                        <img src="images/help/help2.jpeg" alt="Attēlu nevarēja ielādēt">
                    </div>
                    <div class="big-text-block">
                        <i class="fas fa-search"></i>
                        <h3>3. Mēs pārbaudīsim, vai preces ir noliktavā un tikai pēc tam notiek pirkuma apmaksa un piegādes veida precīzēšana</h3>
                        <img src="images/help/help3.jpeg" alt="Attēlu nevarēja ielādēt">
                    </div>
                    <div class="big-text-block">
                        <i class="fas fa-shipping-fast"></i>
                        <h3>4. Preces varat saņemt mūsu noliktavā, vai arī citā, jums ērtajā adresē</h3>
                        <img src="images/help/help4.jpeg" alt="Attēlu nevarēja ielādēt">
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>