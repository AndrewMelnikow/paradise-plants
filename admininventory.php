<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_checkaccess.php";
require_once "comp/component_connectdb.php";
require_once "comp/component_item_edit.php";
?>
<!DOCTYPE html>
<html lang='lv'>    
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Adminpanel - rediģēt esošās preces</title>
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
        <!-- Script for image input -->
        <script type="text/javascript">
            $(function() {
              $(document).on("click", "input[type='button'][value!='+']", remove_field);
              $(document).on("click", "input[type='button'][value!='-']", add_field);
            });
            function add_field(){
              var count = $(".image_input").length;
                if(count < 6)
                $(".image_input:last").clone().insertAfter($(this).parent());
            }
            function remove_field(){
              $(this).parent().remove();
            }         
        </script>
    </head>    
    <body>        
        <?php
        require_once "html-templates/header.php";
        ?> 
        <!-- Breadcrumbs, headings -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12"><ul class="breadcrumb">
                        <li><a href="index.php">Galvenā</a></li>
                        <li><a href="adminpanel.php">Adminpanel</a></li>
                        <li><a href="admininventorysearch.php">Rediģēt esošās preces - meklēšana</a></li>
                        <li>Rediģēt esošās preces</li>
                    </ul>
                    <h2 class="underline">Rediģēt esošās preces</h2>
                </div>
            </div>              
            <!-- Errors -->
            <?php
            if (!empty($_GET['e'])) {
                foreach ($_GET['e'] as $v) {
                ?>
                    <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong><?= strtr(filter_var(stripslashes($v),FILTER_SANITIZE_FULL_SPECIAL_CHARS), "_", " ")?></strong></div>
                <?php
                }
            } 
            ?>
            <!-- Connect to database and get info abot item, check article -->    
            <?php
            require_once "comp/component_db_iteminfo.php";
            ?>
            <!-- Form -->
            <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_article">Artikuls (Nedrīkst mainīt!)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[article]" value="<?= $item['article'] ?>" readonly required maxlength="64" style="background-color: LightGray">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_name">Nosaukums (Obligāts! 1-64 simbolu!)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[name]" value="<?= $item['name'] ?>" required maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_name">Apraksts</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[descr]" value="<?= $item['description'] ?>" maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p>Attēli</p>
                    </div>
                    <div class="col-sm-8">
                        <?php
                        $item['image_path'] = unserialize($item['image_path']);
                        foreach ($item['image_path'] as $k => $v) {
                        ?>
                            <div style="width: 30%">
                                <div class="inventory-image">
                                    <img src="images/items/<?= $v ?>.jpg" alt="Nevarēja ielādēt attēlu" style="width: 100%">
                                    <input type="text" name="all_images[<?= $v ?>]" hidden>
                                    <input type="checkbox" name="del_images[<?= $v ?>]" class="form-check-input checkbox" id="item_img_delete">
                                    <label class="form-check-label" for="item_img_delete">Izdzēst</label>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="image_input">
                            <input type="file" name="file_upload[]" style="width: 70%">             
                            <input type="button" value="+" style="width: 10%">
                            <input type="button" value="-" style="width: 10%">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_collection">Kolekcija</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[collection]" value="<?= $item['collection'] ?>" maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_dimensions">Izmēri</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[dimensions]" value="<?= $item['dimensions'] ?>" maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_color">Krāsa</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[color]" value="<?= $item['color'] ?>" maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_material">Materiāls</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[material]" value="<?= $item['material'] ?>" maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_department">Sadaļa (Obligāts! Jaunu sadaļu var izveidot lapā "Darbs ar sadaļām")</label>
                    </div>
                    <div class="col-sm-8">
                        <select type="text" name="item[department]" required>
                            <?php
                                require_once "comp/component_department_select.php";
                                foreach ($datas as $data) {
                                    ?>
                                    <option value="<?= $data['name'] ?>" <?php if($data['name'] ==  $item['department']) echo "selected"; ?>>
                                        <?= filter_var(stripslashes($data['name']),FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                                    </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_price">Cena (Obligāts! Piemērs: 0.99, ar punktu, bez valūtas zīmes)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[price]" value="<?= $item['price'] ?>" required maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_price">Akcijas cena</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[discount_price]" value="<?= $item['discount_price'] ?>" maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_discount_price_time_start">Akcijas cenas termiņa sākums (formāts: GGGG-MM-DD)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[discount_price_time_start]" value="<?= $item['discount_price_time_start'] ?>" maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                         <label for="item_discount_price_time_end">Akcijas cenas termiņa beigas (formāts: GGGG-MM-DD)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[discount_price_time_end]" value="<?= $item['discount_price_time_end'] ?>" maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                         <label for="item_count">Daudzums (Obligāts!)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[count]" value="<?= $item['item_count'] ?>" required maxlength="64">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="is_visible">Ir redzams? (Obligāts!)</label>
                    </div>
                    <div class="col-sm-8">
                        <select type="text" name="item[is_visible]" required>
                          <option value="no">Nē</option>
                          <option value="yes" <?php if($item['is_visible'] == 'yes') echo "selected"; ?>>Jā</option>
                        </select>
                    </div>
                </div>
                <input type="submit" value="Saglabāt izmaiņas" name="edit_item">
            </form>
        </div>
        <?php 
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>