<?php // Portfolio loop - 3 items ?>
@foreach($portArr as $project)
  <a href="#" class="project _wrap" id="{!! $project['id'] !!}" style="font-size:10px;display:block;">
    <div class="project _zoom"></div>
    <section class="project _content">
      <h2>{!! $project['name'] !!}</h2>
    </section>
  </a>
@endforeach

<?php // Ajax response ?>
<div id="rtnAjax"></div>

<?php // JS scripts ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
// Ajax get portfolio items
var baseUrl = 'http://' + window.location.host;
console.log(baseUrl);


$(document).on('click','a',function(e) {
  var id = $(this).attr('id');
  var url = baseUrl + '/ajax/ajaxGetPortfolioItem';

  $.ajax({
      url: url,
      data: { id: id },
      type:'GET',
      success: function(response){
        //$response = $(response);
        $('#rtnAjax').html(response);
      }
  });
});

</script>