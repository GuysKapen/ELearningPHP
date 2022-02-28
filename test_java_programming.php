<?php
session_start();
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
	</style>
</head>

<body>

	<div class="flex">


		<!------Side bar start---->

		<aside class="w-3/12" aria-label="Sidebar">
			<div class="px-3 py-4 overflow-y-auto rounded bg-gray-50 dark:bg-gray-800">
				<ul class="space-y-2">
					<li>
						<a href="#" class="flex items-center p-2 font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
							<span class="ml-3">Dashboard</span>
						</a>
					</li>
					<?php
					$con = mysqli_connect('127.0.0.1', 'uniqueDev', 'uniqueDev');
					mysqli_select_db($con, 'uniquedeveloper');
					$course_name = $_GET['course_name'];

					//$_GET['course_name'];
					// unset($_GET['course_name']);
					$q = "select * from courses where course_name='$course_name'";
					$result = mysqli_query($con, $q);
					while ($res = mysqli_fetch_array($result)) { ?>

						<form action="fetch_main_content.php" method="POST">

							<input type="hidden" name="txt1" value="<?php echo $res['id'] ?>">
							<button style="background-color: transparent;border: none;text-align:left;color: white;">
								<li>
									<a href="#" class="flex items-center p-2 font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 link-no-styled">
										<span class="ml-3"><?php echo $res['topic_name']; ?></span>
									</a>
								</li>
							</button>

						</form>


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

					if (isset($_SESSION['message'])) {
						echo $_SESSION['message'];
					}

					?>
				</p>

			</div>

			<div class="text-right">
				<button id="btn_next" class="px-24 py-4 bg-indigo-600 text-xl font-black text-white">Next</button>
			</div>

		</div>

	</div>

	<script type="text/javascript">
		var li = document.getElementsByTagName('li')[0].style = "color:red";
	</script>

</body>

</html>