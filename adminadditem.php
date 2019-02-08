<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_checkaccess.php";
require_once "comp/component_connectdb.php";
require_once "comp/component_item_add.php";
?>
<!DOCTYPE html>
<html lang='lv'>    
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Adminpanel - izveidot jauno preci</title>
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
        <!-- Header -->
        <?php
        require_once "html-templates/header.php";
        ?>
        <!-- Breadcrumb and heading -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12"><ul class="breadcrumb">
                      <li><a href="index.php">Galvenā</a></li>
                      <li><a href="adminpanel.php">Adminpanel</a></li>
                      <li>Izveidot jauno preci</li>
                    </ul>
                    <h2 class="underline">Izveidot jauno preci</h2>
                </div>
            </div>            
            <!-- Alerts -->
            <?php
            if (!empty($_GET['e'])) {
                foreach ($_GET['e'] as $v) {
                ?>
                    <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong><?= strtr(filter_var(stripslashes($v),FILTER_SANITIZE_FULL_SPECIAL_CHARS), "_", " ")?></strong></div>
                <?php
                }
            }
            if (isset($_GET['success'])) {
                ?>
                <div class="alert alert-success" role="alert" style="margin-top: 10px"><strong>Prece ir veiksmīgi rediģēta</strong></div>
                <?php
            }
            ?>   
            <!-- Filter Get-queries -->
            <?php
            if (isset($_GET['p'])) {
                foreach ($_GET['p'] as $error_nbr => $error_name) {
                    $error_nbr = filter_var(stripslashes($error_name),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }
            }
            ?>
            <!-- Form -->
            <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_article">Artikuls (Obligāts! 1-30 simbolu!)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[article]" required maxlength="64" value="<?php if (!empty($_GET['p'][0])) echo $_GET['p'][0]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_name">Nosaukums (Obligāts! 1-30 simbolu!)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[name]" required maxlength="64" value="<?php if (!empty($_GET['p'][1])) echo $_GET['p'][1]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_name">Apraksts</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[descr]" maxlength="64" value="<?php if (!empty($_GET['p'][2])) echo $_GET['p'][2]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="upload">Attēli (Obligāts! Attēliem jābūt ar izmēru vismaz 500x500!)</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="image_input">
                            <input type="file" name="file_upload[]" style="width: 70%" required>             
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
                        <input type="text" name="item[collection]" maxlength="64" value="<?php if (!empty($_GET['p'][3])) echo $_GET['p'][3]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_dimensions">Izmēri</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[dimensions]" maxlength="64" value="<?php if (!empty($_GET['p'][4])) echo $_GET['p'][4]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_color">Krāsa</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[color]" maxlength="64" value="<?php if (!empty($_GET['p'][5])) echo $_GET['p'][5]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_material">Materiāls</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[material]" maxlength="64" value="<?php if (!empty($_GET['p'][6])) echo $_GET['p'][6]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_department">Sadaļa (Obligāts! Jaunu sadaļu var izveidot lapā "Darbs ar sadaļām")</label>
                    </div>
                    <div class="col-sm-8">
                        <select type="text" name="item[department]">
                            <?php
                            require_once "comp/component_department_select.php";
                            foreach ($datas as $data) {
                            ?>
                                <option value="<?= $data['name'] ?>" 
                                    <?php if (isset($_GET['p'][7]) && $_GET['p'][7] == $data['name']) echo "selected"; ?>>
                                    <?= $data['name'] ?>
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
                        <input type="text" name="item[price]" required maxlength="64" value="<?php if (!empty($_GET['p'][8])) echo $_GET['p'][8]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item_price">Akcijas cena</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[discount_price]" maxlength="64" value="<?php if (!empty($_GET['p'][9])) echo $_GET['p'][9]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="item[discount_price_time_start]">Akcijas cenas termiņa sākums, formāts: GGGG-MM-DD (obligāti aizpildīt, ja ir akcijas cena)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[discount_price_time_start]" maxlength="64"  value="<?php if (!empty($_GET['p'][10])) echo $_GET['p'][10]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                         <label for="item_discount_price_time_end">Akcijas cenas termiņa beigas, formāts: GGGG-MM-DD (obligāti aizpildīt, ja ir akcijas cena)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[discount_price_time_end]" maxlength="64" value="<?php if (!empty($_GET['p'][11])) echo $_GET['p'][11]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                         <label for="item_count">Daudzums (Obligāts!)</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="item[count]" required maxlength="64" value="<?php if (!empty($_GET['p'][12])) echo $_GET['p'][12]; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="is_visible">Ir redzams? (Obligāts!)</label>
                    </div>
                    <div class="col-sm-8">
                        <select type="text" name="item[is_visible]">
                          <option value="no">Nē</option>
                          <option value="yes" <?php if ($_GET['p'][13] == 'yes') echo "selected"; ?>>Jā</option>
                        </select>
                    </div>
                </div>
                <input type="submit" value="Pievienot preci datu bāzē" name="add_item" />
            </form>
        </div>        
        <?php 
        require_once "html-templates/footer.php";
        ?>        
    </body>
</html>