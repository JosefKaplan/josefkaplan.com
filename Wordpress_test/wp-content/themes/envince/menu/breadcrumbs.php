<?php if ( function_exists( 'breadcrumb_trail' ) && !is_page_template( 'template-magazine.php' ) ) : // Check for breadcrumb support. ?>

	<?php breadcrumb_trail(
		array(
			'container'     => 'nav',
			'separator'     => '>',
			'show_on_front' => false,

			'labels'        => array(
				'browse' => __( 'You are here:', 'envince' )
			)
		)
	); ?>

<?php endif; // End check for breadcrumb support. ?>