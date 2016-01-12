<!DOCTYPE html>
<html>
<head>
  <title>
    Ajax test
  </title>

  {{-- <link href="{{ URL::asset('/css/style.css') }}" rel="stylesheet" /> --}}
  <link href="{{ URL::asset('/css/sass/style.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('/css/temp.css') }}" rel="stylesheet" />
  @yield('headCSS')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

  <script src="{{ URL::asset('/js/helper-functions.js') }}"></script>
  @yield('headJs')

</head>
<body>

  @yield('content')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="{{ URL::asset('/js/history.js') }}"></script>
  <script>
  $(function() {
    //$('#link').click(function(e) {e.preventDefault()});
  });

  var baseUrl = location.protocol + '//' + location.host;
  /*
  $(document).on('click','#link', function(e){
  e.preventDefault()
  var pageId = $(this).attr('data-page');
  $l(pageId);
  $.ajax({
      url: baseUrl + '/ajax-' + pageId,
      type: "GET",
      success: function(data){
        $data = $(data);
        $('#main').html($data);
        }
    });
  });
  */


  $(function() {

    var location = window.history.location || window.location;

    // looking for all the links and hang on the event, all references in this document
    $(document).on('click', '#link', function(e) {
      e.preventDefault();
      // keep the link in the browser history
      var thisHref = this.href;
      history.pushState(null, null, thisHref);

      // here can cause data loading, etc.
      $l('a');

      $.ajax({
        url: thisHref,
        type: "GET",
        success: function(data){
          $data = $(data);
          $('#main').html($data);
        },
        error: function() {
          $l('error');
        }
      });

      // do not give a default action
      return false;
    });

    // hang on popstate event triggered by pressing back/forward in browser
    $(window).on('popstate', function(e) {

      // here can cause data loading, etc.

      // just post
      //$l("We returned to the page with a link: " + location.href);

      $l('popstate fired!');
      // Doesnt work correctly
      var thisHref = document.location;
      $.ajax({
        url: thisHref,
        type: "GET",
        success: function(data){
          $data = $(data);
          $('#main').html($data);
        },
        error: function() {
          $l('error');
        }
      });

      // https://rosspenman.com/pushstate-jquery/
      // http://stackoverflow.com/questions/25150661/html5-history-api-initial-load-issue
      // http://diveintohtml5.info/history.html
      // https://css-tricks.com/using-the-html5-history-api/

      // https://codyhouse.co/gem/animated-page-transition-2/
    });
  });


  /*
  // https://css-tricks.com/using-the-html5-history-api/
  (function(){

    "use strict";

    var container = document.querySelector('.gallery'),
      imgs = document.querySelectorAll('img'),
      textWrapper = document.querySelector('.highlight'),
      content = document.querySelector('.content'),
      defaultTitle = "Select your Ghostbuster!";

    function updateText(content){
      textWrapper.innerHTML = content;
    }

    function requestContent(file){
      $('.content').load(file + ' .content');
    }

    function removeCurrentClass(){
      for(var i = 0; i < imgs.length; i++){
        imgs[i].classList.remove('current');
      }
    }

    function addCurrentClass(elem){
      removeCurrentClass();
      var element = document.querySelector("." + elem);
      element.classList.add('current');
    }

    container.addEventListener('click', function(e){
      if(e.target != e.currentTarget){
        e.preventDefault();
        var data = e.target.getAttribute('data-name'),
          url = data + ".php";
        addCurrentClass(data);
        history.pushState(data, null, url);
        updateText(data);
        requestContent(url);
        document.title = "Ghostbuster | " + data;
      }
      e.stopPropagation();
    }, false);


    window.addEventListener('popstate', function(e){
      var character = e.state;

      if (character == null) {
        removeCurrentClass();
        textWrapper.innerHTML = " ";
        content.innerHTML = " ";
        document.title = defaultTitle;
      } else {
        updateText(character);
        requestContent(character + ".php");
        addCurrentClass(character);
        document.title = "Ghostbuster | " + character;
      }
    })
    })();
    */

   // http://html5doctor.com/history-api/
   /*
    var contentEl = document.getElementById('content'),
        photoEl = document.getElementById('photo'),
        linkEls = document.getElementsByTagName('a'),
        cats = {
          fluffy: {
            content: 'Fluffy!',
            photo: 'http://placekitten.com/200/200'
          },
          socks: {
            content: 'Socks!',
            photo: 'http://placekitten.com/280/280'
          },
          whiskers: {
            content: 'Whiskers!',
            photo: 'http://placekitten.com/350/350'
          },
          bob: {
            content: 'Just Bob.',
            photo: 'http://placekitten.com/320/270'
          }
        };

    // Switcheroo!
    function updateContent(data) {
      if (data == null)
        return;

      contentEl.textContent = data.content;
      photoEl.src = data.photo;
    }

    // Load some mock JSON data into the page
    function clickHandler(event) {
      var cat = event.target.getAttribute('href').split('/').pop(),
          data = cats[cat] || null; // In reality this could be an AJAX request

      updateContent(data);

      // Add an item to the history log
      history.pushState(data, event.target.textContent, event.target.href);

      return event.preventDefault();
    }

    // Attach event listeners
    for (var i = 0, l = linkEls.length; i < l; i++) {
      linkEls[i].addEventListener('click', clickHandler, true);
    }

    // Revert to a previously saved state
    window.addEventListener('popstate', function(event) {
      console.log('popstate fired!');

      updateContent(event.state);
    });

    // Store the initial content so we can revisit it later
    history.replaceState({
      console.log('replaceState fired!');
      content: contentEl.textContent,
      photo: photoEl.src
    }, document.title, document.location.href);
  */
  </script>

  @yield('footJs')
</body>
</html>
