<?php

namespace wptwig\Workers;

class CaptureEcho
{
  public static function capture($method, $args = array())
  {
    ob_start();
    call_user_func_array($method, $args);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }
}
