<div class="py-8">
    <?php

    $topic_id = $_GET['edit_topic'];
    $res = get_topic($topic_id);
    ?>
    <div class="mt-1">
        <p class="text-2xl font-bold text-center">Update topic</p>
    </div>

    <form method="POST" action="inc/controller/course_controller.php" class="ml-3 mt-4">
        <input type="hidden" name="course_id" value="<?php echo $res['id']; ?>">

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-4" for="inline-full-name">
            Course name
        </label>
        <input type="text" name="coursename" readonly="readonly" class="form-control mt-1" value="<?php echo $res['course_name'] ?>"><br>
        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-4" for="inline-full-name">
            Topic name
        </label>
        <input type="text" name="topic_name" class="form-control mt-1" value="<?php echo $res['topic_name'] ?>">

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-4" for="inline-full-name">
            Content
        </label>
        <textarea id="editor" name="editor" class="ckeditor mt-2" placeholder="Enter the content..."><?php echo $res['description']; ?></textarea>
        <button type="submit" name="update_topic" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
            Update
        </button>
    </form>
</div>