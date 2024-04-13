<?php

class Server { 
	
	function agent() { 

		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown'; 
		$platform = 'Unknown'; 
		$version= "Unknown"; 

		if (preg_match("/ipod/i", $u_agent)) { 
			$platform = "iPod"; 
		} elseif (preg_match('/iphone/i', $u_agent)) { 
			$platform = 'iPhone'; 
		} elseif (preg_match("/ipad/i", $u_agent)) { 
			$platform = "iPad"; 
		} elseif (preg_match("/android/i", $u_agent)) { 
			$platform = "Android"; 
		} elseif (preg_match("/windows phone/i", $u_agent)) { 
			$platform = "Windows Phone"; 
		} elseif (preg_match("/blackberry/i", $u_agent)) { 
			$platform = "BlackBerry"; 
		} elseif (preg_match('/linux/i', $u_agent)) {	 
			$platform = 'Linux'; 
		} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) { 
			$platform = 'Mac'; 
		} elseif (preg_match('/windows|win32/i', $u_agent)) { 
			$platform = 'Windows'; 
		}

		if(preg_match('/Konqueror/i',$u_agent)) { 
			$bname = 'Konqueror'; 
			$ub = 'Konqueror'; 
		} elseif(preg_match('/Dreampassport/i',$u_agent)) { 
			$bname = 'Dreampassport'; 
			$ub = 'Dreampassport'; 
		} elseif(preg_match('/BTRON/i',$u_agent)) { 
			$bname = 'BTRON'; 
			$ub = 'BTRON'; 
		} elseif(preg_match('/iCab/i',$u_agent)) { 
			$bname = 'iCab'; 
			$ub = 'iCab'; 
		} elseif(preg_match('/Sleipnir/i',$u_agent)) { 
			$bname = 'Sleipnir'; 
			$ub = 'Sleipnir'; 
		} elseif(preg_match('/OmniWeb/i',$u_agent)) { 
			$bname = 'OmniWeb'; 
			$ub = 'OmniWeb'; 
		} elseif(preg_match('/amaya/i',$u_agent)) { 
			$bname = 'amaya'; 
			$ub = 'amaya'; 
		} elseif(preg_match('/Opera/i',$u_agent)) { 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} elseif(preg_match('/OPR/i',$u_agent)) { 
			$bname = 'Opera'; 
			$ub = "OPR"; 
		} elseif(preg_match('/Trident/i',$u_agent) && !preg_match('/MSIE/i',$u_agent)) { 
			$bname = 'Internet Explorer'; 
			$ub = "rv"; 
		} elseif(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} elseif(preg_match('/Firefox/i',$u_agent)) { 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} elseif(preg_match('/Chrome/i',$u_agent)) { 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} elseif(preg_match('/Safari/i',$u_agent)) { 
			$bname = 'Safari'; 
			$ub = "Safari"; 
		} elseif(preg_match('/Netscape/i',$u_agent)) { 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 

		$known = array('Version', $ub, 'other'); 
		$pattern = '#(?<browser>' . join('|', $known) .')[/: ]+(?<version>[0-9.|a-zA-Z.]*)#'; 
		if (!preg_match_all($pattern, $u_agent, $matches)) {} 
		$i = count($matches['browser']); 
		if ($i != 1) { 
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){ 
				$version= $matches['version'][0]; 
			} else { 
				$version= $matches['version'][1]; 
			} 
		} else { 
			$version= $matches['version'][0]; 
		} 
		if ($version==null || $version=="") { 
			$version='Unknown'; 
		} 
		
		//IE‚Ìversion‚ÌðŒ’Ç‰Á
		if($bname == 'Internet Explorer' && $version != "11.0"){
			if(preg_match("/Trident\/6\.0/",$u_agent)){
				$version = "10.0";
			}
			if(preg_match("/Trident\/5\.0/",$u_agent)){
				$version = "9.0";
			}
			if(preg_match("/Trident\/4\.0/",$u_agent)){
				$version = "8.0";
			}
			if(!preg_match("/Trident/",$u_agent)){
				$version = "6.0";
			}
		}
		return array( 
			'user_agent' => $u_agent, 
			'name' => $bname, 
			'version' => $version, 
			'platform' => $platform, 
			); 
	 
	} 
}
?>
