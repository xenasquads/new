<?php
//Created with <3 by rzyz gavini
//Netwezeen Revolution
$header = array( 			
    "X-LIBRARY: okhttp+network-api",
    "Authorization: Basic dGhlc2FpbnRzYnY6ZGdDVnlhcXZCeGdN",
    "User-Agent: Booking.App/22.9 Android/10; Type: mobile; AppStore: google; Brand: Xiaomi; Model: Mi A1;",
    "X-Booking-API-Version: 1",
  	);   


function uid() {
		$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://www.uuidgenerator.net/api/guid');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$x = curl_exec($ch);
	curl_close($ch);
	return $x;
}
function add_dot($str){ 
		if ((strlen($str) > 1) && (strlen($str) < 31)) { 
			$ca = preg_split("//",$str); 
			array_shift($ca); 
			array_pop($ca); 
			$head = array_shift($ca); 
			$res = add_dot(join('',$ca)); 
			$result = array(); 
			foreach($res as $val){ 
				$result[] = $head . $val; 
				$result[] = $head . '.' .$val; 
			} 
			return $result; 
		} 
		return array($str); 
	} 


function reg($email, $password, $header, $uid){
$data = json_encode(array(
													"email" => $email,
													"password" => $password,
													"return_auth_token" => 1));		

$url = 'https://mobile-apps.booking.com/json/mobile.createUserAccount?&user_os=10&user_version=22.9-android&device_id='.$uid.'&network_type=4g&languagecode=id&display=normal_xxhdpi&affiliate_id=337852';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$x = curl_exec($ch);
	curl_close($ch);
	
	if(strpos($x, "auth_token")){
	return array($x, $data);
	} else if (strpos($x, "Authentication token is invalid")){
		echo "ERROR CONTACT ADMIN";
	} else if (strpos($x, "USER_ALREADY_EXISTS")) {
			echo "[!] USER DAH AD BANGSAT";
	}
		
	};



function add($token, $header, $uid){

	$hotel = array('3342092','1102392','4984319');

	foreach($hotel as $hotelid) {
	
	$url = 'https://mobile-apps.booking.com/json/mobile.Wishlist?wishlist_action=create_new_wishlist&name=Jakarta&hotel_id='.$hotelid.'&list_dest_id=city%3A%3A-2679652&use_list_details=1&checkin=2020-06-27&checkout=2020-06-28&num_rooms=1&num_adults=2&num_children=0&user_os=8.0.0&user_version=22.9-android&device_id='.$uid.'&network_type=4g&auth_token='.$token.'&languagecode=id&display=normal_xxhdpi&affiliate_id=337862';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$x = curl_exec($ch);
	curl_close($ch);
	$x1 = json_decode($x, 1);
	
	if(strpos($x, "reward_given_wallet")){				
					echo "[!] ".strip_tags($x1["gta_add_three_items_campaign_status"]["modal_body_text"])."\n";
				
					echo "[!] Check for Result on Account.txt\n";
					
	}
	}
}

@@system(clear);
echo "+-NETWEZEN REVOLUTION-+\n";
echo "+-Booking.com-+\n";
echo "[!] CODED BY RZYZ GAVINI [!]\n";
echo "[!] use vpn for get more rewards [!]\n";
sleep(2);
echo "[?] Gmail (ex rzyzgavini@gmail.com ) : ";
$email = trim(fgets(STDIN));
echo "[?] Password : ";
$password = trim(fgets(STDIN));


$user = explode('@', $email);
$res = add_dot($user[0]);
foreach($res as $val) {			
				$fp = fopen($user[0].'.txt', 'a+');
				fwrite($fp, "$val@gmail.com\n");
				fclose($fp);
				
};
				   
$x = file_get_contents($user[0].'.txt');
$xx = explode("\n", $x);



foreach($xx as $email){			
$uid = uid();
echo $email."\n";
				echo "[!] Registering...\n";
				$token = reg($email, $password, $header, $uid);					
				$token1 = json_decode($token[0], 1);
				$result = json_decode($token[1], 1);
				echo '[+] TOKEN : '.$token1["auth_token"].''."\n";
				echo "[!] Proses Klaim..\n";
				echo add($token1["auth_token"], $header, $uid);
				echo "[+] Sukses : ".$email."|".$password."\n";
				echo "[+] CHECK account.txt [!]\n";
				echo "++++++++++++++++++++++++++++++++++++++++++\n";
				$fp = fopen('account.txt', 'a+');
				fwrite($fp, $email."|".$password."\n");
				fclose($fp);
				sleep(3);						
			
}

?>
