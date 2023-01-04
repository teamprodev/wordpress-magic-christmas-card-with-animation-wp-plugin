<script>
jQuery(document).ready(function() {

	// Uploading files
jQuery('#upload_mp3_button').on('click', function( event ){
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#mp3').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});

jQuery('#upload_ogg_button').on('click', function( event ){
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#ogg').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});

});
</script>
<div class="wrap">
	<div id="lbg_logo">
			<h2>Card Settings for card: <span style="color:#FF0000; font-weight:bold;"><?php echo $_SESSION['xname']?> - ID #<?php echo $_SESSION['xid']?></span></h2>
 	</div>

	<div style="text-align:center; padding:0px 0px 20px 0px;"><img src="<?php echo plugins_url('images/icons/magnifier.png', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="javascript: void(0);" onclick="showDialogPreview(<?php echo strip_tags($_SESSION['xid'])?>)">Preview Card</a></div>

	<div id="previewDialog"><iframe id="previewDialogIframe" src="" width="100%" height="600" style="border:0;"></iframe></div>

  <form method="POST" enctype="multipart/form-data" id="form-card-settings">
	<script>
	jQuery(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
		jQuery( "#accordion" ).accordion({
			icons: icons,
			autoHeight: false
		});
	});
	</script>


<div id="accordion">
  <h3><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;General Settings</a></h3>
  <div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">

		  <tr>
		    <td align="right" valign="top" class="row-title" width="25%">Card Name</td>
		    <td align="left" valign="top" width="75%"><input name="name" type="text" size="40" id="name" value="<?php echo $_SESSION['xname'];?>"/></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title" colspan="2"><hr></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H1 (the first line)</td>
		    <td align="left" valign="middle"><input name="h1" type="text" size="105" id="h1" value="<?php echo $_POST['h1'];?>"/></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top"><span class="small_text">Add your company name here</span></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H2 (the second line)</td>
		    <td align="left" valign="middle"><input name="h2" type="text" size="105" id="h2" value="<?php echo $_POST['h2'];?>"/></td>
	    </tr>
			<tr>
			    <td align="right" valign="top" class="row-title">&nbsp;</td>
			    <td align="left" valign="top"><span class="small_text">Example: Wishes You Happy Holidays</span></td>
		  </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">H3 (the third line)</td>
		    <td align="left" valign="middle"><input name="h3" type="text" size="105" id="h3" value="<?php echo $_POST['h3'];?>"/></td>
	    </tr>
			<tr>
			    <td align="right" valign="top" class="row-title">&nbsp;</td>
			    <td align="left" valign="top"><span class="small_text">Example: Merry Christmas</span></td>
		  </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">H4 (the forth line)</td>
		    <td align="left" valign="middle"><input name="h4" type="text" size="105" id="h4" value="<?php echo $_POST['h4'];?>"/></td>
	    </tr>
			<tr>
			    <td align="right" valign="top" class="row-title">&nbsp;</td>
			    <td align="left" valign="top"><span class="small_text">Example: December 23rd, <?php echo date("Y");?> at 7:30 PM</span></td>
		  </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">H5 (the fifth line)</td>
		    <td align="left" valign="middle"><input name="h5" type="text" size="105" id="h5" value="<?php echo $_POST['h5'];?>"/></td>
	    </tr>
			<tr>
			    <td align="right" valign="top" class="row-title">&nbsp;</td>
			    <td align="left" valign="top"><span class="small_text">Example: Please join us us for our annual holiday party with cocktail and caroling.</span></td>
		  </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">H6 (the sixth line)</td>
		    <td align="left" valign="middle"><input name="h6" type="text" size="105" id="h6" value="<?php echo $_POST['h6'];?>"/></td>
	    </tr>
			<tr>
			    <td align="right" valign="top" class="row-title">&nbsp;</td>
			    <td align="left" valign="top"><span class="small_text">Example: Santa will be there, with his sleigh full of gifts.</span></td>
		  </tr>
			<tr>
		    <td align="right" valign="top" class="row-title" colspan="2"><hr></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">Your Facebook Link</td>
		    <td align="left" valign="middle"><input name="facebook_link" type="text" size="60" id="facebook_link" value="<?php echo $_POST['facebook_link'];?>"/></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">Your Twitter Link</td>
		    <td align="left" valign="middle"><input name="twitter_link" type="text" size="60" id="twitter_link" value="<?php echo $_POST['twitter_link'];?>"/></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">Your Instagram Link</td>
		    <td align="left" valign="middle"><input name="instagram_link" type="text" size="60" id="instagram_link" value="<?php echo $_POST['instagram_link'];?>"/></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">Your YouTube Link</td>
		    <td align="left" valign="middle"><input name="youtube_link" type="text" size="60" id="youtube_link" value="<?php echo $_POST['youtube_link'];?>"/></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">Your Pinterest Link</td>
		    <td align="left" valign="middle"><input name="pinterest_link" type="text" size="60" id="pinterest_link" value="<?php echo $_POST['pinterest_link'];?>"/></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">Your LinkedIn Link</td>
		    <td align="left" valign="middle"><input name="linkedin_link" type="text" size="60" id="linkedin_link" value="<?php echo $_POST['linkedin_link'];?>"/></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">Your Google Plus Link</td>
		    <td align="left" valign="middle"><input name="googleplus_link" type="text" size="60" id="googleplus_link" value="<?php echo $_POST['googleplus_link'];?>"/></td>
	    </tr>
			<tr>
			    <td align="right" valign="top" class="row-title">&nbsp;</td>
			    <td align="left" valign="top"><span class="small_text">If you don't define the link for a social channel, the social channel icon will not appear on the card.</span></td>
		  </tr>
			<tr>
		    <td align="right" valign="top" class="row-title" colspan="2"><hr></td>
	    </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">MP3 file</td>
		    <td align="left" valign="top"><input name="mp3" type="text" id="mp3" size="80" value="<?php echo (array_key_exists('mp3', $_POST))?strip_tags($_POST['mp3']):''?>" />
		      <input name="upload_mp3_button" type="button" id="upload_mp3_button" value="Upload File" />
		      <br />
		      Enter an URL or upload the file</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Optional OGG file (for old versions of browsers Mozzila, Opera). You can ignore it.</td>
		    <td align="left" valign="top"><input name="ogg" type="text" id="ogg" size="80" value="<?php echo (array_key_exists('ogg', $_POST))?strip_tags($_POST['ogg']):''?>" />
		      <input name="upload_ogg_button" type="button" id="upload_ogg_button" value="Upload File" />
		      <br />
		      Enter an URL or upload the file</td>
	      </tr>
		  <tr>
			<tr>
		    <td align="right" valign="top" class="row-title" colspan="2"><hr></td>
	    </tr>
      <tr>
        <td align="right" valign="top" class="row-title">Activate PopUp</td>
        <td align="left" valign="middle"><select name="popup" id="popup">
          <option value="true" <?php echo (($_POST['popup']=='true')?'selected="selected"':'')?>>true</option>
          <option value="false" <?php echo (($_POST['popup']=='false')?'selected="selected"':'')?>>false</option>
        </select></td>
    	</tr>
			<tr>
		 		<td align="right" valign="top" class="row-title">&nbsp;</td>
		 		<td align="left" valign="top"><span class="small_text">- If you activate the popup, when you open your website, the card will appear on your website in a pop-up window<br>
				- Only one card can be activated as popup </span></td>
		 	</tr>
		 <tr>
		   <td align="right" valign="top" class="row-title">&nbsp;</td>
		   <td align="left" valign="middle">&nbsp;</td>
	      </tr>

      </table>
  </div>


</div>

<div style="text-align:center; padding:20px 0px 20px 0px;"><input name="Submit" type="submit" id="Submit" class="button-primary" value="Update Card Settings"></div>

</form>
</div>
