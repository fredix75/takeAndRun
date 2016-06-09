<?php
	include_once('class/Channels.class.php');

	$channel=new Channel();
	
	require_once('inc/magpierss-0.72/rss_fetch.inc');
	$chan1="http://gdata.youtube.com/feeds/api/users/connassecanal/uploads?orderby=updated";
	$chan2="http://gdata.youtube.com/feeds/api/users/GrolandCANAL/uploads?orderby=updated";
	$chan2="http://gdata.youtube.com/feeds/api/users/JoeBonamassaTV/uploads?orderby=updated";
	$chaine = fetch_rss($chan2);
	$arrayChannel=$chaine->items;
?>
<div id="content">
<?php
	for($i=0;$i<8;$i++){
?>
	
	<a class="lienvideo" href="<?php echo $channel->formatLink($arrayChannel[$i]['link']);?>"><div>
<?php			
		echo $channel->getImgVideo($arrayChannel[$i]['link'],175,100);
		echo $arrayChannel[$i]['atom_content']
?>
	</div></a>
<?php	
	}
	print_r($arrayChannel);
?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.lienvideo').magnificPopup({
		  type: 'iframe',
		  iframe: {
		    patterns: {
		      dailymotion: {
		        index: 'dailymotion.com',
		        id: function(url) {        
		            var m = url.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/);
		            if (m !== null) {
		                if(m[4] !== undefined) {
		                    return m[4];
		                }
		                return m[2];
		            }
		            return null;
		        },
		        src: 'http://www.dailymotion.com/embed/video/%id%'		        
		      },
		     youtube: {
			      index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
			      id: 'v=', // String that splits URL in a two parts, second part should be %id%
			      // Or null - full URL will be returned
			      // Or a function that should return %id%, for example:
			      // id: function(url) { return 'parsed id'; } 	
			      src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
			  }
		    }
		  }
		});
	});
</script>
<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>