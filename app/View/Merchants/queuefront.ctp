<html xmlns:fb="https://www.facebook.com/2008/fbml">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<script type="text/javascript" src="//sslstatic.wix.com/services/js-sdk/1.17.0/js/Wix.js"></script>

<script type="text/javascript" src="//use.typekit.net/vid1sqp.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> 
<script type="text/javascript" src="http://oauth.googlecode.com/svn/code/javascript/oauth.js"></script>
<script type="text/javascript" src="http://oauth.googlecode.com/svn/code/javascript/sha1.js"></script>
<script type="text/javascript" src="https://raw.github.com/padolsey/prettyPrint.js/master/prettyprint.js"></script>

<style>

  body {
    font-size: 20px;
    line-height: 30px;
  }

 <?php if (!isset($_GET["small"])) {  ?>
  @media only screen 
  and (min-device-width : 568px) {
    body {
      font-size: 30px;
      line-height: 45px;
    }
  }
    <?php } ?>
  
  .footer {
    position: absolute;
    text-align: center;
    white-space: nowrap;
    width: 100%;
    bottom: 0;
    padding: 2% 0;
    border-top: 1px solid #ddd;
  }
  
  .queued .seats, .setup .name {
    margin-top: 5%;
  }
  
  .queued .seats, .queued .position, .queued .estimate, .setup .name, .setup .seats, .setup .labels {
    margin-left: 3%;
  }

  @media screen and (orientation:landscape) {
    .footer {
      position: relative;
      margin-top: 5%;
    }
  }

  body {
    font-family: "faricy-new-web", helvetica;
    font-weight: 300;
    width: 100%;
    margin: 0;
    padding: 0;
    -webkit-tap-highlight-color: rgba(255, 255, 255, 0); 
  }

  .setup, .queued, span.bar, span.bbq, span.patio, .enqueue, .update, .thank {
    display: none;
  }
  
  
  /* Header */
  .restaurant {
    display: block;
    width: 100%;
    height: 25%;
    overflow: hidden;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    margin-bottom: 3%;
    border-bottom: 1px solid black;
    line-height: 90%;
    -moz-box-shadow: 0 0 25px 3px #666;
    -webkit-box-shadow: 0 0 25px 3px #666;
    box-shadow: 0 0 25px 3px #666;
  }
  
  .restaurant div {
    padding: 3%;
    font-weight: 600;
    /*
    text-shadow: -1px -1px 0 white,   
                 1px -1px 0 white, 
                 -1px 1px 0 white,
                 1px 1px 0 white;
    */
    color: white;
    text-shadow: 0 1px 0 black,
                 1px 0 0 black;
  }
  
  .restaurant .name {
    font-size: 120%;
  }
  
  .restaurant .address {
    font-size: 90%;
    line-height: 110%;
  }
  
  
  /* Queued */
  div.seats span.seats, div.position span.position, div.estimate span.estimate {
    font-size: 110%;
    text-decoration: blink;
  }
  
  div.seats, div.position, div.estimate {
    margin: 5px;
    padding-left: 35px;
    background-size: 30px;
    background-position: 0%;
    background-repeat: no-repeat;
  }
  
  div.seats {
    background-image: url(http://queuefor.me/img/table-icon.png);
  }
  
  div.position {
    background-image: url(http://queuefor.me/img/queue-icon.png);
  }
  
  div.estimate {
    background-image: url(http://queuefor.me/img/clock-icon.png);
  }
  
  /* Buttons */
  .footer div.button + div.button {
    border-left: 1px solid #ddd;
    margin-left: -1px;
  }
  
  .button {
    width: 50%;
    height: 40px;
    display: inline-block;
  }
  
  .buttonIcon {
    width: 40px;
    height: 40px;
    display: inline-block;
    vertical-align: middle;
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
  }
  
  .buttonText {
    margin-left: 10px;
    display: inline-block;
    vertical-align: middle;
    margin-left: 10px;
  }
  
  .cancel {
    background-image: url(http://queuefor.me/img/cross-icon.png);
  }
  
  .edit {
    background-image: url(http://queuefor.me/img/edit-icon.png);
  }
  
  /* Facebook */
  .media {
    margin-top: 10px;
    text-align: center;
  }
  
  .media div {
    background-repeat: no-repeat;
    background-size: 35px;
    background-position: 5px;
    display: inline-block;
    line-height: 110%;
    margin: 2px;
    font-weight: bold;
    font-size: 90%;
    border: 1px solid #aaa;
    border-radius: 4px;
    padding: 5px 5px 5px 50px;
  }
  
  .facebook {
    background-image: url(http://queuefor.me/img/facebook-icon.png);
  }
  
  .yelp {
    background-image: url(http://queuefor.me/img/yelp-icon.png);
  }
  
  .thank {
    text-align: middle;
    padding: 20px;
  }
  
  
  /* Setup */
  .setup {
    position: relative;
    width: 80%;
    margin: 0 auto;
  }
  
  .setup span.name, .setup span.seats {
    display: inline-block;
    margin: 1%;
    width: 25%;
    margin-left: 10px;
  }
  
  .labels {
    margin: 1%;
  }
  
  .labels input {
    margin-right: 5px;
  }
  
  input.text, select {
    height: 30px;
    width: 60%;
    vertical-align: text-bottom;
  }
  
  .enqueue, .update {
    position: relative;
    border-radius: 5px;
    padding: 8px;
    cursor: pointer;
    width: 120px;
    text-align: center;
    margin: 15px auto;
    vertical-align: middle;
    
    background-repeat: no-repeat;
    background-size: 40px;
    background-position: 5px;
    line-height: 110%;
    border: 1px solid #aaa;
    padding: 15px 5px 15px 50px;
  }
  
  .enqueue {
    background-image: url(http://queuefor.me/img/queue-icon.png);
  }
 
  .update {
    background-image: url(http://queuefor.me/img/tick-icon.png);
  }
 
 
  /* Shroud */
  .shroud {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.2);
    display: none;
  }
</style>
<body>
  <div class="restaurant">
    <div class="name"></div>
    <div class="address"></div>
  </div>
  <div class="setup">
    <span class="name">Name: </span><input type="text" class="text name"><br/>
    <span class="seats">Seats: </span><select class="select seats">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4" selected="selected">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select><br/>
    <div class="labels"></div>
    <div class="enqueue" onclick="enqueue()">Queue Now!</div>
    <div class="update" onclick="update()">Update</div>
  </div>
  <div class="queued">
    <div class="seats"><span class="seats">0</span> in your party<span class="label"></span>.<br/></div>
    <div class="position"><span class="position">0</span> part<span class="positionPlural">ies</span><span class="positionSingular">y</span> ahead of you.<br/></div>
    <div class="estimate"><span class="estimate">0</span> minute<span class="estimatePlural">s</span> approximate wait.<br/></div>
    <div class="media">
      <div class="facebook">Check in on<br>Facebook!</div>
      <div class="yelp">Check in<br>on Yelp!</div>
    </div>
    <div class="footer">
      <div class="button" onclick="edit()"><div class="buttonIcon edit"></div><div class="buttonText">Edit</div></div><div class="button" onclick="cancel()"><div class="buttonIcon cancel"></div><div class="buttonText">Cancel</div></div>
    </div>
  </div>
  <div class="thank">
    Thank you for using q4me!<br>
    Have a pleasent meal.
  </div>
  <div class="shroud">
  </div>
</body>
<script>

  function createCookie(name, value, days) {
    var expires;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
    } else {
      expires = "";
    }
    document.cookie = name + "=" + value + expires;
  }

  function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1, c.length);
      }
      if (c.indexOf(nameEQ) == 0) {
        return c.substring(nameEQ.length, c.length);
      }
    }
    return null;
  }

  function eraseCookie(name) {
    createCookie(name,"",-1);
  }

</script>

<script>

  var merchant = <?php echo $merchantJson; ?>; 
  var merchantLocation = <?php echo $merchantLocationJson; ?>;
  var state;
  var qid = readCookie('qid');
  var mid = readCookie('mid');
  var periodicPoll;
  var initialized = false;
  var lastPing = false;
  
  function bind(func, obj) {
    var args = Array.prototype.slice.call(arguments, 2);
    return function() {
      return func.apply(obj, args.concat(Array.prototype.slice.call(arguments)));
    };
  }
  
  function encode(params) {
    var output = '';
    for (prop in params) {
      output += prop + ':' + encodeURIComponent(params[prop]) + '/';
    }
    return output;
  }
  
  function sendXhr(page, callback, params) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://queuefor.me/queues/' + page + '/' + encode(params));
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        if (callback) {
          callback(JSON.parse(xhr.responseText));
        }
      } else if (xhr.readyState == 4) {
        location.reload();
      }
    }
    xhr.send(null);
  }

  function makeLabel(text) {
    var labelDiv = document.createElement('div');

    var labelElement = document.createElement('input');
    labelElement.type = 'radio';
    labelElement.name = 'label';
    labelElement.value = text;
    labelDiv.appendChild(labelElement);
    
    var labelText = document.createTextNode(text);
    labelDiv.appendChild(labelText);
    
    return labelDiv;
  }
  
  function init() {
    if (qid && mid != merchant.id) {
      eraseCookie('qid');
      eraseCookie('mid');
      qid = null;
      mid = null;
    }
    
    Array.prototype.slice.call(document.querySelectorAll('.setup, .queued, .enqueue, .update, .thank')).forEach(function(element) {
      element.style.display = 'none';
    });
    
    if (!initialized) {
      document.querySelector('.restaurant').style.backgroundImage = 'url(' + merchant.imageurl + ')';
      document.querySelector('.restaurant .name').innerHTML = merchant.name;
      document.querySelector('.restaurant .address').innerHTML = merchant.address;
      
      var labels = merchant.options.split(';');
      var labelsElement = document.querySelector('.labels');
      labelsElement.innerHTML = '';
      if (labels.length > 0) {
        var label = makeLabel('None');
        label.querySelector('input').checked = true;
        labelsElement.appendChild(label);
      }
      for (var i = 0, label; label = labels[i]; i++) {
        labelsElement.appendChild(makeLabel(label));
      }
      
      if (!merchant.yelpaddress || merchant.yelpaddress == '') {
        document.querySelector('.yelp').style.display = 'none';
      } else {
        document.querySelector('.yelp').onclick = bind(function(address) {
          window.open(address);
        }, null, merchant.yelpaddress);
      }
    }
    
    if (qid) {
      document.querySelector('.queued').style.display = 'block';
      clearTimeout(periodicPoll);
      periodicPoll = setTimeout(poll, 500);
    } else {
      document.querySelector('.enqueue').style.display = 'block';
      document.querySelector('.setup').style.display = 'block';
    }
  }
  
  function request(page, callback) {
    var params = {};
  
    params.name = document.querySelector('input.name').value;
    params.seats = parseInt(document.querySelector('select.seats').value);
    params.options = '';
    params.merchantID = merchant.id;
    
    var labels = document.querySelectorAll('.labels input');
    for (var i = 0, label; label = labels[i]; i++) {
      if (label.value != 'None' && label.checked) {
        params.options += label.value + ';';
      }
    }
    
    if (qid) {
      params.queueID = qid;
    }
    
    sendXhr(page, callback, params);
  }
  
  function enqueue() {
    document.querySelector('.shroud').style.display = 'block';
    request('enqueue', function(data) {
      document.querySelector('.shroud').style.display = 'none';
      createCookie('qid', data.Queue.id, 1);
      createCookie('mid', merchant.id, 1);
      qid = readCookie('qid');
      mid = readCookie('mid');
      init();
    });
  };
  
  function poll() {
    sendXhr('poll', function(data) {
      state = data;
    
      document.querySelector('div.seats span.seats').innerHTML = data.Queue.seats;
      document.querySelector('div.position span.position').innerHTML = data.Queue.position;
      if (data.Queue.position == 1) {
        document.querySelector('div.position span.positionSingular').style.display = 'inline';
        document.querySelector('div.position span.positionPlural').style.display = 'none';
      } else {
        document.querySelector('div.position span.positionSingular').style.display = 'none';
        document.querySelector('div.position span.positionPlural').style.display = 'inline';
      }
      document.querySelector('div.estimate span.estimate').innerHTML = Math.round(parseInt(data.Queue.estimatedwaitsecs) / 60);
      if (Math.round(parseInt(data.Queue.estimatedwaitsecs) / 60) == 1) {
        document.querySelector('div.estimate span.estimatePlural').style.display = 'none';
      } else {
        document.querySelector('div.estimate span.estimatePlural').style.display = 'inline';
      }
      document.querySelector('.label').innerHTML = data.Queue.options == '' ? '' : ' for ' + data.Queue.options.replace(/;$/, '').replace(/;/g, ', ');
      
      if (!initialized) {
        document.querySelector('input.name').value = data.User.fullname;
        document.querySelector('select.seats').value = data.Queue.seats;
        var labels = data.Queue.options.split(';');
        for (var i = 0, label; label = labels[i]; i++) {
          document.querySelector('input[type="radio"][value="' + label + '"]').checked = true;
        }
        initialized = true;
      }
      
      if (data.Queue.completedcheckins.indexOf('facebook') != -1) {
        document.querySelector('.facebook').style.backgroundImage = 'url(http://queuefor.me/img/tick-icon.png)';
        document.querySelector('.facebook').innerHTML = 'Checked in<br/>on Facebook';
        document.querySelector('.facebook').onclick = null;
      }
      
      var nextPoll = 500;
      
      if (data.Queue.cancelled != '') {
        alert('Your queue request has been terminated. Please queue again.');
        eraseCookie('cid');
        eraseCookie('mid');
        qid = null;
        mid = null;
        init();
      } else if (data.Queue.pinged && !data.Queue.fulfilled) {
        if (lastPing != data.Queue.pinged) {
          lastPing = data.Queue.pinged;
          var snd = new Audio('http://www.soundjay.com/phone/sounds/telephone-ring-2.mp3');
          var alerted = {alerted: false};
          snd.addEventListener('playing', bind(function(snd, alerted) {
            if (!alerted.alerted) {
              alerted.alerted = true;
              alert('A table is available for you!');
              snd.pause();
            }
          }, null, snd, alerted));
          snd.play();
          if (window.navigator.vibrate) {
            window.navigator.vibrate(2000);
          }
          window.setTimeout(bind(function() {
            if (!alerted.alerted) {
              alerted.alerted = true;
              alert('A table is available for you!!');
              snd.pause();
            }
          }, null, snd, alerted), 1000);
        }
        periodicPoll = setTimeout(poll, nextPoll);
      } else if (!data.Queue.fulfilled) {
        periodicPoll = setTimeout(poll, nextPoll);
      } else {
        eraseCookie('cid');
        thankYou();
      }
    }, {queueID: qid});    
  }
  
  function thankYou() {
    qid = null;
    mid = null;
    eraseCookie('qid');
    eraseCookie('mid');
      
    Array.prototype.slice.call(document.querySelectorAll('.setup, .queued, .enqueue, .update, .thank')).forEach(function(element) {
      element.style.display = 'none';
    });
    document.querySelector('.thank').style.display = 'block';
  }
  
  function cancel() {
    sendXhr('cancel', function() {
      clearTimeout(periodicPoll);
      thankYou();
    }, {queueID: qid});
  }
  
  function edit() {
    clearTimeout(periodicPoll);
    Array.prototype.slice.call(document.querySelectorAll('.setup, .queued, .enqueue, .update, .thank')).forEach(function(element) {
      element.style.display = 'none';
    });
    document.querySelector('.update').style.display = 'block';
    document.querySelector('.setup').style.display = 'block';
    document.querySelector('.setup .seats').focus();
  }
  
  function update() {
    document.querySelector('.shroud').style.display = 'block';
    request('update', function(data) {
      document.querySelector('.shroud').style.display = 'none';
      init();
    });
  }
  
  init();
  
