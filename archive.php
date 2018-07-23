<?php get_header(); ?>
<div class="top-title-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 page-info">
                <h1 class="page-title">
				<?php if ( is_day() ) : ?>
				<?php  _e( "Daily Archives:", 'stt' ); echo (get_the_date()); ?>
				<?php elseif ( is_month() ) : ?>
				<?php  _e( "Monthly Archives:", 'stt' ); echo (get_the_date( 'F Y' )); ?>
				<?php elseif ( is_year() ) : ?>
				<?php  _e( "Yearly Archives:", 'stt' );  echo (get_the_date( 'Y' )); ?>
				<?php else : ?>
				<?php _e( "Blog Archives", 'stt' ); ?>
				<?php endif; ?>				
				</h1>				
            </div>
        </div>
    </div>
</div>
<div class="space-sep20"></div>	

<div class="content-wrapper"><div class="body-wrapper">
    <div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8">
			<?php 	while(have_posts()):the_post();
					global $more; $more = 0; 
					get_template_part( 'content', get_post_format() );
					endwhile; ?>				
				
				<div class="pagination">
					<?php if ( get_next_posts_link() ): ?>
						<?php next_posts_link('<span class="prev">&larr;</span>'.__('Older posts', 'stt' ) ); ?>
						<?php endif; ?>
						<?php if ( get_previous_posts_link() ): ?>
						<?php previous_posts_link( __( 'Newer posts', 'stt' ). '<span class="next">&rarr;</span>' ); ?>
						<?php endif; ?>					
					
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>