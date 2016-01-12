<?php

namespace App\Http\Controllers;

use Input;
use Session;
use Illuminate\Support\Facades\Request;

use App\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  public function index()
  {
    // Home page
    $homeId = 2; // Home
    $homePage = get_post($homeId);

    $homeThumbId = get_post_thumbnail_id($homeId);
    $homeThumbArr = wp_get_attachment_image_src($homeThumbId, 'large');
    $homeThumb = $homeThumbArr[0];

    $homeMeta = get_post_meta($homePage->ID);

    $homeArr = [
      'title'     =>  $homePage->post_title,
      'thumbnail' =>  $homeThumb,
      'tagline'   =>  $homeMeta['tagline'][0],
      'intro'     =>  $homeMeta['intro'][0]
    ];

    // Portfolio items - first 3 by order_by
    //$portfolio = wpPostsLimitedNo('portfolio', 4, 'menu_order');

    $args = array(
      'numberposts' => 4,
      'orderby'     => 'menu_order',
      'order'       => 'ASC',
      'post_type'   => 'portfolio',
      'meta_query'  => array(
        array( 'key' => 'featured', 'value' => true )
      )
    );

    $portfolio = get_posts($args);
    
    $portArr = [];
    foreach($portfolio as $project) {
      $portArr[] =[
        'id'          =>  $project->ID,
        'title'       =>  $project->post_title,
        'slug'        =>  $project->post_name,
        'list_image'  =>  wp_get_attachment_url(get_post_meta($project->ID, 'list_image', true)),
        'featured_headline' => $project->featured_headline,
        'has_case_study'    => $project->has_case_study
      ];
    }


    // Return arrays
    if( Request::ajax() ) {
      return view('ajax.ajaxHomeNew', compact('homeArr', 'portArr'));
    } else {
      return view('home', compact('homeArr', 'portArr'));
    }
  }






  // TESTING CONTROLLERS
  // Show all (in json format)
  public function showAll() {

    $pages = wpPostsByType('page');

    $portfolio = wpPostsByType('portfolio');

    $all = [
      'pages' => $pages,
      'portfolio' => $portfolio
    ];

    dd($all);
  }

  public function port()
  {
    $portfolio = wpPostsLimitedNo('portfolio', 3, 'menu_order');
    $args = array(
      'numberposts' => 3,
      'orderby' => 'menu_order',
      'meta_key' => 'featured',
      'order' => 'ASC',
      'post_type' => 'portfolio'
    );

    $posts = get_posts($args);

    //$portfolio = $posts;
    $portArr = [];
    foreach($portfolio as $project) {
     $portArr[] = [
      'id'      =>  $project->ID,
      'name'    =>  $project->post_name,
      'image_1' =>  wp_get_attachment_url(get_post_meta($project->ID, 'list_image', true))
     ];
    }

    dd($portArr);
    return view('test.portTest', compact('portArr'));

  }

  public function meta()
  {
    $post_id = 22;
    $meta = get_post_meta($post_id);
    dd($meta);
    // dd($meta['abc'][0]); // aaa
    $metaArr = array(
      'abc'   =>  $meta['abc'][0],
      'def'   =>  $meta['def'][0],
      'img'   =>  wp_get_attachment_url( $meta['abc'][0] )
    );
    return view('test.meta', compact('metaArr'));
  }





  // AJAX TESTING
  /*public function ajaxOne()
  {
    return view('viewAjax');
  }
  public function ajaxTwo()
  {
    if( Request::ajax() ) {
      return view('viewTwoAjax');
    } else {
      //return 'HTTP';
      return view('viewTwoNotAjax');
    }
  }*/

  public function ajaxHome()
  {
    if( !Request::ajax() ) {

      return view('test.htmlAjax'); //->with('id', 'hi');
    }
  }
  public function ajaxId($id = null)
  {
    //dd($id);

    if( Request::ajax() ) {
    //if( Request::isMethod('get')) {
      return view('test.ajaxId')->with('id', $id);
    } else {
      return view('test.ajaxIdNotAjax')->with('id', $id);
    }


  }
}
