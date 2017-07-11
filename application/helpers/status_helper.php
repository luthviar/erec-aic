<?php
	function get_status($status) {
		switch($status) {
			case 1 : 
				$status = "Active";
			break;
			case 0 : 
				$status = "Not Active";
			break;
		}
		
		return $status;
	}
	
	function get_yes_no($status) {
		switch($status) {
			case 1 : 
				$status = "Yes";
			break;
			case 0 : 
				$status = "No";
			break;
		}
		
		return $status;
	}
	
	function get_true_false($status) {
		switch($status) {
			case 1 : 
				$status = "True";
			break;
			case 0 : 
				$status = "False";
			break;
		}
		
		return $status;
	}
	
	function get_approved($status) {
		switch($status) {
			case 9 : 
				$status = "On Progress";
			break;
			case 8 : 
				$status = "Processing";
			break;
			case 7 : 
				$status = "Closed";
			break;
			case 6 : 
				$status = "Canceled";
			break;
			case 5 : 
				$status = "Approval Recruitment";
			break;
			case 4 : 
				$status = "Approval 2";
			break;
			case 3 : 
				$status = "Approval 1";
			break;
			case 2 : 
				$status = "Rejected";
			break;
			case 1 : 
				$status = "Approved";
			break;
			case 0 : 
				$status = "Confirmation";
			break;
		}
		
		return $status;
	}
?>