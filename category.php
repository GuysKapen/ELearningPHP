<?php include('inc/head.php') ?>

<body>

    <?php include("inc/header.php") ?>

    <?php
    $category = get_category($_GET['cat']);
    $categories = select_categories();
    ?>

    <div id="wrap" class="flex min-h-screen">
        <div class="w-1/5 p-4 bg-white">
            <div class="primary-btn bg-primary text-white w-full">Categories</div>
            <ul class="list-none pl-2 mt-2">
                <?php foreach ($categories as $c) { ?>
                    <li class="mt-1 hover:text-indigo-600"><a href="category.php?cat=<?php echo $c['id']?>" class="decorate-none"><?php echo $c['name'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="w-4/5">
            <div id="crumb">
                <span><a href="index.php">Home</a></span>
                <span>></span>
                <span><?php echo $category['name'] ?></span>
            </div>
            <div class="flex space-between p-6">
                <h2>
                    Courses
                </h2>
                <span>
                    <i class="fa fa-arrow-right"></i>
                </span>
            </div>

            <div class="grid grid-col-3 grid-gap-2 justify-start mx-8 mb-8">

                <?php

                $courses = get_courses_of_category($category['id']);

                foreach ($courses as $course) { ?>
                    <div class="course-card">
                        <a href="topic.php?topic_id=<?php echo $course["topic_id"] ?>">
                            <img src="<?php echo $course["course_image"] ?>" alt="">
                            <h3><?php echo $course["course_name"] ?></h3>
                            <h4><?php echo $course["course_description"] ?></h4>
                            <h5>Teacher: <?php echo $course["username"] ?></h5>
                        </a>
                    </div>
                <?php } ?>

            </div>

            <div class="flex space-between p-6">
                <h2>
                    Courses video
                </h2>
                <span>
                    <i class="fa fa-arrow-right"></i>
                </span>
            </div>

            <div class="grid grid-col-3 grid-gap-2 justify-start mx-8 mb-8">

                <?php

                $courses = get_courses_video_of_category($category['id']);

                foreach ($courses as $course) { ?>
                    <div class="course-card">
                        <a href="topic_videos.php?course_id=<?php echo $course["id"] ?>">
                            <img src="<?php echo $course["course_image"] ?>" alt="">
                            <h3><?php echo $course["course_name"] ?></h3>
                            <h4><?php echo $course["course_description"] ?></h4>
                            <h5>Teacher: <?php echo $course["username"] ?></h5>
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>

    </div>
    <?php include("inc/footer.php") ?>

</body>

</html>