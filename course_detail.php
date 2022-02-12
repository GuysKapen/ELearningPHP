<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Learning | Course</title>
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
        <div id="course" class="flex">
            <div id="course-left">
                <img src="imgs/courses/course_1.jpg" alt="Course 1">
                <div class="mt-2 flex space-between">
                    <button class="bg-f primary-btn bg-f"><i class="fab fa-facebook-f mr-2"></i>Share</button>
                    <button class="primary-btn bg-gp"><i class="fab fa-google-plus mr-2"></i>Share</button>
                    <button class="primary-btn bg-tw"><i class="fab fa-twitter mr-2"></i>Tweet</button>
                    <button class="primary-btn bg-wa"><i class="fab fa-whatsapp mr-2"></i>Share</button>
                </div>
            </div>
            <div id="course-right">
                <h2>NodeJs course for beginners</h2>
                <table class="mt-2">
                    <tr>
                        <td>Instructor</td>
                        <td>Guys</td>
                    </tr>
                    <tr>
                        <td>Enroll By</td>
                        <td>9 students</td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>Expert level</td>
                    </tr>
                    <tr>
                        <td>Language</td>
                        <td>English</td>
                    </tr>
                    <tr>
                        <td>Lectures</td>
                        <td>12</td>
                    </tr>
                </table>
                <div id="price" class="mt-4 flex items-center">
                    <h3 class="mr-2">Price: $21 <span>70$</span></h3>
                    <div class="mr-2 bubble">70%</div>
                    <h5>Saving 49$</h5>
                </div>
                <div class="mt-4">
                    <form action="">
                        <div class="flex">
                            <button class="primary-btn mr-2 w-full"><i class="fa fa-shopping-cart mr-2"></i>Add to cart</button>
                            <button class="primary-btn ml-2 w-full"><a href="" class="text-white decorate-none"><i class="fa fa-bolt mr-2"></i>Enroll now</a></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div id="detail" class="flex">
            <div class="w-8/12 pr-2">
                <div id="desc" class="bg-white w-full">
                    <h2>Course detail</h2>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus asperiores aut corporis adipisci porro architecto, recusandae alias voluptate dolore soluta accusantium voluptatibus ea illum eos libero unde beatae cupiditate provident?</p>
                    <h2 class="mt-2">What you will learn?</h2>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus asperiores aut corporis adipisci porro architecto, recusandae alias voluptate dolore soluta accusantium voluptatibus ea illum eos libero unde beatae cupiditate provident?</p>
                    <h2 class="mt-2">Before starting</h2>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus asperiores aut corporis adipisci porro architecto?</p>
                    <div>
                        <h2 class="mt-2">Instructor</h2>
                        <div class="flex space-between mt-2">
                            <img src="imgs/courses/course_1.jpg" alt="" class="w-full">
                            <div class="w-8/12">
                                <p>I am a fullstack developer and computer science professional Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis numquam sint pariatur deserunt, repellendus et deleniti iste animi, in expedita vitae voluptatum voluptas doloremque quos maxime. Nobis enim cupiditate molestias!</p>
                                <div class="mt-2 flex space-between">
                                    <button class="bg-f primary-btn bg-f"><i class="fab fa-facebook-f mr-2"></i>Share</button>
                                    <button class="primary-btn bg-gp"><i class="fab fa-google-plus mr-2"></i>Share</button>
                                    <button class="primary-btn bg-tw"><i class="fab fa-twitter mr-2"></i>Tweet</button>
                                    <button class="primary-btn bg-wa"><i class="fab fa-whatsapp mr-2"></i>Share</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="curr">
                        <h2>Curriculum</h2>
                        <ul>
                            <li>
                                <p>
                                    <i class="fa fa-puzzle-piece mr-1"></i>
                                    Introduction
                                </p>
                            </li>
                            <li>
                                <p>
                                    <i class="fa fa-puzzle-piece mr-1"></i>
                                    Overview
                                </p>
                            </li>
                            <li>
                                <p>
                                    <i class="fa fa-puzzle-piece mr-1"></i>
                                    Creating important folders
                                </p>
                            </li>
                            <li>
                                <p>
                                    <i class="fa fa-puzzle-piece mr-1"></i>
                                    Connect with database
                                </p>
                            </li>
                            <li>
                                <p>
                                    <i class="fa fa-puzzle-piece mr-1"></i>
                                    Design home page
                                </p>
                            </li>
                            <li>
                                <p>
                                    <i class="fa fa-puzzle-piece mr-1"></i>
                                    Including files
                                </p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="w-4/12 pl-2">
                <div id="rel" class="bg-white w-full h-full">
                    <h2>Related courses</h2>
                    <div class="mt-2">
                        <ul class="list-none">
                            <li class="mt-2">
                                <a href="" class="decorate-none flex hover:opacity-0.8">
                                    <img src="imgs/courses/course_1.jpg" alt="" class="w-4/12 h-24">
                                    <p class="ml-2 text-title-fade">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                                </a>
                            </li>
               
                            <li class="mt-2">
                                <a href="" class="decorate-none flex hover:opacity-0.8">
                                    <img src="imgs/courses/course_1.jpg" alt="" class="w-4/12 h-24">
                                    <p class="ml-2 text-title-fade">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("inc/footer.php") ?>

</body>

</html>