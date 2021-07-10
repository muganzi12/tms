$(function(){
//get the click of this button
$('#modalButton').click(function(){
    $('#modal').modal('show')
    .find('#modalContent')
    .load($(this).attr('value'));

});
//alert('We are here');
});