<?php
session_start();
include "authMiddleware.php";
include "config.php";
    try {
        $sql = "delete from profiles where id='$_GET[id]'";
        $conn->exec($sql);
    } catch (PDOException $exception) {
        die($exception->getMessage());
    }
    return redirect('profiles.php', true);



 ?>