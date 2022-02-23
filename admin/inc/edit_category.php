<div class="w-1/2 mx-auto shadow-lg rounded-lg p-8">
    <h3 class="text-black text-2xl font-bold">Edit category</h3>
    <div class="mt-4">
        <form method="post" enctype="multipart/form-data">
            <?php
            $cat = get_category($_GET['edit_cat']);
            ?>

            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
                Topic name
            </label>
            <input type="text" name="name" id="name" class="form-control mt-2" value="<?php echo $cat["name"] ?>" placeholder="Enter category name">
            <input type="hidden" name="id" value=" <?php echo $_GET['edit_cat'] ?>"></input>
            <button type="submit" name="update_cat" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                Update category
            </button>
        </form>
    </div>

</div>



<?php echo update_cat(); ?>