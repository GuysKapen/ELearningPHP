<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />
<?php
$course_id = $_GET['edit_course'];
$course = get_course($course_id);
?>
<div class="">
  <header class="border-gray-100 flex items-stretch border-b dark:border-gray-800">
    <div class="flex items-center py-3 flex-grow font-bold px-4">
      <details class="w-full">
        <summary>Update course</summary>
        <div class="mt-2">
          <form method="post" enctype="multipart/form-data" action="inc/controller/course_controller.php">
            <input type="hidden" value="<?php echo $course['id'] ?>" name="course_id">
            <label class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
              Name
            </label>
            <input type="text" name="course_name" value="<?php echo $course['course_name'] ?>" class="form-control mr-4" placeholder="Course name">
            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
              Description
            </label>
            <textarea type="text" name="course_desc" class="form-control mr-4" placeholder="Course description"><?php echo $course['course_description'] ?></textarea>
            <div class="form-group">
              <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                Image
              </label>
              <div class="form-input mt-1">
                <input type="file" class="form-control" id="c_img" placeholder="Enter Course Image" name="course_image">
              </div>
              <span id="image_error" class="text-danger font-weight-bold"></span>
            </div>

            <div class="field">
              <div class="form-group">
                <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                  Categories
                </label>
                <div class="relative flex w-full mt-1">
                  <select id="update-select-category" name="categories[]" placeholder="Select categories..." autocomplete="off" class="block w-full rounded-sm cursor-pointer focus:outline-none" multiple>
                    <?php
                    $cats = select_categories();
                    foreach ($cats as $cat) {
                      echo "<option value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
                    } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="field">
              <div class="form-group">
                <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 flex-shrink-0" for="inline-full-name">
                  Programing languages
                </label>
                <div class="relative flex w-full mt-1">
                  <select id="update-select-pro-lang" name="pro_langs[]" placeholder="Select programming languages..." autocomplete="off" class="block w-full rounded-sm cursor-pointer focus:outline-none" multiple>
                    <?php
                    $cats = select_programming_langs();
                    foreach ($cats as $cat) {
                      echo "<option value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
                    } ?>
                  </select>
                </div>
              </div>

            </div>


            <div class="form-group">
              <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                Language
              </label>
              <select name="lang_id" id="lang_id" class="form-select mt-1 appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="">Select language</option>
                <?php
                $cats = select_langs();
                foreach ($cats as $cat) {
                  echo "<option value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="flex items-end mt-2">

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
          <a href="?add_topic&course_id=<?php echo $course_id ?>">
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
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">

                <?php


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
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
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

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
  new TomSelect('#update-select-category');
  new TomSelect('#update-select-pro-lang');
</script>