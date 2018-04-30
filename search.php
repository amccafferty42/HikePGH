<!DOCTYPE HTML>
<html>
	<head>
		<title>Hike PGH Search</title>
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
                        <h2>Search Results for &quot<?php echo $_POST["query"]?>&quot</h2>
                        <p><?php 
                            include 'connect.php';
                            $term = $_POST["query"];
                            //simple search query that matches any part of search term with any part of trailname
                            $sql = 'SELECT * from trails WHERE trailname LIKE "%' . $term . '%" ';
                            $result = mysqli_query($connect, $sql);
                            $count = mysqli_num_rows($result);
                            echo $count;?> result(s) returned</p>
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

                    if($_SERVER['REQUEST_METHOD'] != 'POST') {
                        //someone is calling the file directly, don't allow
                        echo 'This file cannot be called directly.';
                    }
                    else {
                        include 'connect.php';

                        $term = $_POST["query"];
                        $min_length = 3;
                        //search query
                        if (strlen($term) >= $min_length) {
                            $sql = 'SELECT * from trails WHERE trailname LIKE "%' . $term . '%" ';
                            $result = mysqli_query($connect, $sql);
                            $count = mysqli_num_rows($result);
                            //only print if there are results
                            if ($count > 0) {
                                while ($row = mysqli_fetch_row($result)) {
                                    echo '<section id="main" class="container">
                                    <div class="box">
                                        <span class="image featured"><img src="' . $row[4] . '" alt="" /></span>
                                        <h3><a href="view.php?id=' . $row[0] . '">' . $row[1] . ' Trail</a></h3>
                                        <p>' . $row[3] . '</p>
                                    <div class="row">
    
                                        <div class="12u">
                                            <ul class="actions fit">
                                                <li><form action="upload.php" method="get">
                                                    <button class="button fit" name="trail" type="submit" value="' . $row[0] . '">Share a Photo</button>
                                                </form></li>
                                                <li><form action="review.php" method="get">
                                                    <button class="button alt fit" name="review" type="submit" value="' . $row[0] . '">Leave a Review</button>
                                                </form></li>
                                                <li><form action="trails.php" method="get">
                                                    <button class="button special fit" type="submit">Return to Trails</button>    
                                                </form></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>';
                                }
                            }
                            else {
                                echo '<section id="main" class="container">
                                <div class="box">
                                    <h3>No Results</h3>
                                    <p><a href="trails.php">Return to Trails</a></p>
                                </div>
                                </section>';                             
                            }
                        }
                        else {
                            echo '<section id="main" class="container">
                            <div class="box">
                                <h3>Minimum length is 3</h3>
                                <p><a href="trails.php">Return to Trails</a></p>
                            </div>
                            </section>';    
                        }   
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
