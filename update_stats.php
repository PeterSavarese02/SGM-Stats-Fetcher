<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Console</title>
    <style media="screen">
    body {
      background: black;
      color: white;
    }

    pre code {
      font: 11pt/1.25 Monaco, monospace;
    }

    .debug { color: Snow; }
    .info  { color: LawnGreen; }
    .warn  { color: GoldenRod; }
    .error { color: LightCoral; }
    </style>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/canvas.js"></script>
    <script type="text/javascript" src="js/jquery.plugin.html2canvas.js"></script>
  </head>
  <body>
    <form method="POST" enctype="multipart/form-data" action="save.php" id="myForm">
       <input type="hidden" name="img_val" id="img_val" value="" />
    </form>
    <div id="target">
          <div id='new-projects'></div>
    </div>
  </body>
  <script type="text/javascript">
  /**
   * This pen allows you to use all your favourite console functions right in
   * CodePen: `console.log`, `console.info`, `console.warn`, `console.error`,
   * and `console.clear` are supported.
   *
   * To scroll the console to the bottom as messages are printed use the
   * `console.follow` function.
   *
   * Made with love by @nullobject (http://joshbassett.info), 2014.
   */

  var console = (function() {
    var following = false,
        pre       = document.createElement('pre'),
        code      = document.createElement('code');

    pre.appendChild(code);
    document.body.appendChild(pre);

    return {
      clear:  clear,
      follow: follow,
      log:    print.bind(this, 'debug'),
      info:   print.bind(this, 'info'),
      warn:   print.bind(this, 'warn'),
      error:  print.bind(this, 'error')
    };

    function clear() {
      while (code.hasChildNodes()) {
        code.removeChild(code.lastChild);
      }
    }

    function follow() {
      following = true;
    }

    function print(className, object) {
      var s    = (typeof object === 'string') ? object : JSON.stringify(object),
          span = document.createElement('span'),
          text = document.createTextNode(s + '\n');

      span.setAttribute('class', className);
      span.appendChild(text);
      code.appendChild(span);

      if (following) {
        scrollToBottom();
      }
    }

    function scrollToBottom() {
      window.scrollTo(0, document.body.scrollHeight);
    }
  }());
  </script>
  <script type="text/javascript">
  /**
  * Return a timestamp with the format "m/d/yy h:MM:ss TT"
  * @type {Date}
  */

  function timeStamp() {
  // Create a date object with the current time
  var now = new Date();

  // Create an array with the current month, day and time
  var date = [ now.getMonth() + 1, now.getDate(), now.getFullYear() ];

  // Create an array with the current hour, minute and second
  var time = [ now.getHours(), now.getMinutes(), now.getSeconds() ];

  // Determine AM or PM suffix based on the hour
  var suffix = ( time[0] < 12 ) ? "AM" : "PM";

  // Convert hour from military time
  time[0] = ( time[0] < 12 ) ? time[0] : time[0] - 12;

  // If hour is 0, set it to 12
  time[0] = time[0] || 12;

  // If seconds and minutes are less than 10, add a zero
  for ( var i = 1; i < 3; i++ ) {
    if ( time[i] < 10 ) {
      time[i] = "0" + time[i];
    }
  }

  // Return the formatted string
  return date.join("/") + " " + time.join(":") + " " + suffix;
  }
  </script>
  <script type="text/javascript">
     setInterval(function() {
       $(function(){
       var contentURI= 'https://www.seriousgmod.com/stats/stats.php?steamid=STEAM_0:1:110286191';
       $('#new-projects').load('grabber.php?url='+ contentURI);
       });
     	$('#new-projects').html2canvas({
     		onrendered: function (canvas) {
              //Set hidden field's value to image data (base-64 string)
     			$('#img_val').val(canvas.toDataURL("image/png"));
                    //Submit the form manually
              $.ajax({
                  url:'save.php',
                  type:'post',
                  data:$('#myForm').serialize(),
                  success:function(){
                      console.info ( 'Stats have been updated! Updated at: ' + timeStamp() );
                  }
              });
     		}
     	});
     }, 5 * 1000);
  </script>

</html>
