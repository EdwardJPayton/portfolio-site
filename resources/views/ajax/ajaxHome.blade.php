{{--

Particles
http://tympanus.net/codrops/2014/09/23/animated-background-headers/
http://tympanus.net/Development/AnimatedHeaderBackgrounds/index2.html

https://github.com/soulwire/sketch.js

http://www.rollstudio.co.uk/explore/oldies-goodies-particles-and-canvas/

http://tympanus.net/Development/FullscreenOverlayStyles/index8.html

http://jsfiddle.net/danielfilho/y63cs/

https://www.script-tutorials.com/night-sky-with-twinkling-stars/

https://github.com/raphamorim/awesome-canvas#examples

http://timothypoon.com/blog/2011/01/19/html5-canvas-particle-animation/

http://vincentgarreau.com/particles.js/


Blobs
http://www.kevs3d.co.uk/dev/eglogo/
http://meru.ca/
https://www.freshdesignweb.com/examples-html5-animation/
http://digitalcraft.co/build/2015-svg-drip
http://tympanus.net/codrops/2015/03/10/creative-gooey-effects/



Buttons
http://tympanus.net/Development/ElasticSVGElements/button.html


Icons
http://tympanus.net/codrops/2014/10/10/freebie-helium-icon-set/


Fadein text blocks
http://codepen.io/suez/pen/3d49b2d6681dac2d87984aa57e55d503


Idea for logo bg
https://github.com/codrops/CreativeGooeyEffects/blob/master/player.html
1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -10

--}}

<section class="home-hello _row" id="page-info" data-title="" data-script="home">
  <div class="home-hello _content fit-h">
    <div class="home-hello _positioning">
      <p class="home-hello _text -first">Pushing</p>
      <div class="home-hello _canvas" id="helloCanvas">
        <p>Pixels</p>
      </div>
      <p class="home-hello _text -last">&amp; crafting code.</p>
    </div>
  </div>
</section>

<section class="home-intro _row">
  <div class="home-intro _content">
    <h2>Hi, I'm Edward.</h2>
    <p>In a nutshell, I'm a web designer and developer based just outside Bristol. My days are spent creating interesting websites that perform flawlessly, have excellent user experience, and that are fun to use. {!! link_to_action('ContactController@index', 'Get in touch', array(), array('class' => 'button -inline -green-pale ajax-link', 'title' => 'Get in touch')) !!}
    </p>
    <div class="home-intro -heart">
      <p>
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
</section>


<section class="home-work _full-width">
  <div class="home-work _row">
  <div class="home-work _content -first">
    <h3><span>My Work</span></h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
  </div>

  <ul class="home-work _content -project-list" id="homeWorkList">
    @foreach($portArr as $project)
      <li class="home-work _item" id="project{!! $project['id'] !!}">
         <div class="home-work _text"> 
          <div class="home-work _text-top">
            <h3>{!! $project['headline'] !!}</h3>
            <p>{!! $project['subheadline'] !!}</p>
          </div>
          <div class="home-work _text-bottom">
            <a href="{!! route('workDetail', [ 'slug' => $project['slug'] ]) !!}" class="button -inline -green ajax-link">Open project</a>
          </div>
        </div>
        <a href="{!! route('workDetail', [ 'slug' => $project['slug'] ]) !!}" class="home-work _img ajax-link">
          @if($project['image_1']) 
            <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! $project['image_1'] !!}" alt="{!! $project['slug'] !!}" />
          @else
            <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="http://placehold.it/600x600" alt="{!! $project['slug'] !!}" />
          @endif
          <p><span>Open project</span></p>
        </a>
      </li>
    @endforeach
  </ul>

  <div class="home-work _content -last">
    <h3>This is just a taster</h3>
    {!! link_to_action('WorkController@index', 'My work', array(), array('class' => 'button -block -green ajax-link', 'title' => 'See my work')) !!}
  </div>
  </div>
</section>


<section class="home-about _row">
  <div class="home-about _content">
    <h3><span>What I'm about</span></h3>
    <div class="home-about _block">
      <h4>So you know my names Edward.</h4>
      <div class="home-about _img"></div>
    </div>
    <p class="home-about _block">I enjoy problem solving as much as creating eye candy, and through research, understandng, and an eye for detail I build websites that look great on any device and are super quick.
    </p>
    <p class="home-about _block">On the web as in real life I hunt out projects that could teach me something and make me say something more than just "Ooo look, pretty!"
    </p>
    <p class="home-about _block">I'm a big fan of using the right tool for the right job, so I've got a hug mix of experience and talents. From building simple websites in WordPress, to working on e-commerce sites built in Magento.
    </p>
    <div class="home-about _block -icons">
      <h4>My tools of choice</h4>
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_html5.svg') !!}" alt="HTML5"  class="home-about-icons _html" />
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_css3.svg') !!}" alt="CSS3" class="home-about-icons _css" />
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_js.svg') !!}" alt="Javascript" class="home-about-icons _js" />
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_jquery.svg') !!}" alt="jQuery" class="home-about-icons _jq" />
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_php.svg') !!}" alt="PHP" class="home-about-icons _php" />
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_laravel.svg') !!}" alt="Laravel" class="home-about-icons _la" />
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_wp.svg') !!}" alt="WordPress" class="home-about-icons _wp" />
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_mag.svg') !!}" alt="Magento" class="home-about-icons _ma" />
    </div>
  </div>

  <ul class="home-about _content -favourites">
    <li class="fav -framework">My favourite framework is <span>Laravel</span></li>
    <li class="fav -color">My (current) favourte CSS color is <span>Tomato</span></li>
  </ul>
</section>


<section class="home-contact _full-width">
  <div class="home-content _row">
    <div class="home-contact _content -last">
      <h3>Let's make something great</h3>
      {!! link_to_action('ContactController@index', 'Get in touch', array(), array('class' => 'button -block -green-pale ajax-link', 'title' => 'Contact me')) !!}
    </div>
    <a class="home-contact _map-link" href="https://goo.gl/maps/MYbo3G4wo482" target="_blank">Google Map</a>
  </div>
</section>