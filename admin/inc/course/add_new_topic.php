<?php
$course_id = $_GET['course_id'];
$course = get_course($course_id);
?>

<div>
  <div class="flex">

    <div class="md:w-10/12">
      <!--  main body content starts -->

      <!-- ===============================================================================================================-->


      <!-- form starts -->

      <div class="ml-3 mt-2">
        <h3 class="text-3xl font-black text-center">Add new topic</h3>
      </div>

      <form method="POST" action="inc/controller/course_controller.php" class="ml-3 mt-2 px-8" onsubmit="return validation()">
        <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
          Course name
        </label>
        <input type="text" name="coursename" id="coursename" class="form-control mt-2" readonly="readonly" value="<?php echo $course['course_name'] ?>"> <span id="name_error"></span><br>

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
          Topic name
        </label>
        <input type="text" name="topic_name" id="topic_name" class="form-control mt-2">
        <span id="desc_error" class="text-danger small"></span>

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-4" for="inline-full-name">
          Content
        </label>
        <div class="mt-1">
          <textarea id="editor" name="editor" id="editor" placeholder="Enter the content..." rows="3" class="ckeditor py-2 px-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="you@example.com"></textarea>
        </div>
        <span id="editor_error" class="text-danger small"></span><br>

        <button type="submit" name="add_topic" class="font-bold text-sm px-8 py-2 bg-indigo-600 text-white ml-auto rounded-full float-right">Submit</button>
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