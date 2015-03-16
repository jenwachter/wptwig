<?php

/**
 * Template for front page if front
 * page is assigned a static page
 */

// Get page data
$page = new \wptwig\Controllers\Page($post);
$data = $page->get();

// setup twig
$config = array("autoescape" => false);
$twig = new \wptwig\Workers\Twig(__DIR__ . "/src", $config);

// output
$twig->render("templates/page", $data);
