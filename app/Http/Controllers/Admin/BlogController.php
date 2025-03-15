<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

final class BlogController extends Controller
{

  /**
   * Display Blog List
   *
   * @return InertiaResponse
   */
  public function index(): InertiaResponse
  {
    return Inertia::render('Admin/Blog/List');
  }

}
