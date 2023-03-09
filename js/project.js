var cardsCounter = 1;
function addObservationCardP() {
	//$("#forms-cards-holder").append()
    $('#cardAppend').append('<div class="col-lg-4 col-md-6 d-flex align-items-stretch formCard">'+$('.formCard:first').html()+'</div>');
}
/*function addObservationCard() {
    $('#cardAppend').append('<div class="col-lg-3 col-md-6 d-flex align-items-stretch formCard">'+$('.formCard:first').html()+'</div>');
}*/
function removeCard(obj){
    if ($(".formCard").length > 1) {
        $(obj).parents().eq(1).remove();
    }
}
setTimeout(() => {
	initMapClickForChecklistCapture();
}, 4000); 













