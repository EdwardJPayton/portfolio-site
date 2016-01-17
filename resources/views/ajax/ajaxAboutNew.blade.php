{{-- http://9elements.com/ --}}

<div class="about _wrap" id="page-info" data-title="About" data-script="about">
  <section class="about _intro anim-intro">
    <h1 class="text-pale text-centered-h page-heading">About Me</h1>
    <p class="text-pale">So you know my names Edward. This is a bit more about who I am and what I do, both when I'm working and when I'm not. Lorem ipsum dolor sit amet, consectetur.</p>
  </section>

  <div class="about _content anim-content">
    <div class="about _blocks">
      <div class="about-block -me">
        <div class="about-block _img"><img /></div>
        <p>I enjoy problem solving as much as creating eye candy, and through research, understandng, and an eye for detail I build websites that look great on any device and are super quick.</p>
        <p>On the web as in real life I hunt out projects that could teach me something and make me say something more than just "Ooo look, pretty!"
        </p>
        <p>I'm a big fan of using the right tool for the right job, so I've got a hug mix of experience and talents. From building simple websites in WordPress, to working on e-commerce sites built in Magento.
        </p>
      </div>
      <div class="about-block -icons text-bg">
        <div class="about-icons">
          <h3 class="text-centered-h">My tools of choice</h3>
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_html5.svg') !!}" alt="HTML5"  class="about-icons _html" />
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_css3.svg') !!}" alt="CSS3" class="about-icons _css" />
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_js.svg') !!}" alt="Javascript" class="about-icons _js" />
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_jquery.svg') !!}" alt="jQuery" class="about-icons _jq" />
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_php.svg') !!}" alt="PHP" class="about-icons _php" />
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_laravel.svg') !!}" alt="Laravel" class="about-icons _la" />
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_wp.svg') !!}" alt="WordPress" class="about-icons _wp" />
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{!! asset('images/logo_magento.svg') !!}" alt="Magento" class="about-icons _ma" />
        </div>

        <div class="about-skills">
          <h3 class="text-centered-h">Skills</h3>
          <img />
        </div>

        <div class="about-fav">
          <p class="fav -color text-centered-h">My (current) favourte CSS color is <span>Tomato</span></p>
        </div>
      </div>
    </div>

    <div class="about-api">
      <div class="about-api _github">
        <p>I'm working on <span id="repoTotal"></span> repos on Github</p>
        <ul id="apiGithub"></ul>

        <div class="hide">
          <p>and <span></span> Gists</p>
          <ul></ul>
        </div>
      </div>
      <div class="about-api _codepen">
        <p>I try things out on <a href="http://codepen.io/edwardjpayton/" target="_blank">Codepen</a></p>
      </div>
      <div class="about-api _instgram hide">
        <p>See what I've been upto on Instgram</p>
        <ul id="apiInstgram"></ul>
      </div>
    </div>
  </div>
</div>