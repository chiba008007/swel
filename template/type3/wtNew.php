<?PHP
$css1 = "wt";
$title = "AMS:顧客情報一覧画面";
$js = array("wt");
$time = true;

include_once("include_header.php");
?>
<div id="main">
  <div id="contents">
    <?PHP
    $code = "新規登録";
    if ($sec == "edit") {
      $code = "更新";
    }
    if ($basetype == 1) {
      $pan = array(
        array(
          "/index/ptn/" . $ptid,
          "顧客企業一覧"
        ),
        array(
          "/",
          "検査一覧"
        ),
        array(
          "/index/wt/",
          "重みマスタ"
        ),
        array(
          "",
          $code
        ),
      );
    }
    if ($basetype == 2) {
      $pan = array(

        array(
          "/",
          "検査一覧"
        ),
        array(
          "/index/wt/",
          "重みマスタ"
        ),
        array(
          "",
          $code
        ),
      );
    }
    include_once("include_title.php");
    ?>
    <script type="text/javascript">
      <!--
      $(function() {

        $(document).on('change', 'input[name="csv"]', function() {
          var _val = $(this).val();
          var _id = $(this).attr("id").split("_");
          var _kcode = _id[1];
          var fd = new FormData();
          if ($("input[name='hoge']").val() !== '') {
            fd.append("file", $("input[name='csv']").prop("files")[0]);
          }
          fd.append("dir", $("#hoge").val());
          var postData = {
            type: "POST",
            dataType: "text",
            data: fd,
            processData: false,
            contentType: false
          };
          var _url = "/index/reg/?weightcsv=on";
          $.ajax(
            _url, postData
          ).done(function(text) {
            var _obj = $.parseJSON(text);
            $("#txt1").val(_obj[1]);
            $("#txt2").val(_obj[2]);
            $("#txt3").val(_obj[15]);
            $("#txt4").val(_obj[4]);
            $("#txt5").val(_obj[5]);
            $("#txt6").val(_obj[6]);
            $("#txt7").val(_obj[19]);
            $("#txt8").val(_obj[20]);
            $("#txt9").val(_obj[21]);
            $("#txt10").val(_obj[22]);
            $("#txt11").val(_obj[23]);
            $("#txt12").val(_obj[24]);
            $("#txt13").val(_obj[25]);
            $("#txt14").val(_obj[26]);
          });
        });
        /*
         $(document).on('change','input[name="csv"]',function(){
            var _val = $(this).val();
            var _id = $(this).attr("id").split("_");
            var _kcode = _id[1];
            var fd = new FormData();
          if ($("input[name='hoge']").val()!== '') {
            fd.append( "file", $("input[name='csv']").prop("files")[0] );
          }
          fd.append("dir",$("#hoge").val());
          var postData = {
            type : "POST",
            dataType : "text",
            data : fd,
            processData : false,
            contentType : false
          };
          var _url = "../reg/";
          $.ajax(
            _url
            ,postData
          ).done(function( text ){
            console.log(text);
            var _obj = $.parseJSON(text);
            console.log(_obj);
            $("#txt1").val(_obj[0][23]);
            $("#txt2").val(_obj[0][24]);
            $("#txt3").val(_obj[0][25]);
            $("#txt4").val(_obj[0][26]);
            $("#txt5").val(_obj[0][27]);
            $("#txt6").val(_obj[0][28]);
            $("#txt7").val(_obj[0][29]);
            $("#txt8").val(_obj[0][30]);
            $("#txt9").val(_obj[0][31]);
            $("#txt10").val(_obj[0][32]);
            $("#txt11").val(_obj[0][33]);
            $("#txt12").val(_obj[0][34]);
            $("#txt13").val(_obj[0][35]);
            $("#txt14").val(_obj[0][36]);
          });
        });
        */
      });
      //
      -->
    </script>

    <form action="" method="POST">
      <br clear=all />
      ▼CSV<br />
      <input type="file" name="csv" class="csv" id="csv">
      <input id="hoge" type="hidden" value="hoge">
      <br />
      ▼マスター名<br />
      <input type="text" name="master_name" value="<?= $master_name ?>" id="master_text">
      <br clear=all />
      <br clear=all />
      <table id="table">
        <tr>
          <th><?= $element['e_feel'] ?></th>
          <th><?= $element['e_cus'] ?></th>
          <th><?= $element['e_aff'] ?></th>
          <th><?= $element['e_cntl'] ?></th>
          <th><?= $element['e_vi'] ?></th>
          <th><?= $element['e_pos'] ?></th>

        </tr>
        <tr>
          <td><input type="text" name="e_feel" id="txt1" value="<?= $e_feel ?>"></td>
          <td><input type="text" name="e_cus" id="txt2" value="<?= $e_cus ?>"></td>
          <td><input type="text" name="e_aff" id="txt3" value="<?= $e_aff ?>"></td>
          <td><input type="text" name="e_cntl" id="txt4" value="<?= $e_cntl ?>"></td>
          <td><input type="text" name="e_vi" id="txt5" value="<?= $e_vi ?>"></td>
          <td><input type="text" name="e_pos" id="txt6" value="<?= $e_pos ?>"></td>

        </tr>
        <tr>
          <th><?= $element['e_symp'] ?></th>
          <th><?= $element['e_situ'] ?></th>
          <th><?= $element['e_hosp'] ?></th>
          <th><?= $element['e_lead'] ?></th>
          <th><?= $element['e_ass'] ?></th>
          <th><?= $element['e_adap'] ?></th>
        </tr>
        <tr>
          <td><input type="text" name="e_symp" id="txt7" value="<?= $e_symp ?>"></td>
          <td><input type="text" name="e_situ" id="txt8" value="<?= $e_situ ?>"></td>
          <td><input type="text" name="e_hosp" id="txt9" value="<?= $e_hosp ?>"></td>
          <td><input type="text" name="e_lead" id="txt10" value="<?= $e_lead ?>"></td>
          <td><input type="text" name="e_ass" id="txt11" value="<?= $e_ass ?>"></td>
          <td><input type="text" name="e_adap" id="txt12" value="<?= $e_adap ?>"></td>

        </tr>
        <tr>
          <th>平均点</th>
          <th>標準偏差値</th>
        </tr>
        <tr>
          <td><input type="text" name="avg" id="txt13" value="<?= $avg ?>"></td>
          <td><input type="text" name="hensa" id="txt14" value="<?= $hensa ?>"></td>
        </tr>
      </table>
      <br clear=all />
      <input type="button" name="back" id="back" value="一覧に戻る" class="button">
      <input type="submit" name="conf" id="conf" value="確認" class="button">
      <br clear=all />

    </form>

  </div>
  <br clear=all />
  <?PHP
  include_once("include_footer_name.php");
  ?>
</div>

<?PHP
include_once("include_footer.php");
?>