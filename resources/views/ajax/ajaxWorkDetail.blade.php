<div class="project _wrap anim-gradient" id="page-info" data-title="{!! $projectArr['title'] !!}" data-script="work">
  <div class="project _intro text-centered-h anim-intro">
    <h1 class="text-pale page-heading">{!! $projectArr['title'] !!}</h1>
    <p class="project _headline text-pale">{!! $projectArr['list_headline'] !!}</p>
    <p class="project _skills">{!! $projectArr['skills'] !!}</p>
  </div>

  <div class="project _content anim-content">
    <div class="project _intro-image">
      <img src="{!! $projectArr['project_image'] !!}" />
    </div>

    <div class="project _brief">
      <h3 class="text-centered-h text-pale">The brief</h3>
      {!! $projectArr['project_brief'] !!}
    </div>

    <div class="project _detail">
      <h3 class="text-centered-h text-pale">The work</h3>
      {!! $projectArr['project_detail'] !!}
    </div>

    @if($projectArr['url'])
      <div class="project _url">
        <a href="{!! $projectArr['url'] !!}" target="_blank" class="button -block -white-bg -text-large">See live website</a>
      </div>
    @endif


    {{--@include('partials.workMenu')--}}

    <div class="project _cta">
      <p>Let's work together! {!! link_to_action('ContactController@index', 'Get in touch', null, array('class' => 'button -inline -white-bg -text-mid ajax-link', 'title' => 'Contact me')) !!}</p>
    </div>
  </div>
</div>