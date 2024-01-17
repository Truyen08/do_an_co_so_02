	<?php
        if(isset($_POST['themgiohang'])){
            $tensanpham = $_POST['tensanpham'];
            $id_sanpham = $_POST['sanpham_id'];
            $hinhanh = $_POST['hinhanh'];
            $soluong = $_POST['soluong'];
            $giasp = $_POST['gia'];

			$sql_select_giohang = mysqli_query($conn, "SELECT * FROM giohang WHERE sanpham_id = '$id_sanpham'");
			$count =  mysqli_num_rows($sql_select_giohang);
			if($count > 0){
				$row_sanpham = mysqli_fetch_array($sql_select_giohang);
				$soluong = $row_sanpham['soluong'] + 1;
				$sql_giohang = "UPDATE giohang SET soluong = '$soluong' WHERE sanpham_id = '$id_sanpham'";
			} else {
				$soluong = $soluong;
				$sql_giohang = "INSERT INTO giohang(tensanpham,sanpham_id,hinhanh,soluong,gia) 
            	values ('$tensanpham', '$id_sanpham', '$hinhanh', '$soluong', '$giasp')";
			}

			$insert_query = mysqli_query($conn, $sql_giohang);
           
            if($sql_giohang == 0){
                header('location:index.php?quanli=chitietsp$id='. $id_sanpham);
            } 
		}
		else if(isset($_POST['capnhatsoluong'])){

			for($i=0; $i<count($_POST['product_id']) ;$i++ ){
				$sanpham_id = $_POST['product_id'][$i];
				$soluong = $_POST['soluong'][$i];
				$sql_update = mysqli_query($conn, "UPDATE giohang SET soluong = '$soluong' WHERE sanpham_id = '$sanpham_id'");
			}

		}
		elseif(isset($_GET['xoa']))
		{
			$id = $_GET['xoa'];
			$sql_xoa = mysqli_query($conn, "DELETE FROM giohang WHERE giohang_id = '$id'");
			
		} else if (isset($_GET['dangxuat'])){
				$id = $_GET['dangxuat'];
				if ($id == 1){
					unset($_SESSION['dangnhap_home']);
				}
			
		}
        elseif(isset($_POST['thanhtoan'])){
			$tenkhachhang = $_POST['name'];
            $phone = $_POST['phone'];
            $diachi = $_POST['address'];
            $email = $_POST['email'];
            $chuthich = $_POST['note'];
			$hinhthucthanhtoan = $_POST['hinhthucthanhtoan'];


			$sql_khachhang = "INSERT INTO khachhang(name,phone,address,email,note,hinhthucthanhtoan) 
			values ('$tenkhachhang', '$phone', '$diachi', '$email', '$chuthich', '$hinhthucthanhtoan')";
			$kq_khachhang = mysqli_query($conn, $sql_khachhang);

			if($sql_khachhang){
				$sql_select_khachhang = mysqli_query($conn, "SELECT * FROM khachhang ORDER BY khachhang_id DESC LIMIT 1");
				$mahang = rand(0,9999);
				$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
				$khachhang_id = $row_khachhang['khachhang_id'];
				
				$_SESSION['dangnhap_home'] = $row_khachhang['name'];
                $_SESSION['khachhang_id'] = $khachhang_id;

				for($i=0; $i<count($_POST['thanhtoan_product_id']) ;$i++ ){
					
					$sanpham_id = $_POST['thanhtoan_product_id'][$i];
					$soluong = $_POST['thanhtoan_soluong'][$i];
					$sql_donhang = mysqli_query($conn, "INSERT INTO donhang(sanpham_id,khachhang_id,soluong, mahang)
					values ('$sanpham_id', '$khachhang_id', '$soluong', '$mahang') ");

					$sql_giaodich = mysqli_query($conn, "INSERT INTO giaodich(sanpham_id,khachhang_id,soluong, magiaodich)
					values ('$sanpham_id', '$khachhang_id', '$soluong', '$mahang') ");

					$sql_detele_thanhtoan = mysqli_query($conn, "DELETE FROM giohang WHERE sanpham_id = '$sanpham_id'");
				}

			}

		} else if (isset($_POST['thanhtoangiohang'])){

			$khachhang_id = $_SESSION['khachhang_id'];
			$mahang = rand(0,9999);
			$thanhtoan = $_POST['capnhat_thanhtoan'];
				
				for($i=0; $i<count($_POST['thanhtoan_product_id']) ;$i++ ){
					
					$sanpham_id = $_POST['thanhtoan_product_id'][$i];
					$soluong = $_POST['thanhtoan_soluong'][$i];
					$sql_donhang = mysqli_query($conn, "INSERT INTO donhang(sanpham_id,khachhang_id,soluong, mahang)
					values ('$sanpham_id', '$khachhang_id', '$soluong', '$mahang') ");

					$sql_giaodich = mysqli_query($conn, "INSERT INTO giaodich(sanpham_id,khachhang_id,soluong, magiaodich)
					values ('$sanpham_id', '$khachhang_id', '$soluong', '$mahang') ");

					$sql_capnhat_hinhthuc = mysqli_query($conn, "UPDATE `khachhang` SET `hinhthucthanhtoan`='$thanhtoan'
					WHERE khachhang_id = '$khachhang_id'");

					$sql_detele_thanhtoan = mysqli_query($conn, "DELETE FROM giohang WHERE sanpham_id = '$sanpham_id'");
				}
		}
    ?>

	<?php
		if (isset($_SESSION['dangnhap_home'])){
	?>
			

    <!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Trang chủ</a>
						<i>|</i>
					</li>
					<li>

					<?php
						if(isset($_SESSION['dangnhap_home'])){
							echo 'Giỏ hàng của '. $_SESSION['dangnhap_home'];
							echo '<input type="button" class="btn ml-2"><a href="?quanli=giohang&dangxuat=1">Đăng xuất</a>
							</input>';
						} else {
							echo '';
						}
					?>
						
				
					</li>
					
					
				</ul>
				
			</div>
			
		</div>
	</div>
	<!-- //page -->

	<?php
		}
	?>

	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Giỏ hàng
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">

				<div class="table-responsive">
					<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>STT</th>
								<th>Sản phẩm</th>
								<th>Số lượng</th>
								<th>Tên sản phẩm</th>

								<th>Giá</th>
								<th>Tổng giá</th>
								<th>Xoá</th>
							</tr>
						</thead>
						<tbody>

                        <?php
							$total = 0;

                            $sql_laygiohang = mysqli_query($conn, "SELECT * FROM giohang ORDER BY giohang_id DESC");
                            while($row_laygiohang = mysqli_fetch_array($sql_laygiohang)){
							
							$subtotal = $row_laygiohang['gia'] * $row_laygiohang['soluong'];
							$phiship = 100000;
							$total += $subtotal;
							
							$tong =$total +$phiship; 

                        ?>
							<tr class="rem1">
								<td class="invert"><?= $row_laygiohang['giohang_id']?></td>
								<td class="invert-image">
									<a href="single.html">
										<img src="images/<?= $row_laygiohang['hinhanh']?>" alt=" " height="125"
										class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<input type="number" min="1" name="soluong[]" value="<?= $row_laygiohang['soluong']?>">
									<input type="hidden"  name="product_id[]" value="<?= $row_laygiohang['sanpham_id']?>">
								
								</td>
								<td class="invert"><?= $row_laygiohang['tensanpham']?></td>
								<td><?php echo number_format($row_laygiohang['gia']).' vnd' ?></td>
								<td class="invert"><?= number_format($subtotal).' vnd'?></td>
								<td class="invert"">
									<a href="?quanli=giohang&xoa=<?= $row_laygiohang['giohang_id']?>">Xoá</a>
								</td>
							</tr>
							<?php
								}
							?>

							<tr>
								<td colspan="4"></td>
								<td colspan="3" style="text-align: left;">Tổng tiền: <?= number_format($total). ' vnd'?></td>
							</tr>
							<tr>
								<td colspan="4"></td>
								<td colspan="3"><input class="btn btn-success float-left" type="submit" name="capnhatsoluong" 
								value="Cập nhật"></td>
							</tr>
							
						</tbody>
					</table>



						<!-- Thanh toán có session -->
						<?php

							$sql_ktr_giohang = mysqli_query($conn, "SELECT * FROM giohang");
							$row_ktr_giohang = mysqli_num_rows($sql_ktr_giohang);

							if (isset($_SESSION['dangnhap_home']) && $row_ktr_giohang > 0){
								while($row_1 = mysqli_fetch_array($sql_ktr_giohang)){
						?>

						
						<input type="hidden" name="thanhtoan_soluong[]" value="<?= $row_1['soluong']?>">
						<input type="hidden"  name="thanhtoan_product_id[]" value="<?= $row_1['sanpham_id']?>">
							<?php
								}
							?>
						
								
						<div class="mt-3 py-3" >
							<select class="form-select" aria-label="Default select example" name="capnhat_thanhtoan">
								<option>Hình thức thanh toán</option>
								<option value="1">Thẻ ngân hàng</option>
								<option value="2">Khi nhận hàng</option>
												
							</select>
						</div>
						

						<input type="submit" name="thanhtoangiohang" id="btnThanhToan" class="btn btn-success mt-3" 
						value="Thanh Toán" style="width: 20%;">
						
						<?php
							}
						?>

					</form>
				</div>



			<!-- Kiểm tra chưa có session -->
			<?php
			if (!isset($_SESSION['dangnhap_home'])){
			?>
			
			</div>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" 
										placeholder="Tên của bạn" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số điện thoại" 
												name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa chỉ" 
												name="address" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="email" 
												name="email" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<textarea name="note" class="form-control" placeholder="Ghi chú đơn hàng" ></textarea>
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="hinhthucthanhtoan">
											<option>Hình thức thanh toán</option>
											<option value="1">Thẻ ngân hàng</option>
											<option value="2">Khi nhận hàng</option>
											

										</select>
									</div>
								</div>
								<?php
									$sql_thanhtoan = mysqli_query($conn, "SELECT * FROM giohang ORDER BY giohang_id DESC");
									while($row_thanhtoan = mysqli_fetch_array($sql_thanhtoan)){
								?>
								<input type="hidden" name="thanhtoan_soluong[]" value="<?= $row_thanhtoan['soluong']?>">
								<input type="hidden"  name="thanhtoan_product_id[]" value="<?= $row_thanhtoan['sanpham_id']?>">
								
								
								<?php
									}
								?>
								<input type="submit" name="thanhtoan" id="btnThanhToan" class="btn btn-success" value="Thanh Toán" style="width: 20%;">
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<!-- //checkout page -->
