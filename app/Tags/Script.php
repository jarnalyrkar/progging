<?php

namespace App\Tags;

use Statamic\Tags\Tags;

class Script extends Tags
{
  /**
   * Gets the time a file was created
   *
   * @return string|array
   */
  public function index()
  {
    $type = $this->params->get('type');
    $path = "";
    if (!$type) return;
    if ($type === "css") {
      $path = "/dist/css/" . scandir("dist/css")[2];
    }
    if ($type === "js") {
      $path = "/dist/js/" . scandir("dist/js")[2];
    }
    return $path;
  }
}
