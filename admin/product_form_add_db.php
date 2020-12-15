<meta charset="UTF-8">
<?php
include('fnc.php');
include('../connect.php');
include("check.php");

//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
$date1 = date("Ymd_His");
//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
$numrand = (mt_rand());
//รับค่าไฟล์จากฟอร์ม
$p_name = secureStr($_POST['p_name']);
$p_price = secureStr($_POST['p_price']);
$t_id = secureStr($_POST['t_id']);
$p_detail = secureStr($_POST['p_detail']);
$p_q_id = secureStr($_POST['p_q_id']);
$d_id = secureStr($_POST['d_id']);
$upload = $_FILES['p_img'];
// $p_img = (isset($_POST['p_img']) ? $_POST['p_img'] : '');
//img

// ด้านซ้าย และ ด้านขวา ไม่เท่ากัน (a <> b) -> true
if ($upload <> '') {

	//โฟลเดอร์ที่เก็บไฟล์
	$path = "p_img/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['p_img']['name'], ".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname = 'p_img' . $numrand . $date1 . $type;
	$path_copy = $path . $newname;
	$path_link = "p_img/" . $newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['p_img']['tmp_name'], $path_copy);
}
// เพิ่มไฟล์เข้าไปในตาราง uploadfile

$sql = "INSERT INTO tbl_product
		(
		p_name,
		t_id,
		p_price,
		p_detail,
		p_q_id,
		d_id,
		p_img
		)
		VALUES
		(
		'$p_name',
		'$t_id',
		'$p_price',
		'$p_detail',
		'$p_q_id',
		'$d_id',
		'$newname')";

$result = mysqli_query($conn, $sql); // or die ("Error in query: $sql " . mysqli_error());

mysqli_close($conn);
// javascript แสดงการ upload file


if ($result) {
	echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสินค้า $p_name สำเร็จ!! ');";
    echo "window.location = 'product.php'; ";
    echo "</script>";
} else {
	
}
?>