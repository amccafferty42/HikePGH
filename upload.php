<!DOCTYPE HTML>
<html>
	<head>
		<title>Hike PGH Upload</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
			<header id="header">
				<h1><a href="index.html">Hike PGH</a></h1>
				<nav id="nav">
					<ul>
						<li>
							<a href="#" class="icon fa-angle-down">Directory</a>
							<ul>
								<li><a href="trails.php">Trails</a></li>
								<li><a href="gallery.php">Gallery</a></li>
								<li><a href="review.php">Write Review</a></li>
								<li><a href="upload.php">Upload Photo</a></li>
							</ul>
						</li>
						<li><a href="index.html" class="button">Home</a></li>
					</ul>
				</nav>
			</header>

			<!-- Main -->
				<section id="main" class="container 75%">
					<header>
						<h2>Upload</h2>
						<p>Select an image of you on the trail and tell us where you went.</p>
					</header>
					<div class="box">
					<!-- File browser for image  -->
					<form enctype="multipart/form-data" id="form1" method="post" action="addexec.php">
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="file" name="photo" id="photo" required/></li>
									</ul>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<div class="select-wrapper">
										<select name="trail" id="trail" required>
											<option value="">- Trail -</option>
											<?php
												include 'connect.php';
												$sql = 'SELECT id, trailname from trails';
												$result = mysqli_query($connect, $sql);
												
												//auto select trail name if redirecting from trail view
												while ($row = mysqli_fetch_assoc($result)) {
													if (isset($_GET['trail']) && $_GET['trail'] == $row['id']) {
														echo '<option selected value=' . $row['id'] . '>' . $row['trailname'] . ' Trail</option>';
													}
													else {
														echo '<option value=' . $row['id'] . '>' . $row['trailname'] . ' Trail</option>';
													}
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<textarea name="caption" id="caption" placeholder="Caption" rows="4" required></textarea>
								</div>
							</div>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" name="submit" value="Upload" /></li>
									</ul>
								</div>
							</div>
					</form>
					</div>
				</section>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>