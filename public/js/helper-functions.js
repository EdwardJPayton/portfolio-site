// Selector shorthand(s)
function $qsa(el) {
  return document.querySelectorAll(el);
}
function $qs(el) {
  return document.querySelector(el);
}
function $id(el) {
  return document.getElementById(el);
}

// Console shorthand
function $l($m) {
  return console.log($m);
}

// Manage classNames // TODO implement these, test toggle
// http://jaketrent.com/post/addremove-classes-raw-javascript/
/*function hasClass(el, className) {
  if (el.classList)
    return el.classList.contains(className)
  else
    return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'))
}*/

function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}
function addClass(el, className) {
  if (el.classList)
    el.classList.add(className)
  else if (!hasClass(el, className)) el.className += " " + className
}
function removeClass(el, className) {
  if (el.classList)
    el.classList.remove(className)
  else if (hasClass(el, className)) {
    var reg = new RegExp('(\\s|^)' + className + '(\\s|$)')
    el.className = el.className.replace(reg, ' ')

    // el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
  }
}
function toggleClass(el, className) {
  if (el.classList) {
    el.classList.toggle(className);
  } else {
    var classes = el.className.split(' ');
    var existingIndex = -1;
    for (var i = classes.length; i--;) {
      if (classes[i] === className)
        existingIndex = i;
    }
    if (existingIndex >= 0)
      classes.splice(existingIndex, 1);
    else
      classes.push(className);
    el.className = classes.join(' ');
  }
}
//

// Cross browser event listener solution
function $evt(el,myEvent,myFunction) {

  if (document.addEventListener) {
    return el.addEventListener(myEvent, myFunction, false);
  } else if (document.attachEvent) {
    myEvent = 'on' + myEvent;
    return el.attachEvent(myEvent, myFunction);
  }
}

// Transform with Modernizr
var transformProperty = Modernizr.prefixed('transform');

// Add class to image when loaded
function imgLoaded(myEl) {
  function getBgUrl(myEl) {
      var bg = "";
      if (myEl.currentStyle) { // IE
          bg = myEl.currentStyle.backgroundImage;
      } else if (document.defaultView && document.defaultView.getComputedStyle) { // Firefox
          bg = document.defaultView.getComputedStyle(myEl, "").backgroundImage;
      } else { // try and get inline style
          bg = myEl.style.backgroundImage;
      }
      return bg.replace(/url\(['"]?(.*?)['"]?\)/i, "$1");
  }
  var image = document.createElement('img');
  image.src = getBgUrl(myEl);
  image.onload = function () {
      myEl.className = myEl.className + ' loaded';
  };
}
// imgLoaded($id('myId'));

