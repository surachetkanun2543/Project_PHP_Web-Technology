<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="js/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

  <script language-="javascript">
    $().ready(function() {
      $('#bt').click(function() {
        $('#bt').attr('disabled', true);
        
        $.ajax({
          type: "POST",
          url: "checklogin.php",
          dataType: "json",
          data: "txt_user=" + $("#txt_user").val() + "&txt_pass=" + $("#txt_pass").val(),
          success: function(data) {
            if (data.status == "ok") {
              window.location = "index.php";
            } else {
              $("#report").removeClass('sr-only').html(data.msg);
            }
          },
          error: function(data) {
            console.log(data.responseText);
          }
        });
        $('#bt').attr('disabled', false);
      });

    });


  </script>
 <style>
  body{
    font-family: 'Prompt', sans-serif;
  padding-top:50px;
  margin-top: 10%;
}
.panel {
  box-shadow: -4px 41px 53px -24px rgba(84,61,105,1);

}
button {
  box-shadow: -4px 4px 34px -11px rgba(0,0,0,0.75);
}
body {
    height: 600px;
    background: url('https://images.unsplash.com/photo-1484807352052-23338990c6c6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat;
    background-size: cover;
    background-position: center;
    position: relative;
}
</style>



<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 style="font-family: 'Prompt', sans-serif;  color:#775BC9 ;" align="center" class="panel-title">เข้าสู่ระบบสำหรับแอดมิน</h3>
          </div>
          <div class="panel-body">
          <div id="report" class="sr-only"></div>
            <form accept-charset="UTF-8" role="form" action="checklogin.php" method="POST">

              <fieldset>
                <div class="form-group">
                  <input class="form-control" style=" font-family: 'Prompt', sans-serif;" type="text" name="txt_user" id="txt_user" placeholder="Username">
                </div>
                <div class="form-group">
                  <input class="form-control" style=" font-family: 'Prompt', sans-serif;" type="password" name="txt_pass" id="txt_pass" placeholder="Password">
                </div>
                <button class="btn btn-lg btn btn-block"  style="font-family: 'Prompt', sans-serif; background-color: #775BC9; color:#d8c5c0 ;" type="submit" id="bt" style=" font-family: 'Athiti', sans-serif;">เข้าสู่ระบบ</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
