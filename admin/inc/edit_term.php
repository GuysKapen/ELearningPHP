<div id="body-right">
    <h3>Edit category</h3>
    <form id="edit-form" method="post" enctype="multipart/form-data">
        <?php
        $term = get_term($_GET['edit_term']);
        echo '<select required name="type" id="type">';
        echo '<option value="">Select type</option>';
        echo '<option "' . ($term['type'] == 'student' ? " selected='selected'" : "") . '" value="student">Student</option>';
        echo '<option "' . ($term['type'] == 'teacher' ? ' selected="selected"' : "") . '" value="teacher">Teacher</option>';
        echo '</select>';
        echo '<input class="mt-2" type="text" name="name" value="' . $term["name"] . '" placeholder="Enter term name">';
        echo '<input type="hidden" name="id" value="' . $_GET['edit_term'] . '"></input>';
        ?>
        <button name="update_term">Update language</button>
    </form>
</div>

<?php echo update_term(); ?>