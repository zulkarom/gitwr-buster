<?php 
use sjaakp\gcharts\PieChart;

?>

<div class="project-update">

<h3>Total Writing Duration: <span id="pomo_duration"><?=$model->projDuration?></span></h3>


<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Session</span>
              <span class="info-box-number"><?=$model->countPomo()?></span>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-header"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Heading</span>
              <span class="info-box-number"><?=$model->countHead()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Paragraph</span>
              <span class="info-box-number"><?=$model->countPara()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-commenting-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Comment</span>
              <span class="info-box-number"><?=$model->countComment()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
	  



<div class="row">
<div class="col-md-12">

<h3>Collaboration Report</h3>
<div class="form-group"><?php 
	
	if($model->collaborations){
		echo '<table class="table table-stripped">
		<thead>
		<tr>
			<th>No.</th><th>Name</th><th>Contents</th><th>Comments</th><th>Session</th>
			<th>Duration</th>
		</tr>
		</thead>
		
		';
		$i = 1;
		foreach($model->collaborations as $col){
			echo '<tr><td>'.$i.'. </td>
			<td>'.$col->user->fullname .'</td>
			<td>'.$model->countContentByUser($col->user_id).'</td>
			<td>'.$model->countCommentByUser($col->user_id).'</td>
			<td>'.$model->countPomoByUser($col->user_id).'</td>
			<td>'.$model->projDurationByUser($col->user_id).'</td>
			</tr>';
		$i++;
		}
		echo '</table>';
	}
	
	?></div>

</div>

<div class="col-md-6">
</div>

</div>







</div>