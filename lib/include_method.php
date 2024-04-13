<?PHP
class method
{
	public function __construct()
	{

		$password = MOBILE_PASS;
		if($_REQUEST[ 'errorQuery' ]){
			$password = $password+"test";
		}
		try {
			
			$pdo = new PDO("mysql:host=" . MOBILE_DSN . ";dbname=" . DB_NAME . ";charset=utf8;", MOBILE_USR, $password);
		} catch ( Exception $ex ) {
//			var_dump($_SESSION[ 'visit' ]);

if ($_SESSION[ 'errorCount' ] <= 1) {
    
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $to = "info@innovation-gate.jp";
    $title = "DB接続エラー";

    $content = "データベースの接続エラー
受検者ID : ".$_SESSION[ 'visit' ][ 'exam_id' ]."
TEST_ID : ".$_SESSION[ 'visit' ][ 'test_id' ]."
TESTPAPER_ID : ".$_SESSION[ 'visit' ][ 'login_id' ]."
			";

  mb_send_mail($to, $title, $content);
}
$_SESSION[ 'errorCount' ] = $_SESSION[ 'errorCount' ]+1 ;
$loginmsg = "お手数をお掛けしますが、「リロード」ボタンを押し、再度更新してください。
";
if ($_SESSION[ 'errorCount' ] >= 5) {
  	$loginmsg = "お手数ですが、しばらく時間を置いてから、<br />再度受検していただけますようお願いいたします。";
    $login = "<a href='/?k=".$_REQUEST[ 'k' ]."' class='button'>ログイン画面に戻る</a>";
}
			$html = "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<LINK rel='stylesheet' href='".D_URLS."/css/test/base.css' type='text/css'>
</head>
<body>
<div style='text-align:center;'>
<p style='font-size:18px;'>
受検が集中しており、回答が登録できませんでした。
<br />
<br />


<br />
".$loginmsg."
</p>
<div style='margin-top:20px;cursor:pointer'>
<a class='button' onclick=\"window.location.reload(true);\" >リロード</a>
".$login."
</div>
</div>
</body>
</html>
			";
			echo $html;
			exit();
		}
		/*
            $dbobj = DB::connect(DEFAULT_DSN);
            var_dump($dbobj);
            if (DB::isError($dbobj)) {
              exit($dbobj->getMessage());
            }
            $dbobj->query('SET NAMES utf8');
            if (PEAR::isError($dbobj)) {
                die($dbobj->getMessage());
            }
             * 
             */


		$_SESSION[ 'errorCount' ] = 0;
		$this->db = $pdo;
	}
	public function logincheck()
	{
		
		$sql = "SELECT "
			. " * "
			. " FROM "
			. " t_user "
			. " WHERE "
			. " login_id='" . filter_input(INPUT_POST, 'username') . "' AND "
			. " login_pw='" . filter_input(INPUT_POST, 'password') . "' AND customer_display=1 ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$ipcheck = $result['ipcheck'];
		// ipcheckがあるときはチェックを行う
		if (strlen($ipcheck) > 5) {
			$permission = explode("\n", $ipcheck);
			$ip = $_SERVER["REMOTE_ADDR"];
			if (!in_array($ip, $permission)) {
				return false;
			}
		}
		if ($result) :
			$set = [];
			$set['company_name'] = $result['name'];
			$set['worktext'] = "ログイン";
			$this->setUserData("log", $set);
			foreach ($result as $key => $val) {
				$_SESSION[$key] = $val;
			}
		endif;
		return $result;
	}
	function getTest($where)
	{
		$sql = "
			SELECT 
				*
			FROM 
				t_test
			WHERE 
				id=" . $where['id'] . "
		";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$rlt3 = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt3;
	}
	function getParentData($data)
	{
		$id = $data['id'];
		$sql = "";
		$sql = "SELECT partner_id from t_user ";
		$sql .= " WHERE ";
		$sql .= " id=" . $id . " AND ";
		$sql .= " del=0 AND ";
		$sql .= " type=3 AND ";
		$sql .= " 1=1 ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$rlt3 = $stmt->fetch(PDO::FETCH_ASSOC);

		$sql = "";
		$sql = "SELECT * from t_user ";
		$sql .= " WHERE ";
		$sql .= " id=" . $rlt3['partner_id'] . " AND ";
		$sql .= " del=0 AND ";
		$sql .= " type=2 AND ";
		$sql .= " 1=1 ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);



		return $rlt2;
	}

