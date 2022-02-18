<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Learning | Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/function.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
</head>

<body>

    <?php include("inc/header.php") ?>
    <div id="wrap" class="flex min-h-screen">
        <div class="w-1/5 bg-primary p-4">
            <div class="primary-btn bg-white-imp text-primary-imp w-full">Categories</div>
            <ul class="list-none pl-2 mt-2">
                <li class="mt-1"><a href="" class="decorate-none text-white"><i class="fa fa-code mr-2"></i>Development</a></li>
                <li class="mt-1"><a href="" class="decorate-none text-white"><i class="fa fa-user mr-2"></i>Design</a></li>
            </ul>

            <div class="primary-btn bg-white-imp text-primary-imp w-full mt-8">Sub categories</div>
            <ul class="list-none pl-2 mt-2">
                <li class="mt-1"><a href="" class="decorate-none text-white"><i class="fa fa-user mr-2"></i>Design</a></li>
                <li class="mt-1"><a href="" class="decorate-none text-white"><i class="fa fa-code mr-2"></i>Development</a></li>
            </ul>
        </div>
        <div class="w-4/5">
            <div id="crumb">
                <span><a href="index.php">Home</a></span>
                <span>></span>
                <span>Web development</span>
            </div>
            <div class="flex space-between px-6 mt-4">
                <h2>
                    Course title
                </h2>
            </div>
            <div class="px-6 mt-2">
                <form class="w-full" action="" method="POST">
                    <div class="flex">
                        <input class="left-rounded-input h-9" type="text" name="name" placeholder="Enter course name">
                        <button class="right-rounded-button w-1/5 bg-primary text-white font-bold h-9" type="submit" name="add_course">Add course</button>
                    </div>
                </form>
            </div>
            <div class="flex space-between px-6 mt-4">
                <h2>
                    Course image
                </h2>
            </div>
            <div class="flex px-6 mt-2">
                <div class="w-4/12">
                    <img src="imgs/courses/course_1.jpg" alt="" class="w-full">
                </div>
                <div class="ml-2 w-8/12">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio optio similique obcaecati voluptatum cumque odit maiores aut harum quo laboriosam. Porro reprehenderit laborum repellat necessitatibus itaque voluptatem excepturi rerum repellendus.</p>
                    <form action="">
                        <div>
                            <input type="file" class="mt-2">
                        </div>
                        <button type="submit" class="primary-btn mt-2">Save</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <?php include("inc/footer.php") ?>

</body>

</html>