<div id="body-right">
    <h3>Edit category</h3>
    <form id="edit-form" method="post" enctype="multipart/form-data">
        <?php
        $sub_cat = get_sub_category($_GET['edit_sub_cat']);
        echo '<select name="cat_id" id="cat_id">';
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

        echo '<input class="mt-2" type="text" name="name" value="' . $sub_cat["name"] . '" placeholder="Enter category name">';
        echo '<input type="hidden" name="id" value="' . $_GET['edit_sub_cat'] . '"></input>';
        ?>
        <button name="update_sub_cat">Update category</button>
    </form>
</div>

<?php echo update_sub_cat(); ?>