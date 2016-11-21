<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/header.php"); ?>
<?php
    $post_id=$_POST['post'];
    //echo $post_id;
    $sql="SELECT * FROM post WHERE post_id='$post_id'";

    $result=mysql_query($sql,$connection);
    $row=mysql_fetch_array($result);
    $post_body=$row['post_description'];
    $post_time=$row['time_stamp'];
    $post_head=$row['post_head'];
    $user_id=$row['user_id'];
    $sql="SELECT * FROM user WHERE user_id='$user_id'";
    $result=mysql_query($sql,$connection);
    $row=mysql_fetch_array($result);
    $user_name=$row['user_name'];
    ?>

    <div class="post">
        <div id="heading"><p><?php echo $post_head."<br\>";?></p></div>
        <div id="author"><p>By: <?php echo $user_name."<br\>";?></p></div>
        <div id="post_time"><p><?php echo $post_time."<br\>";?></p></div>
        <div id="post_body"><p><?php echo $post_body."<br\>";?></p></div>
        <div id="contact-area">
            <form action="show_contact.php" method="post">
                <button id="contact_button" value="<?php echo $user_id;?>" type="submit" name="contact">Contact This Person</button>
            </form>
        </div>
    </div>
<?php
?>

<?php include("includes/footer.php");?>