<div class="">
  <div class="flex">
    <!-- ========================================================================================================================== -->
    <!-- ========================================================================================================================== -->

    <?php $coursename = 'java'; ?>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col flex-grow mt-4">
      <div class="flex items-center justify-between px-4">
        <p class="text-2xl font-bold">Course topics</p>
        <div class="px-4 py-2 rounded-full bg-indigo-600 font-bold text-sm text-white">
          <a href="add_new_topic.php?course_name=<?php echo $coursename ?>">
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
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">

                <?php

                $course_id = $_GET['edit_course'];
                $topics = course_topics($course_id);

                foreach ($topics as $res) {
                ?>

                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900"> <?php echo $res['topic_name'] ?> </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500"><textarea rows="3" class="w-full"><?php echo html_entity_decode($res['description'], ENT_QUOTES); ?></textarea></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Active </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end">
                      <a href="index.php?edit_topic=<?php echo $res['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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