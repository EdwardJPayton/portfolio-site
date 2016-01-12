{{--
http://elrumordelaluz.github.io/draGGradients/

--}}

<div class="home _wrap anim-home anim-gradient" id="page-info" data-title="" data-script="home">
  <div class="home-intro _wrap">
    <span id="introBg"></span>
    <div class="home-intro _content">
      <div class="home-intro _headline fit-vp-9">
        {{--
        <p class="home-intro _text -no1">Pushing</p>
        <p class="home-intro _text -no2" id="introCanvas">Pixels</p>
        <p class="home-intro _text -no3">&amp; crafting code.</p>
        --}}
        <div class="home-intro _headline-text">
          <p class="home-intro _text -no1"><span class="span1">Lets</span>&nbsp;<span class="span2">Make</span></p>
          <p class="home-intro _text -no2">Something</p>
          <p class="home-intro _text -no3"><span>G</span><span>r</span><span>e</span><span>a</span><span>t</span></p>
        </div>
      </div>

      <div class="home-intro _hi">
        <h2>Hi, I'm Edward</h2>
        <p>In a nutshell, I'm a web designer and developer based just outside Bristol. My days are spent creating interesting websites that perform flawlessly, have excellent user experience, and are fun to use.
        </p>

        <p class="home-intro _heart">
            <span>You will</span>
            <span>
              <svg viewBox="0 0 100 100" width="50">
                <path d="M98.2,17.305 c-2.493-6.252-7.495-11.51-14.416-14.766 C77.667-0.34,71.076-0.686,65.085,1.073 C59.096,2.832,53.71,7.626,50,13.168 C46.291,7.626,40.905,2.832,34.916,1.073 S22.334-0.34,16.217,2.539 C9.297,5.794,4.295,11.053,1.801,17.305 c-2.493,6.252-2.504,13.511,0.638,20.73 C9.161,53.477,49.787,89.719,50,90.338 c0.213-0.619,40.84-36.861,47.561-52.303 C100.705,30.815,100.693,23.557,98.2,17.305z"></path>
              </svg>
            </span> 
            <span>what I do</span>
        </p>
      </div>
    </div>
  </div>

  <ul class="home-work _wrap list-no-style max-width">
    @foreach($portArr as $project)
      <li class="home-work _item" id="project{!! $project['id'] !!}">
        <div class="home-work _img">
          @if($project['list_image']) 
            <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! $project['list_image'] !!}" alt="{!! $project['slug'] !!}" />
          @else
            <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="http://placehold.it/600x600" alt="{!! $project['slug'] !!}" />
          @endif
        </div>
        <div class="home-work _text"> 
          <p>{!! $project['featured_headline'] !!}</p>
          {{--
          @if($project['has_case_study']) 
            <a href="{!! route('workDetail', [ 'slug' => $project['slug'] ]) !!}" class="button -block -white -text-mid ajax-link">Open project</a>
          @endif
          --}}
        </div>
      </li>
    @endforeach
  </ul>

  {!! link_to_action('WorkController@index', 'See my work', array(), array('class' => 'button -block -white-bg -text-large ajax-link', 'title' => 'See my work')) !!}
</div>