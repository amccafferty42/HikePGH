<!DOCTYPE HTML>
<html>
	<head>
		<title>Hike PGH Review</title>
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
						<h2>Leave a Review</h2>
						<p>Tell us what you think of the trail.</p>
					</header>
					<div class="box">
                                            <?php
                                                include 'connect.php';
                                                $sql = 'SELECT id, trailname from trails';
                                                $result = mysqli_query($connect, $sql);

                                                if (isset($_GET['review'])) {
                                                    echo '<form method="post" action="view.php?id=' . $_GET["review"] . '">';
                                                }
                                                else {
                                                    echo '<form method="post" action="trails.php">';
                                                }
                                                echo '<div class="row uniform 50%">
                                                    <div class="6u 12u(mobilep)">
                                                        <div class="select-wrapper">
                                                            <select name="trail" id="trail" required>
                                                                <option value="">- Trail -</option>';
                                                //auto select trail if redirecting from trail list
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    if (isset($_GET['review']) && $_GET['review'] == $row['id']) {
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
                                <!-- Select list for rating -->
								<div class="6u 12u(mobilep)">
                                    <div class="select-wrapper">
                                        <select name="rating" id="rating" required>
                                            <option value="">- Rating out of 5 -</option>
                                            <option value=5>5</option>
                                            <option value=4>4</option>
                                            <option value=3>3</option>
                                            <option value=2>2</option>
                                            <option value=1>1</option>
                                        </select>
                                    </div>
								</div>
                            </div>
                            <div class="row uniform">
                                <div class="12u">
                                    <input type="text" name="caption" id="caption" value="" placeholder="Title" />
								</div>
							</div>
							<div class="row uniform">
								<div class="12u">
									<textarea name="review" id="review" placeholder="Enter your review" rows="6"></textarea>
								</div>
							</div>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" value="Send Review" /></li>
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