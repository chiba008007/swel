<?PHP
$css1 = "exam";
$title = "AMS:検査申込";
$scroll = true;

include_once("include_header.php");

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
<!--
    var _url  = location.href;
    $(window).load(function(){
        $("#move").on("click",function(){
           if(confirm("移動を行います。")){
               return true;
           }else{
               return false;
           }
        });
        $("#move").hide();
        $(this).setPartner();
        $("#customerid").on("change",function(){
            $(this).setTests();
        });
        $("#partnerid").on("change",function(){
            $(this).setPartner();
            $(this).setTests();
        });
    });
    $.fn.setTests = function(){
        
        var _partnerid = $("#partnerid").val();
        var _customerid = $("#customerid").val();
        var _data = {
            "flag":"tests"
            ,"pid":_partnerid
            ,"cid":_customerid
        };
        $.ajax(_url,{
           type: 'POST',
           data: _data
        }).done(function(rlt){
            $("#testid").html("");
            var _option = "";
            try{
                if(rlt.length != "0"){
                    $.each(rlt,function(key,val){
                        _option += "<option value='"+val.id+"'>"+val.name+"</option>\n";
                    });
                    $("#testid").html(_option);
                     $("#move").show();
                }else{
                    $("#move").hide();
                }
            }catch(e){
                
                var _option = "<option value='0'>データがありません。</option>\n";
                $("#testid").html(_option);
            }
        });
    };
    $.fn.setPartner = function(){
        
        var _partnerid = $("#partnerid").val();
        var _data = {
            "flag":"company"
            ,"pid":_partnerid
        };
        $.ajax(_url,{
           type: 'POST',
           data: _data
        }).done(function(rlt){
            console.log(rlt);
            var _option = "";
            try{
           $.each(rlt,function(key,val){
               _option += "<option value='"+val.id+"'>"+val.name+"</option>\n";
           });
           $("#customerid").html(_option);
           
           $(this).setTests();
            }catch(e){
                _option += "<option value=''>データがありません。</option>\n";
                 $("#customerid").html(_option);
            }
        });
    };
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
				"/index/data/".$sec,
				"受検結果一覧"
			),
		);
            ?>
            <?php include_once("include_title.php"); ?>
		<div id="dataTitle">検査移動</div>
                
                
                <form action="" method="POST" >
                    <h4>パートナー企業</h4>
                    
                    
                    <!--
                    <select name="partnerid" id="partnerid" class="form-control" > 
                    <?php foreach($partner as $key=>$val): ?>
                        <?php 
                            $sel = "";
                            if($val[ 'id' ] == $ptid) $sel = "SELECTED";
                        ?>
                        <option value="<?=$val[ 'id' ]?>" <?=$sel?> ><?=$val[ 'name' ]?></option>
                    <?php endforeach; ?>
                    </select>
                    -->
                    <input type="hidden" name="partnerid" id="partnerid" value="<?=$ptid?>" />
                    <h4>顧客名</h4>
                    <select name="customerid" id="customerid" class="form-control" >
                    </select>
                    <h4>テスト名</h4>
                    <select name="testid" id="testid" class="form-control" >
                    </select>
                    <br />
                    <input type="submit" name="move" id="move" class="btn btn-success" value="移動" />
                </form>
        </div>     
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
