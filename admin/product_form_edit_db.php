<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.15.3/dist/sweetalert2.all.min.js"></script>
<?php
  include('fnc.php');
  include('../connect.php');
//1. เชื่อมต่อ database: 
// include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
$date1 = date("Ymd_His");
//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
$numrand = (mt_rand());

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$p_id = secureStr($_POST["p_id"]);
$p_name = secureStr($_POST["p_name"]);
$p_price = secureStr($_POST["p_price"]);
$t_id = secureStr($_POST["t_id"]);
$p_detail = secureStr($_POST["p_detail"]);
$p_q_id = secureStr($_POST['p_q_id']);
$d_id = secureStr($_POST["d_id"]);
$p_img = (isset($_POST['p_img']) ? $_POST['p_img'] : '');
$img2 = $_POST['img2'];
$upload = $_FILES['p_img']['name'];

if ($upload != '') {

    //โฟลเดอร์ที่เก็บไฟล์
    $path = "p_img/";
    //ตัวขื่อกับนามสกุลภาพออกจากกัน
    $type = strrchr($_FILES['p_img']['name'], ".");
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = $numrand . $date1 . $type;

    $path_copy = $path . $newname;
    $path_link = "p_img/" . $newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    move_uploaded_file($_FILES['p_img']['tmp_name'], $path_copy);
} else {
    $newname = $img2;
}

//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 

$sql = "UPDATE tbl_product SET  p_name='$p_name', p_price='$p_price', t_id='$t_id',  p_detail='$p_detail', p_q_id='$p_q_id', d_id='$d_id', p_img='$newname'
		WHERE p_id='$p_id' ";

$result = mysqli_query($conn, $sql) or die;

mysqli_close($conn); //ปิดการเชื่อมต่อ database 

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลสินค้า $p_name สำเร็จ!! ');";
    echo "window.location = 'product.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลสินค้า $p_name ไม่สำเร็จ!! ');";
    echo "window.location = 'product.php'; ";
    echo "</script>";
}
