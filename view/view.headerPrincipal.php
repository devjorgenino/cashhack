<?php 
session_name("cashhack");
session_start();
if(isset($_SESSION['usuario'])):
  //header('Location: index.php?c=app&a=dashboard');
endif;
require_once 'model/model.login.php';
?>

<!DOCTYPE html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Custom styles for this template-->
  <link rel="Shortcut Icon" type="image/x-icon" href="assets/img/geekhack-logo.ico" />
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/css/fontawesome/css/all.css" rel="stylesheet">

  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/vendor/datatables/responsive.bootstrap4.min.css"> 


</head>
<body class="bg-gradient-primary">
<div class="loader"></div>