<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="../map/map.css">

<style>
  #map {
    width: 100%;
    height: 100vh;
  }
</style>
<div class="container">
  <div id="map"></div>
</div>
<script>
  var customLabel = {
    restaurant: {
      label: 'R'
    },
    bar: {
      label: 'B'
    }
  };

    function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(-23.559385, -46.184875),
      zoom: 7
    });
    var infoWindow = new google.maps.InfoWindow;
      downloadUrl('data.php', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
          var id = markerElem.getAttribute('id');
          var name = markerElem.getAttribute('name');
          var point = new google.maps.LatLng(
              parseFloat(markerElem.getAttribute('lat')),
              parseFloat(markerElem.getAttribute('lng')));

          var infowincontent = document.createElement('div');
          var button_delete = document.createElement('button')
          button_delete.innerHTML = 'Delete';
          button_delete.classList.add("alert");
          button_delete.onclick = function()
          {
            function getCookie(cname) {
              var name = cname + "=";
              var decodedCookie = decodeURIComponent(document.cookie);
              var ca = decodedCookie.split(';');
              for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                  c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
                }
              }
              return "";
            }
            var url = "http://localhost/api/v1/report/delete/?id="+markerElem.getAttribute('id')+"&company="+getCookie('company')+"&password="+getCookie('password')+"&user="+getCookie('user');
            downloadUrl(url, function(data) {
              alert("Deleted");
              window.location.reload(); 
            })
          }
          var button_edit = document.createElement('button')
          button_edit.innerHTML = 'Edit';
          button_edit.onclick = function()
          {
            location.href = '../reports/report.php?id='+markerElem.getAttribute('id');
          }
          var strong = document.createElement('strong');
          strong.textContent = name
          
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));
          infowincontent.appendChild(button_delete);
          infowincontent.appendChild(button_edit);

          var text = document.createElement('text');
          infowincontent.appendChild(text);
          var marker = new google.maps.Marker({
            map: map,
            position: point,
          });
          marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
          });
        });
      });
    }



  function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }

  function doNothing() {}
</script>
<?php
  require_once '../../../secure/env.php';
  echo "<script defer
  src='https://maps.googleapis.com/maps/api/js?key=" . $key_map . "&callback=initMap'>
  </script>";
?>