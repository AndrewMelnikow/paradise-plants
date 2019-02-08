<?php
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Par mums</title>
        <!-- IE6-10 -->
        <link rel="shortcut icon" href="favicon/favicon.ico">
        <!-- Other browsers-->
        <link rel="icon" href="favicon/favicon.ico">
        <!-- jQuery, Popper.js, Bootstrap-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style/style.css">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    </head>
    <body>
        <!-- Header -->
        <?php
        require_once "html-templates/header.php";
        ?>
        <!-- Breadcrumb -->
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Galvenā</a></li>
                <li>Par mums</li>
            </ul>
            <!-- "About us" -->
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="underline">Par mums</h2>
                    <p class="welcome-text">Mūsu mājaslapā jūs varat pasūtīt mākslīgos ziedus vairumā jebkurā Latvijas pilsētā. Mēs esam ieinteresēti ilgtermiņa sadarbībā, kā arī mūsu klientu izaugsmē, kas regulāri iepērk mūsu preci. Mēs operatīvi nosūtam mākslīgos ziedus vairumā labākā kvalitātē. Noformējot pasūtījumu mūsu mājaslapā, jūs iegūsiet drošu piegādātāju un partneri uz ilgiem gadiem.</p>
                </div>
            </div>
            <!-- "Why Us" -->
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="underline">Kāpēc mēs?</h2>
                </div>
            </div>
            <!-- "Choose us" -->
            <?php 
            require_once "html-templates/choose_us.php"; 
            ?>
        </div>
        <!-- Footer -->
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>