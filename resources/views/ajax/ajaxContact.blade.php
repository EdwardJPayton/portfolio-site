<div class="contact _wrap" id="page-info" data-title="Contact" data-script="contact">
  <section class="contact _intro anim-intro">
    <h1 class="text-pale text-centered-h page-heading">Contact Me</h1>
    <p class="text-pale">Have questions about my work or just want to say hello? Go ahead and email me on <a href="javascript:void(0)" onclick="emailMe();" title="moc.liamg@notyapjdrawde">moc.liamg@notyapjdrawde</a>, or use the contact form below.</p>
  </section>

  <div class="contact _content anim-content">
    <div class="contact _form-wrap">
      @if (Session::has('message'))
        <p id="formMessage" class="form-message text-pale text-centered-h">
          {{ Session::get('message') }}
        </p>
      @endif

      <div class="contact _ajax-form">
        {!! Form::open(array('action' => 'ContactController@submitForm', 'class' => 'contact-form _form', 'id' => 'contactForm', 'name' => 'contactForm')) !!}
          <div class="contact-form _input-wrap" id="inputWrap">

            <div class="contact-form _special" id="special">
              {!! Form::label('birthday', 'Birthday Field') !!}
              {!! Form::text('birthday', @$birthday) !!}
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
            <button type="submit" class="contact-form-button _submit button -block -white-bg -text-large">
              <span class="contact-form-button _text">Send</span>
              <i class="contact-form-button _icon"></i>
            </button>
          </div>

        {!! Form::close() !!}
      </div>

      <div class="contact _no-js-alternative">
        <p class="text-pale text-centered-h">Email me on <span>moc.liamg@notyapjdrawde</span></p>
      </div>

      {{--
      <div class="contact _map">
        <p><a class="contact _map-link" href="https://goo.gl/maps/MYbo3G4wo482" target="_blank">Google Map</a>
        </p>
      </div>
      --}}
      
    </div>
  </div>
</div>
