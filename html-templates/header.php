<!-- 
Alert about cookies 
-->
<?php
if (!isset($_SESSION['cookies-alert'])) {
?>
    <script src="style/cookies-alert.js"></script>
    <div class="cachealert">
        <span class="closebtn cookies-alert" onclick="this.parentElement.style.display='none';"><i class="fas fa-times"></i></span> 
        Lai nodrošinātu vislabāko Paradise Plants interneta veikala darbību, mēs izmantojam sīkdatnes. Ja turpini izmantot šo interneta lapu, tu piekrīti lietot mūsu sīkdatnes. Iepazīsties ar mūsu <a href="#">lietošanas noteikumiem</a> un <a href="#">izmantotajām sīkdatnēm (cookies)</a>
    </div>
<?php
}
?>
<!-- 
First navbar with basket info and adminpanel button
-->
<div class="attention">
    <div class="container">
        <div class="row">
            <a href="basket.php">
                <i class="fa fa-shopping-basket"></i>
                Grozā ir <strong>
                    <span id='basket-item-count'>
                        <?php
                        if (isset($_SESSION['basket']['total-count'])) echo $_SESSION['basket']['total-count'];
                        else echo 0; 
                        ?>
                    </span>
                </strong> prece(-s) (Apskatīt)
            </a>
            <?php if ($_SESSION['user'] == 'admin') { ?>
                <a href="adminpanel.php">Adminpanel</a>
                <a href="comp/component_admin_logout.php">Iziet no admin-profila</a>
            <?php } ?>
            <a href="#"><i class="fab fa-facebook-f" style="color: white"></i></a>
            <a href="#"><i class="fab fa-instagram" style="color: white"></i></a>
            <a href="#"><i class="fab fa-pinterest-p" style="color: white"></i></a>
        </div>
    </div>
</div>
<!-- 
Second navbar 
-->
<nav class="navbar navbar-expand-lg bg-light navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img class="navbar-logo" src="images/navbar-logo.png">Paradise Plants</a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#allnavbar" aria-controls="allnavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="allnavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Preču sortiments</a>
                    <div class="dropdown-menu">
                        <?php
                        require_once "comp/component_db_departlist2.php";
                        foreach ($deps as $dep) { ?>
                            <a class="dropdown-item" href="department.php?name=<?php echo $dep['name']; ?>"><?php echo $dep['name']; ?></a>
                        <?php } ?>
                    </div>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link" href="delivery.php">Kā nopirkt / Piegāde</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link" href="aboutus.php">Par mums</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link" href="contacts.php">Kontakti</a>
                </li>
            </ul>
        </div>
        <span class="navbar-text navbar-phone" style="padding-right: 20px">
            <i class="fa fa-phone"></i> Zvani: 67777777 (8-21) vai <a href="./contacts.php">raksti</a>
        </span>
    </div>
</nav>