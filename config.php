<?php
//As MySQL is depreciating. So, I would prefer to use MySQLi
    $dbcon = mysqli_connect("localhost","root","root","calendar") or die(mysqli_error($dbcon));

?>