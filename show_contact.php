<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/header.php"); ?>
</div>
<?php
if(isset($_POST['contact']))
{
if(logged_in())
{
    $user_id=$_POST['contact'];
    $sql="SELECT * FROM profile WHERE user_id='$user_id'";
    $result=mysql_query($sql,$connection);
    $row=mysql_fetch_array($result);
    ?>
    <div id="contact">
    	Contact Number: <?php echo $row['contact']; ?>
    </div>
    <?php
}
else
{
    redirect_to("login.php");
}
}
?>

<?php include("includes/footer.php");?>