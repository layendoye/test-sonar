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
        .btRadio {
            padding:20% 20% 20% 20% !important;
        }
        .pager>.active>a{
            border-radius: 50px;
            background-color: rgba(14, 13, 13, 0.288);
            color:white;
        }
        .pager{
            justify-content: center;
            margin-top:2%;
        }
        .page_link,.prev_link,.next_link{
            border:1px solid #fec2368f;
            border-radius: 50px;
            font-size:20px;
            background-color: white;
            padding:2px 10px 3px 10px;
            text-decoration: none ;
            color: #212529;
            
        }
        .page_link:hover,.prev_link:hover,.next_link:hover{
            text-decoration: none;
            color: #212529;
        }
        .btinf {
            width:100%;
            padding-top:1px;
            padding-bottom:1px;
        }
    </style>
