<div id="top-course">
    <h3>Top courses</h3>
    <div class="grid grid-col-4 grid-gap-2">

        <?php

        $courses = get_course_videos();

        foreach ($courses as $course) { ?>
            <div class="course-card">
                <a href="topic_videos.php?course_id=<?php echo $course["id"] ?>">
                    <img src="<?php echo $course["course_image"] ?>" alt="">
                    <h3><?php echo $course["course_name"] ?></h3>
                    <h4><?php echo $course["course_description"] ?></h4>
                    <h5>Teacher: Guys</h5>
                </a>
            </div>
        <?php } ?>

    </div>
</div>