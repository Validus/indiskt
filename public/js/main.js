function showMeny() {
	$("#book").removeClass("hidden");
	$("#next").removeClass("arrowNextHidden");
	$("#back").removeClass("arrowBackHidden");
	
	if(document.width < 700 || $('link[href$="main.css"]').attr("media") == "none")
	{
		$(".mainSection").addClass("ieMain");	
	}
}
function pickItem(elem) {

	if(elem.name == "FRITEXT") {
		$('input[name$="base_dish"]').attr("disabled",false);
		$('input[name$="base_dish"]').removeClass("tooltip");
		$("#toolTipContent").addClass("displayNone");
	}
	else
	{
		$('input[name$="base_dish"]').val(elem.name);
	}
	$("#book").addClass("hidden");
	$("#next").addClass("arrowNextHidden");
	$("#back").addClass("arrowBackHidden");
	
	$(".mainSection").removeClass("ieMain");	
}

function loadCss() {
	if ($.browser.mozilla)
	{
		$("<link/>", {
		   rel: "stylesheet",
		   type: "text/css",
		   href: "/css/main_ff.css"
		}).appendTo("head");
	}
	
	if($(".mainSection").css("width") == "800px" && $(".about").css("display") == "none")
	{
		$("body").css("width", "800px");
	}
}

function flipInner() {

	if(document.width < 1000 || $('link[href$="main.css"]').attr("media") == "none") {
		if($("#aboutInner").hasClass("displayInner")) {
			$("#aboutInner").removeClass("displayInner");
			$("#about").removeClass("aboutDisplayInner");
		}
		else {
			$("#aboutInner").addClass("displayInner");
			$("#about").addClass("aboutDisplayInner");
		}
	}

}

function mobile () {
	$('link[href$="main_mobile.css"]').attr("media","screen");
	$('link[href$="main.css"]').attr("media","none");
	$('link[href$="book.css"]').attr("media","none");
	$('link[href$="no_book.css"]').attr("media","screen");
}

function desktop() {
	$('link[href$="main_mobile.css"]').attr("media","none");
	$('link[href$="main.css"]').attr("media","screen");
	$('link[href$="book.css"]').attr("media","screen and (min-width: 950px)");
	$('link[href$="no_book.css"]').attr("media","screen and (max-width: 950px)");
}