<?php
error_reporting(error_reporting() & ~E_NOTICE);
session_start();
include('../connect.php');

//แสดงชื่อผู้ใช้ที่เจ้าสู่ระบบทุกหน้าใน navber
$user_id = ($_SESSION['user_id']);
$a_name = ($_SESSION['a_name']);


?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ร้านค้าออนไลน์</title>
<link href="css/s.css" rel="stylesheet" />
<link rel="icon" href="https://www.flaticon.com/svg/static/icons/svg/353/353343.svg" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>



<style>
nav {
    height: 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* border: 1px solid red; */
    color: #fff;
    position: relative;
    z-index: 10;
}
  body { 
    font-family: 'Prompt', sans-serif;
    height: 100%;
    background: url('https://translatesongstudio.com/wp-content/uploads/2018/09/white-background-4.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    position: relative;
}
  .navbar-toggler {
    overflow: hidden;
    background-color: #FF4000;
    position: fixed;
    top: 0;
    width: 100%;
    color: lightgray;
  }

  footer {
    position: fixed;
    float: left;
    bottom: 0;
    color: lightgray;
  }

  .table-table-striped {
    font-size: 25px;
  }
</style>
<!-- Footer -->
<footer class="page-footer font-small blue" align="end">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-2">เริ่มเขียนวันที่ 9 ตุลาคม 2563</div>
  <!-- Copyright -->

</footer>
<!-- Footer -->