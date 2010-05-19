<playlist version="1" xmlns="http://xspf.org/ns/0/">
  <title>CG Playlist</title>
  <trackList>
		<?php foreach ($aryVideoList as $aryVideo) { 
			$img = ($aryVideo["video_image"]) ? $this->iht_common->get_thumb(IMG_THUMB_VIDEO_PATH.$aryVideo["video_image"]) : '';
			$file = IMG_VIDEO_PATH.$aryVideo["file_real_name"];
			?>
			<track>
			  <title><?php echo $aryVideo["file_name"]; ?></title>
			  <location><?php echo $file;?></location>
			  <image><?php echo $img; ?></image>
			</track>
			<?php
		}
		?>
  </trackList>
</playlist>