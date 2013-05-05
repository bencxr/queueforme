<script type="text/javascript" src="//sslstatic.wix.com/services/js-sdk/1.16.0/js/Wix.js"></script>

<style>
  body {
    font-family: helvetica;
    width: 270px;
    height: 100px;
  }
  
  #merchant_code {
    margin-left: 10px;
    width: 100px;
  }
  
  button{
    padding: 10px;
    width: 80px;
  }
</style>

<span>Merchant Shortname:</span><input type="text" id="merchant_code"><br>
<div style="font-size: 12px; color: #999">Obtain your <i>Merchant Shortname</i> by <a href="http://merchant.queuefor.me">registering</a>.</div><br>
<button onclick="update()">Update</button>

<script>

  function update() {
    var xhr = new XMLHttpRequest();
    var compId = Wix.Utils.getOrigCompId();
    xhr.open('GET', 'http://queuefor.me/merchants/associatewix/compId:' + compId + '/shortname:' + encodeURIComponent(document.querySelector('#merchant_code').value));
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        Wix.Settings.refreshAppByCompIds(compId);
      }
    }
    xhr.send(null);
  }

</script>