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

  <a href="/ajax" class="ajax" id="">Home</a><br>
  <a href="/ajax/1" class="ajax" id="1">1</a><br>
  <a href="/ajax/2" class="ajax" id="2">2</a>

  <div id="main">
    @yield('content')
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/reqwest/2.0.5/reqwest.min.js"></script>
  <script src="{{ URL::asset('/js/history.js') }}"></script>
  <script>

  var hrefLink = $q('.ajax');
  for (var i = 0; i < hrefLink.length; i++) {
    $evt(hrefLink[i],'click',function(e) {
      e.preventDefault();
      var href = this.href;

      getContent( href, true);

      //removeClass(hrefLink,'active');
      removeClass(document.querySelector('.ajax'),'active');
      addClass(this,'active');

    });
  }

  // Adding popstate event listener to handle browser back button
  window.addEventListener("popstate", function(e) {

      // Get State value using e.state
      getContent(location.pathname, false);
  });

  function getContent(url, addEntry) {

      reqwest({
        url: url,
        method: 'get',
        success: function(data) {
          // Updating Content on Page
          $l(data);
          if ( data == '[object XMLHttpRequest]' ) {
            data = 'hi';
          }
          document.getElementById('main').innerHTML = data;

          if(addEntry == true) {
              // Add History Entry using pushState
              history.pushState(null, null, url);
          }
        }
      });

  }
  //http://code.tutsplus.com/tutorials/an-introduction-to-the-html5-history-api--cms-22160


  // https://css-tricks.com/using-the-html5-history-api/
  // http://html5doctor.com/history-api/
  </script>

  @yield('footJs')
</body>
</html>
