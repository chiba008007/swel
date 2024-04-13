<?PHP
//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusSearch.php");

$obj = new cusSearchMethod();

if($_REQUEST[ 'lists' ]){
	$limit = 50;

	$where[ 'partner_id'  ] = $ptid;
	$where[ 'customer_id' ] = $id;
	$where[ 'exam_id'     ] = $_REQUEST[ 'exam_id' ];
	$where[ 'kana'        ] = $_REQUEST[ 'kana'    ];
	$where[ 'from'        ] = $_REQUEST[ 'from'    ];
	$where[ 'to'          ] = $_REQUEST[ 'to'      ];
	$where[ 'memo1'       ] = $_REQUEST[ 'memo1'      ];
	$where[ 'memo2'       ] = $_REQUEST[ 'memo2'      ];
	$where[ 'exam_state'] = $_REQUEST[ 'exam_state' ];
	
	$where[ 'limit'       ] = $limit;
	$where[ 'offset'      ] = $limit*(int)$_REQUEST[ 'pages' ];
	$list = $obj->getTestData($where);
	$row = $obj->row;
	$ceil = ceil($row/$limit);

	$i=1;
	if($list && count($list)){
		foreach($list as $key=>$val){
			$no = $i;
			$html .= "<tr>";
			$html .= "<td>".$no."</td>";
			$html .= "<td>".$val[ 'exam_id'   ]."</td>\n";
			$html .= "<td>".$val[ 'name'      ]."</td>\n";
			$html .= "<td>".$val[ 'kana'      ]."</td>\n";
			$html .= "<td>".$val[ 'birth'     ]."</td>\n";
			$html .= "<td><a href='/index/data/".$val[ 'test_id' ]."/0'>".$val[ 'testname'  ]."</a></td>\n";
			if($val['exam_state'] == 2 ){
				$html .= "<td>".$val[ 'exam_date' ]."</td>\n";
			}else{
				$html .= "<td>受検中</td>\n";

			}
			
			$html .= "<td>".$val[ 'memo1' ]."</td>\n";
			$html .= "<td>".$val[ 'memo2' ]."</td>\n";
			
			
			$html .= "</tr>";
			$i++;
		}
		$page = "<ul id='pageCnt' >\n";
		$start = $_REQUEST[ 'pages' ]+1;
		$end   = $_REQUEST[ 'pages' ]+5;
		if($end > $ceil){
			$end = $ceil;
		}
		$page .= "<li>[<a href='/index/search/0/'><<</a>]</li>\n";
		for($i=$start;$i<=$end;$i++){
			$no = $i-1;
			$page .= "<li>[<a href='/index/search/".$no."'>".$i."</a>]</li>\n";
		}
		$endCnt = $ceil-1;
		$page .= "<li>[<a href='/index/search/".$endCnt."/'>>></a>]</li>\n";
		$page .= "</ul>";

		echo $html."_".$page;
	}else{
		echo "";
	}
	exit();
}
?>