	//--------------------------------------
	//ユーザーデータ取得CRON用
	//--------------------------------------
	public function getAfterSend($where)
	{
		$sendDate = $where['sendDate'];
		$sql = "
				SELECT 
					u.*
					,u2.name as cname
					,u2.rep_email  as crep_email 
					,u2.rep_name  as crep_name 
				FROM 
					t_afterSend as tas
					LEFT JOIN 
						(SELECT name as name,rep_name,rep_email,partner_id,login_id,login_pw FROM t_user ) as u 
							ON u.partner_id = tas.partner_id 
							AND u.login_id = tas.login_id
							AND u.login_pw = tas.login_pw
					LEFT JOIN (SELECT id, name,rep_email,rep_name  FROM t_user ) as u2 ON u2.id = tas.partner_id
					WHERE
						tas.send_date = '" . $sendDate . "' AND
						tas.status = 0 
				";

		$r = mysql_query($sql);
		$i = 0;
		while ($rlt = mysql_fetch_assoc($r)) {
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}
	//--------------------------------------
	//管理者データ取得
	//--------------------------------------
	public function getAdminUserSuper()
	{
		$sql = "SELECT "
			. " * "
			. " FROM "
			. " t_user "
			. " WHERE "
			. " type = 1 AND "
			. " super = 1";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}

	public function getAdminUser()
	{
		$sql = "SELECT "
			. " * "
			. " FROM "
			. " t_user "
			. " WHERE "
			. " type = 1 AND "
			. " super = 0";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}


	//--------------------------------------
	//ユーザーデータ取得
	//--------------------------------------
	public function getUser($where)
	{
		$id = $where['id'];

		$sql = "";
		$sql .= "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=" . $id . " AND ";
		$sql .= " 1=1 ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}

	//------------------------------------
	//データ削除
	//------------------------------------
	public function deleteUserData($table, $data)
	{
		if (count($data['where'])) {
			foreach ($data['where'] as $k => $v) {
				if (is_numeric($v)) {
					$where .= $k . "=" . $v . " AND ";
				} else {
					$where .= $k . "= '" . $v . "' AND ";
				}
			}
			$sql = "";
			$sql = " DELETE FROM  " . $table . " ";
			$sql .= " WHERE ";
			$sql .= $where;
			$sql .= " 1=1 ";
			$stmt = $this->db->prepare($sql);
			$r = $stmt->execute();

			return $r;
		}
	}

	//------------------------------------
	//データ修正
	//------------------------------------
	public function editUserData($table, $data)
	{

		foreach ($data['edit'] as $k => $v) {
			$edit .= "," . $k . "='" . $v . "'";
		}
		$edit = preg_replace("/^,/", "", $edit);
		foreach ($data['where'] as $k => $v) {
			$where .= $k . "='" . $v . "' AND ";
		}
		$sql = "";
		$sql = " UPDATE " . $table . " SET ";
		$sql .= $edit;
		$sql .= " WHERE ";
		$sql .= $where;
		$sql .= " 1=1 ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return true;
	}
	//-----------------------------------------------
	//データ登録
	//-----------------------------------------------
	public function setUserData($table, $data)
	{

		foreach ($data as $key => $val) {
			$calum .= "," . $key;
			$value .= ",'" . $val . "'";
		}
		$calum = preg_replace("/^,/", "", $calum);
		$value = preg_replace("/^,/", "", $value);
		$sql = "";
		$sql = "INSERT INTO " . $table . " (";
		$sql .= $calum;
		$sql .= ") VALUES (";
		$sql .= $value;
		$sql .= ")";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$this->lastid = $this->db->lastInsertId();
		return true;
		/*
		$r = mysql_query($sql);
		if($r){
			return true;
		}else{
			return false;
		}
                 * 
                 */
	}

	public function getLoginCheckMAX($where)
	{
		$sql = "
			SELECT 
				MAX(accessdate) as accessdate
				FROM 
				logincheck
				WHERE
					ip = :ip AND 
					status = :status AND 
					page = :page
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':ip', $where['ip']);
		$stmt->bindValue(':status', $where['status']);
		$stmt->bindValue(':page', $where['page']);
		$stmt->execute();

		$i = 0;
		$list = [];
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}

	public function getLoginCheck($where)
	{
		$sql = "
			SELECT 
				*
				FROM 
				logincheck
				WHERE
					ip = :ip AND 
					status = :status AND 
					page = :page
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':ip', $where['ip']);
		$stmt->bindValue(':status', $where['status']);
		$stmt->bindValue(':page', $where['page']);
		$stmt->execute();

		$i = 0;
		$list = [];
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}
	public function editLoginCheckMAX($where)
	{
		$sql = "
			SELECT 
				*,
				count(*) as cnt 
				FROM 
				logincheck
				WHERE
					ip = :ip AND 
					status = :status AND 
					page = :page
			ORDER BY id DESC
		";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':ip', $where['ip']);
		$stmt->bindValue(':status', $where['status']);
		$stmt->bindValue(':page', $where['page']);
		$stmt->execute();

		$rlt = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($rlt['cnt'] >= 5) {
			$five = date("Y-m-d H:i:s", strtotime("-5 minute"));

			if ($rlt['accessdate'] <= $five) {
				$edit = [];
				$edit['where']['ip'] = $where['ip'];
				$edit['edit']['status'] = 3;
				$this->editUserData("logincheck", $edit);
			}
		}
	}
	//-----------------------------------------------
	//メール配信処理
	//登録内容
	//
	//
	//
	//-----------------------------------------------
	public function sendMailer($data, $bcc = "")
	{
		$subject = $data['subject'];
		$to      = $data['to'];
		$body    = $data['body'];
		$pwd     = $data['login_pw'];
		mb_language("japanese");
		mb_internal_encoding("UTF-8");

		$from = D_FROM_MAIL;
		if ($bcc) {
			$from .= ";\nBcc: " . $bcc . ";";
		}
		if ($to) {
			mb_send_mail($to, $subject, $body, "From:" . $from);
		}
	}

