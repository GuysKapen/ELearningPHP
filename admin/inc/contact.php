<div id="body-right">
    <h3>Edit category</h3>
    <form id="contact" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Update contact number</td>
                <td><input type="text" name="contact_no"></td>
            </tr>
            <tr>
                <td>Update email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Update office address 1</td>
                <td><input type="text" name="address_1"></td>
            </tr>
            <tr>
                <td>Update office address 2</td>
                <td><input type="text" name="address_2"></td>
            </tr>
            <tr>
                <td>http://youtube.com/</td>
                <td><input type="text" name="yt"></td>
            </tr>
            <tr>
                <td>http://facebook.com/</td>
                <td><input type="text" name="fb"></td>
            </tr>
            <tr>
                <td>http://plus.google.com</td>
                <td><input type="text" name="gp"></td>
            </tr>
            <tr>
                <td>http://twitter.com/</td>
                <td><input type="text" name="tw"></td>
            </tr>
            <tr>
                <td>http://linkedin.com/</td>
                <td><input type="text" name="ln"></td>
            </tr>
        </table>
        <button name="update_term">Update language</button>
    </form>
</div>

<?php echo update_term(); ?>