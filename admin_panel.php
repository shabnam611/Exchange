<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/admin_header.php"); ?>
<?php

if (!admin_logged_in()) {
    redirect_to("admin.php");
}
?>
<div id="admin_panel">
	<form action="add_user.php">
    <button type="submit">Add User</button>
</form>
<form action="add_post.php">
    <button type="submit">Add Post</button></form>
<form action="add_tag.php">
    <button type="submit">Add Tag</button>
</form>
</div>
<?php require_once("includes/footer.php"); ?>