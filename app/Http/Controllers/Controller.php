<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \Cache;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // Global list of all portfolio pages
    public function __construct()
    {
      // Build our navigation
      $portAllArr = Cache::get('portAllArr', function()
      {
        $workAll = wpPostsByType('portfolio');
        $portAllArr = [];
        foreach($workAll as $project) {
          $portAllArr[] =[
            'id'      =>  $project->ID,
            'title'   =>  $project->post_title,
            'slug'    =>  $project->post_name,
          ];
        }
        Cache::forever('portAllArr', $portAllArr);
        return $portAllArr;
      });



      \View::share('portAllArr', $portAllArr);

    }
}
