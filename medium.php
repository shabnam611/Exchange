<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/header.php"); ?>

<?php
    if(isset($_POST['add_post']))
    {
        $tag_id=$_POST['tag'];
        $post_body=$_POST['post_body'];
        $user_id=$_SESSION['user_id'];
        $post_head=$_POST['post_head'];
        $sql="INSERT INTO post (user_id,post_description,status,tag,post_head) VALUES('$user_id','$post_body','0','$tag_id','$post_head')";
        mysql_query($sql,$connection);
        redirect_to('index.php');
    }
?>

<?php include("includes/footer.php");?>