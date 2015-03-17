<?php

namespace wptwig\Models;

class Post extends Base
{
  public function __construct($post)
  {
    parent::__construct($post);
  }

  public function get()
  {
    $data = parent::get();

    // modify data for posts, if needed

    return $this->forceArray($data);
  }
}
