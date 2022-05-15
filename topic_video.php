<?php
session_start();
if (!isset($_SESSION['user'])) {
	$_SESSION['redirect'] = 'topic_video.php?topic_video_id=' . $_GET['topic_video_id'];
	header('location:login.php');
}


include("inc/function.php")
?>

<!DOCTYPE html>
<html>

<head>
	<title>E Learning</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/function.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />

</head>

<body>

	<?php
	$topic_video_id = $_GET['topic_video_id'];
	$topic_video = get_topic_video($topic_video_id);
	?>

	<?php include("inc/header.php") ?>
	<div id="wrap">
		<div class="flex py-16 px-8">

			<div class="w-9/12">
				<iframe src="<?php echo $topic_video['video_path'] ?>" frameborder="0" width="850" height="550"></iframe>
			</div>

			<div class="w-3/12">

				<?php
				$related = get_related_topic_video($topic_video_id);

				foreach ($related as $topic) { ?>
					<div class="flex items-start mb-4">
						<div class="w-8/12 flex-shrink-0">
							<a href="?topic_video_id=<?php echo $topic['id'] ?>"><img src="<?php echo $topic['topic_image']; ?>" class="w-64"></a>
						</div>
						<p class="ml-2 text-sm w-4/12"><?php echo $topic['topic_name'] ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php include("inc/footer.php") ?>


</body>

</html>