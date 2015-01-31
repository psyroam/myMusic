function expand(foo)
{
	$(foo).fadeIn(500,function(){
		if(foo == "#menue")
		{
			slide_in('#left_bar');
		}	
	});
}

function fold(foo)
{
	$(foo).fadeOut(500);
}	

function slide_in(foo)
{
	if($("#content").width() != '250px')
	{
		alignment_out(foo);
	}
}

function slide_out(foo)
{
	if($("#content").width() != '100%')
			alignment_in();

	$(foo).animate({width:'0px'},500);	

	
}

function alignment_in()
{
	$("#content").animate({
		'margin-left':'25px',
		'width': "96.5%"
	},500);
}

function alignment_out(foo)
{
	$("#content").animate({
		'margin-left':'275px',
		'width':'78%'
	},{duration:500, queue:false});
	$(foo).animate({
		width:'250px'
	},{duration:500, queue:false});
}