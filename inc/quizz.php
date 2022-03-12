<!-- dropdown list starts -->

<div class="sm:w-6/12 mt-3 mx-auto py-16 text-center">
    <div class="form-group">
        <form method="POST" action="quiz_show.php">
            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="exampleFormControlSelect1">
                Select quiz
            </label>
            <select class="form-control-block mt-4" id="exampleFormControlSelect1" name="quiz_id">

                <?php
                $quizz = get_quizz();
                foreach ($quizz as $quiz) {
                ?>
                    <option value="<?php echo $quiz['id'] ?>"><?php echo  $quiz['quiz_name']; ?></option>
                <?php } ?>

            </select>

            <button type="submit" name="quiz" class="font-bold text-sm px-8 py-2 bg-primary text-white ml-auto rounded-full mt-2">Start quiz</button>

        </form>
    </div>
</div>