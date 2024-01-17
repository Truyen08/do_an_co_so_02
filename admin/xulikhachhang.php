<?php
    include('../db/connect.php');
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
            <div class="col-md-12">
                <h4>Danh sách khách hàng</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Tên khách hàng </th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Ngày mua</th>
                        
                        <th>Quản lí</th>
                    </tr>
                    <?php 

                        $sql_kh = mysqli_query($conn, "SELECT * FROM khachhang,giaodich
                        WHERE giaodich.khachhang_id = khachhang.khachhang_id
                        GROUP BY giaodich.magiaodich
                        ");
                        $i = 0;
                        while($row_kh = mysqli_fetch_array($sql_kh)){
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i?></td>
                        <td><?= $row_kh['name']?></td>
                        <td><?= $row_kh['phone']?></td>   
                        <td><?= $row_kh['address']?></td>                    
                        <td><?= $row_kh['email']?></td> 
                        <td><?= $row_kh['ngaythang']?></td>
                        
                        <td><a href="?quanli=xemgiaodich&khachhang=<?= $row_kh['magiaodich']?>">xem giao dịch</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>

                </table>
            </div>

            <div class="col-md-12">
                <h4> Thông tin chi tiết </h4>

                <?php
                if(isset($_GET['khachhang'])){
                    $magiaodich = $_GET['khachhang'];
                }else {
                    $magiaodich= '';
                }

                ?>

                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã giao dịch</th>
                        
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Ngày đặt</th>
                        
                    </tr>
                    <?php 
                        $sql_donhang = mysqli_query($conn, "SELECT * FROM giaodich,khachhang,sanpham 
                        WHERE giaodich.sanpham_id = sanpham.sanpham_id AND khachhang.khachhang_id = giaodich.khachhang_id
                        AND giaodich.magiaodich = '$magiaodich'
                        
                        ORDER BY giaodich.giaodich_id DESC ");
                        $i = 0;
                        while($row_donhang = mysqli_fetch_array($sql_donhang)){
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i?></td>
                        <td><?= $row_donhang['magiaodich']?></td>
                        
                        <td><?= $row_donhang['sanpham_name']?></td>
                        <td><?= $row_donhang['soluong']?></td>
                        <td><?= $row_donhang['ngaythang']?></td>
                        
                        
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