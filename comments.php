<?php if ( post_password_required() ): ?>
	<?php _e( 'This post is password protected. Enter the password to view any comments.', 'weblizar' ); ?></p>
	<?php return; endif; ?>
    <?php if ( have_comments() ): ?>
	 <div class="comments">
        <div class="blog-span">
		<div class="title-block clearfix">	
			<h3 class="h3-body-title"><?php echo comments_number('No Comments', '1 Comment', '% Comments'); ?></h3>
			<div class="title-seperator"></div>
		</div>			
			<ol class="comments-list">
			<?php wp_list_comments( array( 'callback' => 'weblizar_comment' ) ); ?>
			</ol>
		</div>
	</div>		
	<?php endif; ?>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
		<nav id="comment-nav-below">			
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'weblizar' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'weblizar' ) ); ?></div>
		</nav>
		<?php endif;  ?>
<?php if ( comments_open() ) : ?>
	<div class="row">
	 <div class="blog-span">							
	<?php  
	 $fields=array(
		'author' => '<div class="form-group clearfix"><label class="control-label col-xs-2" id="name">Name *</label><div class="col-xs-6"><input required class="form-control" name="author" id="author" value="" type="text"/></div></div>',
		'email' => '<div class="form-group clearfix"><label class="control-label col-xs-2" for="user-email" id="user-email"> E-mail *</label><div class="col-xs-6"><input  required class="form-control" name="email" id="user-email" value=""   type="text" ></div></div>',
		'website' => '<div class="form-group clearfix"><label class="control-label col-xs-2" for="website_url" id="website_url">Website *</label><div class="col-xs-6"><input required class="form-control" name="website_url" id="website_url" value=""   type="text" ></div></div>',
		);
	function my_fields($fields) { 
		return $fields;
	}
	add_filter('comment_form_default_fields','my_fields');
		$defaults = array(
		'fields'=> apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'=> '<div class="form-group clearfix"><label for="message" class="control-label col-xs-2"> Message *</label>
		<div class="col-xs-8"><textarea name="comment" id="comment" class="form-control"></textarea></div></div><div class="space-sep-10"></div>',		
		'logged_in_as' => '<p class="logged-in-as">' . __( "Logged in as ",'weblizar' ).'<a href="'. admin_url( 'profile.php' ).'">'.$user_identity.'</a>'. '<a href="'. wp_logout_url( get_permalink() ).'" title="Log out of this account">'.__(" Log out?",'weblizar').'</a>' . '</p>',
		
		'class_submit' => 'btn btn-primary',
		'label_submit'=>__( 'Send','weblizar'),
		'comment_notes_before'=> '',
		'comment_notes_after'=>'<div class="form-group clearfix"><label class="control-label col-xs-2"></label><div class="col-xs-6">                    <input type="submit" class="btn btn-primary" value="Send">                </div>
            </div>',
		'title_reply'=> '<div class="title-block clearfix"><h3 class="h3-body-title">Leave A Comment</h3><div class="title-seperator"></div></div>',
		'id_form'=> 'comment-form',
		'class_form'=> 'form-wrapper'
		);
		comment_form($defaults); ?>		
		</div>
</div>
<?php endif; ?>