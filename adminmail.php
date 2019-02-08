<?php
require_once "comp/component_nocache.php";
require_once "comp/component_sessioncookie.php";
require_once "comp/component_checkaccess.php";
require_once "comp/component_connectdb.php";
require_once "comp/component_contactform_admin.php";
?>
<!DOCTYPE html>
<html lang='lv'>    
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Adminpanel - e-pasts</title>
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
                    <ul class="breadcrumb">  
                    <!-- Breadcrumbs and heading -->
                        <li><a href="index.php">Galvenā</a></li>
                        <li><a href="adminpanel.php">Adminpanel</a></li>
                        <li>Aizsūtīt ziņojumu uz konkrētu e-pastu</li>
                    </ul>
                    <h2 class="underline">Aizsūtīt ziņojumu uz konkrētu e-pastu</h2>       
                    <!-- Error alerts -->
                    <?php
                    if (isset($_GET['error_mail_send'])) { ?>
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Kļūda! Ziņojums netika nosūtīts!</strong></div>
                    <?php }
                        if (isset($_GET['success_mail_send'])) { ?>
                        <div class="alert alert-success" role="alert" style="margin-top: 10px"><strong>Ziņojums tika veiksmīgi nosūtīts adresātam!</strong></div>
                    <?php } ?>
                    <!-- Form -->
                    <form enctype='multipart/form-data' action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
                        <p>Kam (E-pasts):</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="email" name="to_email" minlength='3' maxlength="254" autofocus required value="<?php if(isset($_GET['to_email'])) echo $_GET['to_email']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <?php
                                    if (isset($_GET['error_notvalid_email'])) {
                                ?>
                                    <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Nepareizs e-pasts! Piemērs: my@example.com</strong></div>
                                <?php
                                    }
                                    if (isset($_GET['error_length_email'])) {
                                ?>
                                    <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Laukam "E-pasts" jāsatur 3-254 simboli!</strong></div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <p>Temats:</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="subject" minlength='3' maxlength="32" required value="<?php if(isset($_GET['subject'])) echo $_GET['subject']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <?php
                                    if (isset($_GET['error_length_subject'])) {
                                ?>
                                    <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Laukam "Temats" jāsatur 3-32 simboli!</strong></div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <p>Ziņa:</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <textarea cols="56" rows="8" name="message" minlength='3' maxlength="256" required><?php if(isset($_GET['message'])) echo $_GET['message']; ?></textarea>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                    if (isset($_GET['error_length_subject'])) {
                                ?>
                                    <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Laukam "Ziņa" jāsatur 3-256 simboli!</strong></div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <p>Pievienot failu:</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="file" name="from_file" required> 
                                <input type="submit" value="Aizsūtīt" name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>
