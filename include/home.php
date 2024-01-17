	<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Danh mục sản phẩm</h3>
			<!-- //tittle heading -->
			
			<div class="row">

				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">

						<?php
							$cate_home = mysqli_query($conn, 'SELECT * FROM category ORDER BY category_id DESC');
							while($row_cate_home = mysqli_fetch_array($cate_home)){
						?>


						<!-- first section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic"><?= $row_cate_home['category_name']?></h3>
							<div class="row">

								<?php
									$sanpham = mysqli_query($conn, 'SELECT * FROM sanpham ORDER BY sanpham_id DESC');
									while($row_sanpham = mysqli_fetch_array($sanpham)){
										if($row_sanpham['category_id'] == $row_cate_home['category_id']){
								?>

								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/<?= $row_sanpham['sanpham_image']?>" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="?quanli=chitietsp&id=<?= $row_sanpham['sanpham_id']?>" class="link-product-add-cart">
													Xem chi tiết</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="?quanli=chitietsp&id=<?= $row_sanpham['sanpham_id']?>"><?= $row_sanpham['sanpham_name']?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price"><?php echo number_format($row_sanpham['sanpham_giakhuyenmai']).' vnd' ?></span> <br>
												<del><?php echo number_format($row_sanpham['sanpham_gia']).' vnd' ?></del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<form action="?quanli=giohang" method="post">
												<fieldset>
													<input type="hidden" name="tensanpham" value="<?= $row_sanpham['sanpham_name']?>" />
													<input type="hidden" name="sanpham_id" value="<?= $row_sanpham['sanpham_id']?>" />
													<input type="hidden" name="hinhanh" value="<?= $row_sanpham['sanpham_image']?>" />
													<input type="hidden" name="soluong" value="1" />
													<input type="hidden" name="gia" value="<?= $row_sanpham['sanpham_gia']?>" />
													
													<input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button" />
												</fieldset>
											</form>
											</div>
										</div>
									</div>
								</div>

								<?php
										}
									}
								?>

							</div>
						</div>
						<!-- //first section -->

						<?php
							}
						?>



					</div>
				</div>
				<!-- //product left -->

				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Tìm kiếm</h3>
							<form action="#" method="post">
								<input type="search" placeholder="Tên sản phẩm..." name="search" required="">
								<input type="submit" value=" ">
							</form>
						</div>
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Price</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="#">Dưới 1 triệu</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- //price -->

						<!-- reviews -->
						<div class="customer-rev border-bottom left-side py-2">
							<h3 class="agileits-sear-head mb-3">Đánh giá khách hàng</h3>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>5.0</span>
									</a>
								</li>

							</ul>
						</div>
						<!-- //reviews -->


						<!-- danhmuc sản phẩm -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Danh mục sản phẩm</h3>
							<ul>

							<?php
								$cate_slidebar = mysqli_query($conn, 'SELECT * FROM category ORDER BY category_id DESC');
								while($row_cate_slidebar = mysqli_fetch_array($cate_slidebar)){
							?>

								<li>
									<span class="span"><a href="danhmucsanpham.php?id=<?= $row_cate_slidebar['category_id']?>">
									<?= $row_cate_slidebar['category_name']?></a></span>
								</li>
							<?php
								}
							?>

							</ul>
						</div>
						<!-- //danhmuc sản phẩm -->



						<!-- best seller -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">Sản phẩm bán chạy</h3>
							<div class="box-scroll">
								<div class="scroll">

									<?php
										$sanphamhot = mysqli_query($conn,'SELECT * FROM sanpham WHERE sanpham_hot = "0"');
										while($row_sanphamhot = mysqli_fetch_array($sanphamhot)){
									?>

									<div class="row mb-3">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img src="images/<?= $row_sanphamhot['sanpham_image']?>" alt="" class="img-fluid" >
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href=""><?= $row_sanphamhot['sanpham_name']?></a>
											<span class="item_price"><?php echo number_format($row_sanphamhot['sanpham_giakhuyenmai']).' vnd' ?></span> <br>
											<del><?php echo number_format($row_sanphamhot['sanpham_gia']).' vnd' ?></del>
											
										</div>
									</div>
									
									<?php
										}
									?>

								</div>
							</div>
						</div>
						<!-- //best seller -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->

