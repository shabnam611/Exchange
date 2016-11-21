<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
    //echo $_POST['add_tag'];
    if(isset($_POST['add_id']))
    {
        $sql="UPDATE user SET status='1' WHERE user_id='{$_POST["add_id"]}'";
        mysql_query($sql,$connection);
        redirect_to("add_user.php");
    }
    if(isset($_POST['post_id']))
    {
        $sql="UPDATE post SET status='1' WHERE post_id='{$_POST["post_id"]}'";
        mysql_query($sql,$connection);
        redirect_to("add_post.php");
    }
    if(isset($_POST['add_tag']))
    {

        $sql="INSERT INTO tag (tag_name) VALUES('{$_POST["tag_name"]}')";
        mysql_query($sql,$connection);
        redirect_to("add_tag.php");
    }
?>