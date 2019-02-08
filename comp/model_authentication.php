<?php
namespace Authentication;
class Authentication
{
    public final function CheckInput($uname, $passw)
    {
        if ($uname === 'admin' && $passw === 'admin') {
            session_start();
            $_SESSION['user'] = 'admin';
            header("Location: adminpanel.php");
        } else {
            header("Location: adminlogin.php?wrong_password");
        }
    }
}
        
        