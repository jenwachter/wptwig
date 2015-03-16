<?php

namespace wptwig\Workers;

class Twig
{
  protected $twig;

  public function __construct($templateDir, $options = array())
  {
    $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem($templateDir), $options);
  }

  public function render($path, $data)
  {
    $template = $this->twig->loadTemplate($path . ".twig");
    echo $template->render($data);
  }

  public function addExtension($ext)
  {
    return $this->twig->addExtension($ext);
  }

  public function addFilter($filter)
  {
    return $this->twig->addFilter($filter);
  }

  public function addFunction($filter)
  {
    return $this->twig->addFunction($filter);
  }

}
