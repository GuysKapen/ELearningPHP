<div id="top-course">
    <h3>Top videos</h3>
    <div class="grid grid-col-4 grid-gap-2">

        <?php

        $course_id = $_GET['course_id'];
        $topics = course_topic_videos($course_id);

        foreach ($topics as $topic) { ?>
            <div class="course-card">
                <a href="topic_video.php?topic_video_id=<?php echo $topic["id"] ?>">
                    <img src="<?php echo $topic["topic_image"] ?>" alt="">
                    <h3><?php echo $topic["topic_name"] ?></h3>
                    <h5>Teacher: Guys</h5>
                </a>
            </div>
        <?php } ?>

    </div>
</div>