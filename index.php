<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition layout-top-nav">

<!--<body class="hold-transition skin-blue layout-top-nav">-->
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	 
	<div class="content-wrapper">
		<div class="container">
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="padding-y-sm">
						<?php
							if(isset($_SESSION['error'])){
								echo "
									<div class='alert alert-danger'>
										".$_SESSION['error']."
									</div>
								";
								unset($_SESSION['error']);
							}
						?>
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									<img src="images/chandelier.gif" class="img-fluid rounded">
								</div>
							</div>
						</div>
						<h2><b>Popular Products<b></h2>
						<div class='row'>
							<?php
								$month = date('m');
								$conn = $pdo->open();

								try{
									$inc = 0;
									$stmt = $conn->prepare("SELECT * FROM products LIMIT 2");
									$stmt->execute();
									foreach ($stmt as $row) {
										$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
										echo "
										<div class='col-sm-4'>
										<div class='box box-solid'>
											<div class='box-body prod-body'>
												<a href='product.php?product=".$row['slug']."'>
													<img src='".$image."' width='100%' height='270px' class='thumbnail'>
												</a>
												<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
											</div>
											<div class='box-footer'>
												<b>&#8369; ".number_format($row['price'], 2)."</b>
											</div>
										</div>
									</div>
									
										";
										$inc++;
									}
									if($inc < 2) {
										for ($i = $inc; $i < 2; $i++) {
											echo "<div class='col-md-6'></div>";
										}
									}
								}
								catch(PDOException $e){
									echo "There is some problem in connection: " . $e->getMessage();
								}

								$pdo->close();

							?> 
						</div>
					</div>
					<div class="col-sm-3">
						<?php include 'includes/sidebar.php'; ?>
					</div>
				</div>
			</section>
		</div>
	</div>
  
	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
