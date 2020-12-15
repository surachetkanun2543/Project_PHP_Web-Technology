<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านค้า</title>
    <link href="css/s.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="https://www.flaticon.com/svg/static/icons/svg/353/353343.svg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/reset.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/header-1.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  </head>


  <?php
  // include("check.php");
  //1. เชื่อมต่อ database:
  include('admin/fnc.php'); 
  include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
  $p_id = secureStr($_GET['ID']);
  $p_id = $conn->escape_string($_GET['ID']);
  //2. query ข้อมูลจากตาราง:
  $sql = "SELECT * FROM tbl_product as p INNER JOIN tbl_type as t on p.t_id=t.t_id INNER JOIN tbl_delivery as d on p.d_id=d.d_id INNER JOIN tbl_quantity as q on p.p_q_id=q.p_q_id WHERE p.p_id = '$p_id' ORDER BY p.t_id asc";
  $result = mysqli_query($conn, $sql) or die;
  $row = mysqli_fetch_array($result);
  extract($row);

  ?>
  <style>
    img {

      width: 40%;
      height: 40%;
    }

    h4 {
      font-size: 20px;
    }

    h1 {
      color: white;
    }

    .form-control {
      width: 200px;
      margin: 1px;
    }

    .container-fluid {
      background-color: white;
      font-family: 'Prompt', sans-serif;
    }
  </style>

<body>
  <nav>
    <?php include('nav.php') ?>
  </nav>

  <div class="container col-8">
    <div class="card-body col-12" align="center">
      <div class="container-fluid col-12">&ensp;
        <div class="card-body m-4" style="color: black; font-size: 25px;">
          <p style="font-family: 'Prompt', sans-serif; font-size: 25px; font-weight: bold;"align="left"> รายละเอียดข้อมูลสินค้า </p>
          <hr>
        </div>
        <img class="img-responsive m-3" src="admin/p_img/<?php echo $row["p_img"]; ?>">
        <h2 class="form-horizontal m-5" align="left" style="font-size: 25px; font-weight: bold;"><?php echo $row['p_name']; ?></h2>
        <hr>
        <h3 class="form-horizontal m-5" align="left" style="font-size: 18px; font-weight: bold;"> รายละเอียดสินค้า </h3>
        <li class="form-horizontal m-5 " align="left" style="font-size: 18px;"> <?php echo $row['p_detail']; ?></li>
        <hr>
        <h3 class="form-horizontal m-5" align="left" style="font-size: 18px; font-weight: bold;"> หมวดหมู่ </h3>
        <li class="form-horizontal m-5" align="left" style="font-size: 18px;"><?php echo $row['t_name']; ?></li>
        <hr>
        <h3 class="form-horizontal m-5" align="left" style="font-size: 18px; font-weight: bold;"> จัดส่งโดย </h3>
        <li class="form-horizontal m-5" align="left" style="font-size: 18px;"><?php echo $row['d_name']; ?></li>
        <hr>
        <div class="jumbotron  w-100 p-1">
          <h2 class="form-horizontal m-5" align="left" style="font-size: 20px;font-weight: bold;color:red;">฿ <?php echo $row['p_price']; ?> บาท</h2>
        </div>
        <hr>

        <input type="hidden" name="p_id" value="<?php echo $row["p_id"]; ?>" /><br>
        <input type="hidden" name="p_name" value="<?php echo $row["p_name"]; ?>" />
      </div>
    </div>
  </div>
</body>

</html>