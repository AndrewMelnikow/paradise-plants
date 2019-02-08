<div class="footer-bg">
    <div class="container footer">
        <div class="row">
            <div class="col-sm-3 footer-column">
                <div class="footer-headings">DEPARTMENTI</div>
                <?php
                require_once "comp/component_db_departlist2.php";
                foreach ($deps as $dep) {
                    ?>
                    <a href="department.php?name=<?= $dep['name'] ?>"><?= $dep['name'] ?></a><br />
                    <?php
                } ?>
            </div>
            <div class="col-sm-3 footer-column">
                <div class="footer-headings">SADAĻAS</div>
                <a href="index.php">Galvenā</a><br />
                <a href="aboutus.php">Par mums</a><br />
                <a href="delivery.php">Kā nopirkt / Piegāde</a><br />
                <a href="contacts.php">Kontakti</a>
            </div>
            <div class="col-sm-3 footer-column">
                <div class="footer-headings">PAPILDUS</div>
                <a href="#">Drošā apmaksa</a><br />
                <a href="#">Garantija un atteikums</a><br />
                <a href="#">Lietošanas noteikumi</a><br />
                <a href="#">Sīkdatnes</a><br />
                <a href="#">Medijiem</a>
            </div>
            <div class="col-sm-3 footer-column">
                <div class="footer-headings">MĀJASLAPU IZSTRĀDE</div>
                <p>Izstādājam mājaslapas biznesiem un hobijiem. Droši rakstiet uz: andrewmelnikow1@gmail.com</p>
            </div>
        </div>
    </div>
</div>   
<!-- 
Second footer
--> 
<div class="footer-bg2">
    <div class="container">
        <div class="row footer2-text">
            <div class="col-sm-6">
                <p>© <?php echo date('Y'); ?> Paradise Plants, Visas tiesības rezervētas.</p>
            </div>
            <div class="col-sm-6 footer-column footer-social-icons">
                <p>Seko mums sociālos tīklos: </p>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a>
            </div>
        </div>
    </div>
</div>