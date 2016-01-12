<?php /*

http://tutsnare.com/post-data-using-ajax-in-laravel-5/
http://laravel.io/forum/04-03-2014-simple-ajax-post-response-in-laravel-4


*/ ?>
<meta name="_token" content="{{ csrf_token() }}"/>

<style>

form ._special,
#sending,
#sent,
#error {
  display: none;
}

</style>


<?php $success = Session::get('flashMsg'); ?>
@if($success)
    <div class="alert-box success">
        <h2>{{ $success }}</h2>
    </div>
@endif



{!! Form::open(array('action' => 'ContactController@submitFormTest', 'class' => 'contact-form _form', 'id' => 'contactForm', 'name' => 'contactForm')) !!}

<div class="contact-form _special" id="special">
  {!! Form::label('birthday', 'Birthday Field') !!}
  {!! Form::text('birthday', @$birthday) !!}
</div>

<div class="contact-form _field -name">
  {!! Form::label('name', 'Name') !!}
  {!! Form::text('name', @$name ) !!}
</div>

<div class="contact-form _field -email">
  {!! Form::label('email', 'Email') !!}
  {!! Form::email('email', @$contactEmail ) !!}
</div>

<div class="contact-form _field -msg">
  {!! Form::label('msg', 'Message') !!}
  {!! Form::textarea('msg', @$msg, ['size' => '0x0'] ) !!}
</div>
{!! Form::submit('Send', array('class' => 'contact-form _submit')) !!}

{!! Form::close() !!}

<div id="sending">Sending</div>

<div id="sent">Sent, <span id="rtnName"></span></div>

<div id="error">Error</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


<script>

// Cross browser event listener solution
function $evt(el,myEvent,myFunction) {
  if (document.addEventListener) {
    return el.addEventListener(myEvent, myFunction);
  } else if (document.attachEvent) {
    return el.attachEvent(myEvent, myFunction);
  }
}

// Ajax form
var baseUrl = 'http://' + window.location.hostname,
    url = baseUrl + '/ajax/contact';

var csrfToken = $('input[name=_token]').val();

$('#contactForm input, #contactForm textarea').focus(function() {

  var ajaxMsg = document.getElementById('ajaxMessage');
  if (ajaxMsg) {
    ajaxMsg.parentNode.removeChild(ajaxMsg);
  }

  $(this).closest('.-error').removeClass('-error');
  $(this).parent().find('.-error-text').remove();
});

$('#contactForm').submit(function(e) {
  e.preventDefault();
  $('.-error').removeClass('-error');
  $('.-error-text').remove();

  var ajaxMsg = document.getElementById('ajaxMessage');
  if (!ajaxMsg) {
    var ajaxMsg = document.createElement('div');
    ajaxMsg.id = 'ajaxMessage';
  }
  ajaxMsg.innerHTML = 'Sending';
  document.getElementsByTagName('body')[0].appendChild(ajaxMsg);


  var dataStr = $(this).serialize();

  $.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
  });

  $.ajax({
    type: "POST",
    url: url,
    data: dataStr,
    dataType: 'json',
    success: function(data) {
      ajaxMsg.innerHTML = 'Sent, ' + data.name;
      // More success stuff
    },
    error: function(data) {
      ajaxMsg.innerHTML = 'Error';

      for (key in data.responseJSON) {
        console.log('key: ' + key + ', value: ' + data.responseJSON[key][0]);

        var errDiv = document.createElement('div'),
            elClass = $('.-' + key),
            elVal = data.responseJSON[key][0];

        errDiv.className = '-error-text';

        elClass.addClass('-error');
        elClass.append(errDiv);
        errDiv.innerHTML = elVal;
      }

    }
  });
});
</script>