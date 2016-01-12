<?php

namespace App\Http\Controllers;

use Input;
use Session;
use Illuminate\Support\Facades\Request;

use App\User;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
  public function index()
  {
    $work = wpPostsByType('portfolio');

    $portArr = [];
    foreach($work as $project) {
      $portArr[] =[
        'id'      =>  $project->ID,
        'title'   =>  $project->post_title,
        'slug'    =>  $project->post_name,
        //'headline'=>  $project->headline,
        'skills'  =>  $project->skills_techniques,
        'list_headline' =>  $project->list_headline,
        'list_image' =>  wp_get_attachment_url(get_post_meta($project->ID, 'list_image', true)),
        'has_case_study' => $project->has_case_study
      ];
    }

    if( Request::ajax() ) {
      return view('ajax.ajaxWorkList', compact( 'portArr'));
    } else {
      return view('workList', compact( 'portArr'));
    }
  }


  public function detail($slug)
  {

    $type = 'portfolio';
    $project = wpSinglePostBySlug($slug,$type);

    $projectArr = [
      'title'         => $project[0]->post_title,
      'list_headline' =>  $project[0]->list_headline,
      'skills'        =>  $project[0]->skills_techniques,
      'project_image' =>  wp_get_attachment_url(get_post_meta($project[0]->ID, 'project_image', true)),
      'project_brief' =>  $project[0]->project_brief,
      'project_detail' =>  $project[0]->project_detail,
      'url'      => $project[0]->url,
      //'cat'     => wp_get_post_categories($project[0]->ID)
    ];

    if( Request::ajax() ) {
      return view('ajax.ajaxWorkDetail', compact('projectArr', 'portArr'));
    } else {
      return view('workDetail', compact('projectArr', 'portArr'));
    }

  }
}
