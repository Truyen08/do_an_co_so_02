

	<!-- navigation -->
	<?php
		$sql_category = "SELECT * FROM category ORDER BY category_id DESC";
		$category_kq = mysqli_query($conn, $sql_category);

	?>
	<div class="navbar-inner">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="agileits-navi_search">
					<form action="#" method="post">
						<select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
							<option value="">Danh mục sản phẩm</option>
							<?php
								while($row = mysqli_fetch_array($category_kq)){
							?>
								<option value="<?php echo $row['category_id']?>"><?= $row['category_name']?></option>
							<?php
								}
							?>
						</select>
					</form>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="index.php">Trang chủ
								<span class="sr-only">(current)</span>
							</a>
						</li>

						<?php
							$category_danhmuc = mysqli_query($conn, 'SELECT * FROM category ORDER BY category_id DESC');

							while($danhmuc = mysqli_fetch_array($category_danhmuc)){

						?>
							<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
								<a class="nav-link " href="?quanli=danhmuc&id=<?= $danhmuc['category_id']?>" role="button"  aria-haspopup="true" aria-expanded="false">
									<?= $danhmuc['category_name']?>
								</a>

							</li>
						<?php
							}
						?>


						<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="about.html">Tin tức</a>
						</li>

						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Trang
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="product.html">Sản phẩm mới</a>

								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="?quanli=giohang">Xem đơn hàng</a>
								<a class="dropdown-item" href="payment.html">Trang thanh toán</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.html">Liên hệ</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<!-- //navigation -->
