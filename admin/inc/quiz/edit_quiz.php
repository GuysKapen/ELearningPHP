<?php
$quiz_id = $_GET['edit_quiz'];
$quiz = get_quiz($quiz_id);
$courses = display_courses();
?>
<div class="">
  <header class="border-gray-100 flex items-stretch border-b dark:border-gray-800">
    <div class="flex items-center py-3 flex-grow font-bold px-4">
      <details class="w-full">
        <summary>Update quiz</summary>
        <div class="mt-2">
          <form method="post" enctype="multipart/form-data" action="inc/controller/course_quiz_controller.php">
            <input type="hidden" value="<?php echo $quiz['id'] ?>" name="id">
            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="exampleFormControlSelect1">
              Select course
            </label>
            <select class="form-control mt-1" id="exampleFormControlSelect1" name="course_id">

              <?php foreach ($courses as $course) {
              ?>
                <option value="<?php echo $course['id'] ?>"><?php echo  $course['course_name']; ?></option>
              <?php } ?>

            </select>

            <div class="flex items-end mt-2">
              <input type="text" name="quiz_name" value="<?php echo $quiz['quiz_name'] ?>" class="form-control mr-4" placeholder="Quiz name">
              <button name="update_quiz" class="px-4 py-2 rounded-full bg-indigo-600 font-bold text-sm text-white w-1/4">Update quiz</button>
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
        <p class="text-2xl font-bold"><?php echo $quiz['quiz_name'] ?> quiz questions</p>
        <div class="px-4 py-2 rounded-full bg-indigo-600 font-bold text-sm text-white">
          <a href="?add_question&quiz_id=<?php echo $quiz_id ?>">
            Add question
          </a>
        </div>
      </div>
      <div class="my-2">
        <div class="py-2 align-middle px-4">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="divide-y divide-gray-200 min-w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-5/12">Question</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Options</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">

                <?php

                $questions = quiz_question_options($quiz_id);

                foreach ($questions as $res) {
                ?>

                  <tr>
                    <td class="px-6 py-4 w-5/12">
                      <div class="text-sm font-medium text-gray-900"> <?php echo nl2br($res['question']) ?> </div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="text-sm font-medium text-gray-900">
                        <ul>

                          <?php
                          $i = -1;
                          foreach ($res['options'] as $option) { ?>
                            <?php $i++; ?>
                            <div>
                              <label class="inline-flex items-center mt-3">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600 block" <?php echo (in_array($res['option_ids'][$i], $res['answers']) ? 'checked' : '') ?>>
                                <span class="ml-2 text-gray-700">
                                  <li><?php echo htmlspecialchars($option); ?></li>
                                </span>
                              </label>
                            </div>
                          <?php } ?>
                        </ul>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <div class="flex justify-end items-center">
                        <a href="index.php?edit_question=<?php echo $res['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="inc/controller/course_quiz_controller.php" method="POST">
                          <input type="hidden" name="topic_id" value="<?php echo $res['id'] ?>">
                          <button name="del_question" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </form>
                      </div>
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