<?php

namespace App\Controllers;

class Layout extends BaseController
{
  public function index()
  {
    $data = [
      "title" => "Dashboard"
    ];
    return view('layout/home', $data);
  }
}
