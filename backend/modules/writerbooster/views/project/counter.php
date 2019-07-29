<?php

use yii\helpers\Html;
use richardfan\widget\JSRegister;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@backend/views/myasset');

/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'WRITERBOOSTER TIMER';
?>
<style type="text/css">
#counter{ width: 240px; height: 45px; }
body {font-family: verdana}
</style>
<audio id="audio-begin">
  <source src="<?=$directoryAsset?>/audio/begin_session.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="audio-start">
  <source src="<?=$directoryAsset?>/audio/bismillah.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="audio-rest">
  <source src="<?=$directoryAsset?>/audio/time_rest.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="audio-alarm">
  <source src="<?=$directoryAsset?>/audio/continue_writing.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="audio-applause">
  <source src="<?=$directoryAsset?>/audio/congrat.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<div align="center">

<h2 id="con-header">WRITING TIME</h3>

<input type="hidden" id="project_id" value="0" />

<div id="counter"></div>
<p>
<button id="initiate">Start Session</button>
<button id="pauseButton" style="display:none">Pause</button>
<button id="resumeWrite" style="display:none">Start</button>
</p>

<img id="img-write" src="<?=$directoryAsset?>/img/write.jpg" width="100" />
<img id="img-break" style="display:none" src="<?=$directoryAsset?>/img/coffe-break.jpg" width="100" />
<img id="img-golf" style="display:none" src="<?=$directoryAsset?>/img/golf.jpg" width="100" />
<img id="img-congrats" style="display:none" src="<?=$directoryAsset?>/img/congrats.jpg" width="200" />
<img id="img-alarm" style="display:none" src="<?=$directoryAsset?>/img/alarm.jpg" width="150" />
<p>Finished Session: <span id="finished-pomo">0</span></p>
<hr />
<style>
.rcorners {
  border-radius: 5px;
  padding: 2px; 
  width: 40px;
  height: 20px; 
  text-align:center
}

.rcorners-time {
  border-radius: 5px;
  padding: 2px; 
  width: 70px;
  height: 20px; 
  text-align:center
}

</style>
<p>Targeted Session: <input type="number" class="rcorners inputset" id="target-pomo" value="<?=$model->default_session?>" /></p>

<p>Session Duration: <input type="text" id="session-duration" class="rcorners-time inputset" value="<?=$model->pomo_duration?>" /></p>
<p>Short Break: <input type="text" id="short-break" class="rcorners-time inputset" value="<?=$model->short_break?>" /></p>
<p>Long Break after <input type="number" id="input-long-break" class="rcorners inputset" value="3" /> Session</p>
<p>Long Break Duration: <input type="text" id="long-break" class="rcorners-time inputset" value="<?=$model->long_break?>" /> </p>

<input id="pomo-after-rest-long" type="hidden" value="0" />

</div>




<?php JSRegister::begin(); ?>
<script>

$('#initiate').click(function(){
	$("input.inputset").prop('disabled', true);
	$(this).hide();
	$('#pauseButton').show();
	write();
	
	$('#pauseButton').click(function() { 
		var pause = $(this).text() === 'Pause'; 
		$(this).text(pause ? 'Start' : 'Pause'); 
		$('#counter').countdown(pause ? 'pause' : 'resume'); 
	}); 

});

var long_break = parseInt($("#input-long-break").val());
var au_start = document.getElementById("audio-start"); 
var au_stop = document.getElementById("audio-rest"); 
var au_alarm = document.getElementById("audio-alarm"); 
var au_applause = document.getElementById("audio-applause"); 
var au_begin = document.getElementById("audio-begin"); 

function playStart() { 
  au_start.play(); 
} 
function playStop() { 
  au_stop.play(); 
} 
function playAlarm() { 
  au_alarm.play(); 
} 
function stopAlarm() { 
  au_alarm.pause(); 
	au_alarm.currentTime = 0;
} 
 
function playApplause() { 
  au_applause.play(); 
} 

function playBegin() { 
  au_begin.play(); 
} 


 $(function () {
	playBegin();

}); 

