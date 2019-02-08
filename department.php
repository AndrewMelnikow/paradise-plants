<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
?>

<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="<?php if (isset($_GET['name'])) echo filter_var(stripslashes($_GET['name']), FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>. Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php if (isset($_GET['name'])) echo filter_var(stripslashes($_GET['name']), FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?></title>
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
        <div class="container" style="margin-bottom: 15px">

            <!-- Breadcrumbs -->
            <ul class="breadcrumb">
                <li><a href="index.php">Galvenā</a></li>
                <li><?php echo $_GET['name']; ?></li>
            </ul>

            <!-- Generate items -->
            <div class="row" style="margin-top: 10px">
                <?php
                require_once "comp/component_db_departmentgen.php"; 
                foreach ($items as $item) {
                    require "comp/component_item_discount.php";
                    ?>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a href="item.php?id=<?= $item['item_id'] ?>&name=<?= $item['name'] ?>" style="text-decoration: none">
                    <div class="item">
                            <img class="item-images" src="images/items/<?php echo $item['image_path'][0] ?>.jpg" alt="Attēlu nevarēja ielādēt">
                            <div class="item-name"><?php echo $item['name'] ?></div>
                            <div class="item-price-centred">
                                <div class="item-disc-price">
                                    <?php
                                    if ($is_discount) echo $item['discount_price'] . "€"; 
                                    ?>
                                </div>
                                <div class="item-price">
                                    <?php
                                    if ($is_discount) {
                                        echo "<div class=\"line-through\">";
                                    }
                                    echo $item['price'] . "€";
                                    if ($is_discount) {
                                        echo "</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                    </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>