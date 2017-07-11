<?php
	function handling_characters($str) {
		$str = str_replace("@", "", $str);
		$str = str_replace("#", "", $str);
		$str = str_replace("$", "", $str);
		$str = str_replace("%", "", $str);
		$str = str_replace("^", "", $str);
		$str = str_replace("&", "", $str);
		$str = str_replace("*", "", $str);
		$str = str_replace("'", "", $str);
		$str = str_replace('"', '', $str);
		$str = str_replace('!', '', $str);
		$str = str_replace('?', '', $str);
		
		return $str;
	}
	
	function labeling($str) {
		$str = str_replace(" ", "-", strip_tags($str));
		$str = handling_characters($str);
		$str = str_replace('"', '', $str);
		
		$str = substr($str, 0, 100);
		return $str;
	}
	
	function convert_to_nomor($id) {
		$digit = "";
		$nomor = "";
		
		$id = intval($id);
		if($id < 10) {
			$digit = "000000";
		}
		else if($id >= 10 && $id < 99) {
			$digit = "00000";
		}
		else if($id >= 100 && $id < 999) {
			$digit = "0000";
		}	
		else if($id >= 1000 && $id < 9999) {
			$digit = "000";
		}
		else if($id >= 10000 && $id < 99999) {
			$digit = "00";
		}
		else if($id >= 100000 && $id < 999999) {
			$digit = "0";
		}
		else {
			$digit = "";
		}
		
		$nomor = $digit .''. $id;
		
		return $nomor;
	}
	
	function convert_to_star($len) {
		$encryp = "";
		
		for($i=0; $i<$len; $i++) {
			$encryp = $encryp."*";
		}
		
		return $encryp;
	}
	
	function format_rupiah($value) {
		return 'Rp. '. number_format($value, 2);
	}
	
	function pembulatan_rupiah($value) {
		$value = intval($value);
		if(strlen($value) >= 3) {
			$depan = substr($value, 0, (strlen($value) - 3));
			$ratusan = substr($value, (strlen($value) - 3), 3);
			if($ratusan >= 1 && $ratusan < 250) {
				$ratusan = '000';
			}
			else if($ratusan >= 250 && $ratusan < 500) {
				$ratusan = '250';
			}
			else if($ratusan >= 500 && $ratusan < 750) {
				$ratusan = '500';
			}
			else if($ratusan >= 750 && $ratusan < 1000) {
				if(strlen($value) == 3) {
					$depan = substr($value, 0, (strlen($value) - 2));
					$ratusan = substr($value, (strlen($value) - 2), 2);
					
					if($ratusan >= 1 && $ratusan < 50) {
						$ratusan = '00';
					}
					else {
						$ratusan = '50';
					}
				}
				else {
					$depan = substr($value, 0, (strlen($value) - 2));
					$ratusan = substr($value, (strlen($value) - 2), 2);
					
					if($ratusan >= 51 && $ratusan < 100) {
						$ratusan = '50';
					}
					else {
						$ratusan = '00';
					}
					
				}
			}
			
			$value = $depan.''.$ratusan;
		}
		
		return number_format($value, 2);
	}

	function set_userdata($session, $value) {
		$CI =& get_instance();
		$CI->session->set_userdata($session, $value);
	}
	
	function unset_userdata($session) {
		$CI =& get_instance();
		$CI->session->unset_userdata($session);
	}
	
	function set_flashdata($session, $value) {
		$CI =& get_instance();
		$CI->session->set_flashdata($session, $value);
	}
	
	function unset_flashdata($session) {
		$CI =& get_instance();
		$CI->session->unset_flashdata($session);
	}
	
	function last_query() {
		$CI =& get_instance();
		echo $CI->db->last_query();
		die();
	}
	
	function json($arr) {
		$CI =& get_instance();
		
		$response = array('status' => 'OK');

$CI->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
		
		
exit;
		//header('Content-Type: application/json');
		//echo json_encode($arr, TRUE);
		
		die();
	}
	
	function set_json($arr) {
		$CI =& get_instance();
		
		$CI->output->set_header("HTTP/1.0 200 OK");
		$CI->output->set_header("HTTP/1.1 200 OK");
		$CI->output->set_header('Expires: '.gmdate('D, d M Y H:i:s'));
		$CI->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$CI->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$CI->output->set_header("Pragma: no-cache"); 
		
		$CI->output->set_header('Content-Type: application/json'); 
		return json_encode($arr, TRUE);
	}
	
	function comp($a, $b) {
		if ($a['exam_score'] <= $b['exam_score']) {
			if ($a['student_id'] == $b['student_id']) {
				return $b['student_id'] - $a['student_id'];
			}
			
			return strcmp($a['student_id'], $b['student_id']);
		}
		
		return strcmp($a['exam_score'], $b['exam_score']);
	}
	
	function check_directory($path, $folder) {
		if(!is_dir($path)) {
			mkdir($folder, 0777, TRUE);
		}
	}
	
	function check_file($folder, $file, $result) {
		file_put_contents($folder ."/". $file, $result, FILE_USE_INCLUDE_PATH);
	}
	
	function _push_file($path, $name) {
		// make sure it's a file before doing anything!
		if(is_file($path)) {
			// required for IE
			if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }

			// get the file mime type using the file extension
			$CI =& get_instance();
			$CI->load->helper('file');

			$mime = get_mime_by_extension($path);

			// Build the headers to push out the file properly.
			header('Pragma: public');     // required
			header('Expires: 0');         // no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
			header('Cache-Control: private',false);
			header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
			header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.filesize($path)); // provide file size
			header('Connection: close');
			readfile($path); // push it out
			exit();
		}
		echo $path; die();
	}	
	
	function get_available($status, $id) {
		$available = 0;
		$CI =& get_instance();
		
		$mpp = 0;	$actual = 0;	$process_in = 0;	$process_out = 0;
		$manpower = $CI->load->model('m_global')->get_by_id('td_manpower', 'id', $id);
		foreach($manpower as $row) {
			$mpp 		 = $row->mpp;
			$actual 	 = $row->actual;
			$process_in  = $row->process_in;
			$process_out = $row->process_out;
		}
		
		if($status == 1) {
			// set request
			if($actual < $mpp) {
				$temp 		= doubleval($actual) + doubleval($process_in);
				$available 	= doubleval($mpp) - doubleval($temp);	
			}	
		}
		else {
			// set leave
			if($actual > 0) {
				if($process_out != 0) {
					$temp 		= doubleval($actual) - doubleval($process_out);
					if($temp == 0) {
						$available = doubleval($temp);
					}
					else {
						$available 	= doubleval($mpp) - doubleval($temp);
					}
				}
				else {
					$available = doubleval($actual);
				}	
			}	
			
		}
		
		return $available;
	}
	
	function increment_code($count) {
		$str = "000";
		$count = $count + 1;
		$len = strlen($count);
		
		switch($len) {
			case 1 : 
				$result = "00". $count;
			break;
			case 2 : 
				$result = "0". $count;
			break;
			case 3 : 
				$result = $count;
			break;
		}
		
		return $result;
	}
	
	function generate_code($status) {
		$CI =& get_instance();
		
		// cari kode tahun bulan 
		$KT = date('y');
		$KB = date('m');
		
		// cari kode transaksi 
		if($status == 0) {
			$KR = "OUT";
			$preq = $KR.$KT.$KB;
			$count = $CI->load->model('m_global')->count_by_preq('tp_leave', 'leave_id', 'leave_code', $preq);
		}
		else {
			$KR = "RQT";
			$preq = $KR.$KT.$KB;
			$count = $CI->load->model('m_global')->count_by_preq('tp_request', 'request_id', 'request_code', $preq);
		}
		
		$code 	= increment_code($count);
		$result = $preq.$code;
		
		return $result;
	}
?>