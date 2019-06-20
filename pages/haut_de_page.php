<?php 
session_start();
if(!isset($_GET['title'])) require("class/Autoloader.php"); else require("../class/Autoloader.php");
Autoloader::register();
Bdd::connexion('Universite');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" <?php if(!isset($_GET['title'])) echo'href="css/bootstrap.min.css"'; else echo 'href="../css/bootstrap.min.css"'; ?>>
    <link rel="stylesheet" <?php if(!isset($_GET['title'])) echo'href="css/moncss.css"'; else echo 'href="../css/moncss.css"'; ?>>
    <title><?php if(!isset($_GET['title'])) echo'Accueil'; else echo $_GET['title']; ?></title>
    </head>
    <style>
        .active>.nav-link{
            background-color: #d0c9d675;
            border-bottom: 4px solid #ce2e7469;
        }
        .navbar-expand-lg{
            padding:0px 16px 0px 16px;
        }
        .navbar-light .navbar-nav .nav-link{
            color:#ffffffb5 !important;
        }
        .navbar-light .navbar-nav .nav-link:hover{
           background-color: #39614057;
           border-bottom: 4px solid #39615ad1;
        }
        

    </style>
