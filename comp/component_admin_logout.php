<?php
session_start();
$_SESSION['user'] = 'unknown';
header("Location: ../index.php");