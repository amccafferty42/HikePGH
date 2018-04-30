<?php
include('connect.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Add rating into db on a POST
    $rating = $_POST['rating'];
    $comment = $_POST['review'];
    $caption = $_POST['caption'];
    $trail = $_POST['trail'];
    $date = date("F dS, Y");
    $sql = "INSERT INTO reviews (rating, comment, date, trail, caption) VALUES ('" . $rating . "', '" . $comment . "', '" . $date . "', '" . $trail ."', '" . $caption ."')";
    $result = mysqli_query($connect, $sql);
    //Calculate new rating for trail because a new review was submitted
    $sql2 = 'SELECT rating FROM reviews WHERE trail="' . $trail . '"';
    $raw_result = mysqli_query($connect, $sql2);
    $sum_rate = 0;
    $num_rate = 0;
    while ($row = mysqli_fetch_assoc($raw_result)) {
        $num_rate++;
        $sum_rate = $sum_rate + $row['rating'];
    }
    $rate  = $sum_rate / $num_rate;
    $update = "UPDATE trails SET rating=" . $rate . " WHERE id=" . $trail;
    $result2 = mysqli_query($connect, $update);
}
?>

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
                
                <?php
                    include 'connect.php';
                    //In depth look at trail with more info, reviews, and photos
                    $trail = htmlentities($_GET['id']);

                    $sql = 'SELECT * from trails WHERE id=' . $trail;
                    $result = mysqli_query($connect, $sql);

                    while ($row = mysqli_fetch_row($result)) {
                        echo '<section id="main" class="box">
                                    <header>
                                        <h2>' . $row[1] . '  Trail</h2>
                                        <p>Information, reviews, and images of the trail.</p>
                                    </header>
                                </section>';
                        //majority of trail info with buttons to photo upload, reviews, and back to trail list
                        echo '<section id="main" class="container">
                                <div class="box">
                                    <span class="image featured"><img src="' . $row[4] . '" alt="" /></span>
                                    <h3>' . $row[1] . ' Trail</h3>
                                    <p>' . $row[3] . '</p>
                                <div class="row">
                                    <div class="6u 12u(mobilep)">
                                        <p><b>Location: ' . $row[2] . '</b></p>
                                    </div>
                                    <div class="6u 12u(mobilep)">
                                        <p><b>Length: ' . $row[5] . ' miles</b></p>
                                    </div>

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
                    $trail_rating = $row[6];
                }
                
                    $query = 'SELECT rating, comment, date, caption FROM reviews WHERE trail="' . $trail . '"';
                    $raw_result = mysqli_query($connect, $query);
                    //only show reviews if trail has been reviewed
                    if (mysqli_num_rows($raw_result) > 0) {
                        echo '<section id="main" class="container">
                            <header>
                                <h2>User Rating: ' . $trail_rating . '/5</h2>
                                <p>User reviews of the trail.</p>
                            </header>
                        </section>';

                    //show the most recent first
                    while ($row = mysqli_fetch_assoc($raw_result)) {
                        $rev[] = $row;
                    }
                        $rev = array_reverse($rev, true);
                        foreach($rev as $r) {
                            echo '<section class="box">
                                    <header>
                                        <h3><strong>' . $r['caption'] . ' -- ' . $r['rating'] . '/5</strong></h3>
                                        <p>' . $r['date'] . '  by  anonymous</p>
                                    </header>
                                    <p>' . $r['comment'] . '</p>
                                </section>
                            '; 
                        }
                    }
                    
                    $longq = "SELECT photos.location, photos.caption, photos.date, photos.trail, trails.trailname FROM photos LEFT JOIN trails ON photos.trail = trails.id WHERE photos.trail = '" . $trail . "'";
                    $result3 = mysqli_query($connect, $longq);
                    //only show photos if one has been submitted
                    if (mysqli_num_rows($result3) > 0) {
                        echo '<section id="main" class="container">
                        <header>
                            <h2>Photos</h2>
                            <p>User submitted photos of the trail.</p>
                        </header>';
                        while ($row = mysqli_fetch_assoc($result3)) {
                            $items[] = $row;
                        }
                        $items = array_reverse($items, true);
                        //show most recent first
                        foreach($items as $item) {
                            echo '<div class="box">
                            <span class="image featured"><img src="' . $item['location'] . '" alt="" /></span>
                            <h3>' . $item['date'] . '</h3>
                            <p>' . $item['caption'] . '</p>
                            </div>';
                        }
                        echo '</section>';
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

