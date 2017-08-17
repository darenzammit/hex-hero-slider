# Hex Hero Slider

Slider plugin based on ACF and Swiper.

Can be used with or without front-end

## Filters

```
add_filter('hex/hero_slider/load_frontend_scripts', '__return_false');
```
Use to Disable Frontend functionality

```
add_filter('hex/hero_slider/load_frontend_style', '__return_false');
```
Use to exclude the slide styling

```
add_filter('hex/hero_slider/show_on', function(){
	//Return true false if conditions are met
});
```