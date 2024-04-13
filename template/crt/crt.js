$(function(){
	/*------------------------
	現在の添削ナンバーを見て表示の変更を行う
	-------------------------*/
	$(this).tensakudisp();
	$(".tno").click(function(){
		var _id = $(this).attr("id");
		//添削回数ページリンク選択
		var _tno = _id.split("-");
		_tnoid = _tno[1];
		$(this).tensakudisp(_tnoid);
	});
	//登録データの表示
	$(this).getRegistData();
/*
	$("#tensaku_id").change(function(){
		$(this).getRegistData();
	});
*/
	$("input[name='tensaku_id']").click(function(){
		$(this).getRegistData();
	});

	//内容表示などの切替
	$(this).txtdisp();
	$(this).txtdisp2();
	$(this).txtdisp3();
	$(this).txtdisp4();

	$(".in1").click(function(){
		var _id = $(this).attr("id");
		var _k = _id.split("_");
		var _code = "#"+_k[0]+"_text_"+_k[1];
		$(this).txtdisp(_code);
	});
	$(".in2").click(function(){
		var _id = $(this).attr("id");
		var _k = _id.split("_");
		var _code = "#"+_k[0]+"_text_"+_k[1];
		$(this).txtdisp2(_code);
	});
	$(".in3").click(function(){
		var _id = $(this).attr("id");
		var _k = _id.split("_");
		var _code = "#"+_k[0]+"_text_"+_k[1];
		$(this).txtdisp3(_code);
	});
	$(".in4").click(function(){
		var _id = $(this).attr("id");
		var _k = _id.split("_");
		var _code = "#"+_k[0]+"_text_"+_k[1];
		$(this).txtdisp4(_code);
	});
	
	
	
	//完了ボタン
	$("#finish").click(function(){
		if(confirm("添削を完了し、添削完了の報告を行います。よろしいですか？")){
			return true;
		}else{
			return false;
		}
	});


	//-----------------------------
	//印刷ボタン
	//----------------------------
	$("#print").click(function(){
		if ($('#printbox').css('display') == 'block') {
			$("#printbox").hide();
		}else{
			$("#printbox").show();
		}
	});
	$(".printpage").click(function(){
		_url = location.href;
		var _tno = $("#tensaku_number").val();
	//	var _tid = $("#tensaku_id").val();
		var _tid = $("input[name='tensaku_id']:checked").val();
		var _id =  $(this).attr("id");
		_url += "?tno="+_tno;
		_url += "&tid="+_tid;
		_url += "&pagecode="+_id;

		NewWindow=window.open(_url,"new","fullscreen=1,scrollbars=1,toolbar=1,menubar=1,staus=1,resizable=1");
		NewWindow.focus();
	});


});
/*---------------------------------------
内容表示などの切替
---------------------------------------*/
$.fn.txtdisp = function(_k){
	var _k2 = "";
	if(!_k){
		var _k = "#question_text_1";
		_k2 = "#question_1";
	}
	$(".texts1").css("display","none");
	$(".in1").css("color","#000000");
	$(_k).css("display","block");
	if(_k2){
		$(_k2).css("color","red");
	}else{
		$(this).css("color","red");
	}
}
$.fn.txtdisp2 = function(_k){
	var _k2 = "";
	if(!_k){
		var _k = "#question_text_2";
		_k2 = "#question_2";
	}
	$(".texts2").css("display","none");
	$(".in2").css("color","#000000");
	$(_k).css("display","block");
	if(_k2){
		$(_k2).css("color","red");
	}else{
		$(this).css("color","red");
	}
}
$.fn.txtdisp3 = function(_k){
	var _k2 = "";
	if(!_k){
		var _k = "#question_text_3";
		_k2 = "#question_3";
	}
	$(".texts3").css("display","none");
	$(".in3").css("color","#000000");
	$(_k).css("display","block");
	if(_k2){
		$(_k2).css("color","red");
	}else{
		$(this).css("color","red");
	}
}
$.fn.txtdisp4 = function(_k){
	var _k2 = "";
	if(!_k){
		var _k = "#question_text_4";
		_k2 = "#question_4";
	}
	$(".texts4").css("display","none");
	$(".in4").css("color","#000000");
	$(_k).css("display","block");
	if(_k2){
		$(_k2).css("color","red");
	}else{
		$(this).css("color","red");
	}
}


