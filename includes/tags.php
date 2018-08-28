<?php
// Add term page
add_action( 'post_tag_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );
function pippin_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[related_pages]"><?php _e( 'Related pages' ); ?></label>
		<input type="text" name="term_meta[related_pages]" id="term_meta[related_pages]" value="">
		<p class="description"><?php _e( 'Comma separated list of slugs related to this tag' ); ?></p>
	</div>
<?php
}

// Add the fields to the "related_pages" taxonomy, using our callback function
add_action( 'post_tag_edit_form_fields', 'tag_taxonomy_custom_fields', 10, 2 );
function tag_taxonomy_custom_fields($tag) {
   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="related_pages"><?php _e('Related pages'); ?></label>
	</th>
	<td>
		<input type="text" name="term_meta[related_pages]" id="term_meta[related_pages]" size="25" style="width:60%;" value="<?php echo $term_meta['related_pages'] ? $term_meta['related_pages'] : ''; ?>"><br />
		<span class="description"><?php _e('Comma separated list of slugs related to this tag'); ?></span>
	</td>
</tr>

<?php
}

// A callback function to save our extra taxonomy field(s)
add_action( 'edited_post_tag', 'save_taxonomy_custom_fields', 10, 2 );
add_action( 'create_post_tag', 'save_taxonomy_custom_fields', 10, 2 );
function save_taxonomy_custom_fields( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_term_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ){
			if ( isset( $_POST['term_meta'][$key] ) ){
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		//save the option array
		update_option( "taxonomy_term_$t_id", $term_meta );
	}
}

function print_related_pages() {
	$pages = array();
	if (is_tag()) {
		$tag = get_queried_object()->term_id;
		$term_meta = get_option( "taxonomy_term_$tag" );
		if (empty($term_meta['related_pages'])) return;
		
		$pages = explode(',', $term_meta['related_pages']);
	} else {
		global $post;
		$tags = wp_get_post_tags($post->ID, array('fields' => 'ids'));
		$related = array();
		foreach ($tags as $tag) {
			$term_meta = get_option("taxonomy_term_$tag");
			if (empty($term_meta['related_pages'])) continue;
			$related = array_merge($related, explode(',', $term_meta['related_pages']));
		}
		
		$pages = array_unique($related);
	}

	if (count($pages) == 0) return;
	
	?><h4>Related pages</h4><?php
	foreach ($pages as $page) {
		echo '<p>' . get_page_full_link($page) . '</p>';
	} ?>
	<?php
}
?>