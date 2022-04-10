<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />
<?php
$courses = display_courses(); ?>

<section class="p-6">
    <div class="justify-between items-center block md:flex">
        <div class="flex shrink-0 grow-0 items-center justify-center mb-6 md:mb-0">
            <ul>
                <li class="title-stack-item inline-block pr-3 text-2xl text-gray-500 dark:text-gray-400 last:pr-0 last:font-black last:text-black dark:text-gray-100" data-v-fecf18ac="">Admin</li>
                <li class="title-stack-item inline-block pr-3 text-2xl text-gray-500 dark:text-gray-400 last:pr-0 last:font-black last:text-black dark:text-gray-100" data-v-fecf18ac="">Course</li>
            </ul>
        </div>
    </div>
</section>

<section class="px-0 md:px-6 py-6">

    <section class="px-6 sm:px-0 mb-6 flex items-center justify-between">
        <div class="flex items-center justify-start"><span class="inline-flex justify-center items-center w-6 h-6 mr-3"><svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                    <path fill="currentColor" d="M11,2V22C5.9,21.5 2,17.2 2,12C2,6.8 5.9,2.5 11,2M13,2V11H22C21.5,6.2 17.8,2.5 13,2M13,13V22C17.7,21.5 21.5,17.8 22,13H13Z" style="--darkreader-inline-fill:currentColor;" data-darkreader-inline-fill=""></path>
                </svg></span>
            <h1 class="text-2xl">Courses overview</h1>
        </div><button class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded ring-blue-700 p-1 bg-white text-black border-gray-300 hover:bg-gray-50" type="button"><span class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                    <path fill="currentColor" d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z" style="--darkreader-inline-fill:currentColor;" data-darkreader-inline-fill=""></path>
                </svg></span>
            <!---->
        </button>
    </section>
    <div class="md:rounded border-gray-100 dark:bg-gray-900/70 bg-white border dark:border-gray-800 mb-6">
        <header class="border-gray-100 flex items-stretch border-b dark:border-gray-800">
            <div class="flex items-center py-3 flex-grow font-bold px-4">
                <details class="w-full">
                    <summary>Manage course</summary>

                    <div>




                        <div class="border-b border-gray-200 dark:border-gray-700">
                            <ul class="flex flex-wrap -mb-px nav nav-tabs">
                                <li class="mr-2 nav-item">
                                    <a href="#add" data-toggle="tab" class="nav-link inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 active">Add</a>
                                </li>
                                <li class="mr-2 nav-item">
                                    <a href="#update" data-toggle="tab" class="nav-link inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300">Update</a>
                                </li>
                                <li class="mr-2 nav-item">
                                    <a href="#delete" data-toggle="tab" class="nav-link inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300">Delete</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="add">
                                <div class="mt-2">
                                    <form action="inc/controller/course_controller.php" method="post" enctype="multipart/form-data" onsubmit="return validation()">
                                        <div class="form-group">
                                            <label class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                                                Name
                                            </label>
                                            <div class="form-input mt-1">
                                                <input type="text" class="form-control" id="c_name" placeholder="Enter course name" name="course_name">
                                            </div>
                                            <span id="name_error" class="text-danger font-weight-bold"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                                                Description
                                            </label>
                                            <div class="form-input mt-1">
                                                <input type="text" class="form-control" id="c_desc" placeholder="Enter course description" name="course_desc">
                                            </div>
                                            <span id="desc_error" class="text-danger font-weight-bold"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                                                Image
                                            </label>
                                            <div class="form-input mt-1">
                                                <input type="file" class="form-control" id="c_img" placeholder="Enter course image" name="course_image">
                                            </div>
                                            <span id="image_error" class="text-danger font-weight-bold"></span>
                                        </div>

                                        <div class="field">
                                            <div class="form-group">
                                                <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                                                    Categories
                                                </label>
                                                <div class="relative flex w-full mt-1">
                                                    <select id="select-category" name="categories[]" placeholder="Select categories..." autocomplete="off" class="block w-full rounded-sm cursor-pointer focus:outline-none" multiple>
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
                                                    <select id="select-pro-lang" name="pro_langs[]" placeholder="Select programming languages..." autocomplete="off" class="block w-full rounded-sm cursor-pointer focus:outline-none" multiple>
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

                                        <div class="text-right">
                                            <button name="add_course" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white w-1/4">Add course</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="tab-pane" id="update">
                                <div>
                                    <form action="inc/controller/course_controller.php" method="post" enctype="multipart/form-data" onsubmit="">

                                        <div class="form-group">

                                            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="exampleFormControlSelect1">
                                                Select course
                                            </label>
                                            <select class="form-control mt-1" id="exampleFormControlSelect1" name="selected_course">

                                                <?php foreach ($courses as $course) {
                                                ?>
                                                    <option value="<?php echo $course['id'] ?>"><?php echo  $course['course_name']; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                                                Description
                                            </label>
                                            <div class="form-input mt-1">
                                                <input type="text" class="form-control" id="c_desc" placeholder="Enter Course Description" name="course_desc">
                                            </div>
                                            <span id="desc_error" class="text-danger font-weight-bold"></span>
                                        </div>

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

                                        <div class="text-right">
                                            <button name="update_course" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white w-1/4">Update course</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="tab-pane" id="delete">
                                <div class="mt-2">
                                    <form action="inc/controller/course_controller.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="exampleFormControlSelect1">
                                                Select course
                                            </label>
                                            <select class="form-control mt-1" id="exampleFormControlSelect1" name="selected_course">
                                                <?php foreach ($courses as $course_list) {
                                                ?>
                                                    <option><?php echo  $course_list['course_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="text-right">
                                            <button name="del_course" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white w-1/4">Delete course</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>





                </details>
            </div>
        </header>



        <div class="flex flex-col flex-grow mt-4">
            <div class="flex items-center justify-between px-4">
                <p class="text-2xl font-bold">Manage courses</p>
            </div>
            <div class="my-2">
                <div class="py-2 align-middle px-4">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="divide-y divide-gray-200 min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                <?php
                                $i = 1;
                                $courses = display_courses();

                                foreach ($courses as $course) {
                                ?>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900"> <?php echo $course['course_name'] ?> </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900"> <?php echo $course['course_description'] ?> </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Active </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end">
                                            <a href="index.php?edit_course=<?php echo $course['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form action="inc/controller/course_controller.php" method="POST">
                                                <input type="hidden" name="course_id" value="<?php echo $course['id'] ?>">
                                                <button name="del_course_id" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php }

                                ?>

                                <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


</section>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('#select-category');
    new TomSelect('#update-select-category');
    new TomSelect('#select-pro-lang');
    new TomSelect('#update-select-pro-lang');
</script>