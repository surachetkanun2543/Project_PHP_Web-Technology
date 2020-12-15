<!DOCTYPE html>
<html>

<head>

  <?php
  include("check.php");
  include("../connect.php");

  $query = "SELECT COUNT(*) AS SUM FROM tbl_admin ORDER BY a_id" or die;
  $result1 = mysqli_query($conn, $query);

  $query = "SELECT COUNT(*) AS SUM FROM tbl_member ORDER BY m_id" or die;
  $result2 = mysqli_query($conn, $query);

  $query = "SELECT COUNT(*) AS SUM FROM tbl_type ORDER BY t_id" or die;
  $result3 = mysqli_query($conn, $query);

  $query = "SELECT COUNT(*) AS SUM FROM tbl_delivery ORDER BY d_id" or die;
  $result4 = mysqli_query($conn, $query);

  $query = "SELECT COUNT(p_id) AS SUM FROM tbl_product ORDER BY p_id" or die;
  $result5 = mysqli_query($conn, $query);

  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก - Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.2/bootstrap-material-design.umd.min.js" integrity="sha512-dG5ZzvFUfkBdjYdJbsKdGGh8tOa9fv9wHmiChCFJYHRIW1XgfxN2cGzt2HaEPeunXqbAQXBOJvSBQpGOl0qikw==" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="icon" href="https://www.flaticon.com/svg/static/icons/svg/353/353343.svg" />
    <style>
      .container {
        margin: 50px;
      }
    </style>

    <script>
      $(document).ready(function() {
        swal({
                position: 'top-left',
                buttons: false,
                title: 'ยินดีต้อนรับเข้าสู่',
                text: "หน้าแรก",
                timer: 700
            })
        showGraph();
      });

      function showGraph() {
        $.post('chart_db.php', function(data) {
          console.log(data);
          let name = [];
          let id = [];


          for (let i in data) {
            name.push(data[i].name);
            id.push(data[i].number);
          }

          let chartdata = {
            labels: name,
            datasets: [{
              label: 'จำนวน ',
              // backgroundColor: ["#fca311","#4D5360","rgb(201, 203, 207", "#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#5e60ce", "#81b29a", , ],
              // hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
              backgroundColor: [
                'rgba(0, 137, 132, .2)',
              ],
              borderColor: [
                'rgba(0, 10, 130, .7)',
              ],
              borderCapStyle: 'butt',
              borderColor: 'rgba(0, 8, 7, 0.1)',
              borderJoinStyle: 'miter',
              fill: true,
              borderWidth: 3,
              pointBackgroundColor: '#d9534f',
              pointBorderColor: 'rgba(0, 0, 0, 0.1)',
              pointBorderWidth: 10,
              pointHoverBorderWidth: 1,
              pointHitRadius: 1,
              pointRadius: 5,
              pointHoverRadius: 4,
              pointStyle: 'doughnut',

              data: id
            }]
          };

          let graphTarget = $('#graphCanvas');
          let barGraph = new Chart(graphTarget, {
            type: 'line',
            data: chartdata
          })
        });
      }
    </script>
    <nav>
      <?php include('nav.php') ?>
    </nav>
  </head>

<body>
  <div class="container">
    <div class="row m-5 col-12 p-3 ">
      <main class="col-12 m-3 ml col-lg-10 px-md-4 py-4">
        <h1 class="h2 font-weight-bold">หน้าแรก</h1>
        <p class="">Admin Dashboard - รายงานภาพรวมของร้านค้า</p>
        <hr />
        <div class="row my-4">
          <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card">
              <h5 class="card-header bg-info text-white">จำนวนแอดมิน</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result1 as $results) { ?>
                    <h1 value="<?php echo $results["a_id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> คน</h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a  href="admin.php" class="card-text text-success">รายละเอียด</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
              <h5 class="card-header bg-info text-white">จำนวนสมาชิก</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result2 as $results) { ?>
                    <h1 value="<?php echo $results["m_id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> คน</h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a href="member.php" class="card-text text-success ">รายละเอียด</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
              <h5 class="card-header bg-info text-white">จำนวนหมวดหมู่</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result3 as $results) { ?>
                    <h1 value="<?php echo $results["t_id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> หมวด</h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a href="type.php" class="card-text text-success ">รายละเอียด</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
              <h5 class="card-header bg-info text-white">จำนวนบริษัทจัดส่ง</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result4 as $results) { ?>
                    <h1 value="<?php echo $results["d_id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> บริษัท</h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a href="delivery.php" class="card-text text-success ">รายละเอียด</a>
              </div>
            </div>
          </div>
          <div class="h1"></div>
          <div class="h1"></div>
          <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
              <h5 class="card-header bg-info text-white">จำนวนสินค้า</h5>
              <div class="card-body">
                <div class="h2 card-title">
                  <?php
                  foreach ($result5 as $results) { ?>
                    <h1 value="<?php echo $results["p_id"]; ?>">
                      <h1><?php echo $results["SUM"]; ?> ชิ้น</h1>
                    </h1>
                  <?php }
                  ?>
                </div>
                <hr />
                <a href="product.php" class="card-text text-success ">รายละเอียด</a>
              </div>
            </div>
          </div>
          <div class="h1"></div>
          <div class="h1"></div>
          <div class="col-12 ">
            <div class="card">
              <h5 class="card-header bg-info text-white">หมวดหมู่สินค้าที่มีสินค้า จากน้อยไปมาก</h5>
              <div class="card-body">
                <canvas id="graphCanvas" < />
              </div>
            </div>
          </div>
      </main>
    </div>
  </div>
  </div>
</body>

</html>