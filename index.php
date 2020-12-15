<?php
include('connect.php');
error_reporting(error_reporting() & ~E_NOTICE);
$query = "SELECT * FROM tbl_type ORDER BY t_id asc" or die;
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result = mysqli_query($conn, $query);
?>
<!doctype html>
<html lang="en">

<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>ร้านค้า</title>

    <link rel="icon" href="https://www.flaticon.com/svg/static/icons/svg/353/353343.svg" />


    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="assets/css/slick.css">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <link href="css/index_style.css" rel="stylesheet" />

    <script language-="javascript">
        $().ready(function() {
            show(1);
            $('#btsearch').click(function() {
                show(1);
            });
        });

        function show(page) {
            $("#showContain").load("shoplist.php?page=" + page, {
                q_name: $("#q_name").val()
            }, function() {});
        }
    </script>

    <style>
        img {

            width: 20%;
            height: 20%;
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

        .container {
            background-color: white;
        }
    </style>
</head>

<body>
    <nav>
        <?php include('nav.php') ?>
    </nav>
    <div class="container">
        <div class="row">
            <div class="header-wrapper">
                <div class="header-info">
                    <h1 style="color: white;">สวัสดี! เราคือ  <span id="type"></span></h1>
                    <p>ยินดีต้อนรับเข้าสู่ร้าน Ruay  Shop ร้านค้าออนไลน์ที่มีสินค้าให้ท่านเลือกมากกว่า 1 ล้านชิ้น
                        รับประทันของแท้ทุกชิ้น ! </p>
                    <p> # ขอให้สนุกกับการช็อปปิ้ง</p>
                    </p>
                </div>
            </div>

            <section id="discount-product" class="discount-product pt-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-discount-product mt-30">
                                <div class="product-image">
                                    <img src="assets/images/discount-product/product-1.jpg" alt="Product">
                                </div> <!-- product image -->
                                <div class="product-content">
                                    <h4 class="content-title mb-15">สินค้าสำหรับตกแต่งบ้าน<br>ที่สุดหลากหลาย</h4>
                                    <a href="#">รายละเอียด<i class="lni-chevron-right"></i></a>
                                </div> <!-- product content -->
                            </div> <!-- single discount product -->
                        </div>
                        <div class="col-lg-6">
                            <div class="single-discount-product mt-30">
                                <div class="product-image">
                                    <img src="assets/images/3.jpg" alt="Product">
                                </div> <!-- product image -->
                                <div class="product-content">
                                    <h4 class="content-title mb-15">สินค้าไอที<br> หลากหลายที่สุด</h4>
                                    <a href="#">รายละเอียด<i class="lni-chevron-right"></i></a>
                                </div> <!-- product content -->
                            </div> <!-- single discount product -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
            </section>
            &ensp;
            <div class="card-body col-12">
                <div class="container-fluid col-12">
                    <form action="javascript:;" method="post">
                        <h2 style=" font-family: 'Prompt', sans-serif; font-size: 25px; font-weight: bold;">ค้นหาสินค้า</h2>
                        &ensp;
                        <hr />
                        <h2 style=" font-family: 'Prompt', sans-serif; font-size: 18px;">หมวดหมู่สินค้าทั้งหมด : <?php foreach ($result as $results) { ?> | <?php echo $results["t_name"]; ?> <?php } ?></h2>
                        &ensp;
                        <input class="form-control" ;style=" font-family: 'Prompt', sans-serif;" type="search" name="q_name" id="q_name" placeholder="ค้นหา">
                        <button style="display: none;" id="btsearch" type="submit"></button>
                        <hr>
                    </form>
                </div>
            </div>
            <section id="product" >
                <div class="container">
                    <div class="row">
                    </div>
                    <div class="col-12" id='showContain'></div>
                </div> <!-- row -->
        </div> <!-- product items -->
    </div> <!-- tab pane -->

    <!--====== jquery js ======-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="assets/js/bootstrap.min.js"></script>


    <!--====== Slick js ======-->
    <script src="assets/js/slick.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>

    <!--====== nav js ======-->
    <script src="assets/js/jquery.nav.js"></script>

    <!--====== Nice Number js ======-->
    <script src="assets/js/jquery.nice-number.min.js"></script>

    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.5/typed.js" integrity="sha512-6jYd74hwloeB8HwKDIiUM3juIyZOCyPTrfJbEUlueTxNPjSjcQZr9DkO6P8xVRFuPYN6YitDunNKgxUwFfIixQ==" crossorigin="anonymous"></script>

    <script>
        var typed = new Typed('#type', {
            strings: ['ร้านขายสินค้าไอที', 'ร้านขายสินค้าตกแต่งบ้าน', 'ร้านขายสินค้าเครื่องใช้ไฟฟ้า', 'ร้านขายสินค้าเครื่องเขียน', 'ร้านขายสินค้าอิเล็กทรอนิกส์', 'ร้านขายโทรศัพท์มือถือ'],
            smartBackspace: true,
            loop: true,
            typeSpeed: 100,
            backSpeed: 100,
            fadeOut: false,
        });
    </script>

</body>

</html>
