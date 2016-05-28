<?php
/*
 * © Viktor Evdokimov, viktor_sls@mail.ru
 */

$mounth_mas = array(
                    1 => "Январь",
                    2 => "Февраль",
                    3 => "Март",
                    4 => "Апрель",
                    5 => "Май",
                    6 => "Июнь",
                    7 => "Июль",
                    8 => "Август",
                    9 => "Сентябрь",
                    10 => "Октябрь",
                    11 => "Ноябрь",
                    12 => "Декабрь");

//$corrector_time = 46040;
$current_time = (time() + $corrector_time);

$current_mounth = date("m", $current_time); //текущий месяц

$val_of_days = 31; //дней в текущем месяце. FIXME вынести в отдельную ф-ю, чтоб не пришлось вручную вбивать

$idx = $current_time;
while(date('H', $idx) != 8) {
	$idx += 60;
}
$time_woke_up = $idx;

$sleep_count    = "";
$be_awake_count = "";

if( ($shared_sec = $time_woke_up - $current_time) < 46800) {
	$shared_sec_without_day = $shared_sec - $d1*60*60*24;
	$h1 = (int)($shared_sec_without_day/60/60); //FIXME вынести рассчет в отдельную ф-ю
	$shared_sec_without_day_without_h = ($shared_sec_without_day - $h1*60*60);
	$m1 = (int)($shared_sec_without_day_without_h/60);
	$sleep_count = "<b> $h1:$m1 </b>";
}

if( ($shared_sec -= 32400) > 0) {
	$shared_sec_without_day = $shared_sec - $d1*60*60*24;
	$h1 = (int)($shared_sec_without_day/60/60);
	$shared_sec_without_day_without_h = ($shared_sec_without_day - $h1*60*60);
	$m1 = (int)($shared_sec_without_day_without_h/60);
	$be_awake_count = "<b> $h1:$m1 </b>";
}

?>

Сейчас: <b> <?=date('Y-M-d H:i:s', $current_time)?></b><p>
<h2>Завтра надо проснуться в <?=date('H:i', $time_woke_up)?>
<?php
	if ("" != $sleep_count) {
		echo ", спать осталось: ", $sleep_count;
	}

	if ("" != $be_awake_count) {
		echo "<br>Бодрствовать осталось: ", $be_awake_count;
	}
?>
</h2>

<p>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr align=center>
		<td colspan=40>
			<table border=0 width=100% cellspacing=0 cellpadding=0>
				<tr align=center>
				<?php
				for($idx = 1; $idx < 13; $idx++)
				{
					if($idx == $current_mounth)
					{
						?><td bgcolor="red"><font size="4" color="black"><?=$mounth_mas[$idx]?></font></td><?php
					}
					else
					{
						?><td bgcolor="black"><font color="lightgray"><?=$mounth_mas[$idx]?></font></td><?php
					}
				}
				?>
				</tr>
			</table>
		</td>
	</tr>

	<tr align=center>
	<?php
	$flag = 0;
	for($idx = 1; $idx <= $val_of_days; $idx++)
	{
		if(date('d', $current_time) == $idx)
		{
			$flag = 1;
			?><td bgcolor="red"><font color="black"><?=$idx?></font></td><?php
		}
		else
		{
			if($flag == 0)
			{
				?><td bgcolor="gray"><font color="black"><?=$idx?></font></td><?php
			}
			else
			{
				?><td bgcolor="black"><font color="lightgray"><?=$idx?></font></td><?php
			}
		}
	}
	?>
	</tr>
</table>
<br>

<table width="100%" border="1" cellspacing="0" cellpadding="0" color="white">
	<tr align=center>
	<?php
	$flag = 0;
	for($idx = 0; $idx < 24; $idx++)
	{
		if(date('H', $current_time) == $idx)
		{
			?><td bgcolor="red"><font color="black"><?=$idx?></font></td><?php
			$flag = 1;
		}
		else if($flag == 0)
		{
			?><td bgcolor="gray"><font color="black"><?=$idx?></font></td><?php
		}
		else if( $idx == 23 or $idx == (date('H', $time_woke_up)) )
		{
			?><td bgcolor="lightblue"><font color="black"><?=$idx?></font></td><?php
		}
		else
		{
			?><td bgcolor="black"><font color="lightgray"><?=$idx?></font></td><?php
		}
	}
	
	?>
	</tr>
</table>
<br>

<table width="100%" border="1" cellspacing="0" cellpadding="0" color="white">
	<tr align=center>
	<?php
	$flag = 0;
	for($idx = 0; $idx < 60; $idx++)
	{
		$size = 2;
		if(date('i', $current_time) == $idx)
		{
			$flag = 1;
			$size = 5;
			?><td bgcolor="red"><font size="<?=$size?>" color="black"><?=$idx?></font></td><?php
		}
		else if($flag==0)
		{
			$size=2;
			?><td bgcolor="gray"><font size="<?=$size?>" color="black"><?=$idx?></font></td><?php
		}
		else
		{
			?><td bgcolor="black"><font size="<?=$size?>" color="lightgray"><?=$idx?></font></td><?php
		}
	}
	?>
	</tr>
</table>
<br>


<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr align=center>
	<?php
	$flag = 0;
	
	for($idx = 0; $idx < 60; $idx++)
	{
		$size = 1;
		if(date('s', $current_time) == $idx)
		{
			$flag = 1;
			$size = 4;
			?><td bgcolor="red"><font size="<?=$size?>" color="black"><?=$idx?></font></td><?php
		}
		else if($flag == 0)
		{
			$size = 1;
			?><td bgcolor="gray"><font size="<?=$size?>" color="black"><?=$idx?></font></td><?php
		}
		else
		{
			?><td bgcolor="black"><font size="<?=$size?>" color="lightgray"><?=$idx?></font></td><?php
		}
	}
	?>
	</tr>
</table>
