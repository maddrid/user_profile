function selectUi(thatSelect){
    
   return false ;
}

$(function(){
	  //Selects
    $('select').each(function(){
        selectUi($(this));
    });
});