<?php
$question_id = $_GET['edit_question'];
$question = get_question($question_id);
?>

<div>
  <div class="flex">

    <div class="md:w-10/12">
      <!--  main body content starts -->

      <!-- ===============================================================================================================-->


      <!-- form starts -->

      <div class="ml-3 mt-2">
        <h3 class="text-3xl font-black text-center">Update question</h3>
      </div>

      <form method="POST" action="inc/controller/course_quiz_controller.php" class="ml-3 mt-2 px-8" onsubmit="return validation()">
        <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
          Question
        </label>
        <textarea name="question" id="question" rows="6" class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        mt-3
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"><?php echo $question["question"] ?></textarea>
        <span id="desc_error" class="text-danger small"></span>

        <?php $i = 0;
        foreach ($question['options'] as $option) { ?>
          <div class="mt-1">
            <div class="flex items-center mt-4">
              <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
                Option <?php echo $i + 1; ?> is answer
              </label>
              <input type="checkbox" name="answers[]" id="answers" value="0" class="form-checkbox h-4 w-4 ml-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
              <?php echo (in_array($question['option_ids'][$i], $question['answers']) ? 'checked' : '') ?>>
            </div>
            <input type="text" name="options[]" id="options" class="form-control mt-2" value="<?php echo $option ?>">
          </div>
        <?php $i++;
        } ?>

        <span id="editor_error" class="text-danger small"></span><br>

        <button type="submit" name="update_question" class="font-bold text-sm px-8 py-2 bg-indigo-600 text-white ml-auto rounded-full float-right">Submit</button>
      </form>

    </div>



  </div>
</div>


<script type="text/javascript">
  // =============================================================================================================
  // javascript validation function

  function validation() {
    var name = document.getElementById('course_name').value;
    var topicname = document.getElementById('topic_name').value;
    var editor = document.getElementById('editor').value;
    if (name == "") {
      document.getElementById('name_error').innerHTML = "** Please enter topic name";
      return false;
    }

    if (topicname == "") {
      document.getElementById('desc_error').innerHTML = "** Please enter topic name";
      return false;

    }
    if (editor == "") {
      document.getElementById('editor_error').innerHTML = "** Please enter the description";
      return false;

    }
  }
  // javascript validation function
  // =============================================================================================================
</script>