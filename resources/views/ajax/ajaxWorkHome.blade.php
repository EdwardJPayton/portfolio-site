

<div class="ajax-project _wrap">
  <div class="ajax-project _gallery">
    <img src="{!! $projectArr['image_1'] !!}" />
    <img src="{!! $projectArr['image_2'] !!}" />
    <img src="{!! $projectArr['image_3'] !!}" />
  </div>
  <div class="ajax-project _details">
    <h2>{!! $projectArr['title'] !!}</h2>

    <p>{!! $projectArr['content'] !!}</p>

    <ul>{{-- TODO check if cat exists before UL--}}
      <?php $cats = $projectArr['cat'] ?>
      @foreach ($cats as $c)
        <?php $cat = get_category($c); ?>
        <li>{!! $cat->name; !!}</li>
      @endforeach
    </ul>

    {!! link_to_action('PortfolioController@detail', 'View the full project', array('slug' => $projectArr['name']), array('class' => 'button -inline ajax-link', 'title' => 'View full project')) !!}
  </div>
</div>