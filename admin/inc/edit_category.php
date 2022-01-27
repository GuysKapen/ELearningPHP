<div id="body-right">
    <h3>Edit category</h3>
    <form id="edit-form" method="post" enctype="multipart/form-data">
        <?php
        $cat = get_category($_GET['edit_cat']);
        echo '<input type="text" name="name" value="'. $cat["name"] .'" placeholder="Enter category name">';
        echo '<input type="hidden" name="id" value="' . $_GET['edit_cat'] . '"></input>';
        ?>
        <button name="update_cat">Update category</button>
    </form>
</div>

<?php echo update_cat(); ?>