 $(".filter").select2();
$(document).on('change', '#newsStatus' ,function(){
var status = $(this).val();
if(status == 0){
    status="";
}
var url = window.location.origin+'/manage/newsletter/listing/'+status;
window.location.href = url;


})
$( function() {
    $( "#fromDate" ).datepicker({
      changeMonth: true,
      changeYear: true,
       dateFormat: 'yy-mm-dd'
    });
  } );
$( function() {
    $( "#toDate" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
  } );