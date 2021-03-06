<?php
// Remove unwanted Yoast SEO features, or those that are handled manually
function remove_yoast_json($data){
	$data = array();
	return $data;
}
add_filter('wpseo_json_ld_output', 'remove_yoast_json', 10, 1);
add_filter('disable_wpseo_json_ld_search', '__return_true');

function print_meta() {
	global $post;

	if ((strpos(get_page_template(), 'page-empty.php') !== false) or post_password_required()) { // 404 already adds the meta tag ?>
		<meta name="robots" content="noindex"><?php
		return;
	}
	
	$title = get_the_title() . ' | STT Systems';
	$url = get_permalink();
	$type = 'article';

	$mocap_category = get_category_by_slug('motion-analysis');
	$industry_category = get_category_by_slug('industry');
  $use_post_image = ($mocap_category and in_category($mocap_category->term_id)) or
                    ($industry_category and in_category($industry_category->term_id));
	if (!is_front_page() and !is_page() and $use_post_image) {
		$image = get_post_meta($post->ID, 'image', true);
	} else { 
		if (is_front_page()) {
			$url = get_site_url();
			$title = "STT Systems";
			$type = 'website';
		}
		$image = 'logos/stt-social.jpg';
	}
	?>
	
	<meta name="description" content="<?php echo get_bloginfo('description'); ?>"/>

	<meta property="og:locale" content="en_US"/>
	<meta property="og:type" content="<?php echo $type; ?>"/>
	<meta property="og:title" content="<?php echo $title; ?>"/>
	<meta property="og:url" content="<?php echo $url; ?>"/>
	<meta property="og:image" content="<?php echo get_upload_url($image); ?>"/>
	<?php
	if (is_front_page()) {?>
		<meta property="og:site_name" content="STT Systems"/><?php
	}?>

	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:title" content="<?php echo $title; ?>"/>
	<meta name="twitter:image" content="<?php echo get_upload_url($image); ?>"/>
	<meta name="twitter:site" content="@STTSystems"/>
	<meta name="twitter:creator" content="@STTSystems"/>
	<?php
}

function print_page_breadcrumbitem($title, $url, $pos) {?>
{"@type":"ListItem","position":<?php echo $pos;?>,"item":{"@id":"<?php echo $url;?>","name":"<?php echo $title;?>"}}
<?php
}
function add_page_breadcrumblist() {
	$path = get_ancestors(get_the_ID(), 'page');
	if (count($path) > 0) { ?>
<script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[<?php
		$pos = 1;
		for ($i = count($path) - 1; $i >= 0; --$i) {
			$item = get_post($path[$i]);
			$url = get_permalink($path[$i]);
			print_page_breadcrumbitem($item->post_title, $url, $pos);
			echo ',';
			++$pos;
		}
		print_page_breadcrumbitem(get_the_title(), get_permalink(), $pos); ?>
]}</script><?php
	}	
}

function schema_head() {
	$structured_data = json_encode(json_decode('[
	{
		"@context": "https://schema.org",
		"@type": "WebSite",
		"url": "${URL}",
		"name": "STT Systems",
		"alternateName": "STT Ingenier\u00eda y Sistemas",
		"potentialAction": {
			"@type": "SearchAction",
			"target": "${URL}/?s={search_term_string}",
			"query-input": "required name=search_term_string"
		}
	},{
		"@context": "https://schema.org",
		"@type": "Organization",
		"name": "STT Systems",
		"logo": "${URL}/images/logos/stt-social.jpg",
		"url": "${URL}/",
		"sameAs": [
			"https://www.facebook.com/STTSystems/",
			"https://www.instagram.com/stt.systems",
			"https://www.linkedin.com/company/stt-systems",
			"https://www.youtube.com/user/SttSystems",
			"https://twitter.com/STTSystems"
		]
	},{
		"@context": "https://schema.org",
		"@type": "Organization",
		"url": "${URL}",
		"logo": "${URL}/images/logos/logo@2x.png"
	}
	]'));

	$structured_data = str_replace('${URL}', get_site_url(), $structured_data);
	
	echo "<script type=\"application/ld+json\">$structured_data</script>";
}

function disable_front_page_wpseo_next_rel_link($link) {
	if (is_front_page()) return false;
	return $link;
}
add_filter('wpseo_next_rel_link', 'disable_front_page_wpseo_next_rel_link');

?>