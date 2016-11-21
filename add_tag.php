<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/admin_header.php"); ?>
</div>
<?php
if (!admin_logged_in()) {
    redirect_to("admin.php");
}
?>
    <form action="action.php" method="post">
        <input type="text" name="tag_name">
        <button name="add_tag" type="submit">Add Tag</button>
    </form>
    <form action="admin_panel.php">
        <button type="submit">Back</button>
    </form>
<?php require_once("includes/footer.php"); ?>