<?php
 session_start();
//  DOCUMENT
//  ลงจาก Auten ให้กับสถานะไว้ทุกครั้งที่โหลดหน้าเว็บและตรวจสอบ SESSION ที่มีสถานะเป็น loginstatus
//  มีค่าเป็น 1 มั้ย ถ้ายังไม่เป็น 1 แสดงว่ายังไม่มีการ login
//  แล้วทำการไล่ผู้ใช้ที่ยังไม่ login ออกไปหน้า login

if ($_SESSION['logStatus'] != 1) {

    header('location:login.php');
    session_destroy();
    exit();
} else {
    # code...
}
