<?php
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['capnhatdonhang'])){
        $tinhtrang = $_POST['xuli'];
        $mahang = $_POST['mahang_xuli'];
        $sql_xuli = mysqli_query($conn, "UPDATE donhang SET tinhtrang = '$tinhtrang' 
        WHERE mahang = '$mahang'");
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
        if(isset($_GET['quanli']) == 'xemdonhang'){
            $mahang = $_GET['mahang'];
            $sql_chitiet= mysqli_query($conn, "SELECT * FROM donhang,sanpham WHERE 
            donhang.sanpham_id = sanpham.sanpham_id AND donhang.mahang = '$mahang'");
            
            

        ?>   
            <div class="col-md-7"> 
            <p>Xem chi tiết đơn hàng</p>
            <form action="" method="POST">
            <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                        <!-- <th>Quản lí</th> -->
                    </tr>
                    <?php 
                        
                        $i = 0;
                        while($row_donhang = mysqli_fetch_array($sql_chitiet)){
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i?></td>
                        <td><?= $row_donhang['mahang']?></td>
                        <td><?= $row_donhang['sanpham_name']?></td>
                        <td><?= $row_donhang['soluong']?></td>
                        <td><?= number_format($row_donhang['sanpham_gia']). ' vnd'?></td>
                        <td><?= number_format($row_donhang['soluong']*$row_donhang['sanpham_giakhuyenmai']). ' vnd'?></td>
                        <td><?= $row_donhang['ngaythang']?></td>
                        <!-- <td><a href="?xoa=<?= $row_donhang['donhang_id']?>">Xoá</a> || 
                        <a href="?quanli=xemdonhang&mahang=<?= $row_laydanhmuc['mahang']?>">Xem đơn hàng</a>
                        </td> -->
                        <input type="hidden" value="<?= $row_donhang['mahang']?>" name="mahang_xuli">
                    </tr>
                    <?php
                        }
                    ?>

            </table>
            
            <select class="form-control" name="xuli">
                <option value="1">Đã xử lí</option>
                <option value="0">Chưa xử lí</option>
            </select> <br>
            <input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success" >
            </form>
             </div>
        <?php
            
        } else {
        ?>    
            <div class="col-md-7">
                đơn hàng
            </div>
        <?php
        }
        ?>

            <div class="col-md-5">
                <h4>Liệt kê đơn hàng</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Mã hàng</th>
                        <th>Tình trạng</th>
                        <th>Tên khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Ghi chú</th>
                        <th>Quản lí</th>
                    </tr>
                    <?php 
                        $sql_donhang = mysqli_query($conn, "SELECT * FROM donhang,khachhang,sanpham 
                        WHERE donhang.sanpham_id = sanpham.sanpham_id AND khachhang.khachhang_id = donhang.khachhang_id
                        ORDER BY donhang_id DESC ");
                        $i = 0;
                        while($row_donhang = mysqli_fetch_array($sql_donhang)){
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i?></td>
                        <td><?= $row_donhang['mahang']?></td>
                        <td><?php
                            if($row_donhang['tinhtrang'] == 0){
                                echo 'chưa xử lí';
                            }else {
                                echo 'đã xử lí';
                            }
                        ?></td>
                        <td><?= $row_donhang['name']?></td>
                        <td><?= $row_donhang['ngaythang']?></td>
                        <td><?= $row_donhang['note']?></td>
                        <td><a href="?xoa=<?= $row_donhang['donhang_id']?>">Xoá</a> || 
                        <a href="?quanli=xemdonhang&mahang=<?= $row_donhang['mahang']?>">Xem đơn hàng</a>
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