</script>
<!-- <iframe src="q4me://<?php echo $merchantID; ?>" width=0; height=0></iframe> -->

<div id="fb-root"></div>

<script type="text/javascript">
  window.fbAsyncInit = function() {
    FB.init({appId: '481273731946284', status: true, cookie: true, xfbml: true, oauth: true});

    document.querySelector('.facebook').onclick = function() {
      FB.login(function(response) {
        if (response.authResponse) {
          prepare(response);
        }
      }, {scope: 'publish_stream, publish_checkins'});  	//{scope:'email,user_birthday,status_update,publish_stream,user_about_me'}
    }
  };
  
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());

  function prepare(response){
    if (response.authResponse) {
      var accessToken = response.authResponse.accessToken;
      var fbid = merchant.facebookid;
      if (fbid == 0) {
        var query = FB.Data.query('SELECT page_id FROM place WHERE distance(latitude, longitude, "' + merchantLocation.lat + '", "' + merchantLocation.lng + '") < 250');
        query.wait(function(resp) {
          if (resp.length > 0) {
            checkin(resp[0].page_id);
          } else {
            alert('Unable to check in on Facebook.');
          }
        });
      } else {
        checkin(fbid);
      }
    }
  }

  function checkin(page_id) {
    FB.api('/me/feed', 'post', { 
      message: 'Waiting for some awesome food',
      place: page_id,
    }, function(response) {
      if (!response || response.error) {
        alert('Unable to check in on Facebook.');
      } else {
        document.querySelector('.facebook').style.backgroundImage = 'url(http://queuefor.me/img/tick-icon.png)';
        document.querySelector('.facebook').innerHTML = 'Checked in<br/>on Facebook';
        document.querySelector('.facebook').onclick = null;
        sendXhr('update_checkins', null, {queueID: qid, completedcheckins: 'facebook'});
      }
    });
  }
</script>
</html>
