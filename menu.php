<?php

require_once 'functions.php';

$menu = $_POST['menu'];

$newMenu = saveNav($menu);

header("Location: index.php")
?>