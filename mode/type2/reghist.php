<?PHP
//-------------------------------------------
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_method.php");
$obj = new method();
$array_application = array(
						1=>"新規申込"
						,2=>"追加申込"
						);
$array_sts = array(
						0=>"未対応"
						,1=>"対応済"
						);

if($_REQUEST[ 'flg' ] == "get"){
	$where = array();
	$where[ 'pid' ] = $id;
	$hist = getHist($where,$obj->db);
	foreach($hist as $key=>$val){
		$hist[$key][ 'typename' ] = $array_application[ $val[ 'type' ] ];
		$hist[$key][ 'money'    ] = number_format($val[ 'money' ]);
		//typeが2のときは、testnameを利用する
		if($val[ 'type' ] == 2){
			$hist[$key][ 'examname' ] = $val[ 'testname' ];
		}
		$bname = basename($val[ 'pdfname' ]);
		$hist[$key][ 'pdf' ] = "/pdfDownload/order".$val[ 'cid' ]."/".$bname;
	}
	$lists[ 'hist' ] = $hist;
	$lists[ 'array_sts' ] = $array_sts;
	//JSON形式で出力する
    header('Content-Type: application/json');
    echo json_encode( $lists );
	exit();
}
if($_REQUEST[ 'flg' ] == "sts"){
	$edit = array();
	$edit[ 'where' ][ 'id'     ] = $_REQUEST[ 'id' ];
	$edit[ 'edit'  ][ 'status' ] = $_REQUEST[ 'status' ];
	$table = "t_application";
	$db->editUserData($table,$edit);
	
	exit();
}
function getHist($where,$db){
	$sql = "SELECT
				app.*
				,t.name as testname
				,DATE_FORMAT(app.regist_ts, '%Y/%m/%d %H:%i') as create_ts
				,CASE app.status
					WHEN '0' THEN '未対応'
					WHEN '1' THEN '対応済'
				END as strStatus
				,o.pdfname
				,o.money
			FROM
				t_application as app
				LEFT JOIN t_test as t ON app.tid = t.id
				LEFT JOIN t_order as o ON o.application_id = app.id
			WHERE
				app.pid = ".$where[ 'pid' ]."
			";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $i=0;
        while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
            $list[$i] = $rlt;
            $i++;
        }
	return $list;
}




?>