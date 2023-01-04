<div class="wrap">
	<div id="lbg_logo">
			<h2>Manage Cards</h2>
 	</div>
    <div><p>From this section you can add multiple cards.</p></div>

    <div id="previewDialog"><iframe id="previewDialogIframe" src="" width="100%" height="600" style="border:0;"></iframe></div>

<div style="text-align:center; padding:0px 0px 20px 0px;"><img src="<?php echo plugins_url('images/icons/add_icon.gif', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="?page=CHRISTMAS_CARD_1_Add_New">Add new (card)</a></div>

<table width="100%" class="widefat">

			<thead>
				<tr>
					<th scope="col" width="6%">ID</th>
					<th scope="col" width="28%">Name</th>
					<th scope="col" width="30%">Shortcode</th>
					<th scope="col" width="25%">Action</th>
					<th scope="col" width="11%">Preview</th>
				</tr>
			</thead>

<tbody>
<?php foreach ( $result as $row )
	{
		$row=christmas_card_1_unstrip_array($row); ?>
							<tr class="alternate author-self status-publish" valign="top">
					<td><?php echo $row['id']?></td>
					<td><?php echo $row['name']?></td>
					<td>[christmas_card_1 settings_id='<?php echo $row['id']?>']</td>
					<td>
						<a href="?page=CHRISTMAS_CARD_1_Settings&amp;id=<?php echo $row['id']?>&amp;name=<?php echo $row['name']?>">Card Settings</a> &nbsp;&nbsp;|&nbsp;&nbsp;

                        <a href="?page=CHRISTMAS_CARD_1_Manage_Cards&id=<?php echo $row['id']?>" onclick="return confirm('Are you sure?')" style="color:#F00;">Delete</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="?page=CHRISTMAS_CARD_1_Duplicate_Card&amp;id=<?php echo $row['id']?>&amp;name=<?php echo $row['name']?>">Duplicate</a>
                        </td>
					<td><a href="javascript: void(0);" onclick="showDialogPreview(<?php echo $row['id']?>)"><img src="<?php echo plugins_url('images/icons/magnifier.png', dirname(__FILE__))?>" alt="preview" border="0" align="absmiddle" /></a></td>
	            </tr>
<?php } ?>
						</tbody>
		</table>





</div>
