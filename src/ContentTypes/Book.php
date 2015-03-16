<?php

namespace wptwig\ContentTypes;

class Book
{
  protected $name = "Book";

  public function __construct()
  {
    $args = array(
      "public" => true,
      "label"  => "Books"
    );
    
    register_post_type($this->name, $args);
  }

}
