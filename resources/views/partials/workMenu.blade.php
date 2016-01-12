<section class="work-menu _wrap">
	<nav id ="navSec" class="work-menu _row nav-sec">
	  @foreach($portAllArr as $p)
	    <a href="http://local.lara/work/project/{{ $p['slug'] }}" class="work-menu _menu-item ajax-link">{!! $p['title'] !!}</a>
	  @endforeach
	</nav>
</section>