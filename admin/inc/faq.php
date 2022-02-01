<div id="body-right">
    <h3>View All Categories</h3>
    <div id="add-cat">
        <details>
            <summary>Add FAQ</summary>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="question" placeholder="Enter question">
                <textarea class="mt-2" name="answer" placeholder="Enter answer"></textarea>
                <button name="add_faq">Add FAQ</button>
            </form>
        </details>


        <?php
            $i = 1;
            $faqs = select_faqs();
            foreach ($faqs as $faq) {
                echo '<div class="mt-2">
                        <details class="mt-2">
                        <summary>' . $faq["question"] . '</summary>
                        <form method="post" enctype="multipart/form-data">
                            <input type="text" name="question" value="'. $faq["question"] .'" placeholder="Enter question">
                            <textarea class="mt-2" name="answer" value="'. $faq["answer"] .'"  placeholder="Enter answer">' . $faq["answer"] . '</textarea>
                            <button name="update_faq">Update FAQ</button>
                        </form>
                        </details>
                    </div>';
            }
            ?>
    </div>
</div>


<?php
echo add_faq();
echo del_faq();
echo update_faq(); ?>