<div class="mt-8">
    <h3 class="text-4xl text-center font-bold text-primary-imp">Categories</h3>

    <div class="flex items-center justify-center mt-4">
        <?php
        include_once("inc/function.php");
        $categories = select_categories();
        $categories = array_slice($categories, 0, 5);

        foreach ($categories as $category) { ?>
            <a href="category.php?cat=<?php echo $category['id'] ?>">
                <div class="stack justify-items-center inline-grid items-end mb-4 mx-4 cursor-pointer">
                    <div class="text-center shadow-md w-36 card bg-base-200">
                        <div class="card-body"><?php echo $category['name'] ?></div>
                    </div>
                    <div class="text-center shadow w-36 card bg-base-200">
                        <div class="card-body"></div>
                    </div>
                    <div class="text-center shadow-sm w-36 card bg-base-200">
                        <div class="card-body"></div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>


</div>