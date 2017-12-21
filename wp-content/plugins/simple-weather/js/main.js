jQuery(document).ready(function($){

    jQuery("select[name*='[location-type]']").change(function() {
    	if ( jQuery(this).val() == 'location' ) {
    		jQuery(this).parent().siblings('p.lat-cont').hide();
    		jQuery(this).parent().siblings('p.lon-cont').hide();
    		jQuery(this).parent().siblings('p.loc-cont').show();
    	} else if ( jQuery(this).val() == 'auto' ) {
    		jQuery(this).parent().siblings('p.lat-cont').hide();
    		jQuery(this).parent().siblings('p.lon-cont').hide();
    		jQuery(this).parent().siblings('p.loc-cont').hide();
    	} else {
    		jQuery(this).parent().siblings('p.lat-cont').show();
    		jQuery(this).parent().siblings('p.lon-cont').show();
    		jQuery(this).parent().siblings('p.loc-cont').hide();
    	}
    })
       
    $(document).ajaxSuccess(function(e, xhr, settings) {

        jQuery("select[name*='[location-type]']").change(function() {
        	if ( jQuery(this).val() == 'location' ) {
        		jQuery(this).parent().siblings('p.lat-cont').hide();
        		jQuery(this).parent().siblings('p.lon-cont').hide();
        		jQuery(this).parent().siblings('p.loc-cont').show();
        	} else if ( jQuery(this).val() == 'auto' ) {
                jQuery(this).parent().siblings('p.lat-cont').hide();
                jQuery(this).parent().siblings('p.lon-cont').hide();
                jQuery(this).parent().siblings('p.loc-cont').hide();
    	   } else {
        		jQuery(this).parent().siblings('p.lat-cont').show();
        		jQuery(this).parent().siblings('p.lon-cont').show();
        		jQuery(this).parent().siblings('p.loc-cont').hide();
        	}
        })
    });
 });