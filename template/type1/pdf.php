<?PHP
$css1 = "list";
$title = "AMS:PDF一覧画面";
include_once("include_header.php");
?>
<script >
$(function(){
    $("#pdfall").click(function(){
        var _tid = $("#tid").val();
        var _pid = $("#pid").val();
        var _test_id = $("#test_id").val();
        if(!_tid){
            alert("企業名を選択してください。");
            return false;
        }
        if(!_pid){
            alert("パートナー名を選択してください。");
            return false;
        }
        if(!_test_id){
            alert("テストを選択してください。");
            return false;
        }

       // var href = "http://igtests.sakura.ne.jp/all/down.php?tid="+_tid+"&pid="+_pid+"&testid="+_test_id;
       var _url = "http://igtests.sakura.ne.jp/all/down.php?tid="+_tid+"&pid="+_pid+"&testid="+_test_id;
       // window.open().location.href=href;
       $.ajax({
            type: "POST",
            url: _url,
            success: function(data){
                alert("success");
                return false;
            }
        });

        return false;
    });

    $("#pid").change(function(){
        var _url = location.href;
        var _tid = $("#tid").val();
        var _pid = $("#pid").val();
        var _data = {
            "tid":_tid
            ,"pid":_pid

        };
        $('#test_id > option').remove();
        var _sel = $("#test_id");
        $.ajax({
            type: "POST",
            url: _url,
            data: _data,
            success: function(data){
                _sel.append($('<option>').html("-").val(""));
                $.each(data, function(key, value){
                    _sel.append($('<option>').html(value['name']).val(value['0']));
                });
                return false;
            }
        });

        return false;
    });

    $("#tid").change(function(){
        var _url = location.href;
        var _tid = $(this).val();
        var _data = {"tid":_tid};
        $('#pid > option').remove();
        var _sel = $("#pid");
        $.ajax({
            type: "POST",
            url: _url,
            data: _data,
            success: function(data){
                _sel.append($('<option>').html("-").val(""));
                $.each(data, function(key, value){
                    _sel.append($('<option>').html(value['name']).val(value['0']));
                });
                return false;
            }
        });

        return false;
    });
});
</script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
<div id="main">
	<div id="contents">
<?PHP include_once("include_title.php"); ?>
<br clear=all />
<p>▼企業名</p>
<select name="tid" id="tid" class="form-control">
    <option value="">企業名を選択してください。</option>
    <?php foreach($user as $key=>$value): ?>
        <option value="<?=$value[ 'id' ]?>"><?=$value[ 'name' ]?></option>
    <?php endforeach;?>
</select>
<br />
<p>▼パートナー</p>
<select name="pid" id="pid" class="form-control">
    <option value="">パートナー企業名を選択してください。</option>
</select>
<br />
<p>▼テスト</p>
<select name="test_id" id="test_id" class="form-control">
    <option value="">テスト名を選択してください。</option>
</select>
<br />
<input type="button" id="pdfall" value="一括PDFダウンロード" class="form-control btn btn-warning" /> 
</div><!--contents-->
<br clear=all />
<?PHP include_once("include_footer_name.php"); ?>
</div><!--main-->

<?PHP include_once("include_footer.php"); ?>
