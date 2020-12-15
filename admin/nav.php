<?php include('h.php');
include('check.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/reset.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/header-1.css" />

  </head>
  <body>
    <!-- navbar Start -->
    <header class="site-header" >
      <div class="wrapper site-header__wrapper">
        <a class="text-decoration-none" class="brand"></a>
        <nav class="nav" >
        <button class="nav__toggle" aria-expanded="false" type="button"><i class="fa fa-align-justify" style="width: 20px; height: 20px;"  ></i></button>
                <ul class="nav__wrapper" >
                    <li class="nav__item">
                         <a class="text-decoration-none" style="font-family: 'Prompt', sans-serif; color: #FFFFFF;" class="text-primary"><i  style="color: 	#FFFFFF;" class="fa fa-user-circle-o"> &ensp;</i>ยินดีต้อนรับคุณ : <?php echo $a_name; ?>   | </a>
                    </li>
                    <li class="nav__item">
                        <a class="text-decoration-none"style="color: 	#FFFFFF;" class="text-primary" href="index.php" style="text-decoration: none;"><i class="fa fa-home" title="หน้าหลัก">&ensp;</i> หน้าแรก | </a>
                    </li>
                    <li class="nav__item">
                        <a class="text-decoration-none" style="color:	#FFFFFF;"class="text-primary" href="admin.php"><i class="fa fa-flag-o" title="หน้าจัดการแอดมิน">&ensp;</i> หน้าจัดการแอดมิน | </a>
                    </li>
                    <li class="nav__item">
                        <a class="text-decoration-none" style="color:	#FFFFFF;"class="text-primary" href="member.php"><i class="fa fa-drupal" title="หน้าจัดการสมาชิก">&ensp;</i> หน้าจัดการสมาชิก |  </a>
                    </li>
                    <li class="nav__item">
                       <a class="text-decoration-none" style="color: 	#FFFFFF;"class="text-primary" href="type.php"> <i class="fa fa-file-text-o" title="หน้าจัดการหมวดหมู่สินค้า">&ensp;</i> หน้าจัดการหมวดหมู่ |  </a>
                    </li>
                    <li class="nav__item">
                        <a class="text-decoration-none" style="color: #FFFFFF;"class="text-primary" href="delivery.php"><i class="fa fa-truck"   title="หน้าจัดการบริษัทจัดส่ง">&ensp;</i> หน้าจัดการบริษัทจัดส่ง |  </a>
                    </li>
                    <li class="nav__item">
                        <a class="text-decoration-none" style="color: 	#FFFFFF;"class="text-primary" href="product.php"> <i class="fa fa-shopping-cart"  title="หน้าจัดการสินค้า">&ensp;</i> หน้าจัดการสินค้า |  </a>
                    </li>
                    <li class="nav__item">
                        <a class="text-decoration-none" style="color: 	#FFFFFF;"class="text-primary" href="../index.php"> <i class="fa fa-shopping-bag"  title="หน้าร้านค้า"> &ensp;</i> ร้านค้า |  </a>
                    </li>
                    <li class="nav__item">
                        <a class="text-decoration-none" style="color: 	#FFFFFF;" class="btn btn-danger" href="logout.php" onclick="return confirm('ยืนยันออกจากระบบ?')"><i class="fa fa-sign-in" title="ออกจากระบบ"></i> ออกจากระบบ </a>
                    </li>
                </ul>
        </nav>
      </div>
    </header>
    <!-- Header End -->
  </body>
</html>