<header class="h1">
	<nav class="h2">

		<a class="h3" href=""><?php echo get_bloginfo('name'); ?></a>
		<?php
		wp_nav_menu([
			'menu' => 'header_right',
			'menu_class' => 'h4',
			'theme_location' => 'header_right'
		]);
		?>
	</nav>
</header>