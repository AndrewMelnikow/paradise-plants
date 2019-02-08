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
    </head>    
    <body>            
        <?php
        require_once "html-templates/header.php";
        ?>  
        <div class="container">
            <!-- Breadcrumbs and heading -->
            <div class="row">
                <div class="col-sm-12"><ul class="breadcrumb">
                      <li><a href="index.php">Galvenā</a></li>
                      <li><a href="adminpanel.php">Adminpanel</a></li>
                      <li>Rediģēt esošās preces - meklēšana</li>
                    </ul>
                    <h2 class="underline">Rediģēt esošās preces - meklešana</h2>
                </div>
            </div>             
            <!-- Alerts -->
            <?php
            if (isset($_GET['success'])) {
                ?>
                <div class="alert alert-success" role="alert" style="margin-top: 10px"><strong>Prece ir veiksmīgi rediģēta</strong></div>
                <?php
            }
            ?>            
            <!-- Form -->  
            <form action="admininventory.php" method="get" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="search_article">Ievadiet preces artikulu:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="search_article">
                    </div>
                </div>
                <input type="submit" value="Meklēt šo preci datu bāzē" name="go">
            </form>            
            <!-- List of items-->
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="underline">Preču saraksts</h2>
                </div>
                <table class="table table-responsive table-condensed admin-item-table">
                    <thead class="thead-style">
                        <tr>
                            <th scope="col">Artikuls</th>
                            <th scope="col">Nosaukums</th>
                            <th scope="col">Daudzums</th>
                            <th scope="col">Redzams</th>
                            <th scope="col">Cena</th>
                            <th scope="col">Akc. cena</th>
                            <th scope="col">Akc. sākums</th>
                            <th scope="col">Akc. beigas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "comp/component_db_item_list.php";
                        foreach ($items as $item) { ?>
                            <tr>
                                <th scope="row"><?php echo $item['article']; ?></th>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['item_count']; ?></td>
                                <td><?php if ($item['is_visible'] == 'yes') echo 'Jā'; else echo 'Nē'; ?></td>
                                <td><?php echo $item['price']; ?></td>
                                <td><?php echo $item['discount_price'] == 0 ? "—" : $item['discount_price']  ?></td>
                                <td><?php echo $item['discount_price_time_start'] == 0 ? "—" : $item['discount_price_time_start']; ?></td>
                                <td><?php echo $item['discount_price_time_end'] == 0 ? "—" : $item['discount_price_time_end'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>  
        </div>        
        <?php 
        require_once "html-templates/footer.php";
        ?>        
    </body>
</html>