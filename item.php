<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
require_once "stat/item_stat.php";
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
        <div class="container">
            <!-- Get info about item from DB -->
            <?php
            require_once "comp/component_db_getiteminfo.php";
            require_once "comp/component_item_discount.php";
            ?>
            <!-- Breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="index.php">Galvenā</a></li>
                <li><a href="department.php?name=<?= $item['department'] ?>"><?= $item['department'] ?></a></li>
                <li><?= $item['name'] ?></li>
            </ul>
            <!-- If is_visible criteria of item is set 'yes' -->
            <?php
            if ($item['is_visible'] == 'yes') {
                ?>
                <!-- Product heading -->
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="product-name"><?php echo $item['name']; ?></h2>
                    </div>
                </div>
                <!-- Gallery -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="gallery-container">
                            <?php
                            foreach ($item['image_path'] as $k => $v) {
                                ?>
                                <div class="gallery-slides">
                                  <img class="gallery-img" src="images/items/<?php echo $v; ?>.jpg" style="width:100%" alt="<?php echo $item['name']; ?>">
                                </div>
                                <?php
                            }
                            ?> 
                          <a class="gallery-prev" onclick="plusSlides(-1)">❮</a>
                          <a class="gallery-next" onclick="plusSlides(1)">❯</a>
                          <div class="gallery-row">
                            <?php
                            foreach ($item['image_path'] as $k => $v) {
                                ?>
                                <div class="gallery-column">
                                    <img class="gallery-demo gallery-cursor gallery-img" src="images/items/<?php echo $v; ?>.jpg" style="width:100%" onclick="currentSlide(<?php echo $k+1 ?>)" alt="<?php echo $item['name']; ?>">
                                </div>
                                <?php
                            }
                            ?> 
                          </div>
                        </div>
                    </div>
                    <!-- Specifications -->
                    <?php $item_price = $is_discount ? $item['discount_price'] : $item['price'] ?>
                    <div class="col-sm-6">
                        <div class="product-descr"><?= $item['description'] ?></div>
                        <table class="table table-hover table-striped">
                            <tbody>
                              <tr>
                                <td>Kolekcija</td>
                                <td><?= $item['collection'] ?></td>
                              </tr>
                              <tr>
                                <td>Izmērs</td>
                                <td><?= $item['dimensions'] ?></td>
                              </tr>
                              <tr>
                                <td>Krāsa</td>
                                <td><?= $item['color'] ?></td>
                              </tr>
                              <tr>
                                <td>Materiāls</td>
                                <td><?= $item['material'] ?></td>
                              </tr>
                              <tr>
                                <td>Departments</td>
                                <td><?= $item['department'] ?></td>
                              </tr>
                              <tr>
                                <td>Skaits noliktavā</td>
                                <td><?= $item['item_count'] ?></td>
                              </tr>
                              <tr>
                                <td>Artikuls</td>
                                <td><?= $item['article'] ?></td>
                              </tr>
                            </tbody>
                        </table>
                        <div class="product-add">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="product-disc-price">
                                        <?php
                                        if ($is_discount) 
                                            echo $item_price . "€";
                                        ?>
                                    </div>
                                    <div class="product-price">
                                        <?php
                                        if ($is_discount)
                                            echo "<div class=\"line-through\">";
                                        echo $item['price'] . "€";
                                        if ($is_discount == true)
                                            echo "</div>";
                                        ?>
                                    </div>
                                    <div class="product-disc-time">
                                        <?php
                                        $old_date1 = date($item['discount_price_time_start']);
                                        $old_date_timestamp1 = strtotime($old_date1);
                                        $new_date1 = date('d.m.Y', $old_date_timestamp1);
                                        $old_date2 = date($item['discount_price_time_end']);
                                        $old_date_timestamp2 = strtotime($old_date2);
                                        $new_date2 = date('d.m.Y', $old_date_timestamp2); 

                                        if ($is_discount)
                                            echo "Akcija spēkā: " . $new_date1 . " - " . $new_date2; 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <p style="margin-bottom: 0">Izvēlieties daudzumu:</p>
                                    <select name="count" id="count" oninput="amount_calculation(this.value)" onchange="amount_calculation(this.value)">
                                        <?php
                                        for ($i=1; $i<=$item['item_count']; $i++) {
                                            ?>
                                        <option value="<?= $i ?>" <?php if(isset($_SESSION['basket']['items'][$item['article']]) && ($_SESSION['basket']['items'][$item['article']] == $i)) echo "selected" ?>><?= $i ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <strong>Kopā: <span id="item_sum"></span>€</strong>
                                </div>
                            </div>
                            <a href="#" style="text-decoration: none">
                                <div class="add-to-cart">Pievienot grozam</div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Similar products -->
                <div class="row">
                    <h2 class="underline">Klienti, kas iegādājās šo preci (-es), nopirka arī:</h2>
                </div>
                <div class="row">
                    <?php
                        require_once "comp/component_db_recommended.php";         
                        foreach ($items as $item) {
                            require "comp/component_item_discount.php";
                            ?>
                            <div class="item col-sm-4">
                                <a href="item.php?id=<?= $item['item_id'] ?>&name=<?= $item['name'] ?>" style="text-decoration: none">
                                    <img class="item-images" src="images/items/<?php echo $item['image_path'][0] ?>.jpg" alt="Attēlu nevarēja ielādēt">
                                    <div class="item-name"><?= $item['name'] ?></div>
                                    <div class="item-price-centred">
                                        <div class="item-disc-price">
                                            <?php
                                            if($is_discount) echo $item['discount_price'] . "€";
                                            ?>
                                        </div>
                                        <div class="item-price">
                                            <?php
                                            if($is_discount) echo "<div class=\"line-through\">";
                                            echo $item['price'] . "€";
                                            if($is_discount) echo "</div>";
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                </div>
                <!-- If is_visible criteria of item is set 'no' -->
                <?php 
            } else { 
                ?>
                <div class="alert alert-danger" style="margin-top: 30px">
                  <strong>Kļūda!</strong> Šī prece vairs netiek pārdota.
                </div>
                <?php 
            } ?>
            <!-- Why Choose Us -->
            <div class="row">
                <h2 class="underline">Kāpēc mēs?</h2>
            </div>
            <?php require_once "html-templates/choose_us.php"; ?>
            <!-- Contact button -->
            <div class="row">
                <h2 class="underline">Saziņa</h2>
            </div>
            <div class="row">
                <a href="contacts.php" style="text-decoration: none">
                    <button class="gray-button">
                        <h2>Palika jautājumi? Droši sazinies ar mums!</h2>
                    </button>
                </a>
            </div>
        </div>
        <?php
        require_once "html-templates/footer.php";
        ?>
        <script>
            item_price = '<?= $item_price ?>';
            item_count = $("#count option:selected").text();
            item_article = '<?= $item_article; ?>'; 
            old_item_count = '<?= $item_count_at_start ?>';
        </script>
        <script src="style/item.js"></script>
    </body>
</html>