<?php get_header(); ?>
<div class="top-title-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 page-info">
                <h1 class="page-title"><?php printf( __( 'Author Archives: %s', 'stt' ), get_the_author() ); ?></h1>				
            </div>
        </div>
    </div>
</div>
<div class="space-sep20"></div>	
<div class="content-wrapper"><div class="body-wrapper">
    <div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-9">
			<h1></h1>
			<?php while(have_posts()):the_post();
					global $more; $more = 0;
					get_template_part( 'content', get_post_format() );
					endwhile; ?>				 
				<div class="pagination"><?php
					if ( get_next_posts_link() ):
					next_posts_link('<span class="prev">&larr;</span>'.__('Older posts', 'stt' ) );
					endif;
					
					if ( get_previous_posts_link() ): 
					previous_posts_link( __( 'Newer posts', 'stt' ). '<span class="next">&rarr;</span>' ); 
					endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>