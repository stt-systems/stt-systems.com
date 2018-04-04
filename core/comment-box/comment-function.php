<?php
if ( ! function_exists( 'weblizar_comment' ) ) :
function weblizar_comment( $comment, $args, $depth ) 
{	//get theme data
    $GLOBALS['comment'] = $comment;
	global $comment_data;

	//translations
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : 
	__('Reply','weblizar'); ?>	 
        <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-content">
			<div class="comment-author-avatar">
            <?php echo get_avatar($comment,$size = '60'); ?>
            </div>
           <div class="comment-details">
			    <div class="comment-author-name">
					<span><?php comment_author();?></span>
					<span class="comment-date"><?php comment_date('F j, Y');?>&nbsp;<?php _e('at','weblizar');?>&nbsp;<?php comment_time('g:i a'); ?></span>
									
					<a class="comment-reply" href=""><?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</a>
					<div class="comment-body">
						<?php comment_text() ; ?>
					</div>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'weblizar' ); ?></em>
				<br/>
				<?php endif; ?>	
			</div>
		</div>
<?php
}
endif;
add_filter('get_avatar','wl_add_gravatar_class');
function wl_add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='comment_img", $class);
    return $class;
}
?>