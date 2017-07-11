<?php
	function get_his() {
		$date = date("H:i:s");
		return $date;
	}
	
	function get_dmyhis() {
		$date = date("d-m-Y H:i:s");
		return $date;
	}
	function convert_to_gia($date) {
		$date = date("g:i A", strtotime($date));
		return $date;
	}
	function get_dmyhi() {
		$date = date("d-m-Y H:i");
		return $date;
	}
	
	function get_dmy() {
		$date = date("d-m-Y");
		return $date;
	}
	
	function get_mdy() {
		$date = date("m-d-Y");
		return $date;
	}
	
	function get_ymdhis() {
		$date = date("Y-m-d H:i:s");
		return $date;
	}
	
	function get_ymd() {
		$date = date("Y-m-d");
		return $date;
	}
	
	function convert_to_dmyhis($date) {
		$date = date("d-m-Y H:i:s", strtotime($date));
		return $date;
	}
	
	function convert_to_dmyhi($date) {
		$date = date("d-m-Y H:i", strtotime($date));
		return $date;
	}
	
	function convert_to_dmy($date) {
		$date = date("d-m-Y", strtotime($date));
		return $date;
	}
	
	function convert_to_mdy($date) {
		$date = date("m-d-Y", strtotime($date));
		return $date;
	}
	
	function convert_to_ymd($date) {
		$date = date("Y-m-d", strtotime($date));
		return $date;
	}
	
	function convert_to_ymdhis($date) {
		$date = date("Y-m-d H:i:s", strtotime($date));
		return $date;
	}
	
	function convert_to_textual($date) {
		$date = date("d M Y", strtotime($date));
		return $date;
	}
	
	function convert_hour_to_ampm($date) {
		$date = date("h:i A", strtotime($date));
		return $date;
	}
	
	function convert_hour_to_his($date) {
		$date = date("h:i:s", strtotime($date));
		return $date;
	}
	
	function convert_day_to_textual($day) {
		switch($day) {
			case 0 : 
				$day = "Sunday";
			break;
			case 1 : 
				$day = "Monday";
			break;
			case 2 : 
				$day = "Tuesday";
			break;
			case 3 : 
				$day = "Wednesday";
			break;
			case 4 : 
				$day = "Thursday";
			break;
			case 5 : 
				$day = "Friday";
			break;
			case 6 : 
				$day = "Saturday";
			break;
		}
		
		return $day;
	}
	
	function convert_month_to_int($month) {
		switch($month) {
			case "Jan" : 
				$month = "01";
			break;
			case "Feb" : 
				$month = "02";
			break;
			case "Mar" : 
				$month = "03";
			break;
			case "Apr" : 
				$month = "04";
			break;
			case "May" : 
				$month = "05";
			break;
			case "Jun" : 
				$month = "06";
			break;
			case "Jul" : 
				$month = "07";
			break;
			case "Aug" : 
				$month = "08";
			break;
			case "Sep" : 
				$month = "09";
			break;
			case "Oct" : 
				$month = "10";
			break;
			case "Nov" : 
				$month = "11";
			break;
			case "Dec" : 
				$month = "12";
			break;
		}
		
		return $month;
	}
	
	function convert_month_to_string($month) {
		switch($month) {
			case "01" : 
				$month = "Jan";
			break;
			case "02" : 
				$month = "Feb";
			break;
			case "03" : 
				$month = "Mar";
			break;
			case "04" : 
				$month = "Apr";
			break;
			case "05" : 
				$month = "May";
			break;
			case "06" : 
				$month = "Jun";
			break;
			case "07" : 
				$month = "Jul";
			break;
			case "08" : 
				$month = "Aug";
			break;
			case "09" : 
				$month = "Sep";
			break;
			case "10" : 
				$month = "Oct";
			break;
			case "11" : 
				$month = "Nov";
			break;
			case "12" : 
				$month = "Dec";
			break;
			default :
				$month = "";
			break;	
		}
		
		return $month;
	}
	
	function convert_month_to_integer($month) {
		switch($month) {
			case "Jan" : 
				$month = 1;
			break;
			case "Feb" : 
				$month = 2;
			break;
			case "Mar" : 
				$month = 3;
			break;
			case "Apr" : 
				$month = 4;
			break;
			case "May" : 
				$month = 5;
			break;
			case "Jun" : 
				$month = 6;
			break;
			case "Jul" : 
				$month = 7;
			break;
			case "Aug" : 
				$month = 8;
			break;
			case "Sep" : 
				$month = 9;
			break;
			case "Oct" : 
				$month = 10;
			break;
			case "Nov" : 
				$month = 11;
			break;
			case "Dec" : 
				$month = 12;
			break;
		}
		
		return $month;
	}
	
	function convert_to_his($date) {
		$date = date("H:i", strtotime($date));
		$date = $date .":00";
		return $date;
	}
	
	function convert_to_hi($date) {
		$date = date("H:i", strtotime($date));
		return $date;
	}
	
	function next_date($date, $duration) {
		$next_date = date("Y-m-d", strtotime('+ '. $duration . ' Days', strtotime($date)));
		return $next_date;
	}
	
	function next_time($time, $duration) {
		$next_time = date("H:i:s", strtotime('+ '. $duration . ' Hours', strtotime($time)));
		return $next_time;
	}
	
	function prev_date($date, $duration) {
		$next_date = date("Y-m-d", strtotime('- '. $duration . ' Days', strtotime($date)));
		return $next_date;
	}
	
	function prev_time($time, $duration) {
		$next_time = date("H:i:s", strtotime('- '. $duration . ' Hours', strtotime($time)));
		return $next_time;
	}
	
	function combine_date($date, $duration) {
		$duration = $duration - 1;
		$date_combine = date("Y-m-d", strtotime('+ '. $duration . ' Days', strtotime($date)));
		$date_combine = convert_to_dmy($date_combine);
		$date = convert_to_dmy($date);
		return $date .' s/d '. $date_combine;
	}
	
	function combine_time($time, $duration) {
		$time_combine = date("H:i:s", strtotime('+ '. $duration . ' Hours', strtotime($time)));
		$time_combine = convert_to_hi($time_combine);
		$time = convert_to_hi($time);
		return $time .' s/d '. $time_combine;
	}
	
	function minute_to_int($time) {
		$digit_jam = substr($time, 0, 2);
		$digit_mnt = substr($time, 3, 2);
		
		$jml_jam = intval($digit_jam);
		$jml_mnt = intval($digit_mnt);
		
		$jml_jam = $jml_jam * 60;
		$total_waktu = $jml_jam + $jml_mnt;
		return $total_waktu;
	}
	
	function get_date_in_month($status, $month, $year) {
		$date = $year."-".$month."-01";
		$first_day_this_month = date('01-m-Y', strtotime($date));
		$last_day_this_month = date('t-m-Y', strtotime($date));
		
		if($status == 0) {
			return $first_day_this_month;
		}
		else {
			return $last_day_this_month;
		}
	}

	function diff_date($from, $to) {
		$diff =  (strtotime($to)-strtotime($from))/(60*60*24);
		return $diff;
	}
	
	function time_diff($awal, $akhir) {
		$seconds = 0;
		$detik =0;
		$selisih = 0;
		if(strtotime($awal)>strtotime($akhir)){
		$mulai = $akhir;
		$selesai = $awal;
		}else{
		$mulai = $awal;
		$selesai = $akhir;
		}
		list( $g, $i, $s ) = explode( ":", $mulai );
		$seconds += $g * 3600;
		$seconds += $i * 60;
		$seconds += $s;
		$newSeconds = $seconds;

		list( $g, $i, $s ) = explode( ":", $selesai );
		$detik += $g * 3600;
		$detik += $i * 60;
		$detik += $s;
		$detikbaru = $detik;

		$selisih = intval($detikbaru) - intval($newSeconds);

		$jam = floor( $selisih / 3600 );
		$selisih -= $jam * 3600;
		$menit = floor( $selisih / 60 );
		$selisih -= $menit * 60;

		if($jam<10){ $jam='0'.$jam; }
		if($menit<10){ $menit='0'.$menit; }
		if($selisih<10){ $selisih='0'.$selisih; }

		$result = $jam. ":" .$menit. ":" .$selisih;	
		return $result;
	}
	
	function sum_the_time($time1, $time2) {
		$times = array($time1, $time2);
		$seconds = 0;
		foreach ($times as $time) {
			list($hour,$minute,$second) = explode(':', $time);
			$seconds += $hour*3600;
			$seconds += $minute*60;
			$seconds += $second;
		}
		
		$hours = floor($seconds/3600);
		$seconds -= $hours*3600;
		$minutes  = floor($seconds/60);
		$seconds -= $minutes*60;
		
		$result = $hours. ":" .$minutes. ":" .$seconds;
		return $result;
	}
?>