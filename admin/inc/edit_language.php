<div id="body-right">
    <h3>Edit category</h3>
    <form id="edit-form" method="post" enctype="multipart/form-data">
        <?php
        $lang = get_language($_GET['edit_lang']);
        echo '<input type="text" name="name" value="'. $lang["name"] .'" placeholder="Enter language name">';
        echo '<input type="hidden" name="id" value="' . $_GET['edit_lang'] . '"></input>';
        ?>
        <button name="update_lang">Update language</button>
    </form>
</div>

<?php echo update_lang(); ?>