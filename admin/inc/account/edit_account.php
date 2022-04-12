<div class="w-1/2 mx-auto shadow-lg rounded-lg p-8">
    <h3 class="text-black text-2xl font-bold">Edit account</h3>
    <div class="mt-4">
        <form method="post" enctype="multipart/form-data" action="inc/controller/account_controller.php">
            <?php
            $account = get_account($_GET['edit_account']);
            ?>

            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
                User name
            </label>
            <input type="text" name="username" id="username" class="form-control mt-1" value="<?php echo $account["username"] ?>" placeholder="Enter username">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                Email
            </label>
            <input type="text" name="email" id="email" class="form-control mt-1" value="<?php echo $account["email"] ?>" placeholder="Enter email">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                Phone
            </label>
            <input type="tel" name="phone" id="email" class="form-control mt-1" value="<?php echo $account["phone"] ?>" placeholder="Enter phone">
            <div class="form-group">
                <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="inline-full-name">
                    Role
                </label>
                <select name="role_id" id="role_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option value="">Select role</option>
                    <?php
                    $roles = select_roles();
                    foreach ($roles as $role) {
                        if ($role['id'] == $account['role_id']) {
                            echo "<option selected='selected' value='" . $role['id'] . "'>" . $role['name'] . "</option>";
                        } else {
                            echo "<option value='" . $role['id'] . "'>" . $role['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                Old Password
            </label>
            <span class="text-xs text-gray-500 italic">Leave blank if you don't want to change password</span>
            <input type="password" name="old_password" id="old_password" class="form-control mt-1">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                New Password
            </label>
            <span class="text-xs text-gray-500 italic">Leave blank if you don't want to change</span>
            <input type="password" name="new_password" id="new_password" class="form-control mt-1">
            <input type="hidden" name="id" value=" <?php echo $_GET['edit_account'] ?>"></input>
            <button type="submit" name="update_account" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                Update account
            </button>
        </form>
    </div>

</div>



<?php echo update_cat(); ?>