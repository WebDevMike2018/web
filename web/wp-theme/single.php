<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body>
	<?php get_header(); ?>
	<div class="c1">
		<div>
			<?php
				if (have_posts()) {
					while (have_posts()) {
						the_post();
						get_template_part('template-parts/content', 'article');
					}
				}
			?>
		</div>
	</div>
</body>
</html>