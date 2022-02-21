<!DOCTYPE html>
<html>

<head>
  <title></title>

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

  <!--  font awsome cdn -->
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>

  <?php include('../inc/nav_bar.php') ?>


  <div class="">
    <div class="flex">
      <!-- ========================================================================================================================== -->

      <?php include('../inc/side_bar.php') ?>

      <!-- ========================================================================================================================== -->

      <?php $coursename = $_GET['course_name'] ?>
      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="flex flex-col flex-grow mt-4">
        <div class="flex items-center justify-between px-4">
          <p class="text-2xl font-bold">Manage courses</p>
          <div class="px-4 py-2 rounded-full bg-indigo-600 font-bold text-sm text-white">
            <a href="add_new_topic.php?course_name=<?php echo $coursename ?>">
              Add course
            </a>
          </div>
        </div>
        <div class="my-2">
          <div class="py-2 align-middle px-4">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="divide-y divide-gray-200 min-w-full">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                  <?php

                  $con = mysqli_connect('127.0.0.1', 'uniqueDev', 'uniqueDev');


                  mysqli_select_db($con, 'uniquedeveloper');
                  $q = "select * from courses where course_name='$coursename'";
                  $result = mysqli_query($con, $q);
                  while ($res = mysqli_fetch_array($result)) {
                  ?>

                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="text-sm font-medium text-gray-900"> <?php echo $res['topic_name'] ?> </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500"><textarea rows="3" cols="50" class=""><?php echo html_entity_decode($res['description'], ENT_QUOTES); ?></textarea></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Active </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="update_topic.php?course_id=<?php echo $res['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <a href="verify/verify_delete.php?course_id=<?php echo $res['id'] ?>&amp;course_name=<?php echo $res['course_name']; ?>" class="text-indigo-600 hover:text-indigo-900 ml-2">Delete</a>
                      </td>
                    </tr>

                    <!-- <tr class=" ">
                      <td><?php echo $res['id'] ?></td>

                      <td><?php echo $res['topic_name']; ?></td>

                      <td><textarea rows="3" cols="50" class=""><?php echo html_entity_decode($res['description'], ENT_QUOTES); ?></textarea></td>

                      <td><a class=" no-gutters text-primary" href="update_topic.php?course_id=<?php echo $res['id'] ?>" style="text-decoration: none;">Update<i class="fa fa-pencil-square ml-2" aria-hidden="true"></i></a></td>

                      <td><a class=" no-gutters text-danger" href="verify/verify_delete.php?course_id=<?php echo $res['id'] ?>&amp;course_name=<?php echo $res['course_name']; ?>" style="text-decoration: none;">Delete<i class="fa fa-trash-o ml-2" aria-hidden="true"></a></td>

                    </tr> -->

                  <?php }

                  // echo '<button class="btn btn-primary" id="btn-add"><a href="add_new_topic.php?course_name=' . $coursename . '" class="text-white">Add a new topic</a></button>';

                  ?>

                  <!-- More people... -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>







    </div>
  </div>


  <body>

</html>