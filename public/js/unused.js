// From home.blade
var w = window,
    hidDiv = $q('.header._hidden-menu')[0],
    worksDiv = $q('.works._wrap')[0],
    introDiv = $q('.header._intro')[0],
    headBg = $q('header._bg')[0];

// Helper functions
function winPos() {
  var doc = document.documentElement,
      winScr = (w.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
  return winScr;
}
// Add class to body on scroll
function minHBodyClass(winH) {
  //if( winPos() > (winH / 6 * 5) - 50 ) { // including 50px makes class trigger transition
  if( winPos() > (winH / 6 * 5) ) {
    addClass(body,'header-min-height');
  } else {
    removeClass(body,'header-min-height');
  }
}
// Inner header div opacity
function divOpacity(test) {
  var divOpac = ( hidDiv.offsetHeight - 100) / 100,
      newOpac = divOpac >= 1 ? 1 : divOpac;

  hidDiv.style.opacity = newOpac;
  introDiv.style.opacity = newOpac;

  if (test == 1) {
    // TODO - quick fix for when sudden scroll to top and the function doesnt run correctly. Improve
    hidDiv.style.opacity = 1;
    introDiv.style.opacity = 1;
  }

  // also the header bg image
  //headBg.style.opacity = newOpac;

}
// Adjust header height (load, resize, scroll)
function resizeHeaderH() {
  var winNewH = w.innerHeight,
      scrollPos = winPos(),
      currH = '';

  if ( winNewH >= 600 && winNewH < 1200 ) {
    // normal screen
    currH = winNewH / 6 * 5;
  } else if ( winNewH >= 1200 ) {
    // tall screen
    currH = 1000;
  } else {
    // short screen
    currH = 500;
  }

  newH = currH - scrollPos - 50;

  //hidDiv.style.height = newH + 'px'; // TODO this isnt calculating correctly, needs jquery for some reason
  $(hidDiv).height(newH); // jQ
  worksDiv.style.paddingTop = currH - 50 + 'px';

  minHBodyClass(winNewH);
  divOpacity(0);

  if (scrollPos == 0) {
    divOpacity(1);
  }
}
// Events
resizeHeaderH();
$evt(w,'scroll',resizeHeaderH);
$evt(w,'resize',resizeHeaderH);
// end



// Modal Windows
// http://tympanus.net/Tutorials/ThumbnailGridExpandingPreview/ (alt - itunes style)
var w = window,
    thumb = $('.project._wrap'), // TODO the menu also triggers this
    modal = document.getElementById('modal'),
    content = $('.works._modal-content'),

    modalOpen = false;

// Make the fake div for zoom effect
function modalGo(self) {

    // remove old modal // TODO will I use this?
    if(modalOpen) {
      console.log('old');

      modalOpen = false;
    }

    self.classList.add('-selected');

    var beginAnim = setTimeout(function() {
      // create new
      var tempDiv = document.createElement('div');
      tempDiv.id = 'modal-temp';
      self.appendChild(tempDiv);
      centerThumb(self, modal, tempDiv);
    },600);


};

function centerThumb(thumb, modal, tempDiv) {
  var thumbCords = thumb.getBoundingClientRect();
  var modalCords = modal.querySelector('.works._modal-dialog').getBoundingClientRect();
  var transX, transY, scaleX, scaleY;
  var winW = w.innerWidth / 2;


  thumb.classList.add('-active'); // add class for animating (z-index)

  // scale thumb to same size as modal
  scaleX = modalCords.width / thumbCords.width; //
  scaleY = modalCords.height / thumbCords.height;
  scaleX = scaleX.toFixed(3);
  scaleY = scaleY.toFixed(3);
  tempDiv.style.opacity = '1';
  tempDiv.style[transformProperty] = 'scale(' + scaleX + ',' + scaleY + ')';

  // move thumb to center
  transX = Math.round(winW - thumbCords.left - thumbCords.width / 2);
  //transY = Math.round(winH - thumbCords.top - thumbCords.top / 2);

  thumb.style[transformProperty] = 'translateX(' + transX + 'px)';

  //
  window.setTimeout(function() {
    window.requestAnimationFrame(function() {
      openModal(modal, tempDiv);
    });
  }, 500);

};

function openModal(modal, tempDiv) {
  if (!modalOpen) {
    var content = modal.querySelector('.works._modal-content');
    modal.classList.add('-active');
    content.classList.add('-active');

    content.addEventListener('transitionend', hideTempDiv, false);

    modalOpen = true;
  }

  function hideTempDiv() {
    // fadeout div so that it can't be seen when the window is resized
    //tempDiv.style.opacity = '0';
    content.removeEventListener('transitionend', hideTempDiv, false);
  }
};

function closeModal() {

  var tempDiv = document.getElementById('modal-temp');

  if(modalOpen) {
    // Show tempDiv again, reset style
    tempDiv.style.opacity = '1';
    tempDiv.removeAttribute('style');
    //tempDiv.classList.add('-anim');
    //tempDiv.style.transform = 'scale(1,1)';

    $('.project._wrap.-active').addClass('-anim');

    //modals.removeClass('-active'); // TODO - change this to ID
    modal.classList.remove('-active');
    content.removeClass('-active');
    thumb.css('transform','none'); // TODO Modernizr this transform
    thumb.removeClass('-active');

    modalOpen = false;

  }

  // Remove tempDiv
  tempDiv.addEventListener('transitionend', function() {
    tempDiv.style.opacity = '0';
    thumb.removeClass('-selected');
    setTimeout(function() {
      window.requestAnimationFrame(function() {
        // remove the temp div from the dom with a slight delay so the animation looks good
        tempDiv.remove();
        thumb.removeClass('-anim');
      });
    }, 500);
  });

};

$('.project._wrap').click(function(e){ // TODO the menu also triggers this
  e.preventDefault();
  var self = this;
  modalGo(self);

  // TODO scroll page to portfolio section
});

$('._modal-close').click(function(e) {
  e.preventDefault();
  closeModal();
});

// JS smooth scroll
// http://stackoverflow.com/questions/17722497/scroll-smoothly-to-specific-element-on-page
// http://stackoverflow.com/questions/10063380/javascript-smooth-scroll-without-the-use-of-jquery


// From html.blade
// Full height divs
var fullHdiv = $q('.full-h'),
    fLen  = fullHdiv.length;
function measureH() {
  var winHeight = window.innerHeight,
      divHeight = $(fullHdiv).height();
  return { winH: winHeight, divH: divHeight };
}
function onLoadH() { // Ok
  var H = measureH();
  if(H.winH > H.divH) {
      for (var i = 0; i < fLen; i++) {
        fullHdiv[i].style.minHeight = H.winH + 'px';
      }
  }
}
function onResizeH() { // TODO - test and debug
  var H = measureH(),
      diffH = H.winH - H.divH,
      newH = H.divH - diffH,
      contH = $(fullHdiv).height();
  if(H.winH > contH) {
      for (var i = 0; i < fLen; i++) {
        fullHdiv[i].style.minHeight = H.winH + 'px';
      }
  }
}

// Menu animation
var body = document.getElementsByTagName("BODY")[0], //$('body'),
    tog = document.getElementById('menuTog'), //$('#menuTog'),
    //overlay = $('#overlay'),
    navA = $('#navMain a'),
    hiddenMenu = $('.header._hidden-menu');

tog.addEventListener('click', menuAnim, false);

function menuAnim() {
  //tog.classList.toggle('active');
  toggleClass(tog,'active')

  //body.classList.add('menu-anim');
  addClass(body,'menu-anim');
  var menuAnim = setTimeout(function() {
    //body.classList.remove('menu-anim');
    removeClass(body,'menu-anim');
  },500);

  //body.classList.toggle('menu-open');
  toggleClass(body,'menu-open');

  openMenuH();

}

function openMenuH() {
  // Open menu height
  var winH = measureH().winH,
      hiddenMenuH = hiddenMenu.height();

  if ( hiddenMenuH == 0 ) {
    if ( winH >= 400 ) {
      var openH = (winH / 2) - 50;
    } else {
      var openH = 150;
    }
  } else {
    var openH = 0;
  }
  // TODO use modernizr for this - http://code.runnable.com/Ul8dbNWTyDg8AAAZ/how-to-use-modernizr-prefixed-to-avoid-boilerplate-for-jquery-html5-javascript-and-css3
  hiddenMenu.height( openH );
  $('.scroll._wrap').css({
    '-webkit-transform': 'translateY(' + openH + 'px)',
    '-ms-transform': 'translateY(' + openH + 'px)',
    'transform': 'translateY(' + openH + 'px)'
  });


  /*var scrWrap = $q('.scroll._wrap');

  var transformProperty = Modernizr.prefixed('transform');
  scrWrap[0].style[transformProperty] = 'translateY(' + openH + 'px)';*/

  // Change opacity
  var currOpac = hiddenMenu.css('opacity'); // TODO chnage this to js
  newOpac = currOpac == 0 ? 1 : 0;
  hiddenMenu.css('opacity', newOpac ); // TODO transition
}

// Scroll to section
$('#navMain a').on('click',function(e) {
    e.preventDefault();
    var mainT = $('main').offset().top;
    $('.scroll._wrap').animate({
      scrollTop: $( $.attr(this, 'href') ).offset().top - mainT
    }, 500);
    // Timeout until after the scroll has started (looks nicer)
    setTimeout(function(){
        menuAnim();
    },200);
});