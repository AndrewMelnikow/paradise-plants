<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_checkaccess.php";
require_once "comp/component_connectdb.php";
require_once "comp/component_department_edit.php";
?>
<!DOCTYPE html>
<html lang='lv'>     
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Adminpanel - darbs ar sadaļām</title>
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
        <!-- Breadcrumb, Heading, Form -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Galvenā</a></li>
                        <li><a href="adminpanel.php">Adminpanel</a></li>
                        <li>Darbs ar sadaļām</li>
                    </ul>
                    <h2 class="underline">Izveidot sadaļu</h2>   
                    <!-- Error alerts -->
                    <?php
                    if (isset($_GET['emptyname'])) {
                        ?>
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Lauks "Nosaukums" ir obligāts!</strong></div>
                        <?php
                    }
                    if (isset($_GET['fileerror'])) {
                        ?>
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong><?=filter_var(stripslashes($_GET['fileerror']),FILTER_SANITIZE_FULL_SPECIAL_CHARS)?></strong></div>
                        <?php
                    }
                    if (isset($_GET['filetypeerror'])) {
                        ?>
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Var augšupielādēt tikai attēlus</strong></div>
                        <?php
                    }
                    if (isset($_GET['imageheighterror']) || isset($_GET['imagewidtherror'])) {
                        ?>
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Attēla šaurumam un augstumam ir jābūt lielākiem par 500 pikseļiem</strong></div>
                        <?php
                    }
                    ?>
                    <form action="comp/component_department_addtodb.php" method="POST" enctype="multipart/form-data">
                        <p>Nosaukums (Obligāts!)</p>
                        <input type="text" name="dep_name"><br />
                        <p>Attēls (Obligāts! Attēlam jābūt ar izmēru vismaz 500x500!)</p>
                        <input type="file" name="upload"><br />
                        <p>Ir redzama? (Obligāts!)</p>
                        <select type="text" name="dep_visible">
                          <option value="no">Nē</option>
                          <option value="yes">Jā</option>
                        </select><br />
                        <input type="submit" value="Pievienot sadaļu datu bāzē" name="new_department">
                    </form>
                </div>
            </div>
            <!-- List of items-->
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="underline">Rediģēt sadaļu</h2>
                </div>
                <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data" style="width: 100%">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nosaukums</th>
                                <th scope="col">Rediģēt attēlu</th>
                                <th scope="col">Redzams</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "comp/component_db_departlist.php";
                            foreach ($deps as $dep) {
                                ?>
                                <!-- Table -->
                                <tr>
                                    <input type="text" name="dep[<?= filter_var(stripslashes($dep['id']),FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>][id]" value="<?= filter_var(stripslashes($dep['id']),FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>" hidden>
                                    <td><input type="text" name="dep[<?= filter_var(stripslashes($dep['id']),FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>][name]" value="<?= $dep['name'] ?>" required></td>
                                    <td><input type="file" name="file_upload[<?= filter_var(stripslashes($dep['id']),FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>]" ></td>
                                    <td>
                                        <select type="text" name="dep[<?= filter_var(stripslashes($dep['id']),FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>][visible]" required>
                                            <option value="no">Nē</option>
                                            <option value="yes" <?php if (filter_var(stripslashes($dep['is_visible']),FILTER_SANITIZE_FULL_SPECIAL_CHARS) == 'yes') echo "selected"; ?>>Jā</option>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <input type="submit" value="Saglabāt izmaiņas" name="edit_department">
                </form>
            </div>
        </div>
        <?php 
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>