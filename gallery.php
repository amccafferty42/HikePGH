<!DOCTYPE HTML>
<html>
	<head>
		<title>Hike PGH Gallery</title>
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
				<section id="main" class="container">
					<header>
						<h2>Gallery</h2>
						<p>See what moments others have experienced on the trail.</p>
					</header>
				
                    <?php
						include('connect.php');
						//select allthe photos and the associated trailnames using a JOIN
                        $result = mysqli_query($connect, "SELECT photos.location, photos.caption, photos.date, photos.trail, trails.trailname FROM photos LEFT JOIN trails ON photos.trail = trails.id");
                        while ($row = mysqli_fetch_assoc($result)) {
                            $items[] = $row;
						}
						//reverse items so most recent photo displays first
                        $items = array_reverse($items, true);
						//display photo and include link to trail
                        foreach($items as $item) {
                            echo '<div class="box">
                            <span class="image featured"><img src="' . $item['location'] . '" alt="" /></span>
                            <h3><a href="view.php?id=' . $item['trail'] . '">' . $item['trailname'] . '  Trail</a></h3><h4>' . $item['date'] . '</h4>
                            <p>' . $item['caption'] . '</p>
                            </div>';
                        }
                    ?>
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