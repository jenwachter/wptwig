<?php

namespace wptwig\Controllers;

class Page
{
  protected $post;

  public function __construct($post)
  {
    $this->model = new \wptwig\Models\Page($post);
  }

  public function get()
  {
    return $this->model->get();
  }
}
