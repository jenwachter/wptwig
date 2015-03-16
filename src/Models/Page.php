<?php

namespace wptwig\Models;

use \wptwig\Workers\CaptureEcho;

class Page extends BaseModel
{
  public function __construct($post)
  {
    parent::__construct($post);
  }

  public function getPost()
  {
    $post = $this->post;
    $post->meta = get_post_meta($this->post->ID);

    return $post;
  }

  protected function getSiteData()
  {
    return array(
      "charset" => get_bloginfo("charset"),
      "header" => CaptureEcho::capture("wp_head"),
      "footer" => CaptureEcho::capture("wp_footer"),
      "body_classes" => $this->getBodyClasses()
    );
  }

  protected function getBodyClasses()
  {
    $string = CaptureEcho::capture("body_class"); // class="one two three"
    return str_replace(array('class=', '"'), "", $string);
  }

  public function get()
  {
    $data = array(
      "post" => $this->getPost(),
      "site_data" => $this->getSiteData()
    );

    // force array for twig
    return json_decode(json_encode($data), true);
  }

}
