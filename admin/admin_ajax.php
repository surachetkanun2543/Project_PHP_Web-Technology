<?php
include("check.php");
header('Content-Type: charset=utf-8');
include('../connect.php');
include("fnc.php");
$status = "";
$msg = "";

if ($_POST['action'] == 'edit') {
    if (!empty($_POST['a_id'])) {

        $a_id = secureStr($_POST['a_id']);
        $a_id = $conn->escape_string($_POST['a_id']);

        $sql = "select * from  tbl_admin where a_id='" . $a_id . "' limit 1 ";
        $rs = $conn->query($sql);
        $row = $rs->fetch_array();
        // encode คือการแปล array ในแบบ php เป็นในรูปแบบ json
        echo json_encode($row);
        exit();
    }
}

// delete function
if ($_POST['action'] == 'delete') {
    if (!empty($_POST['a_id'])) {
        $a_id = secureStr($_POST['a_id']);
        $a_id = $conn->escape_string($_POST['a_id']);
        $sql = "delete from tbl_admin where a_id='" . $a_id . "' ";
        $rs = $conn->query($sql);
        if ($rs) {
            $status = "ok";
        } else {
            $msg="ลบ ข้อมูลไม่สำเร็จ โปรดลองอีกครั้ง";
            echo "<script type='text/javascript'>";
            echo "alert('ลบ ผิดพลาด');";
            echo "window.location = 'admin.php'; ";
            echo "</script>";
        }
    } else {
        $msg="ลบ ข้อมูลไม่สำเร็จ โปรดลองอีกครั้ง";
        echo "<script type='text/javascript'>";
        echo "alert('ลบ ผิดพลาด');";
        echo "window.location = 'admin.php'; ";
        echo "</script>";
    }

    echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
    exit();
}
if ($_POST['action'] == 'update') {
    if (!empty($_POST['txt_user']) && !empty($_POST['a_id'])) {

        $a_id = secureStr($_POST['a_id']);
        $a_user =  secureStr($_POST['txt_user']);
        $a_pass =  secureStr($_POST['txt_pass']);
        $a_name =  secureStr($_POST['txt_name']);
        $a_email =  secureStr($_POST['txt_email']);

        $a_id = $conn->escape_string($_POST['a_id']);
        $a_user =  $conn->escape_string($_POST['txt_user']);
        $a_pass =  sha1($conn->escape_string($_POST['txt_pass']));
        $a_name =  $conn->escape_string($_POST['txt_name']);
        $a_email =  $conn->escape_string($_POST['txt_email']);

        $sql = "UPDATE tbl_admin SET  a_user='$a_user' , a_pass='$a_pass' , a_name='$a_name' , a_email='$a_email'  WHERE a_id='$a_id' ";
        $rs = $conn->query($sql);

        if ($rs) {
            $status = "ok";
        } else {
            $msg = "แก้ไขข้อมูลไม่ได้ 1 ";
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไข  ผิด');";
            echo "window.location = 'admin.php'; ";
            echo "</script>";
        }
    } else {
        $msg = "แก้ไขข้อมูลไม่ได้ 2 ";
        echo "<script type='text/javascript'>";
        echo "alert('แก้ไข ผิดพลาด');";
        echo "window.location = 'admin.php'; ";
        echo "</script>";
    }

    echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
    exit();
}
if ($_POST['action'] == 'add') {
    if (!empty($_POST['txt_user'])) {

        $a_user =  secureStr($_POST['txt_user']);
        $a_pass =  secureStr($_POST['txt_pass']);
        $a_name =  secureStr($_POST['txt_name']);
        $a_email =  secureStr($_POST['txt_email']);

        $a_user =  $conn->escape_string($_POST['txt_user']);
        $a_pass =  sha1($conn->escape_string($_POST['txt_pass']));
        $a_name =  $conn->escape_string($_POST['txt_name']);
        $a_email =  $conn->escape_string($_POST['txt_email']);

        $sql = "INSERT INTO tbl_admin (a_user,  a_pass, a_name , a_email) VALUES ('$a_user', '$a_pass', '$a_name', '$a_email')";

        $rs = $conn->query($sql);
        if ($rs) {
            $status = "ok";
            $msg = "สำเร็จ";
        } else {
            $status = "";
            $msg = "ผิดพลาด";
            echo "<script type='text/javascript'>";
            echo "alert('ผิดพลาด โปรดลองอีกครั้ง');";
            echo "window.location = 'admin.php'; ";
            echo "</script>";
        }
    } else {
            echo "<script type='text/javascript'>";
            echo "alert('ผิดพลาด โปรดลองอีกครั้ง');";
            echo "window.location = 'admin.php'; ";
            echo "</script>";
    }
    echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
    exit();
}
