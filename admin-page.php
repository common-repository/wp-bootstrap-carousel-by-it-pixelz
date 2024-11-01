<?php
	if ( ! isset( $_REQUEST['settings-updated'] ) )
	$_REQUEST['settings-updated'] = false;
?>
<style>
.wpbc_carousel_admin_wrapper  {
	   width:90%;
	   background:white;
	   padding:20px 20px;
	max-width: 700px;
	margin: 20px auto;
	    border-top: 1px solid gainsboro;
    border-left: 1px solid gainsboro;
    border-right: 1px solid rgba(220, 220, 220, 0.74);
    border-bottom: 1px solid rgba(220, 220, 220, 0.74);
}

.wpbc_carousel_admin_wrapper table{
	    border: 1px solid #ddd;
		border-spacing: 0;
    border-collapse: collapse;
	    width: 100%;
    max-width: 700px;
	margin:0 auto;
	    background-color: rgba(234, 234, 234, 0.11);
		
		    border-top: 1px solid gainsboro;
    border-left: 1px solid gainsboro;
    border-right: 1px solid rgba(220, 220, 220, 0.74);
    border-bottom: 1px solid rgba(220, 220, 220, 0.74);
}
.wpbc_carousel_admin_wrapper table td {
	    border: 1px solid #ddd;
	    padding: 5px;
}
.wpbc_carousel_admin_wrapper table th {
	   border-bottom: 2px solid #ddd;
	    padding: 5px;
}
.wpbc_carousel_admin_wrapper input[type=color] {
	  
	    padding: 0px;
}
</style>

	<div class="wrap wpbc_carousel_admin_wrapper">
		<h2>WP Bootstrap Carousel Settings</h2>
        
        
		<form method="post" action="options.php">
			<?php settings_fields( 'wpbc_carousel_options' ); ?>
			<?php $options = get_option( 'wpbc_carousel_options' ); ?>
             <table  class="widefat">
			 <tr>
			 <th colspan="2"><h3>Settings Options</h3></th>
			 </tr>
			 
            <tr>
			 <td align="right"><label>Display nav </label></td>
			 <td><select id="wpbc_carousel_options[nav_slider]" class="regular-text" name="wpbc_carousel_options[nav_slider]">
                        <option <?php if( $options['nav_slider'] == 'Yes'){?> selected="selected"<?php }?> value="Yes">Yes</option>
                        <option <?php if( $options['nav_slider'] == 'No'){?> selected="selected"<?php }?> value="No">No</option>
                    </select></td>
			 </tr>
			 
			 <tr>
			 <td align="right"><label>Display direction arrows</label></td>
			 <td><select id="wpbc_carousel_options[direction_controls]" class="regular-text" name="wpbc_carousel_options[arrow_carousel]">
                        <option <?php if( $options['arrow_carousel'] == 'Yes'){?> selected="selected"<?php }?> value="Yes">Yes</option>
                        <option <?php if( $options['arrow_carousel'] == 'No'){?> selected="selected"<?php }?> value="No">No</option>
                    </select></td>
			 </tr>
			 <tr>
			 <td align="right"><label>Display Caption</label></td>
			 <td><select id="wpbc_carousel_options[direction_controls]" class="regular-text" name="wpbc_carousel_options[caption_carousel]">
                        <option <?php if( $options['caption_carousel'] == 'Yes'){?> selected="selected"<?php }?> value="Yes">Yes</option>
                        <option <?php if( $options['caption_carousel'] == 'No'){?> selected="selected"<?php }?> value="No">No</option>
                    </select></td>
			 </tr>
			 <tr>
			 <td align="right"><label>Number of slides</label></td>
			 <td><input placeholder="0" class="ui-corner-all regular-text" type="text" name="wpbc_carousel_options[number_slides]" value="<?php esc_attr_e( $options['number_slides'] ); ?>" /></td>
			 </tr>
			 
			  <tr>
			 <td align="right"><label>Heading Color</label></td>
			  
			 <td><input placeholder="0" class="ui-corner-all  color" type="color" name="wpbc_carousel_options[heading_color]" value="<?php esc_attr_e( $options['heading_color'] ); ?>" /></td>
			 </tr>
			 
			 <tr>
			 <th colspan="2"><h3>Short Code</h3></th>
			 </tr>
			 <tr>
			 <td align="right"><label>Shortcode</label>
</td>
			 <td><input class="ui-corner-all regular-text" readonly type="text"  value="[show_bootstrap_carousel]" onclick="this.focus" />
</td>
			 </tr>
			 
			 <tr>
			 <td></td>
			 <td><input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only button button-primary" value="<?php _e( 'Save Settings', 'ITPIxelz' ); ?>" />
</td>
			 
			 </tr>
			 
			  </table>
                
                
                 
		</form>
		
		<h3>Support</h3>
		<p>In case of support or suggestions, feel free to send me email at <a href="mailto:admin@itpixelz.com" >admin@itpixelz.com</a> </p>
	</div>