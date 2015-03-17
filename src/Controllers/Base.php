<?php

namespace wptwig\Controllers;

abstract class Base
{
  /**
   * WordPress post
   * @var object
   */
  protected $post;

  /**
   * Twig worker
   * @var \wptwig\Workers\Twig
   */
  protected $twig;

  /**
   * Model object
   * @var object
   */
  protected $model;

  /**
   * Name of model to be used in Controller;
   * to be set in classes that extend from Base
   * @var string
   */
  public $modelName;

  /**
   * Location of template; to be set in classes
   * that extend from Base
   * @var string
   */
  public $template;

  /**
   * Setup model and twig template rendering engine
   * @param object $post WordPress post
   */
  public function __construct($post)
  {
    $modelName = "\\wptwig\\Models\\{$this->modelName}";
    $this->model = new $modelName($post);

    $config = array("autoescape" => false);
    $this->twig = new \wptwig\Workers\Twig(dirname(__DIR__) . "/Views", $config);
  }

  /**
   * Gather model data and render twig template
   * @return null
   */
  public function show()
  {
    // get data
    $data = $this->model->get();

    // print_r($data); die();

    // render data
    $this->twig->render($this->template, $data);
  }

}
