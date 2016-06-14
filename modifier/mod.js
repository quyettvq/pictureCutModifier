/* 
    Created on : June 14, 2016
    Author     : Tran Van Quyet <quyettvq at gmail.com>
*/
var pictureCutModifier = {};
pictureCutModifier.initCropMode = function initCropMode(ratios)
{
	$(document).bind('DOMNodeInserted', function(e) {
		// console.log(e.target, ' was inserted');
		if (e.target.id === "SelectOrientacao") {
			
			var new_select_node = "<select id=new_select>"
				+ "<option value=free selected=selected>Free</option>";
			
			for (var i = 0; i < ratios.length; i++) {
				new_select_node += "<option value=" + ratios[i].value + ">" + ratios[i].label + "</option>";
			}
			
			new_select_node += "</select>";

			var new_select = $(new_select_node);
			var default_select = $("#SelectProporcao");
			var crop_box = $("#SelecaoRecorte");
			new_select.insertAfter(default_select);
			new_select.css({
				"width":"100%",
				"height":default_select.height() + "px",
				"border":default_select.css("border")
			});
			default_select.css({
				"width":"0px",
				"height":"0px",
				"border":"none",
				"position":"absolute",
				"visibility":"hidden"
			});
			default_select.html(default_select.children("option[value=livre]")); // important !!!
			default_select.prop("disabled",true);
			var x = 2; // x > 1
			new_select.change(function(){
				var r = new_select.val();
				if ($.isNumeric(r)) {
					crop_box.unbind("resize");
					var p = crop_box.parent();
					crop_box.css("max-width", p.width());
					crop_box.css("max-height", p.height());
					if (p.width() / p.height() <= x * r) {
						crop_box.css("width", "calc(" + String(100 * (1 / x)) + "%)");
						crop_box.css("height", crop_box.width() / r + "px");
					} else {
						crop_box.css("height", "calc(" + String(100 * (1 / x)) + "%)");
						crop_box.css("width", crop_box.height() * r + "px");
					}
					crop_box.resize(function(){
						var height = (crop_box.width() / r) + "px";
						var width = (crop_box.height() * r) + "px";
						crop_box.height(height);
						crop_box.width(width);
						if (parseInt(crop_box.css("top")) + parseInt(crop_box.height()) > parseInt(p.height()) ) {
							crop_box.css("top", parseInt(p.height()) - parseInt(crop_box.height()) + "px");
						}
						if (parseInt(crop_box.css("left")) + parseInt(crop_box.width()) > parseInt(p.width()) ) {
							crop_box.css("left", parseInt(p.width()) - parseInt(crop_box.width()) + "px");
						}
					});
				} else {
					crop_box.unbind("resize");
				}
			});
		}
	});
};