<?php get_header(); ?>

<div id="content">

	<div class="padder">

		<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'buddy' ); ?></h1>

		<h2><?php esc_html_e( 'Oops, it looks like this page does not exist.', 'buddy' ); ?></h2>

		<div class="gp-search">
		
			<p><?php esc_html_e( 'If you are lost use the search form below or visit our', 'buddy' ); ?> <a href="<?php esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'homepage', 'buddy' ); ?></a></p>
	
			<?php get_search_form(); ?>
	
		</div>

		<div class="clear"></div>

	</div>

</div>

<?php get_footer(); ?>