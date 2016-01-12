<!DOCTYPE html>
<html>
<head>
  <title>
    @if (trim($__env->yieldContent('metaTitle')))
      @yield('metaTitle') |
    @endif
    Edward J Payton
  </title>

  {{-- <link href="{{ URL::asset('/css/style.css') }}" rel="stylesheet" /> --}}
  <link href="{{ URL::asset('/css/sass/style.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('/css/temp.css') }}" rel="stylesheet" />
  @yield('headCSS')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

  <script src="{{ URL::asset('/js/helper-functions.js') }}"></script>

  @yield('headJs')

</head>
<body id="body" class="page-@yield('bodyClass')">

  @include('partials.header')

  <main>
    <div id="content" class="content">
      @yield('content')
    </div>
  </main>

  @include('partials.footer')

  {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/reqwest/2.0.5/reqwest.min.js"></script>--}}
  <script src="{{ URL::asset('/js/reqwest.js') }}"></script>
  <script src="{{ URL::asset('/js/history.js') }}"></script>
  {{--<script src="http://cdn.dev.skype.com/uri/skype-uri.js"></script>--}}
  <script>
  // Ajax page load (html5 pushstate / popstate)
  // TODO transitions

  // Shared variables
  var w = window, // scrollClass
      body = $id('body'); // ajax page load, scrollClass
      header = $id('header'), // scrollClass, headsUp
      content = $id('content'), // ajax page load

  // Bind click event to document, if click target has class...
  $evt(document,'click',function(e) {
    var el = e.target;
    do {
      if( hasClass(el, 'ajax-link') ) {
        e.preventDefault();

        // change current class
        var ajaxLink = $qsa('.ajax-link');
        for ( var i = 0; i < ajaxLink.length; i++ ) {
          removeClass(ajaxLink[i],'current');
        }
        addClass(el,'current');

        addClass(body,'-anim');
        addClass(body,'-anim-out');

        var href = el.href;
        getContent(href, true);
      }
    } while (el = el.parentNode);
  });


  // Adding popstate event listener to handle browser back button
  window.addEventListener("popstate", function(e) {
    getContent(location.pathname, false);
  });
  function getContent(url, addEntry) {
    // Get content with Ajax request
    reqwest({
      url: url, // + 'a',
      method: 'get',
      success: function(data) {
        // Update content on page
        content.innerHTML = data;
        window.scrollTo(0,0); // Reset scroll position

        var pageInfo = document.getElementById('page-info'),
            dataScript = pageInfo.getAttribute('data-script'),
            classes = ['page-home','page-work','page-about','page-blog','page-contact'];

        for ( var i = 0; i < classes.length; i++ ) {
          if ( hasClass(body,classes[i]) ) {
            removeClass(body,classes[i]);
          }
        }

        removeClass(body,"-anim-out");

        addClass(body,"page-" + dataScript);

        if(addEntry == true) addClass(body,"-anim-in");

        // Run scripts
        docTitle(pageInfo);
        loadImages();

        // Load new script
        var src = 'http://' + window.location.hostname + '/js/' + dataScript + '.js';
        requireFile(src, function() {
          newFunction();
        });
      },
      error: function(data) {
        //addClass(content,'-load-error');
        window.scrollTo(0,0);
        var showError = setTimeout(function() {
          content.innerHTML = '<div id="page-info" data-title="" class="ajax-error _wrap"><p>There was a problem loading the page you requested</p><a href="#" class="ajax-error _reload" onclick="window.location.reload(true); return false;">Reload</a></div>';
        },500);

        docTitle(); // empty

        $l(data);
      },
      complete: function(data) {
        var timeIn = setTimeout(function() {
          removeClass(body,'-anim');
          removeClass(body,'-anim-in');
        },250);

        // Run scripts
        newPageH();

        // Add history item
        // TODO test this - does pushstate work here?
        if(addEntry == true) {
            history.pushState(null, null, url);
        }
      },
    });

  }
  // Load and execute new JS files
  function requireFile(file, myFunc) {
    // Require file if it doesnt exist, run myFunc
    var scriptEl = $id('pageScript');
    var scriptExists = function(newSrc) {
      // Check if the #pageScript exists, and is the correct src
      if (typeof(scriptEl) != 'undefined' && scriptEl != null) {
        if (scriptEl.src == newSrc) return true;
      }
      return false;
    }
    if( !scriptExists(file) ) {
      // If #pageScript src doesn't match current src, remove script and create new
      scriptEl.parentNode.removeChild(scriptEl);

      var reqScript = function(file) {
        this.src = file;
        this.make = function() {
          var newJs = document.createElement('script');
          newJs.src = this.src;
          newJs.id = 'pageScript';
          document.body.appendChild(newJs);
        }
      }
      new reqScript(file).make();

    } else {
      myFunc();
    }
  }
  // Document title
  function docTitle(p) {
    // Change document title
    p = p || null;
    if( p && p.hasAttribute('data-title') ) {
      var dataTitle = p.getAttribute('data-title');
      if ( dataTitle != '' ) {
        rtnTitle = dataTitle + " | ";
      } else {
        rtnTitle = "";
      }
    } else {
      rtnTitle = "Error | ";
    }
    document.title = rtnTitle + "Edward J Payton";
  }
  // Defer images
  // https://varvy.com/pagespeed/defer-images.html
  // <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="IMG-SRC-HERE">
  function loadImages() {
    var imgDefer = document.getElementsByTagName('img');
    for (var i=0; i<imgDefer.length; i++) {
      $l(imgDefer[i]);
      if(imgDefer[i].getAttribute('data-src')) {
        imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
      }
    }
  }
  loadImages(); // run on http page load
  // end

  // Header scroll up function - on every page
  // TODO not perfect but works. Change to only fire scroll event for lrg and while el is visible
  function headsUp(el, w) {
    var lrg = false;
    if(window.innerWidth > w) {
      lrg = true;
    } else {
      lrg = false;
    }
    var elH = el.clientHeight,
        offset = 0,
        lastScroll = 0;
    function makeOffset() {
      var scrollY = document.documentElement.scrollTop || document.body.scrollTop,
          diff = scrollY - lastScroll;
      offset = (offset + diff > elH) ? elH : offset + diff;
      offset = (offset < 0 || scrollY < 0) ? 0 : offset;

      if (lrg) {
        //el.style.top = (-offset) + 'px';
        el.style[transformProperty] = 'translateY(' + -offset + 'px)';
        el.style.position = 'fixed';
      } else {
        //el.style.top = '0px';
        el.style[transformProperty] = 'translateY(0px)';
        el.style.position = 'absolute';
      }
      lastScroll = scrollY;
    }
    makeOffset();
    $evt(window,'scroll',makeOffset); // event helper
  }
  headsUp(header,700);
  $evt(window,'resize',function() {
    headsUp(header,700);
  });
  // end

  // On scroll class change
  function winPos() {
    var doc = document.documentElement,
        winScr = (w.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
    return winScr;
  }
  $evt(w,'scroll',function() {
    if( winPos() > 60) {
      addClass(header,'scroll-shadow');
    } else {
      removeClass(header,'scroll-shadow');
    }
  });

  // Div wrap height function
  function newPageH() {
    var fitVp = function(el,ratio,min,max,setToMin) {
      var setToMin = typeof setToMin !== 'undefined' ? setToMin : false; // if true, it sets min-height
      this.el = el;
      this.ratio = ratio;
      this.min = min;
      this.max = max;
      this.setToMin = setToMin;
      this.currH();
    }
    fitVp.prototype.currH = function() {
      var self = this;

      function elHeight() {
        var winH = window.innerHeight;
        self.currH = (winH >= self.min && winH < self.max) ? winH * self.ratio : (winH >= self.max) ? self.max * self.ratio : self.min * self.ratio;

        if( self.setToMin != true )
          return self.el.style.height = self.currH + 'px';

        return self.el.style.minHeight = self.currH + 'px';
      }
      
      elHeight();
      $evt(window,'resize',elHeight);
    }
    for( var i=0; i<=10; i++ ) {
      var fitEl = $qs('.fit-vp-' + i);
      if(fitEl) {
        r = i / 10;
        new fitVp(fitEl,r,550,1200);
      }
    }
  }
  newPageH();
  // end

  function emailMe() {
    var em1 = 'edwardjpayton',
      em2 = '%40',
      em3 = 'gmail.com';
    window.location = "mailto:" + em1 + em2 + em3 + "?subject=Hello";
  }

  // Responsive menu
  /*var evtFired = false,
      w = 500;
  function togMenu(w) {
    if(window.innerWidth <= w) {
      toggleClass(header,'show-menu');
      evtFired = false;
    }
  }
  $evt($id('menuButton'),'click',function() {
    togMenu(w);
  });
  $evt(window,'resize',function() {
    if(!evtFired) {
      if(window.innerWidth > w) {
        removeClass(header,'show-menu');
        evtFired = true;
      }
    }
  });*/
  // end
  </script>

  @yield('footJs')
</body>
</html>
