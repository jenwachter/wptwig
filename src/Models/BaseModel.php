<?php

namespace wptwig\Models;

class BaseModel
{
  /**
   * WordPress post object
   * @var object
   */
  protected $post;

  /**
   * Stores all model data
   * @var object
   */
  public $data = array();


  public function __construct($post)
  {
    $this->post = $post;
  }

}
