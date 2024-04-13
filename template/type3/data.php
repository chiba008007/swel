<?php
if ($_COOKIE['lang'] == "ch") {
    $dstr   = "接受检查者一览画面";
    $dstr2  = "筛选";
    $dstr3  = "接受检查状态";
    $dstr4  = "接受检查日";
    $dstr5  = "搜索";
    $dstr6  = "到主要画面";
    $dstr7  = "适合的动作值善良可以在五个步骤显示。 1是高风险的申请人为您的公司。";
    $dstr8  = "号码";
    $dstr9  = "帐号";
    $dstr10 = "姓名";
    $dstr11 = "拼音";
    $dstr12 = "生日<br />(年龄)";
    $dstr13 = "合否";
    $dstr14 = "笔记1";
    $dstr15 = "笔记2";
    $dstr16 = "功能";
    $dstr17 = "状态";
    $dstr18 = "下载检查结果";
    $dstr19 = "所有内容";
    $dstr20 = "除检查只完成";
    $dstr21 = "动作值拟合";
    $dstr22 = "应力共生水平";
} else {
    $dstr   = "検査結果一覧画面";
    $dstr2  = "フィルタリング";
    $dstr3  = "受検ステータス";
    $dstr4  = "受検日";
    $dstr5  = "検索";
    $dstr6  = "メイン画面へ";
    $dstr7  = "行動価値適合度は５段階で表示しています。１が貴社にとってリスクの高い応募者となります。";
    $dstr8  = "番号";
    $dstr9  = "ID";
    $dstr10 = "氏名";
    $dstr11 = "ふりがな";
    $dstr12 = "生年月日<br />(年齢)";
    $dstr13 = "合否";
    $dstr14 = "メモ1";
    $dstr15 = "メモ2";
    $dstr16 = "機能";
    $dstr17 = "ステータス";
    $dstr18 = "検査結果ダウンロード";
    $dstr19 = "全員分";
    $dstr20 = "受検済のみ";
    $dstr21 = "行動価値<br />適合度";
    $dstr22 = "ｽﾄﾚｽ<br />共生ﾚﾍﾞﾙ";
}
$css1 = "data";
$title = "AMS:" . $dstr;
$js = array("data");
$time = true;

include_once("include_header.php");
?>

