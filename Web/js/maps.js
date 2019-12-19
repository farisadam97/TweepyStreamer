// Initialize and add the map
let map;
let markersArray = [];
let latsArray = [];
let lngsArray = [];
let kategoriArray = [];
let jalanArray = [];
let url = "http://maps.google.com/mapfiles/ms/icons/";

var surabaya = {lat: -7.24917, lng: 112.75083};

// var elementsLat = document.querySelectorAll('[id=latitude]');
// var elementsLng = document.querySelectorAll('[id=longitude]');
// var elementsKat = document.querySelectorAll('[id=kategory]');
// var elementsJal = document.querySelectorAll('[id=jalan-text]');




// for(var ii = 0; ii <elementsLat.length;ii++){
//     latsArray.push(elementsLat[ii].textContent);
//     lngsArray.push(elementsLng[ii].textContent);
//     kategoriArray.push(elementsKat[ii].textContent);
//     jalanArray.push(elementsJal[ii].textContent);
// }

var markers = [
    ['Taman Nasional Gunung Gede Pangrango', -6.777797700000000000 , 106.948689100000020000],
    ['Gunung Papandayan', -7.319999999999999000, 107.730000000000020000],
    ['Gunung Cikuray', -7.3225, 107.86000000000001],
    ['Gunung Bromo', -7.942493600000000000, 112.953012199999990000],
    ['Gunung Semeru', -8.1077172, 112.92240749999996],
    ['Gunung Merapi', -7.540717500000000000, 110.445724100000000000],
    ['Gunung Merbabu', -7.455000000000001000, 110.440000000000050000],
    ['Gunung Prau', -7.1869444, 109.92277779999995]
    ];

    function initialize() {
        var mapCanvas = document.getElementById('map');
        map = new google.maps.Map(
                document.getElementById('map'), 
                {zoom: 15, center: surabaya});

        var infowindow = new google.maps.InfoWindow(), marker, i;
        var bounds = new google.maps.LatLngBounds(); // diluar looping


        
        for (i = 0; i < markers.length; i++) {  
            pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(pos); // di dalam looping
            marker = new google.maps.Marker({
                position: pos,
                map: map
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(markers[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
            map.fitBounds(bounds); // setelah looping
        }
    
    }


    // google.maps.event.addDomListener(window, 'load', initialize);

// function initMap() {
//     // The location of surabaya
//     var surabaya = {lat: -7.24917, lng: 112.75083};
//     // The map, centered at surabaya
//     map = new google.maps.Map(
//         document.getElementById('map'), {zoom: 15, center: surabaya});
//     var elementsLat = document.querySelectorAll('[id=latitude]');
//     var elementsLng = document.querySelectorAll('[id=longitude]');
//     var elementsKat = document.querySelectorAll('[id=kategory]');
//     var elementsJal = document.querySelectorAll('[id=jalan-text]');
//     var infowindow = new google.maps.InfoWindow(), marker, i;
//     var bounds = new google.maps.LatLngBounds();



    // for(var ii = 0; ii <elementsLat.length;ii++){
    //     latsArray.push(elementsLat[ii].textContent);
    //     lngsArray.push(elementsLng[ii].textContent);
    //     kategoriArray.push(elementsKat[ii].textContent);
    //     jalanArray.push(elementsJal[ii].textContent);
    // }   

    // for(var jj = 0; jj<latsArray.length;jj++){
    //     pos = new google.maps.LatLng(latsArray[jj],lngsArray[jj]);
    //     bounds.extends(pos);
    //     marker = new google.maps.Marker({
    //         position : pos,
    //         map : map
    //     });
    //     google.maps.event.addListener(marker, 'click', (function(marker, i) {
    //         return function() {
    //             infowindow.setContent(markers[i][0]);
    //             infowindow.open(map, marker);
    //         }
    //     })(marker, i));
    //     map.fitBounds(bounds);

    // }


    // The marker, positioned at surabaya
    // var marker = new google.maps.Marker({position: surabaya, map: map});
    // var latLoc = document.getElementById('latitude').textContent;
    // var lngLoc = document.getElementById('longitude').textContent;
    // var kategori = document.getElementById('kategory').textContent;
    // var latLocInt = parseFloat(latLoc);
    // var lngLocInt = parseFloat(lngLoc);
    // var nodes = document.getElementById('post-data').children;
    // for(var i=0; i<nodes.length; i++) {
    //     if (nodes[i].className == 'post-list') {
    //         if(nodes[i].className == 'card-footer'){
    //             var lat = nodes[i].getElementById('latitude').textContent;
    //             var lng = nodes[i].getElementById('longitude').textContent;
    //             var kategori = nodes[i].getElementById('kategory').textContent;
    //             latsArray.push(lat);
    //             lngsArray.push(lng);
    //             kategoriArray.push(kategori);
    //         }
    //         // var lat = document.getElementById('latitude');
    //         // var lng = document.getElementById('longitude');
    //         // var kategori = document.getElementById('kategory');
    //         // latsArray.push(lat);
    //         // lngsArray.push(lng);
    //         // kategoriArray.push(kategori);
    //     }
    // }
    // for(var i = 0; i<latsArray.length;i++){
    //     console.log(latsArray[i])
    // }

    // addMarker({lat:latLocInt,lng:lngLocInt},kategori);
// }

// function addMarker(latLng,kategori){
//     let url = "http://maps.google.com/mapfiles/ms/icons/";
//     if(kategori === "Lancar"){
//         url += "green" + "-dot.png";
//         let labelWo = "L"
//     }else{
//         url += "red" + "-dot.png";
//     }
    

//     let marker = new google.maps.Marker({
//     map: map,
//     position: latLng,
//     icon: {
//         url: url
//     }
// });

//   //store the marker object drawn in global array
//     markersArray.push(marker);
// }

