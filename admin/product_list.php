<?php
include("check.php");
include('../connect.php');
// get page number
// if page is empty return  $_GET['page'] else return 1 ;
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
if (!empty($_POST['q_name'])) {
  $sql_search = " where p_name like '%" . $_POST['q_name'] . "%' "; // like '%keyword%'
} else {
  $sql_search = '';
}

//get total rows
$rs = $conn->query("select count(p_id) as num from tbl_product $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
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
$rs = $conn->query("SELECT * FROM tbl_product as p INNER JOIN tbl_type as t on p.t_id=t.t_id INNER JOIN tbl_delivery as d on p.d_id=d.d_id  $sql_search  limit $startRow,$rowPerPage "); // limit เริ่มที่ , จำนวนที่ต้องการแสดง
//echo $conn->error ; // for check error ;

// $query2 = "SELECT * FROM tbl_quantity ORDER BY p_q_id asc" or die;
// //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
// $result2 = mysqli_query($conn, $query2);
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

echo  ' <table class="table table-striped shadow mb-3">';
//หัวข้อตาราง
echo "<tr>
      <td bgcolor='5b59a1' style='color: white;'>ไอดี</td>
      <td bgcolor='5b59a1' style='color: white;'>หมวดหมู่</td>
      <td bgcolor='5b59a1' style='color: white;'>ชื่อสินค้า</td>
      <td bgcolor='5b59a1' style='color: white;'>รายละเอียด</td>
      <td bgcolor='5b59a1' style='color: white;'>จำนวนสินค้า</td>
      <td bgcolor='5b59a1' style='color: white;'>บริษัทจัดส่ง</td>
      <td bgcolor='5b59a1' style='color: white;'>ราคาสินค้า</td>
      <td bgcolor='5b59a1' style='color: white;'>รูปภาพ</td>
      <td bgcolor='5b59a1' style='color: white;'>แก้ไข</td>
      <td bgcolor='5b59a1' style='color: white;'>ลบ</td>
    </tr>";

if ($rs->num_rows > 0) {
  while ($row = $rs->fetch_array()) {
    echo "<tr>";
    echo "<td>" . $row["p_id"] .  "</td> ";
    echo "<td>" . $row["t_name"] .  "</td> ";
    echo "<td>" . $row["p_name"] . "</td> ";
    echo "<td>" . $row["p_detail"] . "</td> "; 
    echo "<td>" . $row["p_q_id"] . "</td> ";
    echo "<td>" . $row["d_name"] . "</td> ";
    echo "<td>" . $row["p_price"] . "&ensp;<label> บาท </label>" . "</td>";
    echo "<td class='img-fluid hover-shadow' align=center>" . "<img src='p_img/" . $row["p_img"] . "' width='100'>" . "</td>";
    //แก้ไขข้อมูล
    echo "<td> <a  href='product.php?act=edit&ID=$row[0]'  class='btn btn-outline-warning btn-lg font1 shadow p-1' style='width: 50px;height: 38px;'><i class='fa fa-cog'></i> </a></td> ";
    //ลบข้อมูล
    echo "<td><a href='product_from_delete_db.php?ID=$row[0]' onclick=\"return confirm('ยืนยันการลบข้อมูล')\" class='btn btn-outline-danger btn-lg shadow p-1' style='width: 50px;height: 38px;'><i class='fa fa-bitbucket'></i> </a></td>";
    echo "</tr>";
  }
}
echo "</table>";
?>
<ul class="pagination">
  <?php
  for ($i = 1; $i <= $totalPage; $i++) {
  ?>
    <li class="page-item shadow  mb-3" <?php echo ($i == $page) ? ' class="active"' : '' ?>><a class="page-link" href="javascript:show(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
  <?php
  }
  ?>
</ul>
<!-- 5. close connection -->
<?php mysqli_close($conn); ?>