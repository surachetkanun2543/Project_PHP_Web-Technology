<?php
include("check.php");
//1. เชื่อมต่อ database:
include('../connect.php'); //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//2. query ข้อมูลจากตาราง tb_member:
$query = "SELECT * FROM tbl_type ORDER BY t_id asc" or die;
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result = mysqli_query($conn, $query);
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:
//2. query ข้อมูลจากตาราง 
$query2 = "SELECT * FROM tbl_delivery ORDER BY d_id asc" or die;
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result2 = mysqli_query($conn, $query2);
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:
$query3 = "SELECT * FROM tbl_quantity ORDER BY p_q_id asc" or die;
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result3 = mysqli_query($conn, $query3);
?>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<div class="card-body col-12 shadow p-0 mb-3 ">
    <div class="card-header " style="background-color:#44437a;color: white;">
        <strong>เพิ่ม / แก้ไข ข้อมูล</strong>
    </div>
    <div class="card-body col-12">
        <div id="report" class="alert-danger"></div>
        <form name="addproduct" action="product_form_add_db.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <input type="text" name="p_name" class="form-control" required placeholder="ชื่อสินค้า" />&ensp;
        <input type="text" name="p_price" class="form-control" required placeholder="ราคาสินค้า" />&ensp;
        <select name="t_id" class="form-control" required>
            <option value="t_id">ประเภทสินค้า</option>
            <?php foreach ($result as $results) { ?>
                <option value="<?php echo $results["t_id"]; ?>">
                    <?php echo $results["t_name"]; ?>
                </option>
            <?php } ?>
        </select>&ensp;
        <select name="p_q_id" class="form-control" required>
      <option value="<?php echo $row["p_q_id"]; ?>">
        <?php echo $row["p_q_id"]; ?>
      </option>
      <option value="p_q_id">จำนวนสินค้า</option>
      <?php foreach ($result3 as $results3) { ?>
        <option value="<?php echo $results3["p_q_id"]; ?>">
          <?php echo $results3["p_q_id"]; ?>
        </option>
      <?php } ?>
    </select>&ensp;
        <select name="d_id" class="form-control" required>
            <option value="d_id">บริษัทจัดส่ง</option>
            <?php foreach ($result2 as $results2) { ?>
                <option value="<?php echo $results2["d_id"]; ?>">
                    <?php echo $results2["d_name"]; ?>
                </option>
            <?php } ?>
        </select>&ensp;
        <textarea name="p_detail" class="form-control"></textarea>&ensp;
        <div class="custom-file mb-3">
        <input type="file" name="p_img" id="p_img" class="custom-file-input" title="เลือกรูปภาพสินค้า">&ensp;
        <label class="custom-file-label" for="customFile">เลือกรูปภาพสินค้า</label>
    </div>
        <div class="card-body col-12 " align="right">
            <input type="hidden" name="p_id" id="p_id">
            <button style="width: 60px;height: 40px;" type="submit" id="btn" class="btn btn-outline-primary shadow p-1"glyphicon glyphicon-ok"> <span class="fa fa-cloud-upload"></span> </button>&ensp;
            <button type="reset" style="width: 60px;height: 40px;" class="btn btn-outline-danger shadow p-1"><span class="fa fa-repeat"></span></button>
        </div>
    </div>
</div>
</form>