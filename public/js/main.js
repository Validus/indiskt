function showMeny() {
	$("#book").removeClass("hidden");
	$("#next").removeClass("arrowNextHidden");
	$("#back").removeClass("arrowBackHidden");
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
}

function loadCss() {
	if ($.browser.mozilla)
	{
		$("<link/>", {
		   rel: "stylesheet",
		   type: "text/css",
		   href: "css/main_ff.css"
		}).appendTo("head");
	}

}