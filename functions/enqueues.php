<?php
/*
 * Enqueues
 */

if ( ! function_exists('b5st_enqueues') ) {
	function b5st_enqueues() {

		// Styles

		wp_register_style('bootstrapIcons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css', false, '1.9.1', null);
		wp_enqueue_style('bootstrapIcons');

		wp_register_style('theme', get_template_directory_uri() . '/theme/css/b5st.css', false, null);
		wp_enqueue_style('theme');

		// Scripts

		wp_register_script('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js', false, '5.2.1', true);
		wp_enqueue_script('bootstrap5');

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

	}
}
add_action('wp_enqueue_scripts', 'b5st_enqueues', 100);
