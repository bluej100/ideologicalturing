<?php
require 'init.php';

$klein = new \Klein\Klein();

$klein->respond(function ($request, $response, $service, $app) {
  $service->startSession();
  $app->register('twig', function() {
    $twig = new Twig_Environment(new Twig_Loader_Filesystem('./templates'), array(
      'autoescape' => true,
      'cache' => './compilation_cache',
      'auto_reload' => true,
    ));
    $twig->addGlobal('OAUTH_CLIENT_ID', $_ENV['OAUTH_CLIENT_ID']);
    $twig->addGlobal('logged_in', isset($_SESSION['user']));
    return $twig;
  });
  $app->register('db', function() {
    return turing_db();
  });
});

$klein->respond('GET', '/', function ($request, $response, $service, $app) {
  return $app->twig->render('index.html', array(
    'topics' => $app->db->query('SELECT * FROM topics')->fetchAll(),
  ));
});

$klein->respond('GET', '/privacy', function ($request, $response, $service, $app) {
  return $app->twig->render('privacy.html');
});

$klein->respond('POST', '/auth', function($request, $response, $service, $app) {
  $service->validateParam('id_token')->notNull();
  $id_token = $_POST['id_token'];
  $response = file_get_contents("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=$id_token");
  $json = json_decode($response);
  $sub = $json->sub;
  $app->db->prepare('INSERT INTO users (sub, email, name, picture) VALUES (?, ?, ?, ?)')
    ->execute([$sub, $json->email, $json->name, $json->picture]);

  $sth = $app->db->prepare('SELECT * FROM users WHERE sub = ?');
  $sth->execute([$sub]);
  $_SESSION['user'] = $sth->fetch();
});

$klein->dispatch();
