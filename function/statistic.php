<?
	$counter_mysql=0;
	$timer_mysql=0;
	$timer=microtime (true);
	

	function count_query($query) 
	{
		global $counter_mysql;
		global $timer_mysql;

		$counter_mysql++;
		$start=microtime (true);
		mysql_query("SET CHARSET cp1251");
		$result=mysql_query($query);
		$timer_mysql+=microtime (true)-$start;
		return $result;
	}


	function result() 
	{
		global $counter_mysql;
		global $timer_mysql;
		global $timer;

		$now=microtime (true)- $timer;
		echo "����� ���������� �������: ".round($now,4)."<br>";
		echo "���������� �������� � ��: ".$counter_mysql."<br>";
		echo "����� �������� � ��: ".round($timer_mysql,4)."<br>";
		if ( function_exists('memory_get_usage') )
		{
			echo ' ����������� ������: ' . round(memory_get_usage()/1024/1024, 2) . 'MB ';
		}
		if ( function_exists('memory_get_peak_usage') )
		{
			echo '<br>������� ����������� ������: ' . round(memory_get_peak_usage()/1024/1024, 2) . 'MB ';
		}

	}
?>