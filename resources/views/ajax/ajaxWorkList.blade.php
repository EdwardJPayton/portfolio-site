<div class="work _wrap" id="page-info" data-title="Work" data-script="work">
  <div class="work _page-top">
    <section class="work _intro anim-intro">
      <h1 class="text-pale text-centered-h page-heading">My work</h1>
      <p class="text-pale">E-Commerce websites, responsive web design, social branding. Over the years I have had the pleasure of working with dozens of great clients and companies, and on some really amazing projects. Here is a few notable projects that I can lay claim to working on, from managing a full website redevelopment project, to improving their current website.</p>
    </section>
  </div>

  <div class="work _content white-bg anim-content">
    <ul class="work _list list-no-style">
      @foreach($portArr as $project)
        <li class="work _item" id="project{!! $project['id'] !!}">
          <div class="work _inner">
              @if($project['has_case_study']) 
                <a href="{!! route('workDetail', [ 'slug' => $project['slug'] ]) !!}" class="work _text-link">
                  <h3 class="work _title">{!! $project['title'] !!}</h3>
                  <p class="work _skills">{!! $project['skills'] !!}</p>
                </a>
              @else
                <span class="work _no-link">
                  <h3 class="work _title">{!! $project['title'] !!}</h3>
                  <p class="work _skills">{!! $project['skills'] !!}</p>
                </span>
              @endif
            <div class="work _img">
              <img src="{!! $project['list_image'] !!}" alt="{!! $project['slug'] !!}" />
            </div>

            <div class="work _item-content">
              <p class="work _list-headline">{!! $project['list_headline'] !!}</p>
              @if($project['has_case_study']) 
                <a href="{!! route('workDetail', [ 'slug' => $project['slug'] ]) !!}" class="button -inline -green -text-mid ajax-link">Open project</a>
              @else
                <span class="button -inline -text-mid -disabled">Case study coming soon</span>
              @endif
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>