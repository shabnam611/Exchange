<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
if (admin_logged_in()) {
    redirect_to("admin_panel.php");
}
include_once("includes/form_functions.php");

// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $errors = array();

    // perform validations on the form data
    $required_fields = array('username', 'password');
    $errors = array_merge($errors, check_required_fields($required_fields, $_POST));

    $fields_with_lengths = array('username' => 30, 'password' => 30);
    $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

    $username = trim(mysql_prep($_POST['username']));
    $password = trim(mysql_prep($_POST['password']));
    
    if ( empty($errors) ) {
        // Check database to see if username and the hashed password exist there.
        $query = "SELECT *";
        $query .= "FROM admin ";
        $query .= "WHERE admin_name = '{$username}' ";
        $query .= "AND admin_pass = '{$password}' ";
        $query .= "LIMIT 1";
        $result_set = mysql_query($query);
        confirm_query($result_set);
        if (mysql_num_rows($result_set) == 1) {
            // username/password authenticated
            // and only 1 match
            $found_user = mysql_fetch_array($result_set);
            $_SESSION['username'] = $found_user['admin_name'];
            $_SESSION['admin']=1;
            redirect_to("admin_panel.php");
        } else {
            // username/password combo was not found in the database
            $message = "username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
        }
    } else {
        if (count($errors) == 1) {
            $message = "There was 1 error in the form.";
        } else {
            $message = "There were " . count($errors) . " errors in the form.";
        }
    }

}

?>
<?php include("includes/admin_header.php"); ?>
<div id="form_area">
    <div id="alert">
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
        <?php if (!empty($errors)) { display_errors($errors); } ?>
    </div>
    <form action="admin.php" method="post">
        <table>
            <tr>
                <td>User Name:</td>
                <td><input type="text" name="username" maxlength="30"/></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" maxlength="30"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input id="inp_btn" type="submit" name="submit" value="Login" /></td>
            </tr>
        </table>
    </form>
</div>
<?php include("includes/footer.php");?>
