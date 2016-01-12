<footer id="footer">
  <div class="footer _content max-width">
    <ul class="footer _icons list-no-style">
      <li class="footer _icon -em">
        <a href="javascript:void(0)" onclick="emailMe();" title="moc.liamg@notyapjdrawde">moc.liamg@notyapjdrawde</a>
      </li>
      <li class="footer _icon -sk">
        {{--<a onclick="Skype.tryAnalyzeSkypeUri('call', '0');" href="skype:edwardjpayton?call" target="_blank">skype/edwardjpayton</a>--}}
      </li>
    </ul>

    <ul class="footer _icons list-no-style">
      <li class="footer _icon -li">
        <a href="https://www.linkedin.com/in/edwardpayton" target="_blank">linkedin/in/edwardpayton</a>
      </li>
      <li class="footer _icon -cv">
        <a href="#">Download my resume</a>
      </li>
    </ul>

    <ul class="footer _icons list-no-style">
      <li class="footer _icon -git">
        <a href="https://github.com/edwardjpayton" target="_blank">github.com/edwardjpayton</a>
      </li>
      <li class="footer _icon -cpen">
        <a href="http://codepen.io/edwardjpayton/" target="_blank">codepen.io/edwardjpayton</a>
      </li>
    </ul> 

    <div class="footer _contact-button">
      {!! link_to_action('ContactController@index', 'Contact', null, array('class' => 'button -inline -text-mid -white ajax-link', 'title' => 'Contact me')) !!}
    </div>

    <div class="footer _copy">
      <p>&copy; <?php echo date("Y"); ?> <a href="{!! url('/') !!}">Edward J Payton</a>. All rights reserved.</p>
    </div>
  </div>
</footer>