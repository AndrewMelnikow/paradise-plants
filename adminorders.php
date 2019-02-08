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
        <title>Adminpanel - pasūtījumi</title>
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
            <!-- Breadcrumbs and heading -->
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                      <li><a href="index.php">Galvenā</a></li>
                      <li><a href="adminpanel.php">Adminpanel</a></li>
                      <li>Pasūtījumi</li>
                    </ul>
                    <h2 class="underline">Pasūtījumi</h2>
                    <table class="table table-striped table-responsive">
                        <?php
                        require_once "comp/component_db_getorders.php";
                        ?>
                        <thead class="thead-light">
                            <tr>
                                <th>Vārds</th>
                                <th>Uzvārds</th>
                                <th>Tālrunis</th>
                                <th>E-pasts</th>
                                <th>Adrese</th>
                                <th>Piegādes laiks</th>
                                <th>Komentārs</th>
                                <th>Kopsumma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($all_orders as $order) { ?>
                                <tr>
                                    <?php
                                    $client_info = unserialize($order['client_info']);
                                    foreach ($client_info as $key => $data) {
                                        if ($key !== 'submit') {
                                        ?>
                                        <td style="width: 14.28%"><?= filter_var(stripslashes($data),FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></td>
                                    <?php } } ?>
                                    <td><?= $order['total_price'] ?>€</td>
                                </tr>
                                <tr>
                                    <?php
                                    $order_list = unserialize($order['order_list']);
                                    foreach ($order_list as $article => $count) {
                                        ?>
                                        <td><?= "$article &rarr; $count gab." ?></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>        
        <?php 
            require_once "html-templates/footer.php";
        ?>        
    </body>
</html>