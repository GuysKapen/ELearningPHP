<?php

function quiz_result($quiz_id)
{
    $questions = quiz_question_options($quiz_id);


    if (!isset($_POST['answer'])) {
        $array = array();
        $array['correct'] = 0;
        $array['incorrect'] = count($questions);
        return $array;
    }

    $user_answers = $_POST['answer'];
    $correct = 0;
    $incorrect = 0;

    foreach ($questions as $question) {
        $options = $question['options'];
        $answers = $question['answers'];

        $option_correct = true;

        if (!isset($user_answers[$question['id']])) {
            if (count($answers) == 0) {
                $correct++;
            } else {
                $incorrect++;
            }
            continue;
        }

        if (count($user_answers[$question['id']]) > count($options)) {
            print_r("Cheating ...! 0 mark!");
            $array = array();
            $array['correct'] = $correct;        
            $array['incorrect'] = $incorrect;
            return $array;
        }

        for ($i = 0; $i < count($answers); $i++) {
            if (!isset($user_answers[$question['id']][$answers[$i]])) {
                $option_correct = false;
            }
        }

        if ($option_correct) {
            $correct++;
        } else {
            $incorrect++;
        }
    }

    $array = array();                //creating an array
    $array['correct'] = $correct;         // putting the values inside the array
    $array['incorrect'] = $incorrect;
    return $array;
}
