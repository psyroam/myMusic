function album_hover(i,j){
	$("#album_" +i+j).animate({'top':'-10px'});
}

function album_unhover(i,j){
	$("#album_" +i+j ).animate({'top':'10px'});
}

$(document).ready(function(){
	$("#inner_content").scroll(function(){
		 if($("#inner_content").scrollTop() + $("#inner_content").Height()) {
       alert("bottom!");
   }
});
});
