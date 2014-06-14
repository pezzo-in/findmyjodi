<?php
	class NivoSlider{
		private $slides;
		private $base_path;
		private $files_included;
		
		private $width;
		private $height;

		private $options;

		function __construct($base_path,$width,$height){

			$this->base_path=$base_path;
			$this->files_included=false;
			$this->width=$width;
			$this->height=$height;
/*			
			$this->options['effect']='random';
			$this->options['slices']='15';
			$this->options['animSpeed']='random';
			$this->options['pauseTime']='random';
			$this->options['startSlide']='random';
			$this->options['directionNav']='random';
			$this->options['directionNavHide']='random';
			$this->options['controlNav']='random';
			$this->options['controlNavThumbs']='random';
			$this->options['controlNavThumbsFromRel']='random';
			$this->options['controlNavThumbsSearch']='random';
			
        :'', //Specify sets like: 'fold,fade,sliceDown'
        :15,
        :500, //Slide transition speed
        :3000,
        :0, //Set starting Slide (0 index)
        :true, //Next & Prev
        :true, //Only show on hover
        :true, //1,2,3...
        :false, //Use thumbnails for Control Nav
        :false, //Use image rel for thumbs
        : '.jpg', //Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
        keyboardNav:true, //Use left & right arrows
        pauseOnHover:true, //Stop animation while hovering
        manualAdvance:false, //Force manual transitions
        captionOpacity:0.8, //Universal caption opacity
			
		}
*/

		/*
		* 	function add_slide
		*	$img_path : the path of image
		* 	$link : the click url i.e where to go when this slide is clicked
		*	$caption : the text to be displayed on the slide
		*/
	}
		function add_slide($img_path,$link,$caption){
			$this->slides[]=array('path'=>$img_path, 'link'=> $link, 'caption'=> $caption);
		}
		function set_option($name,$value){
		}
		function render_includes(){
			$this->files_included=true;
?>
    <link rel="stylesheet" href="../second/css/nivo-slider.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../second/js/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="../second/js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({pauseTime:3500,effect:"sliceDown"});
    });
    </script>
    <style>
		#slider {
			/*position:relative;*/
			width:<?php echo $this->width; ?>px;
			height:<?php echo $this->height; ?>px;
			margin-left:190px;
			background:url(images/loading.gif) no-repeat 50% 50%;
		}
	</style>
<?php
		}
		function render_slides(){
			if(!$this->files_included){
				echo '<span style="color:#f00">Nivo Slider include files are missing, please call render_includes() in the &lt;head&gt; &lt;/head&gt; section</span>';
				return;
		}
?>
<div id="wrapper">
	<div id="slider-wrapper">
		<div id="slider" class="nivoSlider">
		<?php
			foreach($this->slides as $index=>$slide){
				if($slide['link']=='')
					echo '<img src="'.$slide['path'].'" alt="" title="#slide'.$index.'" height="300px" width="300px" />';
				else
					echo '<a href="'.$slide['link'].'"><img src="'.$slide['path'].'" alt="" title="#slide'.$index.'" height="300px" width="300px" /></a>';
			}
		?>
		</div>
		<?php
			echo "\r\n\r\n";
			reset($this->slides);
			foreach($this->slides as $index=>$slide){
				echo '<div id="slide'.$index.'" class="nivo-html-caption">'.$slide['caption'].'</div>';
			}
		?>
	</div>
</div>
<?php
		}
	}
?>