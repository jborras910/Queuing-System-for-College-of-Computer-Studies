<?php 
session_start();

if(!isset($_SESSION['authenticanted'])){

    $_SESSION['status'] =  'Access Denied';
    header('Location: ../facultyLogin.php');
  
}



?>




<!DOCTYPE html>
<html lang="en">



    <head>




        <meta charset="utf-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" href="https://tip.edu.ph/assets/Uploads/TIP-INFORMAL-LOGO-04-2.png">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Site Dashboard</title>



        <link href="css/styles.css" rel="stylesheet" />
        <!-- DATA TABLES-->
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/sl-1.3.3/datatables.min.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet" />


        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>





        <style>
        .modal-content {
            background: #292929 !important;
            color: #fff !important;
        }

        .modal-content .btn {
            border: none !important;
        }

        .modal-content .x_btn {
            color: #fff !important;
            border: none !important;
        }



        .modal-content .btn-primary {
            background: #fae80e !important;
            color: #292929 !important;
            font-weight: 600 !important;

        }

        .sb-topnav,
        .sb-sidenav {
            background-color: #000d10 !important;
        }

        .sb-sidenav .nav-link {

            color: #fff !important;
            font-weight: bold;
        }

        .sb-sidenav .fas {
            color: #fff !important;
            font-weight: bold;
        }

        .sb-sidenav-menu-heading {
            color: #fff !important;
            font-weight: bold;
        }

        .sb-sidenav-collapse-arrow {
            color: #fff !important;
            font-weight: bold;
        }

        .nav-link .sb-nav-link-icon {
            font-weight: bold;

            color: #fff !important;
        }



        .card {

            margin: 20px auto !important;
            padding: 0px !important;

        }

        .card img {
            width: 100% !important;

            height: 550px !important;

        }



        #dataTable {
            border-collapse: collapse !important;
            border-spacing: 0 !important;
            width: 100% !important;


        }

        .card-body {

            overflow-x: auto !important;
        }

        </style>
    </head>

    <body class="sb-nav-fixed">

        <?php include('navbar-top.php'); ?>

        <div id="layoutSidenav">
            <?php include('sidebar.php'); ?>


            <div id="layoutSidenav_content">
                <main>
