<?php
session_start();
if (!isset($_SESSION['user'])) {
	$_SESSION['redirect'] = 'topic.php?topic_id=' . $_GET['topic_id'];
	header('location:login.php');
}


include("inc/function.php")
?>

<!DOCTYPE html>
<html>

<head>
	<title>E Learning</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!----css file link-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<!----Linking google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Assistant" rel="stylesheet">

	<!----font-awsome start-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<script src="https://apis.google.com/js/platform.js"></script>


	<style type="text/css">
		#yt {
			margin-top: 50px;
		}

		#mainpagecontent {
			background-color: white;
			margin-top: 80px;
			height: auto;
			box-shadow: 5px 5px 5px 5px #ccc;
			border-color: #ccc;
		}

		.content {
			color: black !important;
		}

		.link-no-styled {
			text-decoration: none;
		}

		.link-no-styled:hover {
			text-decoration: none;
		}

		li .active {
			background-color: rgba(79, 70, 229, 1);
			color: #fff;
		}

		li .active:hover {
			color: rgba(79, 70, 229, 1);
			background-color: #fff;
		}
	</style>
</head>

<body>

	<div class="flex">


		<!------Side bar start---->

		<aside class="w-3/12" aria-label="Sidebar">
			<div class="px-3 py-4 overflow-y-auto rounded bg-gray-50 dark:bg-gray-800">
				<ul class="space-y-2">
					<li>
						<a href="courses.php" class="flex items-center px-4 py-3 font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
							<span class="ml-3">Dashboard</span>
						</a>
					</li>
					<?php
					$topic_id = $_GET['topic_id'];
					$topic = get_topic($topic_id);
					$topics = course_topics($topic["course_id"]);
					foreach ($topics as $res) { ?>
						<li>
							<a href="?topic_id=<?php echo $res["id"] ?>" class="flex items-center py-3 px-4 font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 link-no-styled <?php echo (($topic_id == $res["id"]) ? "active" : ""); ?>">
								<span class="ml-3">
									<?php echo $res['topic_name']; ?>
								</span>
							</a>
						</li>

					<?php } ?>
				</ul>
			</div>
		</aside>


		<!------Side bar ends---->

		<!------java main content starts ---->

		<div id="" class="w-8/12 shadow pb-8 m-16 mx-auto">

			<div class="p-16">
				<p>
					<?php

					if (isset($topic)) {
						echo $topic["description"];
					}

					?>
				</p>

			</div>

			<div class="text-right">
				<button id="btn_next" class="px-24 py-4 bg-indigo-600 text-xl font-black text-white">Next</button>
			</div>

		</div>

	</div>

</body>

</html>