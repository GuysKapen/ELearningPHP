<div id="top-course">
    <h3>Quizz</h3>
    <div class="w-1/2 mx-auto">

        <?php
        $quiz_id = $_POST['quiz_id'];
        $questions = quiz_question_options($quiz_id); ?>

        <div class="block ml-auto text-right my-2" id="time-out">time out</div>


        <form id="quiz-form" action="quiz_result.php" method="POST">
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id ?>">

            <table class="divide-y divide-gray-200 min-w-full mx-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-5/12">Questions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    <?php

                    foreach ($questions as $question) {
                    ?>

                        <tr>
                            <td class="px-6 py-4 w-5/12">
                                <div class="text-sm font-medium text-gray-900"> <?php echo nl2br($question['question']) ?> </div>
                                <div class="text-sm font-medium text-gray-900">
                                    <ul>
                                        <?php
                                        $i = -1;
                                        foreach ($question['options'] as $option) { ?>
                                            <?php $i++; ?>
                                            <div>
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600 block" name="answer[<?php echo $question['id']; ?>][<?php echo $question['option_ids'][$i] ?>]">
                                                    <span class="ml-2 text-gray-700">
                                                        <li><?php echo htmlspecialchars($option); ?></li>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </td>

                        </tr>

                    <?php }                  ?>

                </tbody>
            </table>


            <button type="submit" name="quiz" class="font-bold text-sm px-8 py-2 bg-indigo-600 text-white ml-auto rounded-full block ml-auto mt-4">Submit</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    function timeout() //function to check time out
    {
        var minute = Math.floor(timeleft / 60);
        var second = timeleft % 60;
        var min = checkMin(minute);
        var sec = checkSec(second)
        if (timeleft <= 0) {
            clearTimeout(tm); //if timeout then stop the timeout function
            document.getElementById("quiz-form").submit(); //if timeout then automatic submit the form
        } else {
            document.getElementById("time-out").innerHTML = min + ":" + sec; //else diplay the time
        }
        timeleft--; //decrease time each time
        var tm = setTimeout(function() {
            timeout()
        }, 1000); //after each 1 minute the function timeout will called automatically
    }

    function checkSec(second) //convert from  0:5 to 0:05
    {
        if (second < 10) {
            second = "0" + second;
        }
        return second;
    }

    function checkMin(minute) //convert from  0:20 to 00:20
    {
        if (minute < 10) {
            minute = "0" + minute;
        }
        return minute;
    }


    var timeleft = 5 * 60;
    timeout();
</script>