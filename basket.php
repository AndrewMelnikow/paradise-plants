<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
?>

<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jūsu grozs</title>
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
            <!-- Breadcrumb -->        
            <ul class="breadcrumb">
                <li><a href="index.php">Galvenā</a></li>
                <li>Jūsu grozs</li>
            </ul>        
            <!-- Heading -->        
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="underline">Jūsu grozs</h2>
                </div>
            </div>        
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    if (isset($_SESSION['basket']['items'])) {
                    ?>                      
                        <div class="table-responsive"> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Attēls</th>
                                        <th scope="col">Nosaukums</th>
                                        <th scope="col">Cena par gab.</th>
                                        <th scope="col">Skaits</th>
                                        <th scope="col">Cena kopā</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    try {
                                        foreach ($_SESSION['basket']['items'] as $article => $count) { 
                                            require "comp/component_basket_getitemsinfo.php";
                                            ?>

                                            <tr>
                                                <td style="width: 16.66%">
                                                    <a href="item.php?id=<?= $item['item_id'] ?>">
                                                        <img class="item-images" src="images/items/<?= $item['image_path'][0] ?>.jpg" alt="Attēlu nevarēja ielādēt">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="item.php?id=<?= $item['item_id'] ?>" style="color: black">
                                                        <?= $item['name']?>
                                                    </a>
                                                </td>
                                                <td><?= sprintf('%0.2f', $item_price) ?>€</td>
                                                <td>
                                                    <form action="comp/component_basket_itemcountchange.php" method="post">
                                                        <input name="article" hidden value="<?= $article ?>">
                                                        <select id="item-count" name="count" style="margin: 0; padding: 0"  onchange="this.form.submit()">
                                                            <?php
                                                            for ($i=0; $i<=$item['item_count']; $i++) {
                                                            ?>
                                                                    <option value="<?= $i ?>" <?php if($i == $count) echo "selected"; ?>>
                                                                        <?= $i ?>
                                                                    </option>
                                                            <?php } ?>
                                                        </select>
                                                    </form>
                                                </td>
                                                <th scope="row"><?= sprintf('%0.2f', $item_price * $count) ?>€</th>
                                            </tr>

                                            <?php
                                            /* Count the amount */
                                            if (!isset($checkout_total)) $checkout_total = 0;
                                            $checkout_total += $item_price * $count;
                                        }

                                    } catch (PDOException $e) {
                                        echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
                                    }
                                    ?>

                                    <tr class="table-success">
                                        <th scope="row" style="font-size: 24px">Kopā:</th>
                                        <td colspan="3"></td>
                                        <th scope="row" style="font-size: 24px"><?= sprintf('%0.2f', $checkout_total) ?>€</th>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                        <form action="checkout.php" method="POST">
                            <input type="submit" value="Noformēt pasūtījumu" style="background-color: ForestGreen; font-size: 24px"/>
                        </form>
                    <?php
                    } else { 
                        echo '<div class="alert alert-info">';
                        echo '<strong>Jūsu grozs ir tukšs!</strong> Apskatiet mūsu preču klāstu sadaļā "Preču sortiments"';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>    
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>