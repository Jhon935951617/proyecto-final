<?php
$link = 'salir';
session_start();
session_destroy();
header('location:index.html');
?>