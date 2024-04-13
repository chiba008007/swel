<?PHP


include_once("include_header.php");

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />

    <style type="text/css">
        <!--
        table#table{
            border-top:1px solid #006699 !important;
            border-left:1px solid #006699;
            border-collapse:collapse;
            border-spacing:0;
            background-color:#ffffff;
            empty-cells:show;
                width:100%;
        }
        table#table th{
                border-top:1px solid #006699 !important;
                border-right:1px solid #006699 !important;
                border-left:1px solid #006699 !important;
                border-bottom:1px solid #006699 !important;
                color:#000000;
                background-color:#e0e0ff;
                background-position:left top;
                padding:0.3em 1em;
                text-align:center;
                font-size:11.5px;
                height:30px;
        }
        table#table td{
            border-left:1px solid #006699 !important;
        }
        th,td{
            font-size:11px;
        }
        div#footer{
            position:static;
            margin-top:30px;
        }
        //-->
    </style>
<script type="text/javascript" >
<!--
    $(function(){
       $(".editbtn").click(function(){
           var _id = $(this).attr("id").split("-");
           location.href="/index/inspection/edit/"+_id[1];
           return false;
       });
    });
//-->
</script>
<div id="main">
    <div id="contents">
<?PHP
$pan = array(
			array(
				"/index/ptn/".$ptid,
				"顧客企業一覧"
			),
			array(
				"/",
				"検査一覧"
			),
			array(
				"",
				"受検一覧画面"
			),
		);
include_once("include_title.php");
?>
    </div>
</div>
        <div id="dataTitle">
            <?=$_SESSION[ 'name' ]?> + 採用分析
        </div>
        <form action="" method="GET" >
            <br aler="all" />
            <div class="row" >
                <div class="col-lg-2">
                    ID検索：
                    <input type="text" class="form-control" name="searchid" value="<?=$searchid?>" />
                </div>
                <div class="col-lg-2">
                    氏名検索：
                    <input type="text" class="form-control" name="searchname" value="<?=$searchname?>" />
                </div>
                <div class="col-lg-2">
                    フリガナ：
                    <input type="text" class="form-control" name="searchkana" value="<?=$searchkana?>" />
                </div>
                <div class="col-lg-2">
                    受検開始日：
                    <input type="text" class="form-control datepicker" name="searchfrom" value="<?=$searchfrom?>"   />
                </div>
                <div class="col-lg-2">
                    受検終了日：
                    <input type="text" class="form-control datepicker" name="searchto" value="<?=$searchto?>"  />
                </div>
            </div>
            <div class="row" >
                <div class="col-lg-2">
                    <input type="submit" name="search" value="検索"  class="btn btn-success" />
                </div>
            </div>
        </form>
        <div class="dataTables_paginate paging_bootstrap text-right">
            <ul class="pagination">
                <?php for($i=1;$i<=$ceil;$i++): 
                    $pg = $i-1;
                    ?>
                <li ><a href="/index/inspection/?searchtext=<?=$searchtext?>&p=<?=$pg?>"><?=$i?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
        <table  id="table" class="table table-bordered">
            <tr>
                <th>番号</th>
                <th>受検区分<br />(新卒/中途)</th>
                <th>採用年度</th>
                <th>検査名</th>
                <th>ID</th>
                <th>氏名</th>
                <th>ふりがな</th>
                <th>生年月日<br />(受検日年齢)</th>
                <th>性別</th>
                <th>受検日</th>
                <th>メモ1</th>
                <th>メモ2</th>
                <th>面接評価</th>
                <th>採用合否</th>
                <th>入社日</th>
                <th>退職日</th>
                <th>退職理由</th>
                <th>機能</th>
            </tr>
            <?php 
                $num = 1+($limit*$_REQUEST[ 'p' ]);
                foreach($data as $key=>$val): 
                    
                ?>
                <tr>
                    <td><?=$num?></td>
                    <td><?=$val[ 'inspection' ]?></td>
                    <td><?=$val[ 'exam_year' ]?></td>
                    <td><?=$val[ 'testname' ]?></td>
                    <td><?=$val[ 'exam_id' ]?></td>
                    <td><?=$val[ 'name' ]?></td>
                    <td><?=$val[ 'kana' ]?></td>
                    <td><?=$val[ 'birth' ]?><br />(<?=$val[ 'age' ]?>)</td>
                    <td><?=$a_gender[$val[ 'sex' ]]?></td>
                    <td><?=$val[ 'exam_date' ]?></td>
                    <td><?=$val[ 'memo1' ]?></td>
                    <td><?=$val[ 'memo2' ]?></td>
                    <td><?=$val[ 'evaluation' ]?></td>
                    <td><?=$val[ 'adopt' ]?></td>
                    <td><?=$val[ 'enterdate' ]?></td>
                    <td><?=$val[ 'retiredate' ]?></td>
                    <td><?=$val[ 'retirereason' ]?></td>
                    <td>
                        <input type="button" value="更新" class="btn editbtn" id="edit-<?=$val[ 'id' ]?>" />
                    </td>
                </tr>
            <?php
                $num++;
                endforeach;?>            
        </table>
        <div class="row">
            <div class="col-lg-2">
                <input type="button" value="csvダウンロード" id="download"  class="btn btn-success" />
            </div>
            <div class="col-lg-2">
                <input type="button" value="csvアップロード" id="upload" class="btn btn-primary" />
            </div>
        </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" >
<script type="text/javascript">
    $(function(){
       $("#download").click(function(){
           location.href="/index/inspection/csvdownload/";
           return false;
       });
       
       $("#upload").click(function(){
           location.href="/index/inspection/upload/";
           return false;
       });
       $(".datepicker").datepicker();
    });
</script>
<?PHP
include_once("include_footer_name.php");
?>

<?PHP
include_once("include_footer.php");
?>
