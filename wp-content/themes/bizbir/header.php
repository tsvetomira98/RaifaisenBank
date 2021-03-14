<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * Bizbir
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<?php bizbir_after_head(); ?>
</head>

<body <?php body_class( 'bizbir-theme-template' ); ?>>

	<?php wp_body_open(); ?>

	<?php bizbir_body_top(); ?>

	<div id="page" class="site">

		<?php bizbir_before_header(); ?>

		<?php bizbir_header(); ?>

		<?php bizbir_after_header(); ?>

		<div id="content" class="site-content <?php echo esc_attr(  bizbir_sidebar_class() ); ?>">

				<div class="container">

					<div class="inner-wrapper">