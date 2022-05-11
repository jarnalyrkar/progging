<?php

namespace App\Tags;

use Statamic\Tags\Tags;

class Script extends Tags
{

  public function index()
  {
    $type = $this->params->get('type');
    $path = "";
    if (!$type) return;
    if ($type === "css") {
      foreach (scandir("dist/css") as $file) {
        if (str_ends_with($file, '.css')) {
          $path = "/dist/css/" . $file;
        }
      }
    }
    if ($type === "js") {
      foreach (scandir("dist/js") as $file) {
        if (str_ends_with($file, '.js')) {
          $path = "/dist/js/" . $file;
        }
      }
    }
    return $path;
  }
}
