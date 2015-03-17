<?php

/**
 * Template for front page if front
 * page is assigned a static page
 */

$page = new \wptwig\Controllers\Page($post);
$page->show();
