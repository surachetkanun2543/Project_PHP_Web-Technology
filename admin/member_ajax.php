<?php
include("check.php");
header('Content-Type: charset=utf-8');
include('../connect.php');
include("fnc.php");
$status = "";
$msg = "";

if ($_POST['action'] == 'edit') {
    if (!empty($_POST['m_id'])) {

        $m_id = secureStr($_POST['m_id']);
        $m_id = $conn->escape_string($_POST['m_id']);
        $sql = "select * from  tbl_member where m_id='" . $m_id . "' limit 1 ";
        $rs = $conn->query($sql);
        $row = $rs->fetch_array();
        echo json_encode($row);
        exit();
    }
}

// delete function
if ($_POST['action'] == 'delete') {
    if (!empty($_POST['m_id'])) {

        $m_id = secureStr($_POST['m_id']);
        $m_id = $conn->escape_string($_POST['m_id']);
        $sql = "delete from tbl_member where m_id='" . $m_id . "' ";
        $rs = $conn->query($sql);
        if ($rs) {
            $status = "ok";
        } else {

            echo "<script type='text/javascript'>";
            echo "alert('ลบ ผิดพลาด');";
            echo "window.location = 'admin.php'; ";
            echo "</script>";
        }
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ลบ ผิดพลาด');";
        echo "window.location = 'admin.php'; ";
        echo "</script>";
    }

    echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
    exit();
}
if ($_POST['action'] == 'update') {
    if (!empty($_POST['txt_user'])) {

        $m_id = secureStr($_POST['m_id']);
        $m_user =  secureStr($_POST['txt_user']);
        $m_pass =  secureStr($_POST['txt_pass']);
        $m_name =  secureStr($_POST['txt_name']);
        $m_email = secureStr($_POST['txt_email']);
        $m_tel =  secureStr($_POST['txt_tel']);
        $m_address =  secureStr($_POST['txt_address']);

        $m_id = $conn->escape_string($_POST['m_id']);
        $m_user =  $conn->escape_string($_POST['txt_user']);
        $m_pass =  sha1($conn->escape_string($_POST['txt_pass']));
        $m_name =  $conn->escape_string($_POST['txt_name']);
        $m_email =  $conn->escape_string($_POST['txt_email']);
        $m_tel =  ($conn->escape_string($_POST['txt_tel']));
        $m_address =  $conn->escape_string($_POST['txt_address']);

        $sql = "UPDATE tbl_member SET  m_user='$m_user', m_pass='$m_pass', m_name='$m_name',m_email='$m_email',m_tel='$m_tel', m_address='$m_address' WHERE m_id='$m_id' ";

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

        $m_id = secureStr($_POST['m_id']);
        $m_user =  secureStr($_POST['txt_user']);
        $m_pass =  secureStr($_POST['txt_pass']);
        $m_name =  secureStr($_POST['txt_name']);
        $m_email = secureStr($_POST['txt_email']);
        $m_tel =  secureStr($_POST['txt_tel']);
        $m_address =  secureStr($_POST['txt_address']);

        $m_id = $conn->escape_string($_POST['m_id']);
        $m_user =  $conn->escape_string($_POST['txt_user']);
        $m_pass =  sha1($conn->escape_string($_POST['txt_pass']));
        $m_name =  $conn->escape_string($_POST['txt_name']);
        $m_email =  $conn->escape_string($_POST['txt_email']);
        $m_tel =  ($conn->escape_string($_POST['txt_tel']));
        $m_address =  $conn->escape_string($_POST['txt_address']);

        $sql = "INSERT INTO tbl_member(m_user, m_pass, m_name, m_email, m_tel, m_address) VALUES('$m_user', '$m_pass', '$m_name', '$m_email', '$m_tel', '$m_address')";

        $rs = $conn->query($sql);
        if ($rs) {
            $status = "ok";
            $msg = "สำเร็จ";
        } else {
            $status = "";
            $msg = "ผิดพลาด";
        }
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('Error back to upload again');";
        echo "window.location = 'admin.php'; ";
        echo "</script>";
    }
    echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
    exit();
}
