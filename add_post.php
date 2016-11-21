<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/admin_header.php"); ?>
</div>
    <?php
    if (!admin_logged_in()) {
    redirect_to("admin.php");
    }
    $sql="SELECT * FROM post WHERE status=0";
    $result=mysql_query($sql,$connection);
    while($row=mysql_fetch_array($result))
    {
        echo $row['post_id']." ".$row['post_description']."<br\>";
        ?>
        <div id="list">
            <form action="action.php" method="post">
                <button id="post_button" type="submit" name="post_id" value=<?php echo $row['post_id']; ?>>Approve</button>
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