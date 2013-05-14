<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=no" />

<script type="text/javascript" src="//use.typekit.net/vid1sqp.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<div class="restaurant">
  <div class="name"></div>
  <div class="address"></div>
  <div class="manual" onclick="manual()"></div>
</div>
<div class="contents">
</div>
<div class="shroud">
  <div class="setup">
    <span class="name">Name: </span><input type="text" class="text name"><br/>
    <span class="seats">Seats: </span><select class="select seats" value="4">
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
      <span class="enqueue" onclick="enqueue()">Add</span>
      <span class="update" onclick="update(this)">Update</span>
      <span class="abort" onclick="abort()">Cancel</span>
    </div>
  </div>
</div>

<style>
  body {
    font-family: "faricy-new-web", helvetica;
    font-size: 20px;
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
    white-space: nowrap;
  }
  
  /* Header */
  .restaurant {
    position: fixed;
    height: 150px;
    width: 100%;
    line-height: 27px;
    text-align: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-image: url(http://queuefor.me/img/kitchenrestaurant.png);
    z-index: 100;
    -moz-box-shadow: 0 0 25px 3px #666;
    -webkit-box-shadow: 0 0 25px 3px #666;
    box-shadow: 0 0 25px 3px #666;
  }
  
  .restaurant div {
    color: white;
    padding: 5px;
    font-weight: 600;
    /*
    text-shadow: -1px -1px 0 white,
                 1px -1px 0 white,
                 -1px 1px 0 white,
                 1px 1px 0 white;
    */
  }
  
  .restaurant .name {
    margin-top: 15px;
    font-size: 48px;
    text-shadow: 0 1px 0 black,
                 2px 0 0 black;
  }
  
  .restaurant .address {
    margin-top: 15px;
    font-size: 18px;
    line-height: 22px;
    text-shadow: 0 1px 0 black,
                 1px 0 0 black;
  }
  
  .manual {
    position: absolute;
    right: 5px;
    bottom: 5px;
    width: 40px;
    height: 40px;
    background-image: url(http://queuefor.me/img/add-icon.png);
    background-size: contain;
    background-position: 5%;
    background-repeat: no-repeat;
  }
  
  /* Content */
  .contents {
    margin: 0 auto;
    overflow: auto;
    padding-top: 150px;
    width: 100%;
    z-index: 100;
  }
  
  .contents .column {
    position: relative;
    text-align: center;
    width: 100%;
  }
  
  .contents .queue {
    position: relative;
    width: 100%;
    margin: 0 auto;
    overflow-x: hidden;
  }
  
  .contents .customer {
    display: block;
    position: relative;
    width: 200%;
    position: relative;
    border-bottom: 1px solid #aaa;
    border-top: 1px solid #ddd;
    background-color: white;
    height: 65px;
    transition: all 400ms ease;
    -webkit-transition: all 400ms ease;
    cursor: pointer;
    overflow: hidden;
  }
  
  .contents .customer:nth-child(even) {
    background-color: #efefef;
  }
  
  .contents .customer * {
    margin-top: 18px;
  }
  
  .contents .pinged {
    background-color: rgba(0, 153, 204, 0.33) !important;
  }
  
  .contents .filling {
    background-color: lime !important;
    height: 0;
    paddingTop: 0;
    paddingBottom: 0;
    marginBottom: -1px;
  }
  
  .contents .cancelling {
    background-color: red !important;
    height: 0;
    paddingTop: 0;
    paddingBottom: 0;
    marginBottom: -1px;
  }
  
  .contents .pinged .time:before {
    display: inline-block;
    width: 25px;
    height: 25px;
    padding-right: 8px;
    content: ' ';
    vertical-align: text-bottom;
    background-image: url(http://queuefor.me/img/alarm-icon.png);
    background-size: contain;
    background-repeat: no-repeat;
  }
  
  .contents .name {
    display: inline-block;
    font-weight: bold;
    margin-left: 2%;
    float: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 15%;
    text-align: left;
  }
  
  .fbcheckedin {
    padding-left: 32px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: left;
    background-image: url(http://queuefor.me/img/facebook-icon.png);
  }
  
  .contents .input {
    width: 85px;
  }
  
  .contents .options {
    left: -100%;
  }
  
  .contents .button {
    display: inline-block;
    margin-top: 0;
    width: 10%;
    height: 65px;
    float: right;
  }
  
  .contents .button + .button {
    border-right: 1px solid #ddd;
  }
  
  .contents .buttonIcon {
    display: inline-block;
    vertical-align: middle;
    width: 30px;
    height: 30px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: left;
  }
  
  .contents .buttonText {
    display: inline-block;
    vertical-align: middle;
    margin-left: 10px;
  }
  
  .contents .back {
    background-image: url(http://queuefor.me/img/back-icon.png);
  }
  
  .contents .ping {
    background-image: url(http://queuefor.me/img/alarm-icon.png);
  }
  
  .contents .fill {
    background-image: url(http://queuefor.me/img/tick-icon.png);
  }
  
  .contents .edit {
    background-image: url(http://queuefor.me/img/edit-icon.png);
  }
  
  .contents .cancel {
    background-image: url(http://queuefor.me/img/cross-icon.png);
  }
  
  .contents .special {
    display: inline-block;
    float: right;
    margin-right: 2%;
    width: 30px;
    height: 30px;
    vertical-align: middle;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
  }
  
  .contents .time {
    display: inline-block;
    float: right;
    margin-right: 2%;
    width: 120px;
    text-align: right;
  }
  
  .contents .labels {
    display: inline-block;
    float: right;
    color: #666;
    margin-right: 1%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: left;
    width: 7%;
  }
  
  .contents .seatsGroup {
    display: inline-block;
    float: left;
    margin-left: 2%;
    text-align: center;
    width: 50px;
    height: 50px;
    margin-top: 8px;
    border: 1px solid black;
    border-radius: 25px;
    line-height: 0px;
    color: white;
    background: black;
  }
  
  .contents .seats {
    font-weight: bold;
  }
  
  .contents .guests {
    font-size: 12px;
  }
  
  .contents .estimate {
    display: block;
    margin-top: 15px;
  }
  
  /* Setup */
  .shroud {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.2);
    display: none;
    z-index: 200;
  }
  
  .setup {
    position: absolute;
    width: 250px;
    margin-left: -133px;
    left: 50%;
    top: 15%;
    padding: 16px 8px 10px 8px;
    background-color: white;
  }
  
  .setup span.name, .setup span.seats {
    display: inline-block;
    margin: 5px;
    width: 65px;
    margin-left: 10px;
  }
  
  .setup .labels {
    margin: 10px;
  }
  
  .setup .labels input {
    margin-right: 5px;
  }
  
  .setup input.text, .setup select.select {
    height: 30px;
    vertical-align: text-bottom;
    width: 160px;
  }
  
  .setup .enqueue, .setup .update, .setup .abort {
    border: 1px solid #aaa;
    border-radius: 5px;
    padding: 5px;
    margin: 5px;
    cursor: pointer;
    display: inline-block;
  }
  
  .footer {
    text-align: center;
    white-space: nowrap;
    width: 100%;
  }
</style>

<script>

  var state = <?php echo $merchant_json; ?>;
  var animating = 0;
  var showingOptions;
  var periodicPoll;
  var debug = false;

  function bind(func, obj) {
    var args = Array.prototype.slice.call(arguments, 2);
    return function() {
      return func.apply(obj, args.concat(Array.prototype.slice.call(arguments)));
    };
  };
    function encode(params) {
    var output = '';
    for (prop in params) {
      output += prop + ':' + encodeURIComponent(params[prop]) + '/';
    }
    return output;
  }
  
  function sendXhr(page, callback, params) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://merchant.queuefor.me/queues/' + page + '/' + encode(params));
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        if (callback) {
          callback(JSON.parse(xhr.responseText));
        }
      } else if (xhr.readyState == 4) {
        //location.reload();
      }
    }
    xhr.send(null);
  }
  
  function poll() {
    if (animating == 0) {
      sendXhr('poll', updateData, {merchantID: state.Merchant.id});
    }
    clearTimeout(periodicPoll);
    
    periodicPoll = window.setTimeout(poll, 2000);
  }
  
  function updateData(data) {
    if (animating > 0) {
      return;
    }
    
    state = data;
    var contents = document.querySelector('.contents');
    
    var columnElement = contents.querySelector('.column');
    if (!columnElement) {
      columnElement = document.createElement('div');
      columnElement.className = 'column';
      contents.appendChild(columnElement);
      
      var queueElement = document.createElement('div');
      queueElement.className = 'queue';
      columnElement.appendChild(queueElement);
    }
    
    var queueElement = columnElement.querySelector('.queue');
    
    var customerIndex = 0;
    var customerElement = queueElement.querySelectorAll('.customer')[0];
    for (var customer; customer = data.WaitingQueue[customerIndex]; customerIndex++) {
      while (customerElement && parseInt(customerElement.dataset['qid']) != customer.Queue.id) {
        var toRemove = customerElement;
        customerElement = customerElement.nextSibling;
        bind(remove, toRemove)();
      }
      if (!customerElement) {
        customerElement = createCustomer(queueElement);
      }
      
      customerElement.dataset['qid'] = customer.Queue.id;
      
      var nameElement = customerElement.querySelector('.name');
      nameElement.innerHTML = customer.User.fullname;
      
      if (customer.Queue.completedcheckins.indexOf('facebook') != -1) {
        nameElement.className = 'name fbcheckedin';
      }
    
      var seatsElement = customerElement.querySelector('.seats');
      seatsElement.innerHTML = customer.Queue.seats;
      
      var guestsElement = customerElement.querySelector('.guests');
      if (customer.Queue.seats > 1) {
        guestsElement.innerHTML = 'guests';
      } else {
        guestsElement.innerHTML = 'guest';
      }
      
      var labelsElement = customerElement.querySelector('.labels');
      labelsElement.innerHTML = customer.Queue.options.replace(/;$/, '').replace(/;/g, ', ');
      
      var timeElement = customerElement.querySelector('.time');
      if (customer.Queue.pinged || customerElement.className.indexOf('pinged') > -1) {
        timeElement.innerHTML = format((newDate(data.Now) - newDate(customer.Queue.firstpinged)) / 1000);
        if (customerElement.className.indexOf('pinged') == -1) {
          customerElement.className += ' pinged';
        }
        customerElement.querySelector('.special').className = 'special fill';
        customerElement.querySelector('.special').onclick = bind(fill, customerElement);
      } else {
        timeElement.innerHTML = format((newDate(data.Now) - newDate(customer.Queue.created)) / 1000);
        if (customerElement.className.indexOf('options') == -1) {
          if (debug) debugger;
          customerElement.className = 'customer';
        } else {
          customerElement.className = 'customer options';
        }
      }
      
      customerElement.onclick = bind(showOptions, customerElement);
      customerElement = customerElement.nextSibling;
    }
    
    // Remove extras.
    while (customerElement) {
      bind(remove, customerElement)();
      customerElement = customerElement.nextSibling;
    }    
  }
  
  function newDate(date) {
    var a = date.split(/[^0-9]/);
    return new Date (a[0], a[1]-1, a[2], a[3], a[4], a[5]);
  }
  
  function createButton(text, classname, callback) {
    var button = document.createElement('div');
    button.className = 'button';
    button.onclick = callback;
    
    var buttonIcon = document.createElement('div');
    buttonIcon.className = 'buttonIcon ' + classname;
    button.appendChild(buttonIcon);
    
    var buttonText = document.createElement('div');
    buttonText.className = 'buttonText';
    buttonText.innerHTML = text;
    button.appendChild(buttonText);
    
    return button;
  }
  
  function createCustomer(queueElement) {
    customerElement = document.createElement('div');
    customerElement.className = 'customer';
    queueElement.appendChild(customerElement);
    
    var seatsGroupElement = document.createElement('div');
    seatsGroupElement.className = 'seatsGroup';
    customerElement.appendChild(seatsGroupElement);
    
    var seatsElement = document.createElement('div');
    seatsElement.className = 'seats';
    seatsGroupElement.appendChild(seatsElement);
    
    var guestsElement = document.createElement('div');
    guestsElement.className = 'guests';
    seatsGroupElement.appendChild(guestsElement);

    var nameElement = document.createElement('div');
    nameElement.className = 'name';
    customerElement.appendChild(nameElement);
    
    customerElement.appendChild(createButton('Cancel', 'cancel', bind(cancel, customerElement)));
    customerElement.appendChild(createButton('Edit', 'edit', bind(edit, customerElement)));
    customerElement.appendChild(createButton('Done', 'fill', bind(fill, customerElement)));
    customerElement.appendChild(createButton('Page', 'ping', bind(ping, customerElement)));
    customerElement.appendChild(createButton('Back', 'back', bind(back, customerElement)));
    
    var specialElement = document.createElement('div');
    specialElement.className = 'special ping';
    specialElement.onclick = bind(ping, customerElement);
    customerElement.appendChild(specialElement);
    
    var timeElement = document.createElement('div');
    timeElement.className = 'time';
    customerElement.appendChild(timeElement);
    
    var labelsElement = document.createElement('div');
    labelsElement.className = 'labels';
    customerElement.appendChild(labelsElement);
    
    return customerElement;
  }
  
  function showOptions() {
    if (this.className.indexOf('options') == -1) {
      this.className += ' options';
      if (showingOptions && showingOptions != this) {
        bind(back, showingOptions)();
      }
      showingOptions = this;
    }
  }
  
  function back(event) {
    if (this.className.indexOf('pinged') == -1) {
      if (debug) debugger;
      this.className = 'customer';
    } else {
      this.className = 'customer pinged';
    }
    if (event) {
      event.stopPropagation();
    }
  }
  
  function ping(event) {
    sendXhr('ping', null, {queueID: this.dataset['qid']});
    if (this.className.indexOf('pinged') == -1) {
      this.querySelector('.time').innerHTML = format(0);
      this.querySelector('.special').className = 'special fill';
      this.querySelector('.special').onclick = bind(fill, this);
    }
    this.className = 'customer pinged';
    event.stopPropagation();
  }
  
  function fill(event) {
    sendXhr('fulfill', bind(function() {
      this.className += ' filling';
      animating++;
      window.setTimeout(bind(function() {
        this.parentNode.removeChild(this);
        animating--;
      }, this), 500);
    }, this), {queueID: this.dataset['qid']});
    event.stopPropagation();
  }
  
  function getCustomer(qid) {
    for (var i = 0, customer; customer = state.WaitingQueue[i]; i++) {
      if (customer.Queue.id == qid) {
        return customer;
      }
    }
  }
  
  function edit(event) {
    clearSetup();
  
    var customer = getCustomer(this.dataset['qid']);
    if (!customer) {
      return;
    }
    
    document.querySelector('.shroud input.text.name').value = customer.User.fullname;
    document.querySelector('.shroud select.select.seats').value = customer.Queue.seats;
    
    var options = customer.Queue.options.split(';');
    var labelElements = document.querySelectorAll('.shroud .labels input');
    for (var i = 0, labelElement; labelElement = labelElements[i]; i++) {
      labelElement.checked = ~options.indexOf(labelElement.value);
    }
    if (customer.Queue.options == ';' || customer.Queue.options == '') {
      document.querySelector('.shroud .labels input[value="None"]').checked = true;
    }
  
    document.querySelector('.update').onclick = bind(update, this);
    document.querySelector('.abort').onclick = bind(abort, this);
  
    document.querySelector('.shroud').style.display = 'block';
    document.querySelector('.update').style.display = 'inline-block';
  }
  
  function update() {
    request('update', bind(function(data) {
      document.querySelector('.shroud').style.display = 'none';
      if (this.className.indexOf('pinged') == -1) {
        if (debug) debugger;
        this.className = 'customer';
      } else {
        this.className = 'customer pinged';
      }
      poll();
    }, this), this.dataset['qid']);
  };
  
  function cancel(event) {
    sendXhr('cancel', bind(remove, this), {queueID: this.dataset['qid']});
    if (event) {
      event.stopPropagation();
    }
  }
  
  function remove() {
    this.className += ' cancelling';
    animating++;
    window.setTimeout(bind(function() {
      if (this.parentNode) {
        this.parentNode.removeChild(this);
      }
      animating--;
    }, this), 500);
  }
  
  function clearSetup() {
    Array.prototype.slice.call(document.querySelectorAll('.shroud input.text')).forEach(function (element) {
      element.value = '';
    });
    
    document.querySelector('.shroud select.select').value = 4;
    
    Array.prototype.slice.call(document.querySelectorAll('.labels input')).forEach(function (element) {
      element.checked = false;
    });
    
    document.querySelector('.shroud input[type="radio"][value="None"]').checked = true;
    
    document.querySelector('.enqueue').style.display = 'none';
    document.querySelector('.update').style.display = 'none';
  }
  
  function manual() {
    clearSetup();
  
    document.querySelector('.shroud').style.display = 'block';
    document.querySelector('.enqueue').style.display = 'inline-block';
  }
  
  function abort() {
    document.querySelector('.shroud').style.display = 'none';
    if (!this.className) {
      return;
    }
    if (this.className.indexOf('pinged') == -1) {
      if (debug) debugger;
      this.className = 'customer';
    } else {
      this.className = 'customer pinged';
    }
  }
  
  function request(page, callback, qid) {
    var params = {};
  
    params.name = document.querySelector('input.name').value;
    params.seats = parseInt(document.querySelector('select.seats').value);
    params.options = '';
    params.merchantID = state.Merchant.id;
    
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
    request('enqueue', function(data) {
      document.querySelector('.shroud').style.display = 'none';
      poll();
    });
  };
  
  function format(time) {
    time = Math.round(time);
    
    var sec = ('00' + time % 60).substr(-2);
    time = Math.floor(time / 60);
    
    var min = ('00' + time % 60).substr(-2);
    time = Math.floor(time / 60);
    
    var hr = ('00' + time).substr(-2);
    
    return (hr != '00' ? hr + ':' : '') + min + ':' + sec;
  }
  
  function parse(time) {
    time = time.split(':');
    var sec = 0;
    for (var i = 0, val; val = time[i]; i++) {
      sec *= 60;
      sec += parseInt(val);
    }
    return sec;
  }
  
  function tick() {
    var timeElements = document.querySelectorAll('.time');
    for (var i = 0, timeElement; timeElement = timeElements[i]; i++) {
      timeElement.innerHTML = format(parse(timeElement.innerHTML) + 1);
    }
    
    clearTimeout(periodicPoll);
    periodicPoll = setTimeout(tick, 1000);
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
    document.querySelector('.restaurant').style.backgroundImage = 'url(' + state.Merchant.imageurl + ')';
    document.querySelector('.restaurant .name').innerHTML = state.Merchant.name;
    document.querySelector('.restaurant .address').innerHTML = state.Merchant.address;
    
    var labels = state.Merchant.options.split(';');
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
  
  init();
  poll();
  // tick();
  
</script>