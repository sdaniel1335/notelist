<?php
return array(
  'GET' => array(
    '/' => array('controller' => 'pages', 'class' => 'pages', 'action' => 'index'),
    '/note' => array('controller' => 'pages', 'class' => 'pages', 'action' => 'edit'),
    '/login' => array('controller' => 'auth', 'class' => 'auth', 'action' => 'login')
  ),
  'POST' => array(
    '/note/save' => array('controller' => 'pages', 'class' => 'pages', 'action' => 'save'),
    '/note/delete' => array('controller' => 'pages', 'class' => 'pages', 'action' => 'delete'),
    '/login' => array('controller' => 'auth', 'class' => 'auth', 'action' => 'login_post'),
    '/logout' => array('controller' => 'auth', 'class' => 'auth', 'action' => 'logout')
  )
);
