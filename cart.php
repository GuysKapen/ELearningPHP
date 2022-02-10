<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Learning | Cart</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
</head>

<body>

    <?php include("inc/header.php") ?>
    <div id="wrap">
        <div id="crumb">
            <span><a href="index.php">Home</a></span>
            <span>></span>
            <span>Cart</span>
        </div>
        <div id="cart">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Instructor</th>
                    <th>Language</th>
                    <th>Lecture</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td>
                        <div class="flex">
                            <img src="imgs/courses/course_1.jpg" alt="">
                            <div class="pl-2">
                                <p class="mr-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit</p>
                                <p class="mt-2"><a class="decorate-none text-danger" href=""><i class="fa fa-trash-alt"></i> Remove</a></span>
                            </div>
                        </div>
                    </td>

                    <td>
                        <p>
                            Guys
                        </p>
                    </td>

                    <td>
                        <p>English</p>
                    </td>

                    <td>
                        <p>100</p>
                    </td>

                    <td>
                        <p>$120</p>
                    </td>

                </tr>
            </table>
            <div class="mt-2">
                <button class="primary-btn">Keep Shoping</button>
                <button class="primary-btn"><a class="decorate-none text-white" href="">Checkout</a></button>
            </div>
        </div>





    </div>
    <?php include("inc/footer.php") ?>

</body>

</html>