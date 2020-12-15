<?php
        //1. เชื่อมต่อ database: 
        include('../connect.php');
        include('fnc.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
        //สร้างตัวแปรสำหรับรับค่า member_id จากไฟล์แสดงข้อมูล
        
        
        $p_id = $_REQUEST["ID"];
        $p_id = secureStr($_REQUEST['ID']);
        $p_id = $conn->escape_string($_REQUEST['ID']);
        
        //ลบข้อมูลออกจาก database ตาม member_id ที่ส่งมา

        $sql = "DELETE FROM tbl_product WHERE p_id='$p_id' ";
        $result = mysqli_query($conn, $sql) or die;

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

    if ($result) {
      header('location:product.php');
      // echo "<script>alert('DELETE Succesfuly');window.location ='admin.php';</script>";
    } else {
      

    }
?>