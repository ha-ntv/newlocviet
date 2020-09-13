var speedTest = {};
speedTest.pics = null;
speedTest.map = null;
speedTest.markerClusterer = null;
speedTest.markers = [];
speedTest.infoWindow = null;

speedTest.init = function() {
    var latlng = new google.maps.LatLng(16.0550979, 108.2194105);
    var options = {
        'zoom': 14,
        'zoomControl':false,
        'streetViewControl':false, 
        'scrollwheel':false,
        'center': latlng,
        'mapTypeId': google.maps.MapTypeId.ROADMAP
    };
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {lat: 16.0550979, lng: 108.2194105},
        title: "HONG LOI TOWER",
        icon: "/images/ico_map.png",
    });
  speedTest.directionsService = new google.maps.DirectionsService;
  speedTest.directionsDisplay = new google.maps.DirectionsRenderer;
  speedTest.map = new google.maps.Map(document.getElementById('map'), options);
  speedTest.pics = data;
  var useGmm = document.getElementById('usegmm');
  google.maps.event.addDomListener(useGmm, 'click', speedTest.change);
  
  var numMarkers = document.getElementById('nummarkers');
  google.maps.event.addDomListener(numMarkers, 'change', speedTest.change);

  speedTest.infoWindow = new google.maps.InfoWindow();

  speedTest.showMarkers();
};

speedTest.showMarkers = function() {
  speedTest.markers = [];

  var type = 1;
  if (document.getElementById('usegmm').checked) {
    type = 0;
  }

  if (speedTest.markerClusterer) {
    speedTest.markerClusterer.clearMarkers();
  }

  var panel = document.getElementById('markerlist');
  panel.innerHTML = '';
  var numMarkers = document.getElementById('nummarkers').value;
 
  for (var i = 0; i < numMarkers; i++) {
    var titleText = speedTest.pics[i].photo_title;
    var lat = speedTest.pics[i].latitude;
    var lng = speedTest.pics[i].longitude;
    if (titleText === '') {
      titleText = 'No title';
    }

    var item = document.createElement('DIV');
    var title = document.createElement('A');
    title.href = '#';
    title.className = 'title';
    title.setAttribute("onclick", "nhan('"+titleText+"',"+lat+","+lng+")");
    title.innerHTML = titleText;

    item.appendChild(title);
    panel.appendChild(item);


    var latLng = new google.maps.LatLng(speedTest.pics[i].latitude,
        speedTest.pics[i].longitude);
    var id = 'programs' + i;
    var imageUrl = '/images/lctc.png';
    var markerImage = new google.maps.MarkerImage(imageUrl,
        new google.maps.Size(32, 32));

    var marker = new google.maps.Marker({
      'position': latLng,
      'icon': markerImage,
       'id': id,
       'zIndex':100
    });
  var fn = speedTest.markerClickFunction(speedTest.pics[i], latLng);
  google.maps.event.addListener(marker, 'mouseover', fn);
 
  google.maps.event.addDomListener(title, 'mouseover', fn);
  speedTest.markers.push(marker);
  }
  
   var zoomInButton =  document.getElementById('zoom-in');
  var zoomOutButton =  document.getElementById('zoom-out');
  var current_Button = document.getElementById('current_address');
  
  google.maps.event.addDomListener(zoomInButton,'click',function(){
     speedTest.map.setZoom(speedTest.map.getZoom() + 1)
  })
  google.maps.event.addDomListener(zoomOutButton,'click',function(){
     speedTest.map.setZoom(speedTest.map.getZoom() - 1)
  })
  google.maps.event.addDomListener(current_Button,'click',function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          speedTest.infoWindow.setPosition(pos);
          speedTest.infoWindow.setContent('Location found.');
          speedTest.infoWindow.open(speedTest.map);
          speedTest.map.setCenter(pos);
        }, function() {
          handleLocationError(true, speedTest.infoWindow, speedTest.map.getCenter());
        });
      } 
  });
 function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    speedTest.infoWindow.setPosition(pos);
    speedTest.infoWindow.setContent(browserHasGeolocation ?
      'Error: The Geolocation service failed.' :
      'Error: Your browser doesn\'t support geolocation.');
    speedTest.infoWindow.open(map);
  }
  window.setTimeout(speedTest.time, 0);
};
speedTest.markerClickFunction = function(pic, latlng) {
  return function(e) {
    e.cancelBubble = true;
    e.returnValue = false;
    if (e.stopPropagation) {
      e.stopPropagation();
      e.preventDefault();
    }
    var title = pic.photo_title;
    var url = pic.photo_url;
    var fileurl = pic.photo_file_url;
    var content = pic.content;
    if(fileurl != "" && fileurl != 'no')
      fileurl = '<img src="/uploads/article/354x272'+fileurl+'">';
    else
      fileurl = ""
    var infoHtml = '<div class="infoqw"><h3 id="direction">' + title + ' <br/> ' + fileurl + 
      '</h3><div class="info-body">' + content +
      '</div>' +
      '</div></div>';
    speedTest.infoWindow.setContent(infoHtml);
    speedTest.infoWindow.setPosition(latlng);
    speedTest.infoWindow.open(speedTest.map);
    speedTest.infoWindow.addListener('domready',function(){
    })
  };
};

$('#searchLocal').on('click',function(){
   var lo_current = $('#frm_search_form').val()
   var lat_n = $('#lat').val();
   var lng_n = $('#lng').val();
     if(lo_current != ""){
      calculateAndDisplayRoute(lo_current, lat_n, lng_n);
     }
  })

$(document.body).on("change","#load_maol",function(){
 val_map = this.value;
  m_lat = val_map.split(',')[0]
  m_lng = val_map.split(',')[1]
 var pos = {
            lat: Number(m_lat),
            lng: Number(m_lng)
          };
          speedTest.infoWindow.setPosition(pos);
          speedTest.infoWindow.setContent('Địa chỉ tìm kiếm của bạn.');
          speedTest.infoWindow.open(speedTest.map);
          speedTest.map.setCenter(pos);
});
 if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
       var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
       var infowindow = new google.maps.InfoWindow({
            map: map,
            position: pos,
            content: 'Location found using HTML5.'
            });
        map.setCenter(pos);
      }, function() {
           
         });
 } else {
   
 }
 
function calculateAndDisplayRoute(newMarker, ka, kb){
    speedTest.directionsDisplay.setMap(speedTest.map); 
      speedTest.directionsService.route({
        origin: newMarker,
        destination: {lat: Number(ka), lng: Number(kb)},
        travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            speedTest.directionsDisplay.setDirections(response);
          } else {
            window.alert('Lổi không thể kiểm tra được địa chỉ của bạn' + status);
          }
      })
  }
speedTest.clear = function() {
  document.getElementById('timetaken').innerHTML = 'cleaning...';
  for (var i = 0, marker; marker = speedTest.markers[i]; i++) {
    marker.setMap(null);
  }
};

speedTest.change = function() {
  speedTest.clear();
  speedTest.showMarkers();
};

speedTest.time = function() {
  document.getElementById('timetaken').innerHTML = 'timing...';
  var start = new Date();
  if (document.getElementById('usegmm').checked) {
    speedTest.markerClusterer = new MarkerClusterer(speedTest.map, speedTest.markers, {imagePath: '../images/m'});
  } else {
    for (var i = 0, marker; marker = speedTest.markers[i]; i++) {
      marker.setMap(speedTest.map);
    }
  }

  var end = new Date();
  document.getElementById('timetaken').innerHTML = end - start;
};
