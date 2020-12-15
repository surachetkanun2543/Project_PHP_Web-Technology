<!DOCTYPE html>
<html>

<head>
    <title> จัดการสมาชิก </title>
    <?php
    include('h.php');
    include("check.php");
    include('../connect.php');
    error_reporting(error_reporting() & ~E_NOTICE);
    ?>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.15.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script language-="javascript">
        $().ready(function() {

            swal({
                position: 'top-left',
                buttons: false,
                title: 'ยินดีต้อนรับเข้าสู่',
                text: "หน้าจัดการสมาชิก",
                timer: 700
            })
            show(1);
            // search
            $('#btsearch').click(function() {
                show(1);
            });

            $('.view_data').ready(function() {
                $('#dataModal').modal('show');
            })

            // insert and uppdate
            $('#bt').click(function() {
                $('#bt').attr('disabled', true);
                var data = $("#f").serialize();
                $.ajax({
                    type: "POST",
                    url: "member_ajax.php",
                    dataType: "json",
                    data: data,
                    success: function(data) {
                        if (data.status != "ok") {
                            $("#report").html(data.msg); // show error
                        } else {
                            swal({
                                position: 'top-end',
                                icon: 'success',
                                title: 'เพิ่ม/แก้ไข ข้อมูลเรียบร้อย !!',
                                showConfirmButton: false,
                                timer: 950
                            })
                            // clear data in form
                            $("#m_id").val("");
                            $("#action").val("add"); // คืนค่ากลับไปที่เพิ่มข้อมูล
                            $("#txt_user").val("");
                            $("#txt_pass").val("");
                            $("#txt_name").val("");
                            $("#txt_email").val("");
                            $("#txt_tel").val("");
                            $("#txt_address").val("");
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

        function edit(m_id) {
            $.ajax({
                type: "POST",
                url: "member_ajax.php",
                dataType: "json",
                data: "action=edit&m_id=" + m_id,
                success: function(data) {
                    $("#m_id").val(data.m_id);
                    $("#action").val("update");
                    $("#m_id").val(data.m_id);
                    $("#txt_user").val(data.m_user);
                    $("#txt_pass").val(data.m_pass);
                    $("#txt_name").val(data.m_name);
                    $("#txt_email").val(data.m_email);
                    $("#txt_tel").val(data.m_tel);
                    $("#txt_address").val(data.m_address);
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            });

        }

        function del(m_id) {
            if (swal({
                    position: 'top-end',
                    icon: 'success',
                    title: ' ลบข้อมูลเรียบร้อย !!',
                    showConfirmButton: false,
                    timer: 950
                })) {

                $.ajax({
                    type: "POST",
                    url: "member_ajax.php",
                    dataType: "json",
                    data: "action=delete&m_id=" + m_id,
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
            $("#showContain").load("member_ajax_show.php?page=" + page, {
                q_name: $("#q_name").val()
            }, function() {});
        }
    </script>
</head>

<body>
    <nav>
        <?php include('nav.php') ?>
    </nav>
    <div class="container">
        <div class="card-body col-12">
            <h1 class="h3 font-weight-bold m-3" style="color: black;">หน้าจัดการสมาชิก</h1>
            <hr />
            <div class="container-fluid col-12">
                <div class="s128">
                    <form action="javascript:;" method="post">
                        <div class="inner-form">
                            <div class="row">
                                <div class="input-field first">
                                    <input style="font-family: 'Athiti', sans-serif;" type="search" name="q_name" id="q_name" placeholder="ค้นหา">
                                    <button type="button" style="color:lightgrey;" class='btn btn-outline btn-lg view_data' data-toggle="modal" data-target="#dataModal"><i class="fa fa-plus"></i></button>
                                    <button style="display: none;" id="btsearch" type="submit">ค้นหา</button>
                                </div>
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
                    <strong class="modal-title">เพิ่มสมาชิก</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="f" action="javascript:;" class="form-horizontal">
                        <input name="txt_user" type="text" required class="form-control" id="txt_user" placeholder="Username" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น"><br>
                        <input name="txt_pass" type="password" required class="form-control" id="txt_pass" placeholder="Password"><br>
                        <input name="txt_name" type="text" required class="form-control" id="txt_name" placeholder="ชื่อ-สกุล "><br>
                        <input name="txt_email" type="email" class="form-control" id="txt_email" placeholder=" อีเมล์ name@hotmail.com"><br>
                        <input name="txt_tel" type="text" class="form-control" id="txt_tel" placeholder="เบอร์โทร ตัวเลขเท่านั้น"><br>
                        <textarea name="txt_address" class="form-control" id="txt_address" required></textarea><br>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="m_id" id="m_id">
                    <input type="hidden" name="action" id="action" value="add">
                    <button style="width: 60px;height: 40px;" id="bt" class="btn btn-outline-primary shadow p-1"> <span class="fa fa-cloud-upload"></span> </button>&ensp;
                    </form>
                    <button type="reset" style="width: 60px;height: 40px;" class="btn btn-outline-danger shadow p-1"><span class="fa fa-repeat"></span></button>
                </div>
            </div>
            </form>
        </div>
    </div>

</body>

</html>