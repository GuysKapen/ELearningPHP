<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Learning | Instructor</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/function.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
</head>

<body>

    <?php include("inc/header.php") ?>
    <div id="wrap">
        <div id="crumb">
            <span><a href="index.php">Home</a></span>
            <span>></span>
            <span>Instructor</span>
        </div>
    </div>
    <div id="dash" class="w-full p-6">
        <div class="flex space-between">
            <h2>Instructor dashboard</h2>
            <form class="w-1/2" action="" method="POST">
                <div class="flex">
                    <input class="left-rounded-input h-9" type="text" name="name" placeholder="Enter course name">
                    <button class="right-rounded-button w-1/5 bg-primary text-white font-bold h-9" type="submit" name="add_course">Add course</button>
                </div>
            </form>
        </div>
        <div class="mt-4">
            <table id="dash-table" class="w-full border-spacing-0 bg-white">
                <tr class="bg-primary text-white h-8">
                    <th>Name</th>
                    <th>Course Type</th>
                    <th>Course Price</th>
                    <th>Course Status</th>
                    <th>Enroll By</th>
                    <th>Total Earn</th>
                </tr>
                <tr class="center mt-2 text-title-fade">
                    <td class="text-left">
                        <div class="flex">
                            <img src="imgs/courses/course_1.jpg" alt="" class="h-24">
                            <div class="pl-2">
                                <p class="mr-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit</p>
                                <p class="mt-2"><a class="decorate-none" href=""><i class="fa fa-edit"></i> Edit</a></span>
                            </div>
                        </div>
                    </td>

                    <td>
                        <p>
                            Free
                        </p>
                    </td>

                    <td>
                        <p>$120</p>
                    </td>

                    <td>
                        <p>Active</p>
                    </td>

                    <td>
                        <p>120</p>
                    </td>
                    <td>$800</td>

                </tr>
                         <tr class="center mt-2 text-title-fade">
                    <td class="text-left">
                        <div class="flex">
                            <img src="imgs/courses/course_1.jpg" alt="" class="h-24">
                            <div class="pl-2">
                                <p class="mr-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit</p>
                                <p class="mt-2"><a class="decorate-none" href=""><i class="fa fa-edit"></i> Edit</a></span>
                            </div>
                        </div>
                    </td>

                    <td>
                        <p>
                            Free
                        </p>
                    </td>

                    <td>
                        <p>$120</p>
                    </td>

                    <td>
                        <p>Active</p>
                    </td>

                    <td>
                        <p>120</p>
                    </td>
                    <td>$800</td>

                </tr>
            </table>
        </div>
    </div>
    <?php include("inc/footer.php") ?>

</body>

</html>