<?php

namespace wptwig\Models;

use \wptwig\Workers\CaptureEcho;

abstract class Base
{
  /**
   * WordPress post
   * @var object
   */
  protected $post;

  /**
   * Stores all model data
   * @var object
   */
  public $data = array();

  /**
   * __construct
   * @param object $post WordPress post
   */
  public function __construct($post)
  {
    $this->post = $post;
  }

  /**
   * Fetch data to pass to template for rendering
   * @return array
   */
  public function get()
  {
    $data = array(
      "post" => $this->getPost(),
      "site_data" => $this->getSiteData()
    );

    // force array for twig
    return $this->forceArray($data);
  }

  /**
   * Twig has trouble object data,
   * so force the data to be an array.
   * @param mixed $data Array/object
   * @return array
   */
  protected function forceArray($data)
  {
    return json_decode(json_encode($data), true);
  }

  /**
   * Get post and associated metadata
   * @return object
   */
  protected function getPost()
  {
    $post = $this->post;
    $post->meta = get_post_meta($this->post->ID);

    return $post;
  }

  /**
   * Get data needed for all post/page rendering
   * @return array
   */
  protected function getSiteData()
  {
    return array(
      "charset" => get_bloginfo("charset"),
      "header" => CaptureEcho::capture("wp_head"),
      "footer" => CaptureEcho::capture("wp_footer"),
      "body_classes" => $this->getBodyClasses()
    );
  }

  /**
   * Fetch WordPress-generated body classes
   * @return array Array of class names
   */
  protected function getBodyClasses()
  {
    $string = CaptureEcho::capture("body_class"); // class="one two three"
    $string = str_replace(array('class=', '"'), "", $string);
    return explode(" ", $string);
  }

}
