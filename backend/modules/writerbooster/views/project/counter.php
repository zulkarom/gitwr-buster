<?php

use yii\helpers\Html;
use richardfan\widget\JSRegister;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@backend/views/myasset');

/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'WRITER BOOSTER TIMER';
?>
<style type="text/css">
#counter{ width: 240px; height: 45px; }
body {font-family: verdana}
</style>
<audio id="audio-start">
  <source src="<?=$directoryAsset?>/audio/horn.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="audio-rest">
  <source src="<?=$directoryAsset?>/audio/whistle.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="audio-alarm">
  <source src="<?=$directoryAsset?>/audio/alarm.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="audio-applause">
  <source src="<?=$directoryAsset?>/audio/applause.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<div align="center">

<h2 id="con-header">ENJOY MY WRITING TIME</h3>

<div id="counter"></div>
<p>
<button id="pauseButton">Pause</button>
<button id="resumeWrite" style="display:none">Resume Writing</button>
</p>

<img id="img-write" src="<?=$directoryAsset?>/img/write.jpg" width="100" />
<img id="img-break" style="display:none" src="<?=$directoryAsset?>/img/coffe-break.jpg" width="100" />
<img id="img-golf" style="display:none" src="<?=$directoryAsset?>/img/golf.jpg" width="100" />
<img id="img-congrats" style="display:none" src="<?=$directoryAsset?>/img/congrats.jpg" width="200" />
<img id="img-alarm" style="display:none" src="<?=$directoryAsset?>/img/alarm.jpg" width="150" />

<h3>Targeted of Pomodoro: <span id="target-pomo">4</span></h3>
<h3>Finished Pomodoro: <span id="finished-pomo">0</span></h3>
<p>Pomodoro Duration: <span id="pomo-duration">10</span> Seconds</p>
<p>Short Break: <span id="pomo-duration">5</span> Seconds</p>
<p>Long Break after <span id="pomo-duration">3</span> Pomodoro</p>
<p>Long Break Duration: <span id="pomo-duration">7</span> Seconds</p>
<input id="input-long-break" type="hidden" value="3" />
<input id="pomo-after-rest-long" type="hidden" value="0" />

</div>



<?php JSRegister::begin(); ?>
<script>
var long_break = parseInt($("#input-long-break").val());
var au_start = document.getElementById("audio-start"); 
var au_stop = document.getElementById("audio-rest"); 
var au_alarm = document.getElementById("audio-alarm"); 
var au_applause = document.getElementById("audio-applause"); 

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


$(function () {
	write();
	
	$('#pauseButton').click(function() { 
		var pause = $(this).text() === 'Pause'; 
		$(this).text(pause ? 'Resume' : 'Pause'); 
		$('#counter').countdown(pause ? 'pause' : 'resume'); 
	}); 

});

function write(){
	playStart();
	$("#con-header").text('ENJOY MY WRITING TIME');
	shortly = new Date(); 
	shortly.setSeconds(shortly.getSeconds() + 10.5); 
    //shortly.setMinutes(shortly.getMinutes() + 5.5); 
	$('#counter').countdown({until: shortly, onExpiry: rest});
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
	$("#con-header").text('ENJOY MY WRITING TIME');
	shortly = new Date(); 
	shortly.setSeconds(shortly.getSeconds() + 10.5); 
    
	
	
	$('#counter').countdown({until: shortly, onExpiry: rest});
}

function counterAfterRestLong(){
	var after_rest_long = parseInt($('#pomo-after-rest-long').val());
	after_rest_long++;
	$('#pomo-after-rest-long').val(after_rest_long);
}

function rest() { 
	opener.setPomodoro();
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
		shortly.setSeconds(shortly.getSeconds() + 5.5); 
		
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
		shortly.setSeconds(shortly.getSeconds() + 7.5); 
		//shortly.setMinutes(shortly.getMinutes() + 5.5); 
		
		$('#counter').countdown({until: shortly, onExpiry: startButton});
}



function checkPomodoro(){
	var total = parseInt($("#target-pomo").text());
	var finished = parseInt($("#finished-pomo").text());
	finished++;
	$("#finished-pomo").text(finished);
	if(finished == total){
		playApplause();
		$("#con-header").text('FINISHED');
		$('#pauseButton').hide();
		$('#counter').hide();
		$("#img-write").hide();
		$("#img-congrats").show();
		return false
	}
	return true;
}

</script>
<?php JSRegister::end(); ?>