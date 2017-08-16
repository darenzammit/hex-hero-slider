<?php
/**
 * The Template for displaying an individual gallery slide
 */
global $image;
?>
<div class="swiper-slide" <?php echo sprintf(' style="background-image: url(%s)"', $image['url']); ?>></div>