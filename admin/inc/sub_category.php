<div id="body-right">
    <h3>View All Sub Categories</h3>

    <?php
    ?>
    <div id="add-cat">
        <details>
            <summary>Add sub category</summary>
            <form method="post" enctype="multipart/form-data">
                <select name="cat_id" id="cat_id">
                    <option value="">Select category</option>
                    <?php
                    $cats = select_categories();
                    foreach ($cats as $cat) {
                        echo "<option value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
                    }
                    ?>
                </select>
                <input class="mt-2" type="text" name="sub_cat_name" placeholder="Enter category name">
                <button name="add_sub_cat">Add category</button>
            </form>
        </details>

        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Main</th>
                <th>Action</th>
            </tr>

            <?php
            $i = 1;
            $cats = select_sub_categories();
            foreach ($cats as $cat) {
                echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $cat['name'] . "</td>
                <td>" . $cat['cat_name'] . "</td>
                <td>
                    <a href='index.php?edit_sub_cat=" . $cat['id'] . "'><i class='fa fa-edit'></i></a>
                    <a href='index.php?cat&del_sub_cat=" . $cat['id'] . "'><i class='fa fa-trash'></i></a>
                </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>


<?php

echo add_sub_cat();
echo del_sub_category(); ?>