	public function get_age($birth)
	{
		$ty = date("Y");
		$tm = date("m");
		$td = date("d");
		list($by, $bm, $bd) = explode('/', $birth);
		$age = $ty - $by;
		if ($tm * 100 + $td < $bm * 100 + $bd) $age--;
		return $age;
	}



	//ストレスデータ取得
	public function getStress($dev1, $dev2)
	{
		$ave = ($dev1 + $dev2) / 2;
		$roundedAve = round($ave, 1);
		if ($ave < 30) {
			$st_level = 1;
			$st_score = $roundedAve;
		} else if ($ave < 35) {
			if ($dev1 < 40 && $dev2 < 40) {
				$st_level = 1;
				$st_score = $roundedAve;
			} else {
				$st_level = 2;
				$st_score = 35;
			}
		} else if ($ave < 40) {
			if ($dev1 < 40 && $dev2 < 40) {
				$st_level = 1;
				$st_score = 34.9;
			} else if ($dev1 < 30 || $dev2 < 30) {
				$st_level = 2;
				$st_score = $roundedAve;
			} else {
				$st_level = 3;
				$st_score = 45;
			}
		} else if ($ave < 45) {
			if ($dev1 < 30 || $dev2 < 30) {
				$st_level = 2;
				$st_score = $roundedAve;
			} else if ($dev1 < 50 && $dev2 < 50) {
				$st_level = 3;
				$st_score = 45;
			} else {
				$st_level = 4;
				$st_score = 55;
			}
		} else if ($ave < 50) {
			if ($dev1 < 30 || $dev2 < 30) {
				$st_level = 2;
				$st_score = 44.9;
			} else if ($dev1 < 50 && $dev2 < 50) {
				$st_level = 3;
				$st_score = $roundedAve;
			} else {
				$st_level = 4;
				$st_score = 55;
			}
		} else if ($ave < 55) {
			if ($dev1 < 30 || $dev2 < 30) {
				$st_level = 2;
				$st_score = 44.9;
			} else {
				$st_level = 4;
				$st_score = 55;
			}
		} else if ($ave < 60) {
			if ($dev1 < 50 || $dev2 < 50) {
				$st_level = 4;
				$st_score = $roundedAve;
			} else if ($dev1 < 60 && $dev2 < 60) {
				$st_level = 4;
				$st_score = $roundedAve;
			} else {
				$st_level = 5;
				$st_score = 65;
			}
		} else if ($ave < 65) {
			if ($dev1 < 50 || $dev2 < 50) {
				$st_level = 4;
				$st_score = $roundedAve;
			} else {
				$st_level = 5;
				$st_score = 65;
			}
		} else {
			$st_level = 5;
			$st_score = $roundedAve;
		}
		return array($st_level, $st_score);
	}


