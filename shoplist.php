<?php
include('connect.php');
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
if (!empty($_POST['q_name'])) {
    $sql_search = " WHERE p_name LIKE '%" . $_POST['q_name'] . "%' OR  t_name  LIKE '%" . $_POST['q_name'] . "%'";
} else {
    $sql_search = '';
}
$sql = ("SELECT * FROM tbl_product as p INNER JOIN tbl_type as t on p.t_id=t.t_id INNER JOIN tbl_delivery as d on p.d_id=d.d_id INNER JOIN tbl_quantity as q on p.p_q_id=q.p_q_id $sql_search ORDER BY p.p_id DESC  "); // limit เริ่มที่ , จำนวนที่ต้องการแสดง
$result = $conn->query($sql);
?>
           
            <h1  style="font-size:18px;color: black;">รายการสินค้าตาม ชื่อ / หมวดหมู่ : <?php echo  $_POST['q_name']  ?></h1>
            <hr>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
?>

<style>
    .img-responsive{
        transition: transform .7s; /* Animation */
    }
    .img-responsive:hover{
        -ms-transform: scale(1.4); /* IE 9 */
        -webkit-transform: scale(1.4); /* Safari 3-8 */
        transform: scale(1.4);  /* Animation */
    }
</style>

        <div class="card-body  p-3 m-5" style="box-shadow: -4px 7px 28px -1px rgba(214,210,219,1);" align="center">

            <img class="img-responsive m-3" src="admin/p_img/<?php echo $row["p_img"]; ?>">
            <hr>
            <h2 class="form-horizontal m-4" style="font-family: 'Prompt', sans-serif; font-size: 25px;font-size: 25px; font-weight: bold;font-stretch: ultra-condensed;"><?php echo $row['p_name']; ?></h2>
            <h2 class="form-horizontal m-3" style=" font-family: 'Prompt', sans-serif; font-size: 25px;font-size: 20px;">หมวดหมู่ : <?php echo $row['t_name']; ?></h2>
            <hr>
            <h2 class="form-horizontal m-3" style=" color: red; font-family: 'Prompt', sans-serif; font-size: 25px;font-size: 20px;font-weight: bold;">฿ <?php echo $row['p_price']; ?> บาท</h2>
            <hr>
            <div class="card-footer">
            <input type="hidden" name="p_id" value="<?php echo $row["p_id"]; ?>" /><br>
            <input type="hidden" name="p_name" value="<?php echo $row["p_name"]; ?>" />
            <a name="p_id" href="product_detail.php?act=detail&ID= <?php echo $row[0]; ?>" class="btn btn-warning btn-lg  shadow p-2 m-2"> รายละเอียด</a>
            </div>
        </div>
        



<?php
    }
}
?>