/*---------------------------------------
登録データの表示
---------------------------------------*/
$.fn.getRegistData = function(){
	//var _tid = $("#tensaku_id").val();
	var _tid = $("input[name='tensaku_id']:checked").val();
	var _url = location.href;
	var _data = {getFlg:"1",tid:_tid}
	$.ajax({
		type: "POST",
		url: _url,
		data: _data,
		success: function(data){
			var _d = $.parseJSON(data);

			$("#tensaku-title"       ).html(_d[ 'tensaku-title'        ]);
			
			$("#question_text_1"       ).html($(this).nl2br(_d[ 'question_text'        ]));
			$("#worry_text_1"          ).html($(this).nl2br(_d[ 'worry_text'           ]));
			$("#advice_text_1"         ).html(_d[ 'advice_text'          ]);
			$("#answer_text_1"         ).html(_d[ 'answer_text'          ]);
			$("#answer_advice_text_1"  ).html(_d[ 'answer_advice_text'   ]);
			$("#note_point_1"          ).val(_d[ 'note_point'            ]);
			$("#logic_point_1"         ).val(_d[ 'logic_point'           ]);
			$("#heart_point_1"         ).val(_d[ 'heart_point'           ]);
			$("#apeal_point_1"         ).val(_d[ 'apeal_point'           ]);
			$("#selias_point_1"        ).val(_d[ 'selias_point'          ]);

			$("#question_text_2"       ).html($(this).nl2br(_d[ 'question_text2'         ]));
			$("#worry_text_2"          ).html($(this).nl2br(_d[ 'worry_text2'            ]));
			$("#advice_text_2"         ).html(_d[ 'advice_text2'           ]);
			$("#answer_text_2"         ).html(_d[ 'answer_text_2'          ]);
			$("#answer_advice_text_2"  ).html(_d[ 'answer_advice_text_2'   ]);
			$("#note_point_2"          ).val(_d[ 'note_point_2'            ]);
			$("#logic_point_2"         ).val(_d[ 'logic_point_2'           ]);
			$("#heart_point_2"         ).val(_d[ 'heart_point_2'           ]);
			$("#apeal_point_2"         ).val(_d[ 'apeal_point_2'           ]);
			$("#selias_point_2"        ).val(_d[ 'selias_point_2'          ]);


			$("#question_text_3"       ).html($(this).nl2br(_d[ 'question_text3'         ]));
			$("#worry_text_3"          ).html($(this).nl2br(_d[ 'worry_text3'            ]));
			$("#advice_text_3"         ).html(_d[ 'advice_text3'           ]);
			$("#answer_text_3"         ).html(_d[ 'answer_text_3'          ]);
			$("#answer_advice_text_3"  ).html(_d[ 'answer_advice_text_3'   ]);
			$("#note_point_3"          ).val(_d[ 'note_point_3'            ]);
			$("#logic_point_3"         ).val(_d[ 'logic_point_3'           ]);
			$("#heart_point_3"         ).val(_d[ 'heart_point_3'           ]);
			$("#apeal_point_3"         ).val(_d[ 'apeal_point_3'           ]);
			$("#selias_point_3"        ).val(_d[ 'selias_point_3'          ]);

			$("#question_text_4"       ).html($(this).nl2br(_d[ 'question_text4'         ]));
			$("#worry_text_4"          ).html($(this).nl2br(_d[ 'worry_text4'            ]));
			$("#advice_text_4"         ).html(_d[ 'advice_text4'           ]);
			$("#answer_text_4"         ).html(_d[ 'answer_text_4'          ]);
			$("#answer_advice_text_4"  ).html(_d[ 'answer_advice_text_4'   ]);
			$("#note_point_4"          ).val(_d[ 'note_point_4'            ]);
			$("#logic_point_4"         ).val(_d[ 'logic_point_4'           ]);
			$("#heart_point_4"         ).val(_d[ 'heart_point_4'           ]);
			$("#apeal_point_4"         ).val(_d[ 'apeal_point_4'           ]);
			$("#selias_point_4"        ).val(_d[ 'selias_point_4'          ]);


		}
	});
}

/*------------------------
現在の添削ナンバーを見て表示の変更を行う
-------------------------*/
$.fn.tensakudisp = function(_tnoid){
	$(".tensaku").css("display","none");
	var _tensaku_number = $("#tensaku_number").val();
	if(_tnoid){
		_tensaku_number = _tnoid;
		$("#tensaku_number").val(_tensaku_number);
	}
	var _tid = "tensaku_"+_tensaku_number;
	$("#"+_tid).css("display","block");
}

/*-------------
カテゴリ選択あとの質問選択表示
----------------*/
$.fn.categorySelect = function(option){
	var _id = $("#tensaku_title_status").val();
	var _data = {"flg":"category","category":_id}
	var _url = location.href;
	$.ajax({
	    type: 'GET',
	    url: _url,
	    data: _data,
		cache: false,
	    success: function( data ) {
        	$("#qlist").html(data);
    	}
	});
}

$.fn.nl2br = function(str) {
	return str.replace(/[\r]/g, "<br />");
}
