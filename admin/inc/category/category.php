<div class="">

    <section class="p-6">
        <div class="justify-between items-center block md:flex">
            <div class="flex shrink-0 grow-0 items-center justify-center mb-6 md:mb-0">
                <ul>
                    <li class="title-stack-item inline-block pr-3 text-2xl text-gray-500 dark:text-gray-400 last:pr-0 last:font-black last:text-black dark:text-gray-100" data-v-fecf18ac="">Admin</li>
                    <li class="title-stack-item inline-block pr-3 text-2xl text-gray-500 dark:text-gray-400 last:pr-0 last:font-black last:text-black dark:text-gray-100" data-v-fecf18ac="">Category</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="px-0 md:px-6 py-6">

        <section class="px-6 sm:px-0 mb-6 flex items-center justify-between">
            <div class="flex items-center justify-start"><span class="inline-flex justify-center items-center w-6 h-6 mr-3"><svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                        <path fill="currentColor" d="M11,2V22C5.9,21.5 2,17.2 2,12C2,6.8 5.9,2.5 11,2M13,2V11H22C21.5,6.2 17.8,2.5 13,2M13,13V22C17.7,21.5 21.5,17.8 22,13H13Z" style="--darkreader-inline-fill:currentColor;" data-darkreader-inline-fill=""></path>
                    </svg></span>
                <h1 class="text-2xl">Categories overview</h1>
            </div><button class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded ring-blue-700 p-1 bg-white text-black border-gray-300 hover:bg-gray-50" type="button"><span class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                        <path fill="currentColor" d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z" style="--darkreader-inline-fill:currentColor;" data-darkreader-inline-fill=""></path>
                    </svg></span>
                <!---->
            </button>
        </section>
        <div class="md:rounded border-gray-100 dark:bg-gray-900/70 bg-white border dark:border-gray-800 mb-6">
            <header class="border-gray-100 flex items-stretch border-b dark:border-gray-800">
                <div class="flex items-center py-3 flex-grow font-bold px-4">
                    <details class="w-full">
                        <summary>Add category</summary>
                        <div class="mt-2">
                            <form method="post" enctype="multipart/form-data">
                                <div class="flex items-center">
                                    <input type="text" name="cat_name" class="form-control mr-4" placeholder="Enter category name">
                                    <button name="add_cat" class="px-4 py-2 rounded-full bg-indigo-600 font-bold text-sm text-white w-1/4">Add category</button>
                                </div>
                            </form>
                        </div>
                    </details>
                </div>
            </header>



            <div class="flex flex-col flex-grow mt-4">
                <div class="flex items-center justify-between px-4">
                    <p class="text-2xl font-bold">Manage categories</p>
                </div>
                <div class="my-2">
                    <div class="py-2 align-middle px-4">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="divide-y divide-gray-200 min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    <?php
                                    $i = 1;
                                    $cats = select_categories();

                                    foreach ($cats as $cat) {
                                    ?>

                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900"> <?php echo $cat['name'] ?> </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Active </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="index.php?edit_cat=<?php echo $cat['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <a href="index.php?del_cat=<?php echo $cat['id'] ?>" class="text-red-600 hover:text-red-900 ml-2">Delete</a>
                                            </td>
                                        </tr>

                                    <?php }

                                    ?>

                                    <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>




</div>