$(document).ready(function(){
      $('.slider').slider({
            indicators: true,
            interval: 6000,
            transition: 600,
      });

      $('.slider').slider('pause');
      // Start slider
      $('.slider').slider('start');
      // Next slide
      $('.slider').slider('next');
      // Previous slide
      $('.slider').slider('prev');
      $(".dropdown-button").dropdown();
      $(".button-collapse").sideNav();
      $('.modal').modal();
      $('.materialboxed').materialbox();
      $('.carousel').carousel();
      $(".button-collapse").sideNav();
      $(".dropdown-button").dropdown();
      $('.parallax').parallax();
      $('select').material_select();
      $('.collapsible').collapsible();
      $('.carousel.carousel-slider').carousel({fullWidth: true});
      $('.collapsible').collapsible();
});





function initMap() {
      var myLatLng = {lat: 13.7055772, lng: -89.2129779};

      // Create a map object and specify the DOM element for display.
      var map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      scrollwheel: false,
      zoom: 17,
      });

      // Create a marker and set its position.
      var marker = new google.maps.Marker({
      map: map,
      position: myLatLng,
      title: 'Hello World!'
      });
}