<div id="main">

    <div id="contents">
        <?php
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
                "",
                "受検結果一覧"
            ),
        );
        if ($basetype == 3) {
            $pan = array(

                array(
                    "",
                    $dstr
                ),
            );
        }
        include_once("include_title.php");
        ?>
        <style type="text/css">
            .disp_graph {
                position: absolute;
                margin-left: 180px;
                margin-top: 10px;
            }

            #filtertable td {
                padding: 3px;
            }
        </style>

        <div id="Loading">
            <img src="/images/downLoading.gif">
        </div>
        <div id="dataTitle">
            <?= $testname ?>
        </div>
        <?php if (filter_input(INPUT_GET, "pdferror") == 1) : ?>
            <script type="text/javascript">
                alert("PDFの出力可能枚数が超えています。");
            </script>
        <?php endif; ?>
        <?php if (filter_input(INPUT_GET, "pdferror") == 2) : ?>
            <script type="text/javascript">
                alert("出力期間が過ぎているため、未出力者は出力できません。");
            </script>
        <?php endif; ?>
        <form action="/index/data/<?= $sec ?>/" method="POST">
            <div id="filterBox">
                <div id="filetering">
                    ▼<?= $dstr2 ?><br />
                    <table id="filtertable">
                        <tr>
                            <td>ID </td>
                            <td><input type="text" name="idsearch" id="idsearch" value="" onblur="this.value=this.value.replace(/[^0-9a-zA-Z]+/i,'')" onkeyup="this.value=this.value.replace(/[^0-9a-zA-Z]+/i,'')" /></td>
                            <td>氏名</td>
                            <td><input type="text" name="namesearch" id="namesearch" value="" /></td>
                        </tr>
                        <tr>
                            <td>ふりがな</td>
                            <td><input type="text" name="kanasearch" id="kanasearch" value="" /></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <td><?= $dstr3 ?></td>
                        <td>
                            <select id="exam_state">
                                <?php
                                foreach ($array_status as $key => $val) {
                                ?>
                                    <option value="<?= $key ?>"><?= $val ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <?= $dstr4 ?>
                        </td>
                        <td>
                            <input type="text" name="datepic" id="datepicker" class="datepicker">～
                            <input type="text" name="datepic2" id="datepicker2" class="datepicker2">
                        </td>
                        </tr>
                        <tr>
                            <td>メモ1</td>
                            <td colspan=3>
                                <input type="text" name="memo1" value="" style="width:100%;" id="memo1search" />
                            </td>
                        </tr>
                        <tr>
                            <td>メモ2</td>
                            <td colspan=3>
                                <input type="text" name="memo2" value="" style="width:100%;" id="memo2search" />
                            </td>
                        </tr>

                    </table>
                    <div class="rt">
                        <input type="button" value="<?= $dstr5 ?>" class="button2" id="search">
                    </div>
                </div>
                <div id="buttonline">
                    <input type="button" class="button2" value="<?= $dstr6 ?>" id="mainBack">
                    <?php if ($graphbutton) { ?>

                        <?php if ($test['graph_status'] == 0) : ?>
                            <?php $disp = "非表示";
                            $typedisp = "hidden";
                            ?>
                        <?php else : ?>
                            <?php $disp = "表示中";
                            $typedisp = "display";
                            ?>
                        <?php endif; ?>
                        <?php if ($test['graph_status'] == 1 || $basetype == 1) : ?>
                            <?php if ($basetype == 1) : ?>
                                <a href="" id="<?= $typedisp ?>" class="disp_graph"><?= $disp ?></a>
                            <?php endif; ?>
                            <input type="button" class="button2" value="グラフ表示" id="graph" />
                        <?php endif; ?>

                    <?php } ?>
                    <?php if ($pdfslice == 1) : ?>
                        <input type="button" class="button2" value="pdf一括ダウンロード" id="pdfAll">
                    <?php endif; ?>
                </div>
            </div>
        </form>
        <br clear=all />
        <form action="/index/data/<?= $sec ?>/" name="form">
            <div id="pager"></div>
            <?php
            if ($weight == "0") {
            ?>
                <div id="weightMsg">※<?= $dstr7 ?></div>
            <?php
            }
            ?>
            <table id="table">
                <tr>
                    <?php
                    /*
                <th rowspan=2 class="w10">
                    <input type="checkbox" id="allCheck" value="on" <?=$checked?>>
                </th>
*/
                    ?>
                    <th rowspan=2 class="w10"><?= $dstr8 ?></th>
                    <th rowspan=2><?= $dstr9 ?></th>
                    <th rowspan=2><?= $dstr10 ?>
                        <?php if ($types[0]['type'] == 57) :  ?>
                            (男性)
                        <?php endif; ?>
                    </th>
                    <?php if ($types[0]['type'] == 57) :  ?>
                        <th>氏名(女性)</th>
                    <?php else : ?>
                        <th rowspan=2><?= $dstr11 ?></th>
                    <?php endif; ?>
                    <?php if ($types[0]['type'] == 57) :  ?>
                        <th rowspan="2" class="w100">パスワード</th>
                    <?php else : ?>
                        <th rowspan=2 class="w100"><?= $dstr12 ?></th>
                    <?php endif; ?>
                    <th><?= $dstr13 ?></th>
                    <?php
                    //テスト名表示
                    if (count($types)) {
                        foreach ($types as $key => $val) {
                    ?>
                            <th colspan=<?= $val['colspan'] ?>><?= $a_test_type[$val['type']] ?></th>
                    <?php
                        }
                    }
                    ?>
                    <th rowspan=2><?= $dstr14 ?></th>
                    <th rowspan=2><?= $dstr15 ?></th>
                    <?php if ($val['type'] == 83) : ?>
                        <th rowspan=2>AMPC</th>
                    <?php endif; ?>
                    <?php if ($pdfloguse) : ?>
                        <th rowspan=2>PDF</th>
                    <?php endif; ?>
                    <th rowspan=2 class="w80"><?= $dstr16 ?>
                        <br />

                        <a href="javascript:void(0);" onClick='alert("【結果ファイルをダウンロードする際の注意点】\n・ダウンロードが完全に終了してから開いてください。途中で開くと表示が崩れる場合があります。\n・複数のファイルを同時にダウンロードする場合、回線の速度によってはうまくダウンロードできないことがあります。そのため、１つのファイルが完全にダウンロードできてから、次のファイルをダウンロードしてください。");return false;'>※ PDFダウンロードする際の注意事項</a>
                    </th>

                </tr>
                <tr>
                    <!--
				<th><input type="text" id="textid" class="w30"></th>
				<th><input type="text" id="name_text" class="w60"></th>
				<th><input type="text" id="kana_text" class="w60"></th>
       -->
                    <th>
                        <select name="pass" id="pass_text">
                            <?php
                            foreach ($array_pass as $key => $val) {
                            ?>
                                <option value="<?= $key ?>"><?= $val ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </th>

                    <?php
                    //テスト名表示
                    if (count($types)) {
                        foreach ($types as $key => $val) {
                    ?>
                            <th class="w80"><?= $dstr17 ?></th>
                            <?php
                            //BA,FSの時ストレス共生レベルを表示する
                            if (
                                $val['type'] == 1 ||
                                $val['type'] == 2 ||
                                //	$val['type'] == 3 ||
                                $val['type'] == 12 ||
                                $val['type'] == 54 ||
                                $val['type'] == 72 ||
                                $val['type'] == 91 ||
                                $val['type'] == 82 ||
                                // $val['type'] == 59 ||
                                $val['type'] == 41

                            ) {
                            ?>
                                <?php
                                if ($weight == "0") {
                                ?>
                                    <th class="w80"><?= $dstr21 ?></th>
                                <?php
                                }
                                ?>
                                <th class="w80"><?= $dstr22 ?></th>

                            <?php
                            }
                            ?>

                            <?php
                            //BA,FSの時ストレス共生レベルを表示する
                            if (
                                $val['type'] == 44
                            ) {
                            ?>
                                <th class="w80">メールアドレス</th>
                                <th class="w80">更新ステータス</th>
                                <th class="w80">添削者</th>
                    <?php
                            }
                        }
                    }
                    ?>


                </tr>
                <tbody id="tbody">
                </tbody>
            </table>
            <div id="pager2"></div>

        </form>
        <div id="loading"></div>
        <input type="hidden" id="pages" value="<?= $third ?>">
        <input type="hidden" id="testgrp_id" value="<?= $sec ?>">
        <br clear=all />
        <table>
            <tr>
                <?php
                /*
                <td><a href="/index/data/<?=$sec?>/" class="button" id="deleteAll">チェックした検査を削除</a></td>
*/
                ?>
                <?php
                if ($excelBtn) {
                    if (!$rows) {
                ?>
                        <td>

                            <a href="/index/down/<?= $sec ?>/" class="button not">検査結果ダウンロード</a>

                        </td>
                    <?php
                    } else {
                    ?>
                        <td>
                            <?php
                            if ($wdata && count($wdata) >= 1 && $weight == '0') {
                                //重みつけを表示する
                                $wtKey = 1;
                                if ($excel_master_status == 0) {
                                    //excel_master_statusが０の時は重み付けを表示しない
                                    $wtKey = 0;
                                }
                            ?>
                                <div id="excelWt" style="height:300px;bottom:100px;background-color:#fff;">
                                    ▼重みを選択してください<br />
                                    <select name="weight" id="weight">
                                        <option value="">指定されている基準値</option>
                                        <?php foreach ($wdata as $key => $val) { ?>
                                            <option value="<?= $key ?>"><?= $val['master_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <br />
                                    <input type="button" class="exbutton" id='/index/down/<?= $sec ?>/' value="ダウンロード">
                                    <hr style="margin:15px 0px;" />

                                    <p>基準値を複数選択する場合は、以下から選択してください。</p>
                                    <input type="button" id="all" value="全て選択">
                                    <input type="button" id="allnot" value="全て外す" />
                                    <script type="text/javascript">
                                        <!--
                                        $(function() {

                                            $("#all").click(function() {
                                                $(".checkboxweight").attr("checked", true);

                                                var _cnt = $(".checkboxweight:checked").length;
                                                /*
                                                 if(_cnt > 50){
                                                     alert("基準は50以下しか選べません。再度選択してください");
                                                     $(".checkboxweight").attr("checked",false);
                                                     }
                                                 */


                                                return false;
                                            });
                                            $("#allnot").click(function() {
                                                $(".checkboxweight").attr("checked", false);
                                                return false;
                                            });
                                        });

                                        //
                                        -->
                                    </script>
                                    <div style="overflow-y:scroll;height:100px;">
                                        <?php
                                        $i = 0;
                                        foreach ($wdata as $key => $val) {
                                        ?>
                                            <input type="checkbox" class="checkboxweight" id="weightline_<?= $i ?>" name="weightline[<?= $key ?>]" value="<?= $key ?>" style="width:auto;" /> <?= $val['master_name'] ?>
                                            <br clear="all" />
                                        <?php $i++;
                                        }
                                        ?>
                                    </div>
                                    <br />
                                    <input type="button" value="複数重みダウンロード" id="downloads" style="width:auto;padding:3px;">
                                </div>
                            <?php
                            } else {
                                //重みつけを表示しない
                                $wtKey = 0;
                            }
                            ?>
                            <div id="excelDisp">
                                <a href="/index/down/<?= $sec ?>/normal/" class="resultDown"><?= $dstr19 ?></a><br clear=all />
                                <a href="/index/down/<?= $sec ?>/complete/" class="resultDown"><?= $dstr20 ?></a>
                            </div>
                            <a href="javascript:void(0);" class="button exWtSet"><?= $dstr18 ?></a>
                            <input type="hidden" id="wtKey" value="<?= $wtKey ?>">
                            <input type="hidden" id="downPattern" value="">
                        </td>
                <?php
                    }
                } else {
                    /*
    ?>
                    <td>

                        <a href="/index/downEx/<?=$sec?>/" class="button" id="resultDownEx">検査結果ダウンロード</a>

                    </td>
    <?PHP
    */
                }
                ?>


                <?php
                $thickbox = "thickbox";
                $csvDown  = "csvDown";
                if (!$rows) {
                    $not = "not";
                    $thickbox = "";
                    $csvDown  = "";
                }

                if ($basetype == 1 || $basetype == 3) {
                    if ($basetype == 1) {
                ?>
                        <td><a href="/index/csv/<?= $sec ?>/" class="button <?= $thickbox ?> <?= $not ?>" id="<?= $csvDown ?>">CSVダウンロード</a></td>
                    <?php
                    }
                    ?>
                    <?php
                    if ($basetype == 1 || $csvbutton) {
                    ?>
                        <td><a href="/index/csvUp/<?= $sec ?>/" class="button <?= $not ?>">CSVアップロード</a></td>
                        <td><a href="/index/csvFm/<?= $sec ?>/" class="button <?= $not ?>">CSVフォーマット</a></td>
                    <?php
                    }
                    ?>

                <?php
                }
                ?>

                <td>
                    <a href="/index/status/<?= $sec ?>/" class="button" style="width:auto;white-space:nowrap;">受検状況確認用リスト出力</a>
                </td>

            </tr>
            <tr>

                <?php
                if ($rowflg) {
                ?>
                    <td><a href="/index/rFlgReg/<?= $sec ?>" class="button">ROWデータ登録</a></td>
                    <td><a href="/index/data/<?= $sec ?>" class="button" id="rowFin">ROWデータ登録完了</a></td>
                    <td>&nbsp;</td>

                <?php
                }
                ?>
            </tr>
        </table>
    </div>
    <?php
    include_once("include_footer_name.php");
    ?>
</div>
<input type="hidden" id="wKey" value="">
<input type="hidden" id="wKeyPdf" value="">

<?php
if ($pdfline) {
    foreach ($pdfline as $key => $val) {
?>
        <input type="hidden" id="type<?= $key ?>" value="<?= $val ?>" class="ty">
<?php
    }
}
?>
<script type="text/javascript">
    $(function() {
        $(document).on("click", "input[name='ampccheck']", function() {
            var _examid = $(this).parent().find("input").val();
            if (!confirm("ID：" + _examid + "にAMPレポートCの出力設定をしますか。")) {
                return false;
            }
            var _id = $(this).attr("id").split("_");
            var id = _id[1];
            var _data = {
                "ampflag": "on",
                "id": id
            };
            $.ajax({
                url: '/index/data/',
                type: 'POST',
                data: _data,
                cache: false,
                success: function(lists) {
                    $("#ampccheck_" + id).prop('disabled', true);

                    return false;
                }
            });

        });
        $(".checkboxweight").click(function() {
            $("#weight").val("");
        });

        $("#pdfAll").click(function() {
            location.href = "/index/pdfall/<?= $sec ?>";
            return false;
        });
    });
</script>
<?php
$where = array();
$where['test_id'] = $sec;
//受検データ取得
$testdata  = $obj->getTestData2($where);
$getpdf = $obj->getPdfLog($where);
if ($testdata['pdf_output_limit_count'] == 1) {
?>
    <script type="text/javascript">
        $(function() {
            alert("dddd");
            $(document).on("click", ".pdfdownloads", function() {
                var _id = $(this).attr("id").split("-");
                if (confirm("PDFダウンロードの確認\nID：" + _id[0] + "　\n氏名：" + _id[1] + " \nのPDFをダウンロードしますか。")) {
                    return true;
                }
                return false;
            });

        });
    </script>
<?php } ?>
<?php
include_once("include_footer.php");
?>