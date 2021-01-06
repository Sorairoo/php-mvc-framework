<?php

namespace App\Controllers;

class PostController
{
    protected $layout = '../layout/index.tpl.php';
    public $name = 'Hello World';
public function __construct()
{
    echo 'Post controller creato';
}

    /**
     * @return void
     */
    public function display()
    {
        require  $this->layout;
    }
    public function show(int $postid)
    {
      $message = ' this is a post message';
      ob_start();
      require_once __DIR__.'/../views/post.tpl.php';
      $this->content = ob_get_contents();
      ob_end_clean();
    }
}