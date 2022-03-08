<?php
$quiz_id = $_GET['quiz_id'];
$quiz = get_quiz($quiz_id);
?>

<div>
  <div class="flex">

    <div class="md:w-10/12">
      <!--  main body content starts -->

      <!-- ===============================================================================================================-->


      <!-- form starts -->

      <div class="ml-3 mt-2">
        <h3 class="text-3xl font-black text-center">Add new question</h3>
      </div>

      <form method="POST" action="inc/controller/course_quiz_controller.php" class="ml-3 mt-2 px-8" onsubmit="return validation()">
        <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
          Quiz name
        </label>
        <input type="text" name="quiz_name" id="course_name" class="form-control mt-2" readonly="readonly" value="<?php echo $quiz['quiz_name'] ?>"> <span id="name_error"></span><br>

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
          Question
        </label>
        <input type="text" name="question" id="question" class="form-control mt-2">
        <span id="desc_error" class="text-danger small"></span>

        <div class="mt-1">
          <div class="flex items-center mt-4">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
              Option 1 is answer
            </label>
            <input type="checkbox" name="answers[]" id="answers" value="0" class="form-checkbox h-4 w-4 ml-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          </div>
          <input type="text" name="options[]" id="options" class="form-control mt-2">
        </div>
        <div class="mt-1">
          <div class="flex items-center mt-4">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
              Option 2 is answer
            </label>
            <input type="checkbox" name="answers[]" id="answers" value="1" class="form-checkbox h-4 w-4 ml-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          </div>
          <input type="text" name="options[]" id="options" class="form-control mt-2">
        </div>
        <div class="mt-1">
          <div class="flex items-center mt-4">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
              Option 3 is answer
            </label>
            <input type="checkbox" name="answers[]" id="answers" value="2" class="form-checkbox h-4 w-4 ml-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          </div>
          <input type="text" name="options[]" id="options" class="form-control mt-2">
        </div>
        <div class="mt-1">
          <div class="flex items-center mt-4">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
              Option 4 is answer
            </label>
            <input type="checkbox" name="answers[]" id="answers" value="3" class="form-checkbox h-4 w-4 ml-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          </div>
          <input type="text" name="options[]" id="options" class="form-control mt-2">
        </div>

        <span id="editor_error" class="text-danger small"></span><br>

        <button type="submit" name="add_question" class="font-bold text-sm px-8 py-2 bg-indigo-600 text-white ml-auto rounded-full float-right">Submit</button>
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