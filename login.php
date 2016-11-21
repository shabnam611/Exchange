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

if (isset($_POST['submit'])) { 
$errors = array();


$required_fields = array('username', 'password');
$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

$fields_with_lengths = array('username' => 30, 'password' => 30);
$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

$username = trim(mysql_prep($_POST['username']));
$password = trim(mysql_prep($_POST['password']));

if ( empty($errors) ) {
$query = "SELECT * ";
$query .= "FROM user ";
$query .= "WHERE user_name = '{$username}' ";
$query .= "AND password = '{$password}' ";
$query .= "LIMIT 1";
$result_set = mysql_query($query);
confirm_query($result_set);
if (mysql_num_rows($result_set) == 1) {

$found_user = mysql_fetch_array($result_set);
$_SESSION['user_id'] = $found_user['user_id'];
$_SESSION['username'] = $found_user['user_name'];
$_SESSION['status'] = $found_user['status'];
    redirect_to("index.php");
}
else {

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

<div id="form_area">
    <div id="alert">
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
        <?php if (!empty($errors)) { display_errors($errors); } ?>
    </div>
    <form action="login.php" method="post">
    <table>
        <tr>
            <td>User Name:</td>
            <td><input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input id="inp_btn" type="submit" name="submit" value="Login" /></td>
        </tr>
    </table>
</form>
</div>

<?php include("includes/footer.php");?>