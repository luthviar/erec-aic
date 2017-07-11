<?php
	function sending_emailnya($subject, $to, $msg){
		$from = "support.aic@aerofood.co.id";
		
        switch($subject) {
			case 0:
				$subject = "Notification MPP";
			break;
			case 1:
				$subject = "Notification Leave";
			break;
			case 2:
				$subject = "Notification Request";
			break;
		}
		
		$CI =& get_instance();
		 $config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtp.aerowisata.com',
		  'smtp_port' => '587',
		  'smtp_user' => 'smtp@aerofood.co.id', // change it to yours
		  'smtp_pass' => 'aerofoodacs', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'newline' => "\r\n", //use double quotes to comply with RFC 822 standard
		  'smtp_crypto' => 'tls',
		  'validate'  => true,
		  'wordwrap' => TRUE
		);
        
        //load library            
        $CI->load->library('email', $config);
		
        $CI->email->from($from, 'MPP Application');
        $CI->email->subject($subject);    
        $CI->email->message($msg); 
	
		if(count($to) > 1) {
			foreach ($to as $address){
				$CI->email->to($address);
				if($CI->email->send()){
					$status = 1;
				}
				else {
					$status = 0;
				}	
			}
		} 
		else {
			$CI->email->to($to);
			if($CI->email->send()){
				$status = 1;
			}
			else {
				$status = 0;
			}	
		}
			
        //Untuk mendukung coding email, pada php.ini extension=php_openssl.dll harus diaktifkan
		return $status;
    }
?>