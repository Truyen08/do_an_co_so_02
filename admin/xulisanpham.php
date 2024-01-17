<?php
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['themsanpham'])){
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];

        $giasanpham = $_POST['giasanpham'];
        $giakhuyenmai = $_POST['giakhuyenmai'];
        $danhmuc = $_POST['danhmuc'];
        $soluong = $_POST['soluong'];
        $mota = $_POST['mota'];
        $chitiet = $_POST['chitiet'];

        $path = '../uploads/';
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $sql_themsp =  "INSERT INTO sanpham(category_id, sanpham_name, sanpham_chitiet, sanpham_mota, sanpham_gia, sanpham_giakhuyenmai,  sanpham_soluong, sanpham_image) 
        VALUES ('$danhmuc','$tensanpham','$chitiet','$mota','$giasanpham','$giakhuyenmai','$soluong','$hinhanh')";
        mysqli_query($conn, $sql_themsp);
        
        move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
    } elseif(isset($_POST['capnhatsanpham'])){
        $id_update = $_POST['id_update'];
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];

        $giasanpham = $_POST['giasanpham'];
        $giakhuyenmai = $_POST['giakhuyenmai'];
        $danhmuc = $_POST['danhmuc'];
        $soluong = $_POST['soluong'];
        $mota = $_POST['mota'];
        $chitiet = $_POST['chitiet'];

        $path = '../uploads/';
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

        if($hinhanh == ''){
            $sql_update_image = "UPDATE sanpham SET sanpham_name = '$tensanpham', sanpham_chitiet = '$chitiet', sanpham_mota = '$mota', 
            sanpham_gia = '$giasanpham', sanpham_giakhuyenmai = '$giakhuyenmai', sanpham_soluong = '$soluong', category_id = '$danhmuc'
            WHERE sanpham_id = '$id_update'";
        } else {
            move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
            $sql_update_image = "UPDATE sanpham SET sanpham_name = '$tensanpham', sanpham_chitiet = '$chitiet', sanpham_mota = '$mota', 
            sanpham_gia = '$giasanpham', sanpham_giakhuyenmai = '$giakhuyenmai', sanpham_soluong = '$soluong', category_id = '$danhmuc',
            sanpham_image = '$hinhanh'
            WHERE sanpham_id = '$id_update'";
        }

        mysqli_query($conn, $sql_update_image);
    }
    
    if(isset($_GET['xoa'])){
        $id_xoa = $_GET['xoa'];
        $sql_xoa = mysqli_query($conn, "DELETE FROM sanpham WHERE sanpham_id = '$id_xoa'");
    }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    
    <title>Sản phẩm</title>
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
            $id_capnhat = $_GET['capnhat_id'];
            $sql_in_id_capnhat = mysqli_query($conn, "SELECT * FROM sanpham WHERE sanpham_id = '$id_capnhat'");
            
            $row_sql_id_capnhat = mysqli_fetch_array($sql_in_id_capnhat);
            $id_category01 = $row_sql_id_capnhat['category_id'];

        ?>    
             <div class="col-md-3">
                <h4>Cập nhật sản phẩm</h4>

                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="tensanpham" value="<?= $row_sql_id_capnhat['sanpham_name']?>"><br>
                    <input type="hidden" class="form-control" name="id_update" value="<?= $row_sql_id_capnhat['sanpham_id']?>"><br>
                    
                    <label for="">hình ảnh</label>
                    <input type="file" class="form-control" name="hinhanh""><br>
                    <img src="../uploads/<?= $row_sql_id_capnhat['sanpham_image']?>" height="80" width="80"> <br> <br>
                    <label for="">Giá</label></label>
                    <input type="text" class="form-control" name="giasanpham" value="<?= $row_sql_id_capnhat['sanpham_gia']?>"> <br>
                    <label for="">Giá khuyến mãi</label>
                    <input type="text" class="form-control" name="giakhuyenmai" value="<?= $row_sql_id_capnhat['sanpham_giakhuyenmai']?>"> <br>
                    <label for="">Số lượng</label>
                    <input type="text" class="form-control" name="soluong" value="<?= $row_sql_id_capnhat['sanpham_soluong']?>"> <br>
                    <label for="">Mô tả</label>
                    <textarea class="form-control" rows="8" name="mota" value="<?= $row_sql_id_capnhat['sanpham_mota']?>"></textarea> <br>
                    <label for="">Chi tiết</label>
                    <textarea class="form-control" rows="8" name="chitiet" value="<?= $row_sql_id_capnhat['sanpham_chitiet']?>"></textarea> <br>
                    
                    <label for="">Danh mục</label>

                    
                    <select name="danhmuc" class="form-control">
                        <option value="">------chọn danh mục--------</option>
                            <?php
                                $sql_danhmuc = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                                while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                    if($id_category01 == $row_danhmuc['category_id']){
                            ?>
                        <option selected value="<?= $row_danhmuc['category_id']?>"><?= $row_danhmuc['category_name']?></option>
                            <?php
                                    }else {
                            ?>
                        <option value="<?= $row_danhmuc['category_id']?>"><?= $row_danhmuc['category_name']?></option>
                            <?php
                                    }
                                }
                            ?>
                    </select>

                    
                    <input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" class="btn btn-default my-3">
                    
                </form>

            </div>
        <?php
            }
         else {
        ?> 
            <div class="col-md-3">
                <h4>Thêm sản phẩm</h4>

                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="tensanpham" placeholder="tên sản phẩm"> <br>
                    <label for="">hình ảnh</label>
                    <input type="file" class="form-control" name="hinhanh" placeholder="hình ảnh "> <br>
                    <label for="">Giá</label></label>
                    <input type="text" class="form-control" name="giasanpham" placeholder="giá"> <br>
                    <label for="">Giá khuyến mãi</label>
                    <input type="text" class="form-control" name="giakhuyenmai" placeholder="giá khuyến mãi"> <br>
                    <label for="">Số lượng</label>
                    <input type="text" class="form-control" name="soluong" placeholder="số lượng"> <br>
                    <label for="">Mô tả</label>
                    <input type="text" class="form-control" name="mota" placeholder="Mô tả"> <br>
                    <label for="">Chi tiết</label>
                    <input type="text" class="form-control" name="chitiet" placeholder="chi tiết"> <br>
                    <label for="">Danh mục</label>

                    
                    <select name="danhmuc" class="form-control">
                        <option value="">------chọn danh mục--------</option>
                            <?php
                                $sql_danhmuc = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                                while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                            ?>
                        <option value="<?= $row_danhmuc['category_id']?>"><?= $row_danhmuc['category_name']?></option>
                            <?php
                                }
                            ?>
                    </select>

                    
                    <input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-default my-3">
                    
                </form>

            </div>
        <?php
        }
        ?>

            <div class="col-md-9">
                <h4>Liệt kê sản phẩm</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Tên sản phẩm</th>
                        <th>hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Giá khuyến mãi</th>
                        <th>Quản lí</th>
                    </tr>
                    <?php 

                        $sql_insanpham = mysqli_query($conn, "SELECT * FROM sanpham,category 
                        WHERE sanpham.category_id = category.category_id
                        ORDER BY sanpham_id ASC ");
                        $i = 0;
                        while($row_insanpham = mysqli_fetch_array($sql_insanpham)){
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i?></td>
                        <td><?= $row_insanpham['sanpham_name']?></td>
                        <td><img src="../uploads/<?= $row_insanpham['sanpham_image']?>" width="80" height="80"></td>
                        <td><?= $row_insanpham['sanpham_soluong']?></td>   
                        <td><?= $row_insanpham['category_name']?></td>                    
                        <td><?= number_format($row_insanpham['sanpham_gia']).' vnd'?></td>
                        <td><?= number_format($row_insanpham['sanpham_giakhuyenmai']). ' vnd'?></td>
                        
                        <td><a href="xulisanpham.php?xoa=<?= $row_insanpham['sanpham_id']?>">Xoá</a> || 
                        <a href="xulisanpham.php?quanli=capnhat&capnhat_id=<?= $row_insanpham['sanpham_id']?>">Cập nhật</a>
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