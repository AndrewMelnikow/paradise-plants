<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
require_once "comp/component_checkout_handler.php";
?>
<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pasūtīt</title>
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
                    <h2 class="underline">Pasūtīt</h2>
                </div>
            </div>

            <!-- Error alerts -->
            <?php
            if (isset($_GET['error_mail_send'])) { ?>
                <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Kļūda! Preces netika pasūtītas, pamēģiniet vēlāk!</strong></div>
                <?php 
            }
            if (isset($_SESSION['basket']['items'])) {
            ?>  
            <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
                <div class="row checkout">
                    <div class="col-sm-12">
                        <h3>Pirkums</h3>                    
                        <div class="table-responsive"> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nosaukums</th>
                                        <th scope="col">Cena par gab.</th>
                                        <th scope="col">Skaits</th>
                                        <th scope="col">Cena kopā</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        /* Get info about each item from DB */
                                        foreach ($_SESSION['basket']['items'] as $article => $count) { 
                                            require "comp/component_basket_getitemsinfo.php";
                                            ?>
                                            <tr>
                                                <td><a href="item.php?id=<?= $item['item_id'] ?>" style="color: black"><?= $item['name']?></a></td>
                                                <td><?= sprintf('%0.2f', $item_price) ?>€</td>
                                                <td><?= $count ?></td>
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
                                    <tr>
                                        <th scope="row" style="font-size: 24px">Kopā:</th>
                                        <td colspan="2"></td>
                                        <th scope="row" style="font-size: 24px"><?= sprintf('%0.2f', $checkout_total) ?>€</th>
                                        <input type="text" name="total_price" value="<?= sprintf('%0.2f', $checkout_total) ?>" hidden>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
                <div class="row checkout">
                    <h3>Piegādes informācija</h3>
                    <div class="col-sm-12">
                        <label for="firstname"><i class="far fa-user"></i> Vārds</label>
                        <input type="text" id="firstname" name="Vārds" placeholder="Jānis" required>
                        <label for="lastname"><i class="fas fa-user"></i> Uzvārds</label>
                        <input type="text" id="lastname" name="Uzvārds" placeholder="Bērziņš" required>
                        <label for="phone"><i class="far fa-envelope"></i> Tālrunis</label>
                        <input type="text" id="phone" name="Tālrunis" placeholder="22223333" required>
                        <label for="email"><i class="far fa-envelope"></i> E-pasts</label>
                        <input type="text" id="email" name="E-pasts" placeholder="pasts@example.com" required>
                        <label for="adr"><i class="far fa-map"></i> Piegādes adrese</label>
                        <input type="text" id="adr" name="Adrese" placeholder="Rīga, Labāko Ziedu iela 1-1" required>
                        <label for="delivery_time"><i class="far fa-calendar-alt"></i> Vēlamais piegādes laiks</label>
                        <input type="text" id="delivery_time" name="Laiks" placeholder="2. decembrī, ap 10-13" required>
                        <label for="comment"><i class="far fa-comment"></i> Komentārs</label>
                        <textarea id="comment" name="Komentārs"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <form>
                            <input type="submit" name="submit" value="Pasūtīt" style="background-color: ForestGreen; font-size: 24px"/>
                        </form>
                    </div>
                </div>
            </form>
            <?php
            } else { 
                echo '<div class="alert alert-info">';
                echo '<strong>Jūsu grozs ir tukšs!</strong> Apskatiet mūsu preču klāstu sadaļā "Preču sortiments"';
                echo '</div>';
            }
            ?>
        </div>
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>