<?php
if (!empty($_POST['submit'])) {
    require_once "comp/model_authentication.php";
    $request = new Authentication\Authentication;
    $request->CheckInput($_POST['username'], $_POST['password']);
}