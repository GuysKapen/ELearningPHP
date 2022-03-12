<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E Learning | Home</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/function.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
</head>

<body>

	<?php include("inc/header.php") ?>
	<div id="wrap">
		<div id="" class="w-1/3 mx-auto py-8">
			<form action="login.php" method="POST">
				<h3 class="login-circle"><i class="fa fa-user"></i></h3>
				<h4 class="center mt-2">Login</h4>
				<div class="form-control mt-2">
					<i class="fa fa-envelope"></i>
					<input type="text" name="email" placeholder="Please enter your email">
				</div>
				<div class="form-control mt-2">
					<i class="fa fa-lock"></i>
					<input type="password" name="password" placeholder="Please enter your password">
				</div>
				<div class="flex space-between items-center mt-2">
					<button type="submit" name="login" class="btn-login">Login</button>
					<a href="">
						<h5>Forgot password?</h5>
					</a>
				</div>
			</form>
		</div>
		<?php include("inc/footer.php") ?>
	</div>

</body>

</html>