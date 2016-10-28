<?php
require 'init.php';

return array(
  'paths' => array(
    'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
  ),
  'environments' => array(
    'default_database' => 'turing',
    'turing' => array(
      'name' => 'turing',
      'connection' => turing_db(),
    )
  )
);
