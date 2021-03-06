jQuery(document).ready(function () {
	function setformActionGuests(guest) {
		var url = jQuery("#hotelier-datepicker").attr('action');
		newUrl = url + '?guests=' + guest;
		jQuery("#hotelier-datepicker").attr("action", newUrl);
	}

	function a(a, b) {
		var c = a.split("-");
		jQuery(b + " .day").text(c[2]),
		jQuery(b + " .month").text(c[1])
	}

	jQuery(".ui-datepicker-div").css("zIndex", 999999),
	jQuery(".guests").css("zIndex", 999999),
	jQuery("#gaste").hover(function () {
		jQuery(".guests").fadeIn("fast")
	}, function () {
		jQuery(".guests").fadeOut("fast")
	}),
	jQuery("#gasteSelect li").click(function () {
		var a = jQuery(this).text();
		jQuery("#gasteCount").text(a),
		jQuery('input[id*="guests"]').val(a),
		setformActionGuests(a)
		jQuery(".guests").fadeOut("fast"),
		jQuery("#gasteSelect li").removeClass("active"),
		jQuery(this).addClass("active")
	}),
	jQuery("#vondatepicker").datepicker({
		altField: "#checkin",
		altFormat: "yy-mm-dd",
		minDate: 0,
		onSelect: function (b) {
			var c = new Date(Date.parse(jQuery(this).datepicker("getDate")));
			c.setDate(c.getDate() + 1),
			jQuery("#bisdatepicker").datepicker("option", "minDate", c),
			jQuery("#bisdatepicker").hide(),
			jQuery("#vondatepicker").hide();
			var d = new Date(jQuery(this).datepicker("getDate").getTime()),
			e = jQuery.datepicker.formatDate("yy-MM-dd", new Date(d));
			a(e, "#von");
			var f = new Date(jQuery("#bisdatepicker").datepicker("getDate").getTime()),
			g = jQuery.datepicker.formatDate("yy-MM-dd", new Date(f));
			a(g, "#bis")
		}
	}),
	jQuery("#vondatepicker").addClass("abs"),
	jQuery("#vondatepicker").hide(),
	jQuery("#von").hover(function () {
		jQuery("#vondatepicker").show()
	}, function () {
		jQuery("#vondatepicker").hide()
	}),
	jQuery("#bisdatepicker").datepicker({
		defaultDate: "+1d",
		altField: "#checkout",
		altFormat: "yy-mm-dd",
		onSelect: function (b) {
			jQuery("#vondatepicker").datepicker("option", "maxDate", b),
			jQuery("#vondatepicker").hide(),
			jQuery("#bisdatepicker").hide();
			var c = new Date(jQuery("#bisdatepicker").datepicker("getDate").getTime()),
			d = jQuery.datepicker.formatDate("yy-MM-dd", new Date(c));
			a(d, "#bis")
		}
	}),
	jQuery("#bisdatepicker").addClass("abs"),
	jQuery("#bisdatepicker").hide(),
	jQuery("#bis").hover(function () {
		jQuery("#bisdatepicker").fadeIn("fast")
	}, function () {
		jQuery("#bisdatepicker").fadeOut("fast")
	});
	
	var b = new Date(jQuery("#vondatepicker").datepicker("getDate").getTime()),
	c = jQuery.datepicker.formatDate("yy-MM-dd", new Date(b));
	a(c, "#von");
	
	var d = new Date(jQuery("#bisdatepicker").datepicker("getDate").getTime()),
	e = jQuery.datepicker.formatDate("yy-MM-dd", new Date(d));
	a(e, "#bis")
});