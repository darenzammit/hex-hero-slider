<?php
/**
 * The Template for displaying an individual slide
 */
?>
<div class="swiper-slide">
	<div class="swiper-slide-background"
	<?php if(has_post_thumbnail()) echo sprintf(' style="background-image: url(%s)"', wp_get_attachment_url(get_post_thumbnail_id())); ?>
	></div>
	<div class="container">
		<div class="swiper-content">
			<?php echo wpautop(get_the_content());?>
			<?php //button ?>
		</div>
	</div>
</div>