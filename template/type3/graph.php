<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script src="/lib/Chartjs/Chart.min.js"></script>
        <style type="text/css">
            ul#label{
                list-style-type: none;
                padding:0;
                margin:0;
                
                margin-top:30px;
            }
            ul#label li { 
                clear:both;
                font-size:12px;
                margin-left:20px;
            }
            ul#label li div.blue{ color:blue;float:left;}
            ul#label li div.red{color:red;float:left;}
            .p{
                position:absolute;
                margin-left:45%;
                font-size:11px;
            }
            #p1{margin-top:4%;}
            #p2{margin-top:9%;}
            #p3{margin-top:13%;}
            #p4{margin-top:18%;}
            #p5{margin-top:22%;}
            #p6{margin-top:27%;}
            #p7{margin-top:31%;}
            
            #str1{
                position:absolute;
            }
            #str2{
                position:absolute;
                left:auto;
                right:0;
            }
       </style>
    </head>
    <body>
        <h2>受検者傾向(グラフ)</h2>
        <h3>ストレス共生度数グラフ</h3>
        <table style="width:100%;">
            <tr>
                <td style="width:5%;" >割合</td>
                <td><canvas id="canvas" style="width:300px;" ></canvas></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">ストレス共生レベル</td>
            </tr>
        </table>
        
        <!--
        <div id="str1">割合</div>
        <div id="str2">ストレス共生レベル</div>
        -->
        <ul id="label">
            <li><div class="blue">■</div>　受検者の割合</li>
            <li><div class="red">■</div>　標準的（母数全体）の割合</li>
        </ul>
        <h3>行動価値　12要素の平均</h3>
        <div id="p1" class="p">80</div>
        <div id="p2" class="p">70</div>
        <div id="p3" class="p">60</div>
        <div id="p4" class="p">50</div>
        <div id="p5" class="p">40</div>
        <div id="p6" class="p">30</div>
        <div id="p7" class="p">20</div>
        <canvas id="canvas2" style="width:100%;margin:0 auto;"  height="450" width="640" ></canvas>
        <div style="text-align: center">
            <input type="button" value="閉じる" style="padding:10px;" onClick="window.close();" />
        </div>
       <script>        
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : ["1","2","3","4","5"],
		datasets : [
			{
				fillColor : "rgba(0,0,225,1)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [
                                    <?php echo $set1; ?>
                                    ,<?php echo $set2; ?>
                                    ,<?php echo $set3; ?>
                                    ,<?php echo $set4; ?>
                                    ,<?php echo $set5; ?>
                                    ,1,100
                                ]
			},
                        
			{
				fillColor : "rgba(255,0,0,1)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : [
                                    <?php echo $fix1; ?>
                                    ,<?php echo $fix2; ?>
                                    ,<?php echo $fix3; ?>
                                    ,<?php echo $fix4; ?>
                                    ,<?php echo $fix5; ?>
                                ]
			}       
		]
	}
        
        
        var radarChartData = {
		labels: [
                "<?php echo $str1; ?>"
                , "<?php echo $str2; ?>"
                , "<?php echo $str3; ?>"
                , "<?php echo $str4; ?>"
                , "<?php echo $str5; ?>"
                , "<?php echo $str6; ?>"
                , "<?php echo $str7; ?>"
                , "<?php echo $str8; ?>"
                , "<?php echo $str9; ?>"
                , "<?php echo $str10; ?>"
                , "<?php echo $str11; ?>"
                , "<?php echo $str12; ?>"
            ],
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [
                                    <?php echo $d1; ?>
                                    ,<?php echo $d2; ?>
                                    ,<?php echo $d3; ?>
                                    ,<?php echo $d4; ?>
                                    ,<?php echo $d5; ?>
                                    ,<?php echo $d6; ?>
                                    ,<?php echo $d7; ?>
                                    ,<?php echo $d8; ?>
                                    ,<?php echo $d9; ?>
                                    ,<?php echo $d10; ?>
                                    ,<?php echo $d11; ?>
                                    ,<?php echo $d12; ?>
                                ]
			}
			
		]
	};
        

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
               
                window.myBar = new Chart(ctx).Bar(barChartData, {
                    
			responsive : true
                        ,animation:true
                        ,scaleShowLabels:true
                        ,barValueSpacing : 55
                        ,barDatasetSpacing : 100
                        ,scaleSteps : 100
                        ,scaleStepWidth : 10
                        ,scaleStartValue : 0
                        
                       ,tooltipEvents: []
                       ,onAnimationComplete: function(){
                           this.eachBars(function(bar){
                               var tooltipPosition = bar.tooltipPosition();
                               new Chart.Tooltip({
                                   
                                    x: Math.round(tooltipPosition.x),
                                    y: Math.round(tooltipPosition.y),
                                    xPadding: this.options.tooltipXPadding,
                                    yPadding: this.options.tooltipYPadding,
                                    fillColor: this.options.tooltipFillColor,
                                    textColor: this.options.tooltipFontColor,
                                    fontFamily: this.options.tooltipFontFamily,
                                    fontStyle: this.options.tooltipFontStyle,
                                    fontSize: this.options.tooltipFontSize,
                                    caretHeight: this.options.tooltipCaretSize,
                                    cornerRadius: this.options.tooltipCornerRadius,
                                    text: bar.value+"%",
                                    chart: this.chart
                                    
                               }).draw();
                           });//eachBars
                       }
                });
                
                var value = ["2","3","4"];
                window.myRadar = new Chart(document.getElementById("canvas2").getContext("2d")).Radar(radarChartData, {
                    
                     // 値のラインが棒グラフの値の上にかぶさるようにするか    
                    scaleOverlay : false,
                    // 値の開始値などを自分で設定するか
                    scaleOverride : true,

                    // 以下の 3 オプションは scaleOverride: true の時に使用
                    // 値のステップ数
                    scaleSteps : 6,
                    // 値のステップする大きさ
                    scaleStepWidth : 10,
                    // 値の始まりの値
                    scaleStartValue : 20,
                    pointLabelFontSize : 12,
                    scaleShowLabels : false
                });
                
	};


	
      	</script>
        
    </body>
</html>
