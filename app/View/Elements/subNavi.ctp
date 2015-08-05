<div class="hmcntleft">
	<div class="whatisfxchg">
		<a class="whatisfxchng" >What is Fxchng</a>
		<a class="video-link" href="#" rel="prettyPhoto" title="What is Fxchng" id="what_is_fxchng">
			Watch video <i class="fa fa-play"></i>
		</a>
	</div>
    <!-- <div class="buttonvideo buttonvideoleft gallery">
		<a href="https://www.youtube.com/watch?v=0jiH9VF_ykE" rel="prettyPhoto" title="What is Fxchng"><img src="./img/btn_watch_video.jpg"  /></a>
	</div> -->
</div>
<div class="hmcntright">
	<div class="howitswork">
		<a class="howitsworks">How It Works</a>
		<a class="video-link" href="#" rel="prettyPhoto" title="How It Works" id="how_it_works">
			Watch video <i class="fa fa-play"></i>
		</a>
	</div>
    <!-- <div class="buttonvideo buttonright gallery">
		<a href="https://www.youtube.com/watch?v=8k4lf0yEXBs" rel="prettyPhoto" title="How It Works"><img src="./img/btn_watch_video_bule.jpg" /></a>
	</div> -->
</div>
<div class="clear"></div>
</div>

<style>
	.animatehere{display:block!important; font-family:Arial, Helvetica, sans-serif; padding:10px; border:1px solid #ccc; width:960px; position:absolute; background:#fff; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000; bottom:0; left:15%; border-radius:5px;}
	.animatehere2{display:block!important; font-family:Arial, Helvetica, sans-serif; padding:10px; border:1px solid #ccc; width:960px; position:absolute; background:#fff; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000; bottom:0; left:15%; border-radius:5px;}
	.whatisfxchng{cursor:pointer;}
	.howitsworks{cursor:pointer;}
	.pp_full_res iframe {width:100%!important;}
</style>
<script>
$(document).ready(function() {

	// check if site opened or not..if not then show video
	if (is_open != 'yes') {
		$.fn.prettyPhoto();
		$.prettyPhoto.open('<a href="https://www.youtube.com/watch?v=0jiH9VF_ykE?width=50%&amp;height=100%" rel="prettyPhoto" title="What is Fxchng"><img src="./img/btn_watch_video.jpg" /></a>');
	}

	// open what is fx_chang by preetyphoto
	$('#what_is_fxchng').click(function() {
		$.fn.prettyPhoto();
		$.prettyPhoto.open('<a href="https://www.youtube.com/watch?v=0jiH9VF_ykE?width=50%&amp;height=100%" rel="prettyPhoto" title="" alt="YouTube" width="60" /></a>');
	});

	// open what is fx_chang by preetyphoto
	$('#how_it_works').click(function() {
		$.fn.prettyPhoto();
		$.prettyPhoto.open('<a href="https://www.youtube.com/watch?v=8k4lf0yEXBs?width=50%&amp;height=100%" rel="prettyPhoto" title="" alt="YouTube" width="60" /></a>');
	});

// $(".whatisfxchng").click(function() {
//     $(".what").addClass("bounceInUp");
// 	 $(".what").addClass("animatehere");
// 	 $(".how").removeClass("animatehere2");
// 	  $(".how").removeClass("animatehere2");
// 	 $(".how").removeClass("bounceInUp");
//   });
//   $(".close").click(function(){
// 	 $(".what").removeClass("animatehere");
// 	 $(".what").removeClass("bounceInUp");
//   });
//   $(".howitsworks").click(function() {
//     $(".how").addClass("bounceInUp");
// 	 $(".how").addClass("animatehere2");
// 	 $(".what").removeClass("animatehere");
// 	 $(".what").removeClass("bounceInUp");

//   });
//   $(".close").click(function() {
// 	 $(".how").removeClass("animatehere2");
// 	 $(".how").removeClass("bounceInUp");
//   });
});
</script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("area[rel^='prettyPhoto']").prettyPhoto();

		$(".gallery a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
		$(".gallery a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

		$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
			custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
			changepicturecallback: function(){ initialize(); }
		});

		$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
			custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
			changepicturecallback: function(){ _bsap.exec(); }
		});
	});
</script>