	//ストレスデータ取得
	public function getStress2($dev1, $dev2, $dev3)
	{

		$dev1 = sprintf("%s", ($dev1 >= 70) ? 60 : $dev1);
		$dev2 = sprintf("%s", ($dev2 >= 70) ? 60 : $dev2);
		$dev3 = sprintf("%s", ($dev3 >= 70) ? 60 : $dev3);

		$dev1 = sprintf("%s", ($dev1 <= 35.21) ? 20 : $dev1);
		$dev2 = sprintf("%s", ($dev2 <= 35.21) ? 20 : $dev2);
		$dev3 = sprintf("%s", ($dev3 <= 35.21) ? 20 : $dev3);

		//ポジティブ思考力スコア反転
		$dev3 = 100 - $dev3;

		$ave = ($dev1 + $dev2 + $dev3) / 3;
		$st_score = round($ave, 1);
		if ($ave >= 64.79) {
			$st_level = 5;
		} elseif ($ave >= 54.49) {
			$st_level = 4;
		} elseif ($ave >= 45.3) {
			$st_level = 3;
		} elseif ($ave >= 35) {
			$st_level = 2;
		} else {
			$st_level = 1;
		}

		return array($st_level, $st_score);
	}



	//ランダムな英数字

	public function getRandomStringDir($nLengthRequired = 5)
	{
		/*
		$sCharList = "abcdefghijklmnopqrstuvwxyz0123456789";
		mt_srand();
		$sRes = "";
		for ($i = 0; $i < $nLengthRequired; $i++)
			$sRes .= $sCharList(
				mt_rand(0, strlen($sCharList) - 1));
		*/
		$sRes = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 5);
		return $sRes;
	}

	public function getRandomString($nLengthRequired = 3)
	{
		/*
		$sCharList = "abcdefghijklmnopqrstuvwxyz1234567890";
		mt_srand();
		$sRes = "";
		for ($i = 0; $i < $nLengthRequired; $i++)
			$sRes .= $sCharList(
				mt_rand(0, strlen($sCharList) - 1));

		return $sRes;
*/
		$sRes = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 3);
		return $sRes;
	}

	function getMasterData($data)
	{
		$id = $data['id'];
		$sql = "";
		$sql = "SELECT partner_id from t_user ";
		$sql .= " WHERE ";
		$sql .= " id=" . $id . " AND ";
		$sql .= " del=0 AND ";
		$sql .= " type=3 AND ";
		$sql .= " 1=1 ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$rlt3 = $stmt->fetch(PDO::FETCH_ASSOC);

		$sql = "";
		$sql = "SELECT eir_id from t_user ";
		$sql .= " WHERE ";
		$sql .= " id=" . $rlt3['partner_id'] . " AND ";
		$sql .= " del=0 AND ";
		$sql .= " type=2 AND ";
		$sql .= " 1=1 ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);

		$sql = "";
		$sql = "SELECT * from t_user ";
		$sql .= " WHERE ";
		$sql .= " id=" . $rlt2['eir_id'] . " AND ";
		$sql .= " del=0 AND ";
		$sql .= " type=1 AND ";
		$sql .= " 1=1 ";


		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$rlt = $stmt->fetch(PDO::FETCH_ASSOC);


		return $rlt;
	}


	function fgetcsv_reg(&$handle, $length = null, $d = ',', $e = '"')
	{
		$d = preg_quote($d);
		$e = preg_quote($e);
		$_line = "";
		while ($eof != true) {
			$_line .= (empty($length) ? fgets($handle) : fgets($handle, $length));
			$itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);
			if ($itemcnt % 2 == 0) $eof = true;
		}
		$_csv_line = preg_replace('/(?:\\r\\n|[\\r\\n])?$/', $d, trim($_line));
		$_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:' . $e . $e . '[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';
		preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
		$_csv_data = $_csv_matches[1];
		for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++) {
			$_csv_data[$_csv_i] = preg_replace('/^' . $e . '(.*)' . $e . '$/s', '$1', $_csv_data[$_csv_i]);
			$_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);
		}
		return empty($_line) ? false : $_csv_data;
	}

	//---------------------------
	//画像の真偽の確認
	//----------------------------
	function is_img($file)
	{
		if (!(file_exists($file) && ($type = exif_imagetype($file)))) return false;

		switch ($type) {
			case IMAGETYPE_GIF:
				return 'gif';
			case IMAGETYPE_JPEG:
				return 'jpg';
			case IMAGETYPE_PNG:
				return 'png';
			default:
				return false;
		}
	}

	//---------------------------
	//重みデータ取得
	//----------------------------
	function getWeights($where)
	{
		$test_id     = $where['test_id'];
		$type        = $where['type'];
		$partner_id  = $where['partner_id'];
		$customer_id = $where['customer_id'];

		$sql = "";
		$sql = "SELECT ";
		$sql .= " id,";
		$sql .= " w1,";
		$sql .= " w2,";
		$sql .= " w3,";
		$sql .= " w4,";
		$sql .= " w5,";
		$sql .= " w6,";
		$sql .= " w7,";
		$sql .= " w8,";
		$sql .= " w9,";
		$sql .= " w10,";
		$sql .= " w11,";
		$sql .= " w12";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=" . $test_id . " AND ";
		$sql .= " type=" . $type . " AND ";
		$sql .= " partner_id=" . $partner_id . " AND ";
		$sql .= " customer_id=" . $customer_id . " AND ";
		$sql .= " 1=1 ";
		$r = mysql_query($sql);
		$rlt = mysql_fetch_assoc($r);
		return $rlt;
	}


	//---------------------------
	//携帯電話判定
	//----------------------------
	function mobile_redirect()
	{

		// 切り替え用URLです。falseにすれば対象を除外できます。
		$docomo = true;  // ドコモ
		$au     = true; // au
		$sb     = true; // SoftBank
		$sp     = true; // スマートフォン
		$mobile = true;  // モバイル端末

		$ua = $_SERVER['HTTP_USER_AGENT'];
		// ドコモ
		if (preg_match('/^DoCoMo/', $ua)) {
			$mobileredirect = $docomo;
			$this->ag = "docomo";
			// au
		} elseif (preg_match('/^KDDI-|^UP\.Browser/', $ua)) {
			$mobileredirect = $au;
			$this->ag = "au";
			// SoftBank
		} elseif (preg_match('#^J-(PHONE|EMULATOR)/|^(Vodafone/|MOT(EMULATOR)?-[CV]|SoftBank/|[VS]emulator/)#', $ua)) {
			$mobileredirect = $sb;
			$this->ag = "SoftBank";
			// Willcom
		} elseif (preg_match('/(DDIPOCKET|WILLCOM);/', $ua)) {
			$mobileredirect = $willcom;
			$this->ag = "willcom";
			// e-mobile
		} elseif (preg_match('#^(emobile|Huawei|IAC)/#', $ua)) {
			$mobileredirect = $em;
			// スマートフォン
		} elseif (preg_match('#\b(iP(hone|od);|Android )|dream|blackberry9500|blackberry9530|blackberry9520|blackberry9550|blackberry9800|CUPCAKE|webOS|incognito|webmate#', $ua)) {
			$mobileredirect = $sp;
			// モバイル端末
		} elseif (preg_match('#(^Nokia\w+|^BlackBerry[0-9a-z]+/|^SAMSUNG\b|Opera Mini|Opera Mobi|PalmOS\b|Windows CE\b)#', $ua)) {
			$mobileredirect = $mobile;
			$this->ag = "other";
			// PC	
		} else {
			$mobileredirect = false;
		}
		return $mobileredirect;
	}

	function mb_wordwrap($string, $width = 75, $break = "\n", $cut = false)
	{
		if (!$cut) {
			$regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){' . $width . ',}\b#U';
		} else {
			$regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){' . $width . '}#';
		}
		$string_length = mb_strlen($string, 'UTF-8');
		$cut_length = ceil($string_length / $width);
		$i = 1;
		$return = '';
		while ($i < $cut_length) {
			preg_match($regexp, $string, $matches);
			$new_string = $matches[0];
			$return .= $new_string . $break;
			$string = substr($string, strlen($new_string));
			$i++;
		}
		return $return . $string;
	}


	function mb_str_split($str, $split_len = 1)
	{

		mb_internal_encoding('UTF-8');
		mb_regex_encoding('UTF-8');

		if ($split_len <= 0) {
			$split_len = 1;
		}

		$strlen = mb_strlen($str, 'UTF-8');
		$ret    = array();

		for ($i = 0; $i < $strlen; $i += $split_len) {
			$ret[] = mb_substr($str, $i, $split_len);
		}
		return $ret;
	}
}
