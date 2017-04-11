<?php
    $conn=mysqli_connect("localhost", "gryphon", "123456","project") or die("Failed to connect to MySQL: " . mysqli_connect_error());
    $sql="select * from user";
    $query=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($query);
    $sql2="delete from user where id='$row[id]'";
    mysqli_query($conn,$sql2);
exit();
?>