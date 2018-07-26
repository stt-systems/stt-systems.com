<?php
if (!is_user_logged_in()) {
  exit;
}

$old_path = getcwd();
chdir(get_template_directory());
echo shell_exec('git pull');
chdir($old_path);
?>