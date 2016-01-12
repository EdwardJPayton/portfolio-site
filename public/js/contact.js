function newFunction() {
  $l('executed contact.js');

  // Form input labels
  var inputs = $qsa('input[type="text"],input[type="email"],textarea'),
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
  // Ajax contact form
  var baseUrl = 'http://' + window.location.hostname,
      url = baseUrl + '/contact', // + '/ajax/contact',

      contactForm = $id('contactForm'),
      button = contactForm.querySelector('button'),
      x = $id('x');

  var inputs = $qsa('input[type="text"],input[type="email"],textarea'),
      inLen = inputs.length;
  function errorsOnInputFocus() {
    var self = this,
        parent = self.parentNode,
        errText = parent.querySelector('._error-text');

    if(hasClass(parent,'-error')) {
      removeClass(parent,'-error');
      self.parentNode.removeChild(errText);
    }

    // TODO - TEST THIS
    if (!$qsa('.-error').length) {
      removeClass(contactForm,'-has-errors');
      removeClass(contactForm,'-not-sent');
      button.disabled = false;
    } else {
      $l('still errors');
    }
  }
  for ( i = 0; i < inLen; i++ ) {
    $evt(inputs[i],'keydown',errorsOnInputFocus);
  }

  $evt(x,'click',function() {
    removeClass(contactForm, '-not-sent');
    removeClass(contactForm, '-sent');
    button.disabled = false;
  } ,false); // TODO create console error ( "expected expression got ')'" )

  $evt(contactForm,'submit', function(ev) {
    ev.preventDefault();
    addClass(this,'-sending');
    button.disabled = true;

    removeClass(this,'-has-errors');
    var allErr = $qsa('.-error');
    for ( i = 0; i < allErr.length; i++ ) {
      removeClass(allErr[i],'-error');
    }

    var allErrText = $qsa('._error-text');
    for ( i = 0; i < allErrText.length; i++ ) {
      allErrText[i].parentNode.removeChild(allErrText[i]);
    }

    var ajaxCont = $id('ajaxMessageContent');
    if (!ajaxCont) {
      var ajaxCont = document.createElement('p');
      ajaxCont.id = 'ajaxMessageContent';
    }

    var ajaxMsg = $id('ajaxMessage');
    ajaxMsg.insertBefore(ajaxCont, ajaxMsg.childNodes[0]);

    var csrfToken = $qs('input[name=_token]').value,
        inputBirthday = $id('birthday').value,
        inputName = $id('name').value,
        inputEmail = $id('email').value,
        inputMsg = $id('msg').value;

    var dataStr = '_token=' + csrfToken + '&birthday=' + inputBirthday + '&name=' + inputName + '&email=' + inputEmail + '&msg=' + inputMsg;

    // Send form - ajax
    reqwest({
      method: 'post',
      url: url,
      data: dataStr,
      type: 'json',
      headers: { 'X-CSRF-Token' : csrfToken },
      success: function(data) {
        if(data.sentStatus) {
          // Laravel mail send was successful
          addClass(contactForm, '-sent');
          ajaxCont.innerHTML = 'Thanks for your message ' + data.name + '. I\'ll be speaking to you soon.';
        } else {
          // Else if Laravel mail error
          addClass(contactForm, '-not-sent');
          ajaxCont.innerHTML = data.sentMsg;
        }
      },
      error: function(data) {
        addClass(contactForm, '-has-errors');
        addClass(contactForm, '-not-sent');
        // Create error text fields
        var jsonData = JSON.parse(data.response);
        for (var key in jsonData) {
          //$l(key + ': ' + jsonData[key][0]);

          var errMsg = document.createElement('div'),
              elClass = $qs('.-' + key),
              elVal =  jsonData[key][0];

          addClass(errMsg,'_error-text');
          errMsg.innerHTML = elVal;

          addClass(elClass,'-error');
          elClass.appendChild(errMsg);
        }
        // Show error text fields
        var showErrorText = setTimeout(function() {
          var errMsg = $qsa('._error-text');
          for ( i = 0; i < errMsg.length; i++ ) {
            addClass(errMsg[i],'-show');
          }
        },100);
      },
      complete: function() {
        removeClass(contactForm,'-sending');
      }
    });
  });
  // end

  //http://stackoverflow.com/questions/27216159/loading-google-maps-api-via-ajax-console-error
  //http://www.vijayjoshi.org/2010/01/19/how-to-dynamically-load-the-google-maps-javascript-api-on-demand-loading/
  function loadAPI() {
    var script = document.createElement("script");
    script.src = "http://www.google.com/jsapi?&callback=loadMaps";
    script.type = "text/javascript";
    document.body.appendChild(script);
  }
  function loadMaps() {
    google.load("maps", "3", {"callback" : mapLoaded});
  }
  function mapLoaded() {
    if (GBrowserIsCompatible())
    {
        var map = new GMap2(document.getElementById("map_canvas"));
        map.setMapType(G_SATELLITE_MAP);
        map.setCenter(new GLatLng(28.631466106808542, 77.07853317260742), 5);
    }
  }
  loadAPI();


  // Map
  /*[
      {
          "featureType": "all",
          "elementType": "geometry",
          "stylers": [
              {
                  "color": "#4222f1"
              }
          ]
      },
      {
          "featureType": "all",
          "elementType": "labels.text.fill",
          "stylers": [
              {
                  "gamma": 0.01
              },
              {
                  "lightness": 20
              }
          ]
      },
      {
          "featureType": "all",
          "elementType": "labels.text.stroke",
          "stylers": [
              {
                  "saturation": -31
              },
              {
                  "lightness": -33
              },
              {
                  "weight": 2
              },
              {
                  "gamma": 0.8
              }
          ]
      },
      {
          "featureType": "all",
          "elementType": "labels.icon",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "landscape",
          "elementType": "geometry",
          "stylers": [
              {
                  "lightness": 30
              },
              {
                  "saturation": 30
              }
          ]
      },
      {
          "featureType": "poi",
          "elementType": "geometry",
          "stylers": [
              {
                  "saturation": 20
              }
          ]
      },
      {
          "featureType": "poi.park",
          "elementType": "geometry",
          "stylers": [
              {
                  "lightness": 20
              },
              {
                  "saturation": -20
              }
          ]
      },
      {
          "featureType": "road",
          "elementType": "geometry",
          "stylers": [
              {
                  "lightness": 10
              },
              {
                  "saturation": -30
              }
          ]
      },
      {
          "featureType": "road",
          "elementType": "geometry.stroke",
          "stylers": [
              {
                  "saturation": 25
              },
              {
                  "lightness": 25
              }
          ]
      },
      {
          "featureType": "water",
          "elementType": "all",
          "stylers": [
              {
                  "lightness": -20
              }
          ]
      }
  ]*/
}
newFunction();