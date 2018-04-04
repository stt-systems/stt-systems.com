<?php //Template Name:Redirect
$new_url = get_post_meta($post->ID, 'url', true);
header('Location: ' . get_site_url() . $new_url); // mepty URLs will redirect to the homepage
exit;
?>