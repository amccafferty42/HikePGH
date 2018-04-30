<!DOCTYPE HTML>
<html>
	<head>
		<title>Hike PGH Local</title>
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
						<h2>Local Trails</h2>
						<p>Scroll through trails in Pittsburgh or in the surrounding areas.</p>
                    </header>
                    
                    <section class="box">
					<form method="post" action="search.php">
						<div class="row uniform 50%">
							<div class="9u 12u(mobilep)">
								<input type="text" name="query" id="query" value="" placeholder="Trail Name" />
							</div>
							<div class="3u 12u(mobilep)">
								<input type="submit" value="Search" class="fit" />
							</div>
						</div>
					</form>
                </section>
                
                <?php
                    include 'connect.php';

                    $page = htmlentities($_GET['page']);
                    //for now, trails will fit on two pages, will add more if more trails are added to db
                    if ($page == 2) {
                        $sql = 'SELECT * from trails WHERE id >= 11';
                    }
                    else {
                        $sql = 'SELECT * from trails WHERE id < 11';
                    }

                    $result = mysqli_query($connect, $sql);
                    //display trail summary and image and link to page
                    while ($row = mysqli_fetch_row($result)) {
                        echo '<section id="main" class="container">
                                <div class="box">
                                    <span class="image featured"><img src="' . $row[4] . '" alt="" /></span>
                                    <h3><a href="view.php?id=' . $row[0] . '">' . $row[1] . ' Trail</a></h3>
                                    <p>' . $row[3] . '</p>     
                                </div>
                            </section>';
                    }

                    if ($page == 2) {
                        echo '<a href="trails.php" class="button">Page 1</a>';                       
                    }
                    else {
                        echo '<a href="trails.php?page=2" class="button">Page 2</a>';
                    }
                ?>

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
