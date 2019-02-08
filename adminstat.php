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
        <title>Adminpanel - mājaslapas statistika</title>
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
                      <li>Mājaslapas statistika</li>
                    </ul>
                    <h2 class="underline">Mājaslapas statistika</h2>
                </div>                
                <div class="col-sm-12">
                    <h4 class="small-underline">Apmeklējumi pa precēm</h4>
                    <table class="table table-responsive table-condensed">
                        <thead bgcolor="#eeeeee">
                            <tr>
                                <th scope="col" class="table-small">Artikuls</th>
                                <th scope="col" class="table-small">Apmeklējumi</th>
                            </tr>
                        </thead>
                        <tbody bgcolor="#eeeeee">
                            <?php
                            require_once "stat/get_item_stat.php";
                            ?>
                        </tbody>
                    </table>
                </div>                
                <?php
                if (isset($_GET['col'])) $col=$_GET['col']; 
                else $col=50;
                $file=file("stat/stat.log"); 
                
                if ($col>sizeof($file)) $col=sizeof($file);
                ?>   
                <div class="col-sm-12">
                    <h4 class="small-underline">Galvenās lapas apmeklējumi</h4>
                    <p>Tika atrasti <?= $col ?> galvenās mājaslapas apmeklējumi. </p>
                    <p>Parādīt pēdējos <a href='?col=100'>100</a> <a href='?col=500'>500</a>
                    <a href='?col=100'0>1000</a> vai <a href='?col=<?=sizeof($file)?>'>visus apmeklējumus</a></p>
                </div>
                <div class="col-sm-12">
                    <table class="table table-responsive table-condensed">
                        <tr bgcolor="#eeeeee">
                            <td class="table-small" width="100"><b>Laiks un datums</b></td>
                            <td class="table-small" width="200"><b>Dati par lietotāju</b></td>
                            <td class="table-small" width="100"><b>IP/proxy</b></td>
                            <td class="table-small" width="280"><b>Apmeklētais URL</b></td>
                        </tr>
                        <?php
                        for ($si=sizeof($file)-1; $si+1>sizeof($file)-$col; $si--) {
                            $string=explode("|",$file[$si]);
                            $q1[$si]=$string[0]; // дата и время
                            $q2[$si]=$string[1];
                            $q3[$si]=$string[2];
                            $q4[$si]=$string[3]; 
                            ?>
                            <tr bgcolor="#eeeeee">
                                <td class="table-small"><?=$q1[$si]?></td>
                                <td class="table-small"><?=$q2[$si]?></td>
                                <td class="table-small"><?=$q3[$si]?></td>
                                <td class="table-small"><?=$q4[$si]?></td>
                            </tr>
                        <?php } ?>
                    </table>  
                </div>
            </div> 
        </div>        
        <?php 
        require_once "html-templates/footer.php";
        ?>        
    </body>
</html>