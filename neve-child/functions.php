<?php
/**
 */  

add_action( 'wp_enqueue_scripts', 'neve_child_style' );
				function neve_child_style() {
					wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
					wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
				}

/**
 */

