<div class="sm:w-6/12 mt-3 mx-auto py-16 text-center">

    <form method="POST" action="" id="select-course">
        <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="exampleFormControlSelect1">
            Select course
        </label>
        <select class="form-control-block mt-4" name="course_id">

            <?php
            $courses = get_courses();
            foreach ($courses as $course) {
            ?>
                <option value="<?php echo $course['id'] ?>"><?php echo  $course['course_name']; ?></option>
            <?php } ?>

        </select>

        <button type="submit" name="get_quizz_of_course" class="font-bold text-sm px-8 py-2 bg-primary text-white ml-auto rounded-full mt-2">Start quiz</button>

    </form>

    <div id="form-quiz" class="form-group mt-4 hidden">
        <form method="POST" action="quiz_show.php">
            <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="exampleFormControlSelect1">
                Select quiz
            </label>
            <select class="form-control-block mt-4" id="select-quiz" name="quiz_id">

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


<script>
    // Variable to hold request
    var request;

    $(document).ready(function() {

        // Bind to the submit event of our form
        $("#select-course").submit(function(event) {

            // Prevent default posting of form - put here to work in case of errors
            event.preventDefault();

            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);

            // Let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");

            // Serialize the data in the form
            var serializedData = $form.serialize();

            // Let's disable the inputs for the duration of the Ajax request.
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.
            $inputs.prop("disabled", true);

            // Fire off the request to /form.php
            request = $.ajax({
                url: "./inc/controller/ajax.php",
                type: "post",
                data: serializedData
            });

            // Callback handler that will be called on success
            request.done(function(response, textStatus, jqXHR) {
                response = JSON.parse(response);
                // Log a message to the console
                console.log("Hooray, it worked!", response);

                if (response['success']) {
                    $("#form-quiz").toggleClass("hidden")

                    const quizz = response['quizz'];

                    let options = "";

                    for (let index = 0; index < quizz.length; index++) {
                        const element = quizz[index];
                        options += `<option value='${element["id"]}'>${element["quiz_name"]}</option>`;
                        
                    }

                    $("#select-quiz").html(x)
                }
            });

            // Callback handler that will be called on failure
            request.fail(function(jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error(
                    "The following error occurred: " +
                    textStatus, errorThrown
                );
            });

            // Callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function() {
                // Reenable the inputs
                $inputs.prop("disabled", false);
            });

        });

    })
</script>