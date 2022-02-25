


<div class="w-1/2 mx-auto shadow-lg rounded-lg p-8">
    <h3 class="text-black text-2xl font-bold">Edit language</h3>
    <div class="mt-4">
        <form method="post" enctype="multipart/form-data">
            <?php
            $lang = get_language($_GET['edit_lang']);
            ?>

            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
                Name
            </label>
            <input type="text" name="name" id="name" class="form-control mt-2" value="<?php echo $lang["name"] ?>" placeholder="Enter lang name">
            <input type="hidden" name="id" value=" <?php echo $_GET['edit_lang'] ?>"></input>
            <button type="submit" name="update_lang" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                Update language
            </button>
        </form>
    </div>

</div>



<?php echo update_lang(); ?>