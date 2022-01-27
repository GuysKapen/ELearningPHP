<div id="body-right">
    <h3>View All Categories</h3>
    <div id="add-cat">
        <details>
            <summary>Add category</summary>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="cat_name" placeholder="Enter category name">
                <button name="add_cat">Add category</button>
            </form>
        </details>

        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
            $i = 1;
            $cats = select_categories();
            foreach ($cats as $cat) {
                echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $cat['name'] . "</td>
                <td><a href='#'>Edit</a></td>
                <td><a href='#'>Delete</a></td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>


<?php
echo add_cat(); ?>