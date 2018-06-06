<?


include './lib/dbconn.php';

$sql = "select * from concert";
$result = mysql_query($sql, $connect);
$total_record = mysql_num_rows($result);


	 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<link rel='stylesheet' type='text/css' href='./css/calendar.css'/>
<script type='text/javascript' src='http://www.blueb.co.kr/data/201010/IJ12872423858253/jquery.js'></script>
<script type='text/javascript' src='http://www.blueb.co.kr/data/201010/IJ12872423858253/jquery-ui-custom.js'></script>
<script type='text/javascript' src='http://www.blueb.co.kr/data/201010/IJ12872423858253/fullcalendar.min.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();


		$('#calendar').fullCalendar({

      events: [
          <?php
          for($i=0;$i<$total_record;$i++){
            $row = mysql_fetch_array($result);
          $s_date = explode("-",$row['s_date']);
          $e_date = explode("-",$row['e_date']);

        ?>
        {
          title: '<?=$row['subject']?>',
          start: new Date(<?=$s_date[0]?>,<?=$s_date[1]-1?>,<?=$s_date[2]?>),
          end: new Date(<?=$e_date[0]?>,<?=$e_date[1]-1?>,<?=$e_date[2]?>),
        },
        <?}?>
      ],
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: true,

		});

	});

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>
