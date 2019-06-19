// ============================ Header ========================

// slide products
$('.owl-carousel').owlCarousel({
  loop:true,
  margin:10,
  nav:true,
  autoplay:true,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  responsive:{
      0:{
          items:1
      },
    //   600:{
    //       items:3
    //   },
    //   1000:{
    //       items:5
    //   }
  }
})
// datepicker for search
$(function(){
    $('#Sdate').val('')
    $('#Edate').val('')
    $('#Sdate').datepicker({
        autoOpen: false,
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        onSelect: function(selected){
            $('#Edate').datepicker(
                'option',
                'minDate',
                $('#Sdate').val()
            );
            $('#Sdate').val();
        }

    })

    $('#Edate').datepicker({
        autoOpen: false,
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        onSelect: function(selected){
            $('#Sdate').datepicker(
                'option',
                'maxDate',
                $('#Edate').val()
            );
            $('#Edate').val();
        }
    });
});

// ============================ Contents =====================
// ============================ Alert ========================
$( function() {
    $('#alertModal').modal('show');
} );


