<!DOCTYPE html>
<html>

<head>
  <title></title>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

  <style type="text/css">

    .form-control {
      display: block;
      width: 100%;
      padding: .375rem .75rem;
      font-size: 1rem;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .form-control:disabled,
    .form-control[readonly] {
      background-color: #e9ecef;
      opacity: 1;
    }
  </style>
</head>

<body>

  <?php

  require("../inc/nav_bar.php");    //navigation bar included

  ?>

  <div>
    <div class="flex">
      <!-- ========================================================================================================================== -->

      <!-- sidebar starts -->

      <?php include('../inc/side_bar.php') ?>

      <!-- sidebar ends -->

      <!-- ========================================================================================================================== -->



      <div class="md:w-10/12">
        <!--  main body content starts -->

        <!-- ===============================================================================================================-->


        <!-- form starts -->

        <div class="ml-3 mt-2">
          <h3 class="text-3xl font-black text-center">Add new topic</h3>
        </div>

        <form method="POST" action="verify/verify_changes.php" class="ml-3 mt-2 px-8" onsubmit="return validation()">
          <input type="hidden" name="id" value="<?php echo $_GET['course_id']; ?>">

          <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
            Course name
          </label>
          <input type="text" name="coursename" id="coursename" class="form-control mt-2" readonly="readonly" value="<?php echo $_GET['course_name'] ?>"> <span id="name_error"></span><br>

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

          <button type="submit" name="submitbtn" class="font-bold text-sm px-8 py-2 bg-indigo-600 text-white ml-auto rounded-full float-right">Submit</button>
        </form>

      </div>



    </div>
  </div>




  <script type="text/javascript">
    // =============================================================================================================
    // javascript validation function

    function validation() {
      var name = document.getElementById('coursename').value;
      var topicname = document.getElementById('topic_name').value;
      var editor = document.getElementById('editor').value;
      if (name == "") {
        document.getElementById('name_error').innerHTML = "** please enter topic name";
        return false;

      }

      if (topicname == "") {
        document.getElementById('desc_error').innerHTML = "** please enter topic name";
        return false;

      }
      if (editor == "") {
        document.getElementById('editor_error').innerHTML = "** please enter the description";
        return false;

      }
    }
    // javascript validation function
    // =============================================================================================================
  </script>



  <script src="../ckeditor/ckeditor.js"></script> <!-- script for ckeditor -->

  <body>

</html>