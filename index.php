<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/header.php"); ?>   
<div id="post_area">
<?php
    $sql="SELECT * FROM post WHERE status=1 ORDER BY time_stamp DESC ";
    $result=mysql_query($sql,$connection);

    while($row=mysql_fetch_array($result))
    {
        ?>
            <form action="show_post.php" method="post">
            <button id="post" name="post" value=<?php echo $row['post_id'];?>>
                <div id="post-head"><?php echo $row['post_head']."<br \>";?></div>
                <?php
                $query="SELECT * FROM user WHERE user_id='{$row["user_id"]}'";
                $res=mysql_query($query,$connection);
                $find_user=mysql_fetch_array($res);
                ?>
                <div id="post-user"><?php echo " - ".$find_user['user_name']."<br \>";?></div>
                <div id="post-time"><?php echo $row['time_stamp']."<br \>";?></div>
            </button>
        <?php
        echo "<br \>";
    }
?>
</form>
</div>
<?php include("includes/footer.php");?>
