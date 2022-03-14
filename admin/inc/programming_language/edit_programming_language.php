<div class="w-1/2 mx-auto shadow-lg rounded-lg p-8">
    <h3 class="text-black text-2xl font-bold">Edit language</h3>
    <div class="mt-4">
        <form method="post" enctype="multipart/form-data" action="inc/controller/pro_lang_controller.php">
            <?php
            $lang = get_programming_language($_GET['edit_pro_lang']);
            ?>

            <div class="form-group">
                <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                    Name
                </label>
                <div class="form-input mt-1">
                    <input type="text" name="name" id="name" class="form-control mt-2" value="<?php echo $lang["name"] ?>" placeholder="Enter lang name">
                </div>
                <span id="image_error" class="text-danger font-weight-bold"></span>
            </div>

            <div class="form-group">
                <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                    Image
                </label>
                <div class="form-input mt-1">
                    <input type="file" class="form-control" id="image" placeholder="Enter course image" name="image">
                </div>
                <span id="image_error" class="text-danger font-weight-bold"></span>
            </div>

            <input type="hidden" name="id" value=" <?php echo $_GET['edit_pro_lang'] ?>"></input>
            <button type="submit" name="update_pro_lang" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                Update language
            </button>
        </form>
    </div>

</div>



<?php echo update_lang(); ?>