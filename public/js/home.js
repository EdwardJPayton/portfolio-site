function newFunction() {
  $l('executed home.js');

  imgLoaded( $id('introBg') );

  // TODO
  // Fontsize - http://stackoverflow.com/questions/22943186/html5-canvas-font-size-based-on-canvas-size
  // Performance
  // Resize canvas AFTER final resize

  var introCanvas = function() {
    var body = document.body;
    var html = document.documentElement;
    var pixels = new Array();
    var canvP = $id('introCanvas');
    var canv;
    var ctx; // = canv.getContext('2d');
    var mx = -1;
    var my = -1;
    var words = "Pixels";
    var txt = new Array();
    var cw = 0;
    var ch = 0;
    var resolution = 1;
    var n = 0;
    var timerRunning = false;
    var resHalfFloor = 0;
    var resHalfCeil = 0;

    var r = 241,
       g = 240,
       b = 222,
       a = 255;


    function onLoadGo() {
      canv = document.createElement('canvas');

      // Browser supports canvas? If not - the default text will be displayed
      if( canv.getContext && canv.getContext('2d') ) {
        canvP.innerHTML = '';
        canvP.appendChild(canv);
        ctx = canv.getContext('2d');
        //$qs('.home-intro._canvas').style.display = "none";
      }
    }
    onLoadGo();

    function canvMousemove(evt) {
    var canvRec = canv.getBoundingClientRect();

     mx = evt.clientX - canvRec.left //- canv.offsetLeft;
     my = evt.clientY - canvRec.top; //- canv.offsetTop;
    }

    function canvMouseout(evt) {
     mx = -1;
     my = -1;
    }

    function canvTouchUp(evt) {
    mx = -1;
    my = -1;
    }

    function Pixel(homeX, homeY) {
     this.homeX = homeX;
     this.homeY = homeY;

     this.x = Math.random() * cw;
     this.y = Math.random() * ch;

     //tmp
     this.xVelocity = Math.random() * 10 - 5;
     this.yVelocity = Math.random() * 10 - 5;
    }
    Pixel.prototype.move = function() {
     var homeDX = this.homeX - this.x;
     var homeDY = this.homeY - this.y;
     var homeDistance = Math.sqrt(Math.pow(homeDX, 2) + Math.pow(homeDY, 2));
     var homeForce = homeDistance * 0.05; // 0.1; // speed
     var homeAngle = Math.atan2(homeDY, homeDX);

     var cursorForce = 0;
     var cursorAngle = 0;

     if (mx >= 0) {
       var cursorDX = this.x - mx;
       var cursorDY = this.y - my;
       var cursorDistanceSquared = Math.pow(cursorDX, 2) + Math.pow(cursorDY, 2);
       cursorForce = Math.min(5000 / cursorDistanceSquared, 5000);
       cursorAngle = Math.atan2(cursorDY, cursorDX);
     } else {
       cursorForce = 0;
       cursorAngle = 0;
     }

     this.xVelocity += homeForce * Math.cos(homeAngle) + cursorForce * Math.cos(cursorAngle);
     this.yVelocity += homeForce * Math.sin(homeAngle) + cursorForce * Math.sin(cursorAngle);

     this.xVelocity *= 0.8; //bounce
     this.yVelocity *= 0.8; //bounce

     this.x += this.xVelocity;
     this.y += this.yVelocity;

     this.homeForce = homeForce;
     this.homeAngle = homeAngle;
     this.cursorForce = cursorForce;
     this.cursorAngle = cursorAngle;
    }

    function $(id) {
     return document.getElementById(id);
    }

    function timer() {
     for (var i = 0; i < pixels.length; i++) {
       pixels[i].move();
     }

     drawPixels();
     //wordsTxt.focus();

     requestAnimFrame(timer);
    }

    function drawPixels() {
     var imageData = ctx.createImageData(cw, ch);
     var actualData = imageData.data;

     var index;
     var goodX;
     var goodY;
     var realX;
     var realY;

     for (var i = 0; i < pixels.length; i++) {
       goodX = Math.floor(pixels[i].x);
       goodY = Math.floor(pixels[i].y);

       for (realX = goodX - resHalfFloor; realX <= goodX + resHalfCeil && realX >= 0 && realX < cw; realX++) {
         for (realY = goodY - resHalfFloor; realY <= goodY + resHalfCeil && realY >= 0 && realY < ch; realY++) {
           index = (realY * imageData.width + realX) * 4;
           actualData[index + 0] = r; // R //Math.floor((Math.random() * 255))
           actualData[index + 1] = g; // G
           actualData[index + 2] = b; // B
           actualData[index + 3] = a; // Alpha
         }
       }
     }

     imageData.data = actualData;

     ctx.putImageData(imageData, 0, 0);
    }

    function readWords() {
     txt = words.split('\n');
    }

    function init() {
     readWords();

     var fontSize = 200;
     var wordWidth = 0;
     do {
       wordWidth = 0;
       fontSize -= 5;
       ctx.font = "900 " + fontSize + "px 'Source Sans Pro', sans-serif";
       for (var i = 0; i < txt.length; i++) {
         var w = ctx.measureText(txt[i]).width;
         if (w > wordWidth) wordWidth = w;
       }
     } while (wordWidth > cw - 50 || fontSize * txt.length > ch - 50)

     ctx.clearRect(0, 0, cw, ch);
     ctx.textAlign = "center";
     ctx.textBaseline = "middle";
     //ctx.font = 300 + "px sans-serif";
     //ctx.fillText(txt,cw / 2, ch / 2);//

     for (var i = 0; i < txt.length; i++) {

       ctx.fillText(txt[i], cw / 2, ch / 2 - fontSize * (txt.length / 2 - (i + 0.5)));

    }



     var index = 0;

     var imageData = ctx.getImageData(0, 0, cw, ch);
     for (var x = 0; x < imageData.width; x += resolution) {
       for (var y = 0; y < imageData.height; y += resolution) {
         i = (y * imageData.width + x) * 4;

         if (imageData.data[i + 3] > 128) {
           if (index >= pixels.length) {
             pixels[index] = new Pixel(x, y);
             //console.log(1);

           } else {
             pixels[index].homeX = x;
             pixels[index].homeY = y;
             //console.log(2)
           }
           index++;
         }
       }
     }

     pixels.splice(index, pixels.length - index);
    }

    function body_resize() {

    var introContent = document.querySelector('.home-intro._content');
    var correctW = introContent.clientWidth;

    var computedStyle = getComputedStyle(introContent, null);
    correctW -= parseFloat(computedStyle.paddingLeft) + parseFloat(computedStyle.paddingRight);

     cw = correctW; //document.body.clientWidth;
     //ch = document.body.clientHeight;
     ch = 600; //Math.max(body.scrollHeight, body.offsetHeight,
       //html.clientHeight, html.scrollHeight, html.offsetHeight);

     console.log(cw);
     canv.width = cw;
     canv.height = ch;
     //wordCanv.width = cw;
     //wordCanv.height = ch;

     init();
    }

    window.onresize = function() {
     body_resize();
    }

    $id('introCanvas').addEventListener("mousemove", canvMousemove);
    $id('introCanvas').addEventListener("mouseout", canvMouseout);

    //wordsTxt.focus();

    resHalfFloor = Math.floor(resolution / 2);
    resHalfCeil = Math.ceil(resolution / 2);

    body_resize();

    window.requestAnimFrame = (function() {
    return  window.requestAnimationFrame       ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame    ||
      window.oRequestAnimationFrame      ||
      window.msRequestAnimationFrame     ||

      function(callback) {
        window.setTimeout(callback, 1000 / 60);
      };
    })();
    timer();
  }
  //introCanvas();



  // Hello ticker text
  /*var TxtType = function(el, jsonNum, elInitial) {
      this.jsonNum = jsonNum;
      this.el = el;
      this.loopNum = 0;
      this.txt = elInitial;
      this.tick();
      this.isDeleting = false;
  };
  TxtType.prototype.tick = function() {
      var i = this.loopNum % this.jsonNum.length;
      var fullTxt = this.jsonNum[i];

      if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
      } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
      }

      this.el.innerHTML = this.txt;

      var self = this;
      var delta = 100 - Math.random() * 100; // typing speed

      if (this.isDeleting) { delta /= 2; } // deleting speed

      if (!this.isDeleting && this.txt === fullTxt) {
        this.isDeleting = true;
        delta = 2000; // the pause after the string has finished "writing"
      } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500; // the pause between ending and starting a new string
      }

      setTimeout(function() {
        self.tick();
      }, delta);
  };
  function typeGo(el) {
    var elType = el.getAttribute('data-text');
    if(elType) {
      var elJsonStr = JSON.parse(elType),
          elInitial = el.innerHTML || '';
      new TxtType(el, elJsonStr, elInitial);
    }
  }
  setTimeout(function() {
    var el = $id('helloType');
    typeGo(el);
  }, 2000);
  // end
  */

  //http://jsfiddle.net/edwardomni/WAtVQ/
  //https://css-tricks.com/slide-in-as-you-scroll-down-boxes/
  
}
newFunction();