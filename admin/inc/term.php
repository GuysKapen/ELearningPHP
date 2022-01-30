<div id="body-right">
    <h3>View All Categories</h3>
    <div id="add-cat">
        <details>
            <summary>Add term and condition</summary>
            <form method="post" enctype="multipart/form-data">
                <select name="type" id="type">
                    <option value="">Select term type</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
                <input class="mt-2" type="text" name="name" placeholder="Enter term name">
                <button name="add_term">Add term</button>
            </form>
        </details>

        <table style="width: 80%;margin-top: 2rem;">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>

            <?php
            $i = 1;
            $terms = select_terms();
            foreach ($terms as $term) {
                echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $term['name'] . "</td>
                <td style='text-transform: capitalize'>" . $term['type'] . "</td>
                <td>
                    <a href='index.php?edit_term=" . $term['id'] . "'><i class='fa fa-edit'></i></a>
                    <a href='index.php?term&del_term=" . $term['id'] . "'><i class='fa fa-trash'></i></a>
                </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>


<?php
echo add_term();
echo del_term() ?>