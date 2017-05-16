$(document).ready(function(){
     
      $('.slider').slider({
            height:500
      });
      $('.slider').slider('prev');
      $(".dropdown-button").dropdown();
      $(".button-collapse").sideNav();
      $('.modal').modal();
      $('.materialboxed').materialbox();
      $('.carousel').carousel();
      $(".button-collapse").sideNav();
      $('.parallax').parallax();
      $('select').material_select();
      $('.collapsible').collapsible();
       $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
      });
      
      // Pause slider
      $('.slider').slider('pause');
      // Start slider
      $('.slider').slider('start');
      // Next slide
      $('.slider').slider('next');
      // Previous slide
      $('.slider').slider('prev');
      

});





function initMap() {
      var myLatLng = {lat: 13.7112027, lng: -89.1903494};

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

