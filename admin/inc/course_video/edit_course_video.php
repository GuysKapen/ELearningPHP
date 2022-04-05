<?php
$course_id = $_GET['edit_course_video'];
$course = get_course_video($course_id);
?>
<div class="">
  <header class="border-gray-100 flex items-stretch border-b dark:border-gray-800">
    <div class="flex items-center py-3 flex-grow font-bold px-4">
      <details class="w-full">
        <summary>Update course</summary>
        <div class="mt-2">
          <form method="post" enctype="multipart/form-data" action="inc/controller/course_controller.php">
            <input type="hidden" value="<?php echo $course['id'] ?>" name="id">
            <input type="text" name="name" value="<?php echo $course['course_name'] ?>" class="form-control mr-4" placeholder="Course name">
            <div class="flex items-end mt-2">
              <textarea type="text" name="description" class="form-control mr-4" placeholder="Course description"><?php echo $course['course_description'] ?></textarea>
              <button name="update_course" class="px-4 py-2 rounded-full bg-indigo-600 font-bold text-sm text-white w-1/4">Update course</button>
            </div>
          </form>
        </div>
      </details>
    </div>
  </header>

  <div class="flex">
    <!-- ========================================================================================================================== -->
    <!-- ========================================================================================================================== -->

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col flex-grow mt-4">
      <div class="flex items-center justify-between px-4">
        <p class="text-2xl font-bold">Course topics</p>
        <div class="px-4 py-2 rounded-full bg-indigo-600 font-bold text-sm text-white">
          <a href="?add_video_topic&course_id=<?php echo $course_id ?>">
            Add topic
          </a>
        </div>
      </div>
      <div class="my-2">
        <div class="py-2 align-middle px-4">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="divide-y divide-gray-200 min-w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Video</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">

                <?php


                $topics = course_video_topics($course_id);

                foreach ($topics as $res) {
                ?>

                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900"> <?php echo $res['topic_name'] ?> </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900"> <?php echo $res['video_path'] ?> </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end">
                      <a href="index.php?edit_video_topic=<?php echo $res['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                      <form action="inc/controller/course_controller.php" method="POST">
                        <input type="hidden" name="topic_id" value="<?php echo $res['id'] ?>">
                        <button name="del_topic" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                      </form>
                    </td>
                  </tr>

                <?php }                  ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>







  </div>
</div>