<!DOCTYPE html>
<html>

<head>
    <title> จัดการบริษัทจัดส่ง </title>
    <?php
    include('h.php');
    include("check.php");
    include('../connect.php');
    error_reporting(error_reporting() & ~E_NOTICE);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.15.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


    <script language-="javascript">
        $().ready(function() {
            swal({
                position: 'top-left',
                buttons: false,
                title: 'ยินดีต้อนรับเข้าสู่',
                text: "หน้าจัดการบริษัทจัดส่งสินค้า",
                timer: 700
            })
            show(1);
            // search
            $('#btsearch').click(function() {
                show(1);
            });

            // insert and uppdate
            $('#bt').click(function() {
                $('#bt').attr('disabled', true);
                var data = $("#f").serialize();
                $.ajax({
                    type: "POST",
                    url: "delivery_ajax.php",
                    dataType: "json",
                    data: data,
                    success: function(data) {
                        if (data.status != "ok") {
                            $("#report").html(data.msg); // show error
                        } else {
                            swal("สำเร็จ", "เพิ่ม/แก้ไข ข้อมูลเรียบร้อย !!", "success");
                            // clear data in form
                            $("#d_id").val("");
                            $("#action").val("add"); // คืนค่ากลับไปที่เพิ่มข้อมูล
                            $("#txt_name").val("");
                        }
                        show(1); // refresh table
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                });
                $('#bt').attr('disabled', false);
            });
        });

        function edit(d_id) {
            $.ajax({
                type: "POST",
                url: "delivery_ajax.php",
                dataType: "json",
                data: "action=edit&d_id=" + d_id,
                success: function(data) {
                    $("#d_id").val(data.d_id);
                    $("#action").val("update");
                    $("#d_id").val(data.d_id);
                    $("#txt_name").val(data.d_name);
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            });

        }

        function del(d_id) {
            if (swal("สำเร็จ", "ลบข้อมูลเรียบร้อย !!", "success")) {
                $.ajax({
                    type: "POST",
                    url: "delivery_ajax.php",
                    dataType: "json",
                    data: "action=delete&d_id=" + d_id,
                    success: function(data) {
                        if (data.status != "ok") {
                            $("#report").html(data.msg); // show error
                        }
                        show(1); // refresh table
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                });
            }
        }

        function show(page) {
            $("#showContain").load("delivery_ajax_show.php?page=" + page, {
                q_name: $("#q_name").val()
            }, function() {});
        }
    </script>



</head>
<nav>
    <?php include('nav.php') ?>
</nav>
<div class="container">
    <div class="card-body col-12">
        <h1 class="h3 font-weight-bold m-3" style="color: black;">หน้าจัดการบริษัทจัดส่งสินค้า</h1>
        <hr />
        <div class="container-fluid col-12">
            <div class="s128">
                <form action="javascript:;" method="post">
                    <div class="inner-form">
                        <div class="row">
                            <div class="input-field first">
                                <input style="font-family: 'Athiti', sans-serif;" type="search" name="q_name" id="q_name" placeholder="ค้นหา">
                                <button type="button" style="color:lightgrey;" class="btn btn btn-sm view_data" data-toggle="modal" data-target="#dataModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button style="display: none;" id="btsearch" type="submit">ค้นหา</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card-body col-12 p-0 mb-3">
    <div id="showContain"></div>
</div>
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#44437a;color: white;">
                <strong class="modal-title">เพิ่ม/แก้ไข บริษัทจัดส่งสินค้า</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="f" action="javascript:;" class="form-horizontal">
                    <input name="txt_name" type="text" class="form-control" id="txt_name" placeholder="ชื่อบริษัทจัดส่ง" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" required>
                    <input type="hidden" name="d_id" id="d_id">
                    <input type="hidden" name="action" id="action" value="add">
                    <div class="modal-footer">
                        <button style="width: 60px;height: 40px;" id="bt" class="btn btn-outline-primary btn-rounded shadow p-1"><span class="fa fa-cloud-upload"></span> </button>&ensp;
                        <button type="reset" style="width: 60px;height: 40px;" class="btn btn-outline-warning shadow p-1"><span class="fa fa-repeat"></span></button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>