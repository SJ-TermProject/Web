<?
    $connect=mysql_connect( "localhost", "root", "tnqls123") or
        die( "SQL server에 연결할 수 없습니다.");

    mysql_select_db("kdhong_db",$connect);
?>
