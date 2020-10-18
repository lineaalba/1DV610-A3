<?php

namespace View;

class DateTimeView {

	public function timeAndDate() {

		date_default_timezone_set('Europe/Stockholm');  
		
		$weekDay = date('l');
		$day = date('jS');
		$monthAndYear = date('F Y');
		$time = date('H:i:s');
		
		return '<p>' . $weekDay . ', the ' . $day . ' of ' . $monthAndYear . ', The time is ' . $time . '</p>';
	}
}