function write(){
	playStart();
	$("#con-header").text('WRITING TIME');
	shortly = new Date(); 
	var wr_duration = str_to_sec($('#session-duration').val()) + 0.5;
	shortly.setSeconds(shortly.getSeconds() + wr_duration); 
    //shortly.setMinutes(shortly.getMinutes() + 5.5); 
	$('#counter').countdown({until: shortly, onExpiry: rest});
}

function str_to_sec(str){
	var arr = str.split(':');
	var hour = parseInt(arr[0]);
	var minute = parseInt(arr[1]);
	var second = parseInt(arr[2]);
	return (hour * 60 * 60) + (minute * 60) + second;
}

function startButton(){
	playAlarm();
	$("#img-break").hide();
	$("#img-golf").hide();
	$("#img-alarm").show();
	$("#resumeWrite").show();
	$("#resumeWrite").click(function(){
		rewrite();
		stopAlarm();
		
	});
}

function rewrite(){
	playStart();
	$("#img-write").show();
	$("#img-alarm").hide();
	$('#pauseButton').show();
	$("#resumeWrite").hide();
	$('#counter').countdown('destroy'); 
	$("#con-header").text('WRITING TIME');
	shortly = new Date(); 
	var wr_duration = str_to_sec($('#session-duration').val()) + 0.5;
	shortly.setSeconds(shortly.getSeconds() + wr_duration); 
    
	
	
	$('#counter').countdown({until: shortly, onExpiry: rest});
}

function counterAfterRestLong(){
	var after_rest_long = parseInt($('#pomo-after-rest-long').val());
	after_rest_long++;
	$('#pomo-after-rest-long').val(after_rest_long);
}

function connect_db(){
	var project = <?=$model->id?>;
	var wr_duration = str_to_sec($('#session-duration').val());
	var url = '<?php echo Yii::$app->request->baseUrl. '/apps/project/update-pomo?id='?>' + project + '<?php echo '&dur=' ?>' + wr_duration;
	  $.ajax({
		   url:  url,
		   type: 'get',
		   success: function (data) {
			  console.log(data.hasil);
		   }
	  });
}

function rest() { 
	connect_db();
	counterAfterRestLong();
	if(checkPomodoro()){
		playStop();
		
		var after_long = parseInt($("#pomo-after-rest-long").val());
		var long_break = parseInt($("#input-long-break").val());
		
		
		if(after_long == long_break){
			long_rest();
		}else{
			short_rest();
		}
		
	}
	
}

function short_rest(){
	$("#img-write").hide();
		$("#img-break").show();
		$('#pauseButton').hide();
		$("#con-header").text('SHORT BREAK');
		$('#counter').countdown('destroy'); 
		
		shortly = new Date(); 
		var wr_rest_short = str_to_sec($('#short-break').val()) + 0.5;
		shortly.setSeconds(shortly.getSeconds() + wr_rest_short); 
		
		$('#counter').countdown({until: shortly, onExpiry: startButton});
}

function long_rest(){
		$("#img-write").hide();
		$("#img-golf").show();
		$('#pauseButton').hide();
		$("#con-header").text('LONG BREAK');
		$('#counter').countdown('destroy'); 
		$('#pomo-after-rest-long').val(0);
		shortly = new Date(); 
		var wr_rest_long = str_to_sec($('#long-break').val()) + 0.5;
		shortly.setSeconds(shortly.getSeconds() + wr_rest_long); 
		//shortly.setMinutes(shortly.getMinutes() + 5.5); 
		
		$('#counter').countdown({until: shortly, onExpiry: startButton});
}



function checkPomodoro(){
	var total = parseInt($("#target-pomo").val());
	var finished = parseInt($("#finished-pomo").text());
	finished++;
	$("#finished-pomo").text(finished);
	//alert(finished + '==' + total);
	if(finished == total){
		playApplause();
		$("#con-header").text('FINISHED');
		$('#pauseButton').hide();
		$('#counter').hide();
		$("#img-write").hide();
		$("#img-congrats").show();
		$("input.inputset").prop('disabled', false);
		return false
	}
	return true;
}


</script>
<?php JSRegister::end(); ?>