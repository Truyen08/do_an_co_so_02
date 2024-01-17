<?php
    session_start();
    if(!isset($_SESSION['dangnhap'])){
        header('location:index.php');
    }
?>
<?php
    if(isset($_GET['dangxuat'])){
        session_destroy();
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Welcome to admin</title>
</head>
<body>
    <h1>xin chao` <?= $_SESSION['dangnhap']?></h1>
    <a href="?dangxuat">đăng xuất</a>

    <?php
        include('nav.php');
    ?>

</body>
</html>