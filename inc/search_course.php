<div id="top-course">
    <h3>Courses</h3>
    <div class="grid grid-col-4 grid-gap-2 justify-center my-4">

        <?php

        $kw = $_GET['query'];
        $courses = get_courses_match($kw);

        foreach ($courses as $course) { ?>
            <div class="course-card">
                <a href="topic.php?topic_id=<?php echo $course["topic_id"] ?>">
                    <img src="<?php echo $course["course_image"] ?>" alt="">
                    <h3><?php echo $course["course_name"] ?></h3>
                    <h4><?php echo $course["course_description"] ?></h4>
                    <h5>Teacher: Guys</h5>
                </a>
            </div>
        <?php } ?>

    </div>
</div>