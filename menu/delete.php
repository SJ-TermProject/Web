<?php
session_start();

include "../lib/dbconn.php";

$sql="delete from greet where num=$num";
mysql_query($sql, $connect);

mysql_close();

echo("
<script>
locaion.href='list.php';
</script>
");
 ?>