<?php

namespace wptwig\Models;

class Page extends Base
{
  public function __construct($post)
  {
    parent::__construct($post);
  }

  public function get()
  {
    $data = parent::get();

    // modify data for pages, if needed

    return $this->forceArray($data);
  }
}
