<div id="body-right">
    <h3>View All Categories</h3>
    <div id="add-cat">
        <details>
            <summary>Add category</summary>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="cat_name" placeholder="Enter category name">
                <button>Add category</button>
            </form>
        </details>
    </div>
</div>


<?php

echo add_cat(); ?>