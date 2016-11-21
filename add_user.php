<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/admin_header.php"); ?>
</div>
<?php
if (!admin_logged_in()) {
    redirect_to("admin.php");
}
    $sql="SELECT * FROM user WHERE status=0";
    $result=mysql_query($sql,$connection);
    while($row=mysql_fetch_array($result))
    {
        echo $row['user_id']." ".$row['user_name'];
        ?>
        <div id="list">
            <form action="action.php" method="post">
                <button type="submit" name="add_id" value=<?php echo $row['user_id']; ?>>Approve</button>
            </form>
        </div>
        <?php
        echo "<br\>";
    }
?>
<form action="admin_panel.php">
    <button type="submit">Back</button>
</form>
<?php require_once("includes/footer.php"); ?>