<?php
/**
 * This is the basic Hero Slider structure
 * The markup is based on Swiper
 * @link  http://idangero.us/swiper/api/
 */

global $slides;

if (empty($slides->items)) {
	return;
}

?>

<section class="heroslider" data-display="<?php echo $slides->display ?>">

	<div class="<?php echo (count($slides->items) > 1) ? "swiper-container" : "hero-slider-container" ?>">

	 	<div class="swiper-wrapper">
		<?php
		global $image;
		foreach ($slides->items as $image) {
			HeroSlider()->get_template_part('slide', 'gallery');
		}
		?>
	    </div>

	    <?php if ($slides->content): ?>
    	<div class="heroslider-gallery-content">
    		<div class="container">
				<div class="swiper-content">
					<?php echo $slides->content; ?>
				</div>
			</div>
    	</div>
	    <?php endif ?>

	</div>

</section>