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
		<div class="c2">
			<?php
				if (is_active_sidebar('sidebar-1')) {
					dynamic_sidebar('hero-image');
				}
			?>
			<div class="c3">
				<?php
					if (is_active_sidebar('sidebar-2')) {
						dynamic_sidebar('text-1');
					}
					if (is_active_sidebar('sidebar-3')) {
						dynamic_sidebar('text-2');
					}
				?>
			</div>
			<div class="c6">
				<?php
					if (have_posts()) {
						while (have_posts()) {
							the_post();
							$s_excerpt = get_the_excerpt();
							$s_permalink = get_the_permalink();
							$s_thumbnail = get_the_post_thumbnail_url($post, 'medium');
							$s_title = get_the_title();
							echo "<div class='c7'><div class='c8'><img src='{$s_thumbnail}'></div><div class='c9'><div class='c10'>{$s_title}</div><div class='c11'>{$s_excerpt}</div><div class='c12'><a href='{$s_permalink}'>Read more...</a></div></div></div>";
						}
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>