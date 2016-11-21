<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/header.php"); ?>

<?php
if(logged_in())
{
    redirect_to("index.php");
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
    $name = trim(mysql_prep($_POST['name']));
    $email = trim(mysql_prep($_POST['email']));
    $contact = trim(mysql_prep($_POST['contact']));

    if ( empty($errors) ) {
        // Check database to see if username and the hashed password exist there.
        $query = "SELECT user_id ";
        $query .= "FROM user ";
        $query .= "WHERE user_name = '{$username}' ";
        $result_set = mysql_query($query);
        confirm_query($result_set);
        if (mysql_num_rows($result_set) == 1) {
        // username/password authenticated
         // and only 1 match
            $message = "Username already exist.<br />
            Please make sure your caps lock key is off and try again.";
        }
        else {
            $query = "SELECT user_id ";
            $query .= "FROM profile ";
            $query .= "WHERE email='{$email}' ";
            $result_set = mysql_query($query);
            confirm_query($result_set);
            if (mysql_num_rows($result_set) != 0) {
        // username/password authenticated
         // and only 1 match
            $message = "Email or Phone Number already exist.<br />
            Please make sure your caps lock key is off and try again.";
            }
            else {
                $query = "INSERT into user (user_name,password,status) values('$username','$password','0')";
                mysql_query($query,$connection);

                $query = "SELECT * ";
                $query .= "FROM user ";
                $query .= "WHERE user_name = '{$username}' ";
                $result_set = mysql_query($query);
                confirm_query($result_set);
                $found_user = mysql_fetch_array($result_set);
                $_SESSION['user_id'] = $found_user['user_id'];
                $_SESSION['username'] = $found_user['user_name'];
                $_SESSION['status'] = $found_user['status'];
                $user_id=$_SESSION['user_id'];
                $query = "INSERT into profile (user_id,name,email,contact) values('$user_id','$name','$email','$contact')";
                mysql_query($query,$connection);

                redirect_to("index.php");
            }

        }
    }
    else {
        if (count($errors) == 1) {
            $message = "There was 1 error in the form.";
        } else {
            $message = "There were " . count($errors) . " errors in the form.";
        }
    }

}

?>
<div id="form_area">
    <div id="alert">
    <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
    <?php if (!empty($errors)) { display_errors($errors); } ?>
    </div>
    <form action="registration.php" method="post">
    <table>
        <tr>
            <td>User Name:</td>
            <td><input required type="text" name="username" maxlength="14" value="<?php echo htmlentities($username); ?>" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input required type="password" name="password" maxlength="14" value="<?php echo htmlentities($password); ?>" /></td>
        </tr>
        <tr>
            <td>Full Name:</td>
            <td><input required type="text" name="name"  value="<?php echo htmlentities($name); ?>" /></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input required type="email" name="email" value="<?php echo htmlentities($email); ?>" /></td>
        </tr>
        <tr>
            <td>Mobile:</td>
            <td><input required name="contact" value="<?php echo htmlentities($contact); ?>" type="tel" pattern="01[156789]{1}[0-9]{8}"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input  id="inp_btn" type="submit" name="submit" value="Sign Up" /></td>
        </tr>
    </table>
</form>
</div>
<?php require_once("includes/footer.php"); ?>
