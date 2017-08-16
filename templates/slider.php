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

<section class="heroslider">

	<div class="<?php echo (count($slides->items) > 1) ? "swiper-container" : "hero-slider-container" ?>">

	 	<div class="swiper-wrapper">
		<?php
		global $post;
		foreach ($slides->items as $post) {
			setup_postdata($post);
			HeroSlider()->get_template_part('slide');
		}
		wp_reset_postdata();
		?>
	    </div>

	    <?php if (count($slides->items) > 1): ?>
	    	<div class="swiper-pagination swiper-pagination-white"></div>
	    <?php endif ?>

		<?php if (get_field('hero_slider_fullscreen', $slides->object_id)): ?>
			<a href="#main" class="heroslider-scroll-down"><span class="icon-arrow"></span></a>
		<?php endif ?>

	</div>

</section>