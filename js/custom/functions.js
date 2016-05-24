

// This function require jQuery.js and Bootstrap.css

function myAlert(type,title,content){

	$(".alert").remove();
	type = (type===undefined)? "":type;
	var div = $("<div>")
				.addClass("alert")
				.addClass("alert-"+type)
				.css({"display":"none"})
				.append(
					$("<button>")
					.addClass("close")
					.attr("data-dismiss","alert")
					.html("&times;")
				)
				.append($("<h4>").append(title))
				.append($("<p>").append(content));

	$("#content").prepend(div);
	$(".alert").fadeIn().delay(3000).fadeOut("slow");		
}

$.fn.datepicker.dates['es'] = {
    days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado", "Domingo"],
    daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"],
    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julo", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    today: "Hoy",
    clear: "Borrar"
};