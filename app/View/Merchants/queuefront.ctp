<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<script type="text/javascript" src="//use.typekit.net/vid1sqp.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<style>

  .footer {
    position: absolute;
    text-align: center;
    white-space: nowrap;
    width: 100%;
    bottom: 0;
    padding-bottom: 5px;
  }

  @media screen and (orientation:landscape) {
    .footer {
      position: relative;
      margin-top: 20px;
    }
  }

  body {
    font-family: "faricy-new-web", helvetica;
    font-weight: 300;
    font-size: 20px;
    line-height: 30px;
    width: 100%;
    margin: 0;
    padding: 0;
  }

  .setup, .queued, span.bar, span.bbq, span.patio, .enqueue, .update, .thank {
    display: none;
  }
  
  
  /* Header */
  .restaurant {
    display: block;
    width: 100%;
    min-height: 60px;
    max-height: 90px;
    overflow: hidden;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    margin-bottom: 5px;
    border-bottom: 1px solid black;
    line-height: 27px;
  }
  
  .restaurant div {
    padding: 5px;
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
    font-size: 24px;
  }
  
  .restaurant .address {
    font-size: 18px;
    line-height: 22px;
  }
  
  
  /* Queued */
  div.seats span.seats, div.position span.position, div.estimate span.estimate {
    font-size: 22px;
  }
  
  div.seats, div.position, div.estimate {
    margin: 5px;
    padding-left: 35px;
    background-size: 30px;
    background-position: 0%;
    background-repeat: no-repeat;
  }
  
  div.seats {
    background-image: url(http://icons.iconarchive.com/icons/aha-soft/people/256/people-icon.png);
  }
  
  div.position {
    background-image: url(http://thumb18.shutterstock.com/thumb_large/97840/97840,1312233524,8/stock-photo-queue-82390702.jpg);
  }
  
  div.estimate {
    background-image: url(http://logolitic.com/wp-content/uploads/2009/09/clock.png);
  }
  
  /* Buttons */
  .footer div + div {
    border-left: 1px solid #ddd;
    margin-left: -1px;
  }
  
  .button {
    width: 25%;
    height: 40px;
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    display: inline-block;
  }
  
  .cancel {
    background-image: url(http://png-3.findicons.com/files/icons/75/i_like_buttons_3a/512/cute_ball_stop.png);
  }
  
  .edit {
    background-image: url(http://www.psdgraphics.com/wp-content/uploads/2010/09/pencil-icon.jpg);
  }
  
  .menu {
    background-image: url(http://www.e-zign.com/portfolio_assets/pf-icon-menus.jpg);
  }
  
  .map {
    background-image: url(http://www.veryicon.com/icon/png/System/Palm/Google%20Maps.png);
  }
  
  /* Facebook */
  .media {
    margin-top: 10px;
    text-align: center;
  }
  
  .media div {
    background-repeat: no-repeat;
    background-size: 40px;
    background-position: 5px;
    display: inline-block;
    line-height: 22px;
    margin: 5px;
    border: 1px solid #aaa;
    border-radius: 4px;
    padding: 5px 5px 5px 50px;
  }
  
  .facebook {
    background-image: url(http://www2.myacpa.org/images/stories/Facebook-icon.png);
  }
  
  .thank {
    text-align: middle;
    padding: 20px;
  }
  
  
  /* Setup */
  .setup span.name, .setup span.seats {
    display: inline-block;
    margin: 5px;
    width: 65px;
    margin-left: 10px;
  }
  
  .labels {
    margin: 10px;
  }
  
  .labels input {
    margin-right: 5px;
  }
  
  input.text, select {
    height: 30px;
    width: 75px;
    vertical-align: text-bottom;
  }
  
  .enqueue, .update {
    border: 1px solid #aaa;
    border-radius: 5px;
    padding: 5px;
    cursor: pointer;
  }
 
 
  /* Shroud */
  .shroud {
    position: absolute;
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
    <div class="footer">
      <span class="enqueue" onclick="enqueue()">Queue Now!</span>
      <span class="update" onclick="update()">Update</span>
    </div>
  </div>
  <div class="queued">
    <div class="seats"><span class="seats">0</span> in your party<span class="label"></span>.<br/></div>
    <div class="position"><span class="position">0</span> parties ahead of you.<br/></div>
    <div class="estimate"><span class="estimate">0</span> minutes approximate wait.<br/></div>
    <div class="media">
      <div class="facebook">Check in on<br>Facebook!</div>
    </div>
    <div class="footer">
      <div class="button cancel" onclick="cancel()"></div><div class="button edit" onclick="edit()"></div><div class="button menu"></div><div class="button map"></div>
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

  var merchant = <?php echo $merchant_json; ?>; 
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
    }
    
    if (qid) {
      document.querySelector('.queued').style.display = 'block';
      clearTimeout(periodicPoll);
      periodicPoll = setTimeout(poll, 500);
    } else {
      document.querySelector('.enqueue').style.display = 'inline-block';
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
      document.querySelector('div.seats span.seats').innerHTML = data.Queue.seats;
      document.querySelector('div.position span.position').innerHTML = data.Queue.position;
      document.querySelector('div.estimate span.estimate').innerHTML = Math.round(parseInt(data.Queue.estimatedwaitsecs) / 60);
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
          alert('A table is available for you!');
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
    document.querySelector('.update').style.display = 'inline-block';
    document.querySelector('.setup').style.display = 'block';
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
