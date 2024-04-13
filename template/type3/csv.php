<?PHP
$css1 = "csv";
$title = "AMS:CSVダウンロード画面";
$js = array("del");
//$time = true;

include_once("include_header.php");
?>

<div id="main">

	<div id="contents">
		<div id="dataTitle">CSVダウンロード</div>
		<ul>
<?PHP foreach($tlist as $key=>$val){ ?>

<?PHP if($val[ 'type' ] == 52 || $val[ 'type' ] == 60 || $val[ 'type' ] == 62 || $val[ 'type' ] == 68 || $val[ 'type' ] == 86 || $val[ 'type' ] == 87 || $val[ 'type' ] == 89 || $val[ 'type' ] == 90){ ?>
			<li><a href="/index/csvDown/<?=$sec?>/<?=$val[ 'id' ]?>/<?=$val[ 'type' ]?>/?type=boss"><?=$val[ 'name' ]?>【<?=$a_test_type[$val[ 'type' ]]?>】：上司向け</a></li>
			<li><a href="/index/csvDown/<?=$sec?>/<?=$val[ 'id' ]?>/<?=$val[ 'type' ]?>/?type=sub"><?=$val[ 'name' ]?>【<?=$a_test_type[$val[ 'type' ]]?>】：部下向け</a></li>
			<li><a href="/index/csvDown/<?=$sec?>/<?=$val[ 'id' ]?>/<?=$val[ 'type' ]?>/anq"><?=$val[ 'name' ]?>【アンケート】</a></li>
<?PHP }else{ ?>
			<li><a href="/index/csvDown/<?=$sec?>/<?=$val[ 'id' ]?>/<?=$val[ 'type' ]?>"><?=$val[ 'name' ]?>【<?=$a_test_type[$val[ 'type' ]]?>】</a></li>
<?PHP } ?>

<?PHP } ?>
		</ul>
	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
