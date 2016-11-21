<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/header.php"); ?>
<?php

if(!logged_in())
{
    redirect_to("login.php");
}
?>
</div>
<div id="post_form">
    <form action="medium.php" method="post">
        <h3>Headline</h3>
        <input required id="headline" type="text" name="post_head">
        <br \>
        <h3>Post Description</h3>
        <textarea required name="post_body"></textarea>
        <br \>
        <select name="tag">
            <?php
            $sql="SELECT * FROM tag";
            $result=mysql_query($sql,$connection);
            while($row=mysql_fetch_array($result))
            {
                ?>
                <option value=<?php echo $row['tag_id'];?>><?php echo $row['tag_name'];?></option>
            <?php
            }
            ?>
        </select>
        <button id="post_button" name="add_post" type="submit">Post</button>
    </form>
</div>

<?php include("includes/footer.php");?>