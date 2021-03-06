<?php
	/**
	 * The template for displaying 404 pages (Not Found).
	 */

	if ( !defined('ABSPATH') ){ //Redirect (for logging) if accessed directly
		header('Location: http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], "wp-content/")) . '?ndaat=' . basename($_SERVER['PHP_SELF']));
		exit;
	}

	do_action('nebula_preheaders');
	get_header();
?>

<?php get_template_part('inc/headercontent'); ?>
<?php get_template_part('inc/nebula_drawer'); ?>

<section id="content-section">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php nebula()->breadcrumbs(); ?>
			</div><!--/col-->
		</div><!--/row-->
		<div class="row">
			<main id="top" class="col-md" role="main">
				<article id="post-0" class="post error404 not-found">
					<?php if ( get_theme_mod('title_location') === 'content' ): ?>
						<h1 class="page-title">Not Found</h1>
						<p>The page you requested could not be found.</p>
					<?php endif; ?>

					<?php echo nebula()->search_form(); ?>

					<?php if ( !empty(nebula()->error_query) && nebula()->error_query->have_posts() ): //Check if the error query (from /libs/Functions.php) found any matches ?>
						<div id="error-page-suggestions">
							<h2>Suggestions</h2>
							<?php while ( nebula()->error_query->have_posts() ): ?>
								<?php nebula()->error_query->the_post(); ?>

								<h3 class="suggestion-title entry-title">
									<?php if ( strpos(get_permalink(), nebula()->slug_keywords) ): ?>
										<i class="fa fa-fw fa-star" title="Exact match"></i>
									<?php endif; ?>

									<a class="internal-suggestion" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
						    <?php endwhile; ?>
							<p><a href="<?php echo home_url('/'); ?>?s=<?php echo str_replace('-', '+', nebula()->slug_keywords); ?>">View all results &raquo;</a></p>
						</div>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
				</article>
			</main><!--/col-->

			<?php get_sidebar(); ?>
		</div><!--/row-->
	</div><!--/container-->
</section>

<?php get_footer(); ?>