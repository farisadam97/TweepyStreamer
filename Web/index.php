<?php ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Ajax -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <!-- Mein Css -->
    <link rel="stylesheet" type="text/css" href="./css/index.css"  />
    <!-- <style type="text/css">
        .ajax-load{
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        }</style> -->


    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-light bg-light">
      <span class="navbar-brand mb-0 h1">Navbar</span>
    </nav>
    <div class="app">
      <div class="main">
        <div class="post" id="post-data">
          <?php 
            require('main_q.php');
          ?>
          <?php include('posts.php'); ?>
          <div class="ajax-load text-center" style="display:none">
            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
        </div>
        </div>
        
      </div>
      <div class="map" id="map"></div>
    </div>
    <!-- <script type="text/javascript">
      // $(window).scroll(function(){
      //   if($(window).scrollTop() + $(window).height() >= $(document).height()){
      //     var last_id = $(".post-list:last").attr("id");
      //     loadMoreData(last_id)
      //   }
      // });

      $('.post').bind('scroll'), (function(){
        if($(this).scrollTop() === ($(this)[0].scrollHeight - $(this).innerHeight()){
          var last_id = $(".card.post-list:last").attr("id");
          console.log(last_id)
          loadMoreData(last_id)
        });
      });

      function loadMoreData(last_id){
        $.ajax(
          {
            url:'/loadMoreData.php?last_id=' +last_id,
            type:"get",
            beforeSend: function()
            {
              $('.ajax-load').show();
            }
          }
        )
        .done(function(data)
        {
          $('.ajax-load').hide();
          $('.post-list').append(data);
        })
        .fail(function(jqXHR,ajaxOptions,thrownError)
        {
          alert("Something error....")
        }
        )
      }
      
    </script>
    <script async defer>
      $(document).ready(function(){
        // const $ =  document.querySelectorAll.bind(document);

        // const testEl = $("#latitude").text();
        // testEl.forEach(el=>{
        //   console.log(el)
        // })

        var elementsLat = document.querySelectorAll('[id="latitude"] > *');
        var elementsLng = document.querySelectorAll('[id=longitude]');
        var elementsKat = document.querySelectorAll('[id=kategory]');
        var elementsJal = document.querySelectorAll('[id=jalan-text]');


        Array.prototype.forEach.call(elementsLat, function(el){
          console.log(el.lenght)
        })

        // for(var ii = 0; ii <elementsLat.length;ii++){
        //   // console.log(elementsLat[ii].textContent)
        //     latsArray.push(elementsLat[ii].textContent);
        //     // lngsArray.push(elementsLng[ii].textContent);
        //     // kategoriArray.push(elementsKat[ii].textContent);
        //     // jalanArray.push(elementsJal[ii].textContent);
        // }
        // console.log(elementsLat.lenght)
        // console.log(latsArray.lenght)
              })
    </script> -->
    <!-- <script src="./js/maps.js"></script>  -->

    <script>
      var surabaya = {lat: -7.24917, lng: 112.75083};
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: surabaya,
          zoom: 14
        })
      
        
      
      };
    </script>


    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCk8_2Z96uO5jHZ0s_GR7gtctXVdFC8iWs&callback=initMap"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
