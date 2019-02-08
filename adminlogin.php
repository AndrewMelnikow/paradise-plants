<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
require_once "comp/component_admin_authorization.php";
?>

<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Autorizācija</title>
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
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="underline">Autorizācija</h2>
                    <?php 
                    if (isset($_GET['wrong_password'])) { 
                        ?>
                        <div class="alert alert-danger">
                            <strong>Kļūda!</strong> Nepareizs e-pasts vai parole
                        </div>
                        <?php 
                    } 
                    ?>
                    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST">
                        Lietotājvārds: <input name="username" type="text" /><br />
                        Parole: <input name="password" type="password" /><br />
                        <input type="submit" value="Pieteikties" name="submit" />
                    </form>
                </div>
            </div>
        </div>
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>