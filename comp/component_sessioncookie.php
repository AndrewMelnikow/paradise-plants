<?php
session_start();
/* 
 * Set session[user] to hide the button "Adminpanel" 
 */
if (!isset($_SESSION['user'])) $_SESSION['user'] = 'unknown';