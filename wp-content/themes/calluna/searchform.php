<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="row">
    	<div class="col-sm-12">
        	<div class="input-group add-on">
    		<input class="form-control search-box" type="text" value="" placeholder="<?php esc_html_e( 'Type keywords here', 'calluna-td' ); ?>" name="s" id="s" />
          <div class="input-group-btn">
            <button class="btn btn-default search-button" type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
          </div>
   		</div>
        </div>
    </div>
</form>