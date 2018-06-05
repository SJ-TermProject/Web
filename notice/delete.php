<?php
session_start();
extract($_POST);
   extract($_GET);
   extract($_SESSION);
$table="greet";

include "../lib/dbconn.php";

$sql="delete from $table where num=$num";
mysql_query($sql, $connect);


mysql_close();

echo("
<script>
location.href='list.php';
</script>
");
 ?>
