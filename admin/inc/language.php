<div id="body-right">
    <h3>View All Categories</h3>
    <div id="add-cat">
        <details>
            <summary>Add language</summary>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Enter language name">
                <button name="add_lang">Add language</button>
            </form>
        </details>

        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>   
                <th>Action</th>
            </tr>

            <?php
            $i = 1;
            $langs = select_langs();
            foreach ($langs as $lang) {
                echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $lang['name'] . "</td>
                <td>
                    <a href='index.php?edit_lagn=" . $lang['id'] . "'><i class='fa fa-edit'></i></a>
                    <a href='index.php?cat&del_lang=" . $lang['id'] . "'><i class='fa fa-trash'></i></a>
                </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>


<?php
echo add_lang();
echo del_lang() ?>