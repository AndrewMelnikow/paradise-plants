<?php
require_once "comp/component_sessioncookie.php";
require_once "comp/component_connectdb.php";
require_once "stat/stat.php";
?>
<!DOCTYPE html>
<html lang='lv'> 
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Paradise Plants - mākslīgo ziedu vairumtirdzniecības interneta veikals. Kvalitatīvi mākslīgie ziedi ikdienai un svētkiem.">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Paradise Plants - mākslīgie ziedi ikdienai un svētkiem</title>
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
        <!-- Header -->
        <?php
        require_once "html-templates/header.php";
        ?>    
        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="6000" data-pause="">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="images/slides/slide-1.jpeg" alt="First slide" style="width:100%;">
                    <div class="carousel-caption">
                        <p class="carousel-text">Mākslīgie ziedi jūsu ofisam...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/slides/slide-2.jpeg" alt="Second slide" style="width:100%;">
                    <div class="carousel-caption">
                        <p class="carousel-text">...mājai...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/slides/slide-3.jpeg" alt="Third slide" style="width:100%;">
                    <div class="carousel-caption">
                        <p class="carousel-text">...svētkiem</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>    
        <!-- Departments -->
        <div class="container">
            <div class="row">
                <h2 class="underline">Sadaļas</h2>
            </div>        
            <!-- Department icons -->
            <div class="row">
                <?php
                require_once "comp/component_department_indexblocks.php";
                foreach ($datas as $data) {
                ?>
                    <div class="dep col-sm-4">
                        <a href="department.php?name=<?= $data['name'] ?>" style="text-decoration: none">
                            <img class="dep-image" src="images/departments/<?= $data['image'] ?>.jpg" alt="Attēlu nevarēja ielādēt">
                            <div class="dep-name"><?= $data['name'] ?></div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>        
            <!-- Welcome text -->
            <div class="row">
                <h2 class="underline">Laipni lūdzam</h2>
                <p class="welcome-text">Mūsu mājaslapā jūs varat pasūtīt mākslīgos ziedus vairumā jebkurā Latvijas pilsētā. Mēs esam ieinteresēti ilgtermiņa sadarbībā, kā arī mūsu klientu izaugsmē, kas regulāri iepērk mūsu preci. Mēs operatīvi nosūtam mākslīgos ziedus vairumā labākā kvalitātē. Noformējot pasūtījumu mūsu mājaslapā, jūs iegūsiet drošu piegādātāju un partneri uz ilgiem gadiem.</p>
                <h2 class="underline">Kāpēc mēs?</h2>
            </div>        
            <!-- "Choose us" -->
            <?php require_once "html-templates/choose_us.php"; ?>
        </div>    
        <!-- Footer -->
        <?php
        require_once "html-templates/footer.php";
        ?>    
    </body>
</html>