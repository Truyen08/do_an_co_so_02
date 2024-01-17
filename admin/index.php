<?php
    session_start();
    include('../db/connect.php');
?>
<?php
    //session_destroy();
    if(isset($_POST['dangnhap'])){
        $tendangnhap = $_POST['taikhoang'];
        $pass = MD5($_POST['matkhau']);
        if($tendangnhap == '' || $pass == ''){
            echo "Hãy nhập đủ thông tin";
        } else {
            $sql_select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE `taikhoang` = '$tendangnhap' 
            AND `matkhau` = '$pass' LIMIT 1");
            $count = mysqli_num_rows($sql_select_admin);
            $row_select_admin = mysqli_fetch_array($sql_select_admin);
            if($count>0){
                $_SESSION['dangnhap'] = $row_select_admin['admin_name'];
                $_SESSION['admin_id'] = $row_select_admin['admin_id'];
                header('location:dashboard.php');
            }else{
                echo 'Email hoặc mật khẩu sai';
            }
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Đăng nhập</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>
<body>
<div class="login-form">
    <form action="" method="post">
        <h2 class="text-center">Đăng nhập admin</h2>       
        <div class="form-group">
            <input type="text" name="taikhoang" class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="matkhau" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="dangnhap" class="btn btn-primary btn-block">Đăng nhập</button>
        </div>
        <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div>        
    </form>
    <p class="text-center"><a href="#">Create an Account</a></p>
</div>
</body>
</html>