<?php
/**
 * Header template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js theme-html">
	<head>
		<script type="text/javascript" src="//cdn.callreports.com/companies/298961810/2cd54538642768f7e141/12/swap.js"></script>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MLH7QZX');</script>
		
		<?php
			/**
			 * @package heymk-widget
			 * @version 1.0
			 */
			/*
			Plugin Name: Heymarket Wordpress Widget
			Plugin URI: https://www.heymarket.com
			Description: This plugin allows you to insert the Heymarket web widget into your Wordpress site.
			Author: Anthony Pelot
			Version: 1.0
			Author URI: https://www.heymarket.com
			*/
			function heymk_widget() { ?><script type='text/javascript'>
		(function(_a,id,a,_) {
		function Modal(){
			var h = a.createElement('script'); h.type = 'text/javascript'; h.async = true;
			var e = id; h.src = e+(e.indexOf("?")>=0?"&":"?")+'ref='+_;
			var y = a.getElementsByTagName('script')[0]; y.parentNode.insertBefore(h, y);
			h.onload = h.onreadystatechange = function() {
			var r = this.readyState; if (r && r != 'complete' && r != 'loaded') return;
			try { HeymarketWidget.construct(_); } catch (e) {}
			};
		};
		(_a.attachEvent ? _a.attachEvent('onload', Modal) : _a.addEventListener('load', Modal, false));
		})(window,'https://widget.heymarket.com/heymk-widget.bundle.js',document,{
		CLIENT_ID: "1DcOHvYcMGf6RsUwnA3yVoFfWSXwGEb2HAjKm1OU"
		});
		</script><?php }
			add_action( 'wp_head', 'heymk_widget', 10 );
    	?>

		<!-- Hotjar Tracking Code for Hemmat Law Group -->
		<script>
			(function(h,o,t,j,a,r){
				h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
				h._hjSettings={hjid:3227883,hjsv:6};
				a=o.getElementsByTagName('head')[0];
				r=o.createElement('script');r.async=1;
				r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
				a.appendChild(r);
			})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
		</script>

		<script>
			  window.markerConfig = {
			    project: '65569dde88dbbdb9743b58bc', 
			    source: 'snippet'
			  };

			!function(e,r,a){if(!e.__Marker){e.__Marker={};var t=[],n={__cs:t};["show","hide","isVisible","capture","cancelCapture","unload","reload","isExtensionInstalled","setReporter","setCustomData","on","off"].forEach(function(e){n[e]=function(){var r=Array.prototype.slice.call(arguments);r.unshift(e),t.push(r)}}),e.Marker=n;var s=r.createElement("script");s.async=1,s.src="https://edge.marker.io/latest/shim.js";var i=r.getElementsByTagName("script")[0];i.parentNode.insertBefore(s,i)}}(window,document);
		</script>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php 
			wp_head();
			get_template_part('src/views/partials/header', 'before-body'); 
		?>
	</head>
    <body <?php body_class(); ?>>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MLH7QZX"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
		<?php get_template_part('src/views/partials/header', 'body-start'); ?>

		<div id="page-main" class="body-unload">
                        
			<?php get_template_part('src/views/partials/header', 'content');  ?>
            