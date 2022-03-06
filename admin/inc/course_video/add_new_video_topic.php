<?php
$course_id = $_GET['course_id'];
$course = get_course_video($course_id);
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

      <form method="POST" action="inc/controller/course_controller.php" class="ml-3 mt-2 px-8" onsubmit="return validation()" enctype="multipart/form-data">
        <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
          Course name
        </label>
        <input type="text" name="course_name" id="course_name" class="form-control mt-2" readonly="readonly" value="<?php echo $course['course_name'] ?>"> <span id="name_error"></span><br>

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
          Topic name
        </label>
        <input type="text" name="topic_name" id="topic_name" class="form-control mt-2">
        <span id="desc_error" class="text-danger small"></span>

        <div class="form-group">
          <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
            Image
          </label>
          <div class="form-input mt-1">
            <input type="file" class="form-control" id="c_img" placeholder="Enter Course Image" name="topic_image">
          </div>
          <span id="image_error" class="text-danger font-weight-bold"></span>
        </div>

        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-4" for="inline-full-name">
          Video URL
        </label>

        <input type="text" name="video" id="video" class="form-control mt-2">
        <span id="editor_error" class="text-danger small"></span><br>

        <button type="submit" name="add_video_topic" class="font-bold text-sm px-8 py-2 bg-indigo-600 text-white ml-auto rounded-full float-right">Submit</button>
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