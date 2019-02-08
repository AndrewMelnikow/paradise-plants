<?php
if (($_SESSION['user'])!=='admin') {
    exit("Jums nav tiesību apskatīt šo lapu! <a href=\"index.php\">Atgriezties uz galveno</a>");
}