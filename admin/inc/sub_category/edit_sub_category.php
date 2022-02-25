<div class="w-1/2 mx-auto shadow-lg rounded-lg p-8">
    <h3 class="text-black text-2xl font-bold">Edit sub category</h3>
    <div class="mt-4">
        <form method="post" enctype="multipart/form-data">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-4" for="inline-full-name">
                Main
            </label>
            <?php
            $sub_cat = get_sub_category($_GET['edit_sub_cat']);
            echo '<select name="cat_id" id="cat_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none mt-2">';
            echo '<option value="">Select category</option>';
            $cats = select_categories();
            foreach ($cats as $cat) {
                if ($cat['id'] == $sub_cat['cat_id']) {
                    echo "<option selected='selected' value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
                } else {
                    echo "<option value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
                }
            }
            echo '</select>';
            ?>

            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-4" for="inline-full-name">
                Name
            </label>
            <input type="text" name="name" id="name" class="form-control mt-2" value="<?php echo $sub_cat["name"] ?>" placeholder="Enter sub category name">
            <input type="hidden" name="id" value=" <?php echo $_GET['edit_sub_cat'] ?>"></input>
            <button type="submit" name="update_sub_cat" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                Update sub category
            </button>
        </form>
    </div>

</div>



<?php echo update_sub_cat(); ?>