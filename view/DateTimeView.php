<?php
namespace view;

class DateTimeView {

	public function show() {

		$today = getdate();

		$dayOfWeek = $today['weekday'];
		$dayOfMonthNumber = $today['mday'];
		$monthAsText = $today['month'];
		$yearInDigits = $today['year'];
		$currentTime = date('h:i:s'); //using date() insted of getdate() to get leading zero
		
		$timeString = "{$dayOfWeek}, the {$dayOfMonthNumber}th of {$monthAsText} {$yearInDigits}, The time is {$currentTime}";

		return '<p>' . $timeString . '</p>';
	}
}