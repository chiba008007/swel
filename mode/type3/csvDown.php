<?PHP


require_once("./lib/include_cusCsv.php");

$obj = new cusCsvMethod();


$fname = mb_convert_encoding($a_test_type[$four], 'SJIS-WIN', 'UTF-8') . "_" . date('Y') . date('m') . date('d');
$fileName = $fname . ".csv";



$where['partner_id'] = $ptid;
$where['customer_id'] = $id;
$where['testgrp_id'] = $sec;
$where['test_id'] = $third;
$where['type'] = $four;
if ($five == "anq") {
	$where['type'] = $five;
}

$tlist = $obj->getTestdetail($where);

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $fileName);

switch ($four) {
	case "1":
	case "2":
	case "3":
	case "12":
	case "41":
	case "54":
	case "72":
	case "82":
	case "73":
	case "91":
		include("./mode/type3/csvBA.php");
		break;
	case "92":
		include("./mode/type3/csvWTA.php");
		break;
	case "85":
		include("./mode/type3/csvMHQ.php");
		break;
	case "83":
		include("./mode/type3/csvAMP.php");
		break;
	case "38":
		include("./mode/type3/csvPA.php");
		break;
	case "4":
	case "33":
		include("./mode/type3/csvVF.php");
		break;
	case "7":
		include("./mode/type3/csvEABJ.php");
		break;
	case "5":
		include("./mode/type3/csvEA.php");
		break;
	case "31":
		include("./mode/type3/csvEA2.php");
		break;
	case "6":
	case "37":
		include("./mode/type3/csvSA.php");
		break;
	case "34":
	case "36":
	case "61":
		include("./mode/type3/csvNL.php");
		break;
	case "13":
		include("./mode/type3/csvMATH13.php");
		break;
	case "35":
	case "42":
		include("./mode/type3/csvMATH.php");
		break;
	case "10":
		include("./mode/type3/csvTH.php");
		break;
	case "11":
		include("./mode/type3/csvIQ.php");
		break;
	case "32":
		include("./mode/type3/csvOCS.php");
		break;
	case "39":
		include("./mode/type3/csvSP.php");
		break;
	case "40":
		include("./mode/type3/csvMET.php");
		break;
	case "43":
		include("./mode/type3/csvLCP.php");
		break;
	case "45":
		include("./mode/type3/csvESA.php");
		break;
	case "46":
		include("./mode/type3/csvMMS.php");
		break;
	case "47":
		include("./mode/type3/csvEABJ2.php");
		break;
	case "48":
		include("./mode/type3/csvCRTS.php");
		break;
	case "49":
		include("./mode/type3/csvELAN.php");
		break;
	case "50":
		include("./mode/type3/csvMEA.php");
		break;
	case "51":
		include("./mode/type3/csvBSA.php");
		break;
	case "52":
		include("./mode/type3/csvJUG.php");
		break;
	case "53":
		include("./mode/type3/csvELAN2.php");
	case "69":
		include("./mode/type3/csvELANS.php");
		break;
	case "71":
		include("./mode/type3/csvELANS2.php");
		break;
	case "55":
		include("./mode/type3/csvCBA.php");
		break;
	case "56":
		include("./mode/type3/csvAAC.php");
		break;
	case "57":
		include("./mode/type3/csvAAP.php");
		break;
	case "58":
		include("./mode/type3/csvELAN3.php");
		break;
	case "59":
		include("./mode/type3/csvELAN4.php");
		break;
	case "65":
		include("./mode/type3/csvELAN5.php");
		break;
	case "81":
		include("./mode/type3/csvELAN6.php");
	case "84":
	case "88":
		include("./mode/type3/csvELAN7.php");
		break;
	case "77":
	case "78":
	case "79":
	case "80":
		include("./mode/type3/csvNSPE1.php");
		break;

	case "60":
		if ($_REQUEST['type'] == "boss") {
			include("./mode/type3/csvJUG2.php");
		} else {
			include("./mode/type3/csvJUG2s.php");
		}
		break;
	case "62":
		include("./mode/type3/csvJUG3.php");
		break;

	case "66":
	case "74":
		include("./mode/type3/csvEABJ3.php");
		break;
	case "67":

		include("./mode/type3/csvJug67.php");
		break;
	case "68":
		include("./mode/type3/csvJug68.php");
		break;
	case "86":
		include("./mode/type3/csvJug86.php");
		break;
	case "87":
		include("./mode/type3/csvJug87.php");
		break;
	case "89":
		include("./mode/type3/csvJug89.php");
		break;
	case "90":
		include("./mode/type3/csvJug90.php");
		break;
	case "70":
		include("./mode/type3/csvBAG.php");
		break;
	case "76":
		include("./mode/type3/csvBCO.php");
}
exit();
