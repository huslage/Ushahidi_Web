<div id="main" class="report_detail">

	<div class="left-col" style="float:left;width:520px; margin-right:20px">
	
  	  <?php
    	  if ($incident_verified)
    		{
    			echo '<p class="r_verified">'.Kohana::lang('ui_main.verified').'</p>';
    		}
    		else
    		{
    			echo '<p class="r_unverified">'.Kohana::lang('ui_main.unverified').'</p>';
    		}
  	  ?>	

		<h1 class="report-title"><?php
			echo $incident_title;
			
			// If Admin is Logged In - Allow For Edit Link
			if ($logged_in)
			{
				echo " [&nbsp;<a href=\"".url::site()."admin/reports/edit/".$incident_id."\">".Kohana::lang('ui_main.edit')."</a>&nbsp;]";
			}
		?></h1>
	
		<p class="report-when-where">
			<span class="r_date"><?php echo $incident_time.' '.$incident_date; ?> </span>
			<span class="r_location"><?php echo $incident_location; ?></span>
		</p>
	<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4d73a5be25a220fc"></script>
<!-- AddThis Button END -->
	
		<div class="report-category-list">
		<p>
			<?php
				foreach($incident_category as $category) 
				{ 
				  if ($category->category->category_image_thumb)
					{
					?>
					<a href="<?php echo url::site()."reports/?c=".$category->category->id; ?>"><span class="r_cat-box" style="background:transparent url(<?php echo url::base().Kohana::config('upload.relative_directory')."/".$category->category->category_image_thumb; ?>) 0 0 no-repeat;">&nbsp;</span> <?php echo $category->category->category_title; ?></a>
					
					<?php 
					}
					else
					{
					?>
					  <a href="<?php echo url::site()."reports/?c=".$category->category->id; ?>"><span class="r_cat-box" style="background-color:#<?php echo $category->category->category_color; ?>">&nbsp;</span> <?php echo $category->category->category_title; ?></a>
				  <?php
				  }
				}
			?>
			</p>
			<?php
			// Action::report_meta - Add Items to the Report Meta (Location/Date/Time etc.)
			Event::run('ushahidi_action.report_meta', $incident_id);
			?>
		</div>
		
		<div class="report-description-text">
			<h5><?php echo Kohana::lang('ui_main.reports_description');?></h5>
			<?php echo $incident_description; ?>
			<br/>	
			<!-- start news source link -->
		<div class="credibility">

			<h5><?php echo Kohana::lang('ui_main.reports_news');?></h5>
			<?php if( count($incident_news) > 0 ) { ?>
					<?php
						foreach( $incident_news as $incident_new) 
						{
							?>
							<a href="<?php echo $incident_new; ?>"><?php
							echo $incident_new;?></a>
							<br/>
							<?php	
						}
					} ?>
			<!-- end news source link -->
			</div>

			<?php if ($features_count)
			{
				?>
				<br /><br /><h5><?php echo Kohana::lang('ui_main.reports_features');?></h5>
				<?php
				foreach ($features as $feature)
				{
					echo ($feature->geometry_label) ?
					 	"<div class=\"feature_label\"><a href=\"javascript:getFeature($feature->id)\">$feature->geometry_label</a></div>" : "";
					echo ($feature->geometry_comment) ?
						"<div class=\"feature_comment\">$feature->geometry_comment</div>" : "";
				}
			}?>
			
			<div class="credibility">
				<table class="rating-table" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><?php echo Kohana::lang('ui_main.credibility');?>:</td>
            <td><a href="javascript:rating('<?php echo $incident_id; ?>','add','original','oloader_<?php echo $incident_id; ?>')"><img id="oup_<?php echo $incident_id; ?>" src="<?php echo url::base() . 'media/img/'; ?>up.png" alt="UP" title="UP" border="0" /></a></td>
            <td><a href="javascript:rating('<?php echo $incident_id; ?>','subtract','original')"><img id="odown_<?php echo $incident_id; ?>" src="<?php echo url::base() . 'media/img/'; ?>down.png" alt="DOWN" title="DOWN" border="0" /></a></td>
            <td><a href="" class="rating_value" id="orating_<?php echo $incident_id; ?>"><?php echo $incident_rating; ?></a></td>
            <td><a href="" id="oloader_<?php echo $incident_id; ?>" class="rating_loading" ></a></td>
          </tr>
        </table>
			</div>
		</div>
		
		<?php
            // Action::report_extra - Allows you to target an individual report right after the description
            Event::run('ushahidi_action.report_extra', $incident_id);

			// Filter::comments_block - The block that contains posted comments
			Event::run('ushahidi_filter.comment_block', $comments);
			echo $comments;
		?>
		
		<?php
			// Filter::comments_form_block - The block that contains the comments form
			Event::run('ushahidi_filter.comment_form_block', $comments_form);
			echo $comments_form;
		?>
	
	</div>
	
	<div style="float:right;width:350px;">

		<div class="report-media-box-tabs">
			<ul>
				<li class="report-tab-selected"><a class="tab-item" href="#report-map"><?php echo Kohana::lang('ui_main.map');?></a></li>
				<?php if( count($incident_photos) > 0 ) { ?>
					<li><a class="tab-item" href="#report-images"><?php echo Kohana::lang('ui_main.images');?></a></li>
				<?php } ?>
				<?php if( count($incident_videos) > 0 ) { ?>
					<li><a class="tab-item" href="#report-video"><?php echo Kohana::lang('ui_main.video');?></a></li>
				<?php } ?>
			</ul>
		</div>
		
		<div class="report-media-box-content">
			
			<div id="report-map" class="report-map">
				<div class="map-holder" id="map"></div>
        <ul class="map-toggles">
          <li><a href="#" class="smaller-map">Smaller map</a></li>
          <li style="display:block;"><a href="#" class="wider-map">Wider map</a></li>
          <li><a href="#" class="taller-map">Taller map</a></li>
          <li><a href="#" class="shorter-map">Shorter Map</a></li>
        </ul>
        <div style="clear:both"></div>
			</div>
			
			<!-- start images -->
			<?php if( count($incident_photos) > 0 ) { ?>
				<div id="report-images" style="display:none;">
						<?php
						foreach ($incident_photos as $photo)
						{
							$thumb = str_replace(".","_t.",$photo);
							$prefix = url::base().Kohana::config('upload.relative_directory');
							echo '<a class="photothumb" rel="lightbox-group1" href="'.$prefix.'/'.$photo.'"><img src="'.$prefix.'/'.$thumb.'"/></a> ';
						}
						?>
				</div>
			<?php } ?>
			<!-- end images -->
			
			<!-- start videos -->
			<?php if( count($incident_videos) > 0 ) { ?>
				<div id="report-video" style="display:none;">
					<?php
						// embed the video codes
						foreach( $incident_videos as $incident_video) {
							$videos_embed->embed($incident_video,'');
						}
					?>
				</div>
			<?php } ?>
			<!-- end videos -->
		
		</div>
		<div class="report-additional-reports">
			<h4><?php echo Kohana::lang('ui_main.additional_reports');?></h4>
			<?php foreach($incident_neighbors as $neighbor) { ?>
			  <div class="rb_report">
  			  <h5><a href="<?php echo url::site(); ?>reports/view/<?php echo $neighbor->id; ?>"><?php echo $neighbor->incident_title; ?></a></h5>
  			  <p class="r_date r-3 bottom-cap"><?php echo date('H:i M d, Y', strtotime($neighbor->incident_date)); ?></p>
  			  <p class="r_location"><?php echo $neighbor->location_name.", ".round($neighbor->distance, 2); ?> Kms</p>
  			</div>
      <?php } ?>
		</div>

	</div>
	
	<div style="clear:both;"></div>
	
	
	
	
</div>
