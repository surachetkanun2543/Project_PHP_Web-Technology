<?php
include("check.php");
include('../connect.php');
// get page number
// if page is empty return  $_GET['page'] else return 1 ;
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
if (!empty($_POST['q_name'])) {
    $sql_search = " where m_user like '%" . $_POST['q_name'] . "%' "; // like '%keyword%'
} else {
    $sql_search = '';
}

//get total rows
$rs = $conn->query("select count(m_id) as num from tbl_member $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
$totalRow =  $rs->fetch_array()['num'];
$rowPerPage = 5;  // show 5 rows per a page
// calulate number of Pages
if ($totalRow == 0)
    $totalPage = 1;
else
    $totalPage = ceil($totalRow / $rowPerPage); // ceil หารแล้วปัดเศษขึ้น
// calculate Start row
$startRow = ($page - 1) * $rowPerPage;
// query
$rs = $conn->query("select * from tbl_member $sql_search limit $startRow,$rowPerPage "); // limit เริ่มที่ , จำนวนที่ต้องการแสดง
//echo $conn->error ; // for check error ;
?>
<div class="table-responsive shadow mb-3 ">
<table class="table">
    <!-- //หัวข้อตาราง  -->

    <tr>
        <td bgcolor="5b59a1" style="color: white;">ไอดี</td>
        <td bgcolor="5b59a1" style="color: white;">บัญชีผู้ใช้</td>
        <td bgcolor="5b59a1" style="color: white;">รหัสผ่าน</td>
        <td bgcolor="5b59a1" style="color: white;">ชื่อ</td>
        <td bgcolor="5b59a1" style="color: white;">อีเมล</td>
        <td bgcolor="5b59a1" style="color: white;">ที่อยู่</td>
        <td bgcolor="5b59a1" style="color: white;">แก้ไข</td>
        <td bgcolor="5b59a1" style="color: white;">ลบ</td>
    </tr>

    <?php
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_array()) {
    ?>
            <tr>
                <td><?php echo $row['m_id']; ?></td>
                <td><?php echo $row['m_user']; ?></td>
                <td><?php echo $row['m_pass']; ?></td>
                <td><?php echo $row['m_name']; ?></td>
                <td><?php echo $row['m_email']; ?></td>
                <td><?php echo $row['m_address']; ?></td>
                <td> <a href="#" onclick="edit(<?php echo $row['m_id']; ?>);" data-toggle="modal" data-target="#dataModal"  class='btn btn-outline-warning btn-lg font1 shadow p-1' style="width: 50px;height: 38px;" ><i class='fa fa-cog'></i> </a></td>
                <td> <a href="#" onclick="javascript:del('<?php echo $row['m_id']; ?>');" class='btn btn-outline-danger btn-lg shadow p-1' style="width: 50px;height: 38px;"><i class="fa fa-bitbucket"></i> </a></td>
            </tr>

    <?php
        }
    }
    ?>
</table>
</div>
<!-- bootstrap pagination -->
<ul class="pagination">
    <!-- <li class="page-item"><a class="page-link" href="#"><?php echo 'หน้า ', $totalPage; ?></a></li> -->
    <!-- <li class="page-item"><a  class="page-link" href="#"><?php echo 'ข้อมูลทั้งหมด : ', $totalRow; ?></a></li> -->
    <?php
    for ($i = 1; $i <= $totalPage; $i++) {
    ?>
        <li class="page-item shadow  mb-3" <?php echo ($i == $page) ? ' class="active"' : '' ?>><a class="page-link" href="javascript:show(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
    <?php
    }
    ?>
</ul>