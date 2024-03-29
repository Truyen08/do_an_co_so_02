	<?php
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}

		$sql_chitiet = mysqli_query($conn, "SELECT * FROM sanpham WHERE sanpham_id = '$id'");

		$sql_danhmuc = mysqli_query($conn, "SELECT * FROM sanpham,category WHERE sanpham_id = '$id' 
		AND sanpham.category_id = category.category_id");
		$row_danhmucsanpham = mysqli_fetch_array($sql_danhmuc);
		$title = $row_danhmucsanpham['category_name'];


		while($row_chitiet = mysqli_fetch_array($sql_chitiet)){
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
					<li>Sản phẩm <?= $row_chitiet['sanpham_name']?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->


    
	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"><?= $title?></h3>
			<!-- //tittle heading -->
			<div class="row">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<ul class="slides">

								<li data-thumb="images/<?= $row_chitiet['sanpham_image']?>">
									<div class="thumb-image">
										<img src="images/<?= $row_chitiet['sanpham_image']?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>

								<!-- <li data-thumb="images/si2.jpg">
									<div class="thumb-image">
										<img src="images/si2.jpg" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li> -->
								
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3"><?php echo $row_chitiet['sanpham_name']?></h3>
					<p class="mb-3">
						<span class="item_price"><?php echo number_format($row_chitiet['sanpham_giakhuyenmai']).' vnd' ?></span> <br>
						<del><?php echo number_format($row_chitiet['sanpham_gia']).' vnd' ?></del>
						<label>Miễn phí vận chuyển</label>
					</p>
					<div class="single-infoagile">
						<p><?= $row_chitiet['sanpham_mota']?></p>
					</div>
					<div class="product-single-w3l">
						<p class="my-3">
							<i class="far fa-hand-point-right mr-2"></i>
							<label>1 năm </label>bảo hành</p>
						<p><?= $row_chitiet['sanpham_chitiet']?></p>
						<p class="my-sm-4 my-3">
							<i class="fas fa-retweet mr-3"></i>Net banking & Credit/ Debit/ ATM card
						</p>
					</div>

					<div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
							<form action="?quanli=giohang" method="post">
								<fieldset>
									<input type="hidden" name="tensanpham" value="<?= $row_chitiet['sanpham_name']?>" />
									<input type="hidden" name="sanpham_id" value="<?= $row_chitiet['sanpham_id']?>" />
									<input type="hidden" name="hinhanh" value="<?= $row_chitiet['sanpham_image']?>" />
									<input type="hidden" name="soluong" value="1" />
									<input type="hidden" name="gia" value="<?= $row_chitiet['sanpham_gia']?>" />
									
									<input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Single Page -->
<?php
	}
?>
