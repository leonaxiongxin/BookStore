<?php
session_start();
/* remove all session variables */
session_unset();
/* destroy the sesion */
session_destroy();

/* 倒回登入頁面 */
echo '<script>';
echo 'window.location.href="./signin.html";';
echo '</script>';
?>