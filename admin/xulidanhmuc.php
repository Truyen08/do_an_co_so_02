<?php
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['themdanhmuc'])){
        $tendandmuc = $_POST['danhmuc'];
        $sql_themdanhmuc = mysqli_query($conn, "INSERT INTO category(category_name) values ('$tendandmuc')");
    }
    if(isset($_POST['capnhatdanhmuc'])){
        $id = $_POST['id_saucapnhat'];
        $tendandmuc = $_POST['danhmuccapnhat'];
        $sql_themdanhmuc = mysqli_query($conn, "UPDATE category SET category_name = '$tendandmuc' WHERE
        category_id = '$id'");

        header('location:xulidanhmuc.php');
    }
    if(isset($_GET['xoa'])){
        $id_xoa = $_GET['xoa'];
        $sql_xoa = mysqli_query($conn, "DELETE FROM category WHERE category_id = '$id_xoa'");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    
    <title>danh mục</title>
</head>
<body>

    <?php
        include('nav.php');
    ?>
    <br> <br>


    <div class="container">
        <div class="row">
        <?php
        if(isset($_GET['quanli']) == 'capnhat'){
            $id_capnhat = $_GET['id'];
            $sql_in_id_capnhat = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$id_capnhat'");
            while($row_sql_id_capnhat = mysqli_fetch_array($sql_in_id_capnhat)){

        ?>    
            <div class="col-md-4">
                <h4>Cập nhật danh mục</h4>
                <label for="">Tên danh mục</label>
                <form action="" method="POST">
                    <input type="hidden" name="id_saucapnhat" value="<?= $row_sql_id_capnhat['category_id']?>">
                    <input type="text" class="form-control" name="danhmuccapnhat" 
                    value="<?= $row_sql_id_capnhat['category_name']?>"> <br>
                    <input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" class="btn btn-default">
                </form>
            </div>
        <?php
            }
        } else {
        ?>    
            <div class="col-md-4">
                <h4>Thêm danh mục</h4>
                <label for="">Tên danh mục</label>
                <form action="" method="POST">
                    <input type="text" class="form-control" name="danhmuc" placeholder="tên danh mục"> <br>
                    <input type="submit" name="themdanhmuc" value="Thêm danh mục" class="btn btn-default">
                </form>
            </div>
        <?php
        }
        ?>

            <div class="col-md-8">
                <h4>Liệt kê danh mục</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Tên danh mục</th>
                        <th>Quản lí</th>
                    </tr>
                    <?php 
                        $sql_laydanhmuc = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id ASC ");
                        $i = 0;
                        while($row_laydanhmuc = mysqli_fetch_array($sql_laydanhmuc)){
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i?></td>
                        <td><?= $row_laydanhmuc['category_name']?></td>
                        <td><a href="?xoa=<?= $row_laydanhmuc['category_id']?>">Xoá</a> || 
                        <a href="?quanli=capnhat&id=<?= $row_laydanhmuc['category_id']?>">Cập nhật</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>

                </table>
            </div>
        </div>
    </div>
</body>
</html>