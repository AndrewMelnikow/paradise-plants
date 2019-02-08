<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_checkaccess.php";
require_once "comp/component_connectdb.php";
?>
<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Adminpanel</title>
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
                    <ul class="breadcrumb">
                        <li><a href="index.php">Galvenā</a></li>
                        <li>Adminpanel</li>
                    </ul>
                    <h2 class="underline">Adminpanel</h2>

                    <a href="adminmail.php" style="text-decoration: none">
                        <button class="gray-button">
                            <h4>Aizsūtīt ziņojumu uz konkrētu e-pastu</h4>
                        </button>
                    </a>
                    <a href="adminadditem.php" style="text-decoration: none">
                        <button class="gray-button">
                            <h4>Izveidot jauno preci</h4>
                        </button>
                    </a>
                    <a href="admininventorysearch.php" style="text-decoration: none">
                        <button class="gray-button">
                            <h4>Rediģēt esošās preces</h4>
                        </button>
                    </a>
                    <a href="admindepartments.php" style="text-decoration: none">
                        <button class="gray-button">
                            <h4>Izveidot/rediģēt sadaļas</h4>
                        </button>
                    </a>
                    <a href="adminorders.php" style="text-decoration: none">
                        <button class="gray-button">
                            <h4>Pasūtījumi</h4>
                        </button>
                    </a>
                    <a href="adminstat.php" style="text-decoration: none">
                        <button class="gray-button">
                            <h4>Mājaslapas statistika</h4>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>