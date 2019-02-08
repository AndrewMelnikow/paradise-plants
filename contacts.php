<?php
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
require_once "comp/component_contactform_user.php";
?>
<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Kontakti. Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kontakti</title>
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
                <li>Kontakti</li>
            </ul>
            <div class="row">
                <div class="col-sm-12">
                <h2 class="underline">Kontakti</h2>
                <h4 class="small-underline">Sazinies ar mums</h4>
                    <!-- Error alerts -->
                    <?php
                    if (isset($_GET['error_mail_send'])) {
                        ?>
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Kļūda! Ziņojums netika nosūtīts!</strong></div>
                        <?php
                    }
                    if (isset($_GET['success_mail_send'])) {
                        ?>
                        <div class="alert alert-success" role="alert" style="margin-top: 10px"><strong>Paldies par jautājumu! Atbildi saņemsiet jūsu e-pastā 2 dienu laikā!</strong></div>
                        <?php
                    } ?>
                    <!-- Form -->
                    <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post" style="margin-bottom: 30px">
                        <label>Jūsu vārds</label><br />
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="from_name" minlength='3' maxlength='32' autofocus required value="<?php if(isset($_GET['uname'])) echo $_GET['uname']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <?php
                                if (isset($_GET['error_length_name'])) {
                                    ?>
                                    <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Laukam "Vārds" jāsatur 3-32 simboli!</strong></div>
                                    <?php
                                } ?>
                            </div>
                        </div>
                        <label for="contacts-email">Jūsu e-pasts</label><br />
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="email" name="from_email" minlength='3' maxlength='254' required value="<?php if(isset($_GET['uemail'])) echo $_GET['uemail']; ?>">
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
                                } ?>
                            </div>
                        </div>
                        <label for="contacts-subject">Jautājums</label><br />
                        <div class="row">
                            <div class="col-sm-6">
                                <textarea name="message" minlength='3' maxlength='256' required><?php if(isset($_GET['message'])) echo $_GET['message']; ?></textarea><br />
                            </div>
                            <div class="col-sm-6">
                                <?php
                                if (isset($_GET['error_length_subject'])) {
                                    ?>
                                    <div class="alert alert-danger" role="alert" style="margin-top: 10px"><strong>Laukam "Jautājums" jāsatur 3-256 simboli!</strong></div>
                                    <?php
                                } ?>
                            </div>
                        </div>
                        <input type="submit" value="Nosūtīt" name="submit">
                    </form>
                    <!-- Info -->
                    <h4 class="small-underline">Mūsu kontakti</h4>          
                    <div class="welcome-text">
                        <ul>
                            <li>E-pasts: </li>
                            <li>Adrese: </li>
                            <li>Tālrunis: </li>
                        </ul>
                    </div>
                    <h4 class="small-underline">Mūsu rekvizīti</h4> 
                    <div class="welcome-text">
                        <ul>
                            <li>SIA ""</li>
                            <li>Reģ. Nr.: </li>
                            <li>PVN maksātāja numurs: </li>
                            <li>Juridiskā Adrese:</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once "html-templates/footer.php";
        ?>
    </body>
</html>