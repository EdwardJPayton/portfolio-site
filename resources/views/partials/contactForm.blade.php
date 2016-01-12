{!! Form::open(array('action' => 'ContactController@submitFormTest', 'class' => 'contact-form _form', 'id' => 'contactForm', 'name' => 'contactForm')) !!}
  <div class="contact-form _input-wrap" id="inputWrap">

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

  </div>

  <div class="contact-form _ajax-message" id="ajaxMessage">
    <a href="javascript:void();" id="x" class="text-button -close">Close</a>
  </div>

  <div class="contact-form _send-form" id="sendForm">
    {{--!! Form::submit('Send', array('class' => 'contact-form _submit')) !!--}}
    <button type="submit" class="contact-form-button _submit">
      <span class="contact-form-button _text">
        <i>S</i><i>e</i><i>n</i><i>d</i>
      </span>
      <i class="contact-form-button _icon"></i>
    </button>
  </div>

{!! Form::close() !!}

<script>

// Cross browser event listener solution
function $evt(el,myEvent,myFunction) {
  if (document.addEventListener) {
    return el.addEventListener(myEvent, myFunction);
  } else if (document.attachEvent) {
    return el.attachEvent(myEvent, myFunction);
  }
}
// Form input labels
var inputs = document.querySelectorAll('input[type="text"],input[type="email"],textarea'),
    inLen = inputs.length;
//
function labelOnWinLoad() {
  for ( i = 0; i < inLen; i++ ) {
    if (inputs[i].value.length>0) {
      inputs[i].parentNode.classList.add('-content');
    }
  }
}
function labelOnInputFocus() {
  this.parentNode.classList.add('-focus');
}
function labelOnInputBlur() {
  this.parentNode.classList.remove('-focus');

  if (this.value.length>0) {
    this.parentNode.classList.add('-content');
  } else {
    this.parentNode.classList.remove('-content');
  }
}
//
$evt(window,'load',labelOnWinLoad);
//
for ( i = 0; i < inLen; i++ ) {
  $evt(inputs[i],'focus',labelOnInputFocus)
  $evt(inputs[i],'blur',labelOnInputBlur);
}

</script>