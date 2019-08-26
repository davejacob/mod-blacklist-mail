<?php
/* -----------------------------------------------------------------------------------------
   $Id: email_blacklist.php  2019-08-26 11:11:00Z dazzen $

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]
   -----------------------------------------------------------------------------------------
   Third Party contribution:
   
   based on:
   $Id: blacklist.php,v 1.00 2003/04/10 BMC

   Copyright (c) 2003 BMC http://www.mainframes.co.uk (credit card blacklisting)     
   Copyright (c) 2011 Spegeli https://spegeli.de (Modified 1.6)
   Copyright (c) 2019 David Jacob https://www.dev-man.de (Modified 2)   
   
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

require_once 'includes/application_top.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$blacklist_id = isset($_GET['bID']) ? (int)$_GET['bID'] : 0;
$blacklist_domain_name = isset($_POST['blacklist_domain_name']) ? xtc_db_prepare_input($_POST['blacklist_domain_name']) : '';

switch ($action) 
{
  case 'insert':
    if ('' == $blacklist_domain_name)
    {    
      $messageStack->add_session(WARNING_BLACKLIST_EMPTY, 'warning');  
      xtc_redirect(xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $blacklist_id . '&action=new'));
      break;
    }        
  	$sql_data_array = array(
    	'blacklist_domain_name' => xtc_db_input($blacklist_domain_name),
    	'date_added' => 'now()'
    );
    xtc_db_perform(TABLE_EMAIL_BLACKLIST, $sql_data_array);
    $blacklist_id = xtc_db_insert_id();
    if (USE_CACHE == 'true') { xtc_reset_cache_block('blacklist'); }
    xtc_redirect(xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $blacklist_id));
  	break;
  case 'save':    
    if ('' == $blacklist_domain_name)
    {    
      $messageStack->add_session(WARNING_BLACKLIST_EMPTY, 'warning');  
      xtc_redirect(xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $blacklist_id . '&action=edit'));
      break;
    }
    $sql_data_array = array(
    	'blacklist_domain_name' => xtc_db_input($blacklist_domain_name),
    	'last_modified' => 'now()'
    );
    xtc_db_perform(TABLE_EMAIL_BLACKLIST, $sql_data_array, 'update', 'blacklist_id=' . $blacklist_id);    
    if (USE_CACHE == 'true') { xtc_reset_cache_block('blacklist'); }
    xtc_redirect(xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $blacklist_id));
    break;
  case 'deleteconfirm':    
    xtc_db_query("DELETE FROM " . TABLE_EMAIL_BLACKLIST . " WHERE blacklist_id=" . $blacklist_id . ";");
    if (USE_CACHE == 'true') { xtc_reset_cache_block('manufacturers'); }
    xtc_redirect(xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page']));
    break;
  default:
  	break;
}

require_once DIR_WS_INCLUDES.'head.php';
?>
	</head>
  <body>
    <!-- header //-->
    <?php require_once DIR_WS_INCLUDES . 'header.php'; ?>
    <!-- header_eof //-->
  
    <!-- body //-->
    <table class="tableBody">
      <tr>
        <?php //left_navigation
        if (USE_ADMIN_TOP_MENU == 'false') {
          echo '<td class="columnLeft2">'.PHP_EOL;
          echo '<!-- left_navigation //-->'.PHP_EOL;       
          require_once DIR_WS_INCLUDES . 'column_left.php';
          echo '<!-- left_navigation eof //-->'.PHP_EOL; 
          echo '</td>'.PHP_EOL;      
        }
        ?>   
        <!-- body_text //-->
        <td class="boxCenter">        	
        	<div class="pageHeadingImage"><?php echo xtc_image(DIR_WS_ICONS.'heading/icon_configuration.png'); ?></div>
          <div class="pageHeading"><?php echo HEADING_TITLE_BLACKLIST; ?></div>        	        	
          <div class="main pdg2 flt-l">Configuration</div>
          <table class="tableCenter">
          <tr>
            <td class="boxCenterLeft">
              <table class="tableBoxCenter collapse">
          			<tr class="dataTableHeadingRow">
	              	<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_BLACKLIST; ?></td>
	                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
	             	</tr>

<?php
$blacklist_query_raw = "SELECT blacklist_id, blacklist_domain_name, date_added, last_modified FROM " . TABLE_EMAIL_BLACKLIST . " ORDER BY blacklist_id ASC";
$blacklist_split = new splitPageResults($_GET['page'], '20', $blacklist_query_raw, $blacklist_query_numrows);
$blacklist_query = xtc_db_query($blacklist_query_raw);
while ($blacklist = xtc_db_fetch_array($blacklist_query)) 
{	
  if ( $blacklist_id == $blacklist['blacklist_id'] && !isset($bInfo) && substr($action, 0, 3) != 'new') 
  {  	
    $blacklist_numbers_query = xtc_db_query("SELECT COUNT(*) AS blacklist_count FROM " . TABLE_EMAIL_BLACKLIST . " WHERE blacklist_id=" . (int)$blacklist['blacklist_id'] . ";");
    $blacklist_numbers = xtc_db_fetch_array($blacklist_numbers_query);
    $bInfo_array = xtc_array_merge($blacklist, $blacklist_numbers);
    $bInfo = new objectInfo($bInfo_array);    
  }

  if ( (is_object($bInfo)) && ($blacklist['blacklist_id'] == $bInfo->blacklist_id) ) 
  {
    echo '<tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'pointer\'" onclick="document.location.href=\'' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $blacklist['blacklist_id'] . '&action=edit') . '\'">' . PHP_EOL;
  } 
  else 
  {
    echo '<tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'pointer\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $blacklist['blacklist_id']) . '\'">' . PHP_EOL;
  }  
?>								
									<td class="dataTableContent"><?php echo $blacklist['blacklist_domain_name']; ?></td>
									<td class="dataTableContent" align="right"><?php if ( (is_object($bInfo)) && ($blacklist['blacklist_id'] == $bInfo->blacklist_id) ) { echo xtc_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ICON_ARROW_RIGHT); } else { echo '<a href="' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $blacklist['blacklist_id']) . '">' . xtc_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
								</tr>
<?php } ?>								
							</table>
							<div class="smallText pdg2 flt-l"><?php echo $blacklist_split->display_count($blacklist_query_numrows, '20', $_GET['page'], TEXT_DISPLAY_NUMBER_OF_BLACKLIST_EMAIL_DOMAINS); ?></div>
              <div class="smallText pdg2 flt-r"><?php echo $blacklist_split->display_links($blacklist_query_numrows, '20', MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></div>
	             	
<?php if ($action != 'new') { ?>
							<div class="clear"></div>
							<div class="smallText pdg2 flt-r"><?php echo '<a class="button" onclick="this.blur();" href="' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&action=new') . '">' . BUTTON_INSERT . '</a>'; ?></div>		             
<?php } ?>	             	
	            <div class="clear"></div> 	             		             	          		    
<?php
$heading = array();
$contents = array();
switch ($action) 
{
  case 'new':
    $heading[] = array('text' => '<b>' . TEXT_HEADING_NEW_BLACKLIST_EMAIL_DOMAIN . '</b>');
    $contents = array('form' => xtc_draw_form('blacklisted', FILENAME_EMAIL_BLACKLIST, 'action=insert', 'post', 'enctype="multipart/form-data"'));
    $contents[] = array('text' => TEXT_NEW_INTRO);
    $contents[] = array('text' => '<br /><label for="blacklist_domain_name">' . TEXT_BLACKLIST_EMAIL_DOMAIN . '</label>' . xtc_draw_input_field('blacklist_domain_name','','id="blacklist_domain_name"',true));
    $contents[] = array('align' => 'center', 'text' => '<br /><input type="submit" class="button" onclick="this.blur();" value="' . BUTTON_SAVE . '"/> <a class="button" onclick="this.blur();" href="' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $_GET['bID']) . '">' . BUTTON_CANCEL . '</a>');       
    break;
  case 'edit':
    $heading[] = array('text' => '<b>' . TEXT_HEADING_EDIT_BLACKLIST_EMAIL_DOMAIN . '</b>');
    $contents = array('form' => xtc_draw_form('blacklisted', FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $bInfo->blacklist_id . '&action=save', 'post', 'enctype="multipart/form-data"'));
    $contents[] = array('text' => TEXT_EDIT_INTRO);        
    $contents[] = array('text' => '<br /><label for="blacklist_domain_name">' . TEXT_BLACKLIST_EMAIL_DOMAIN . '</label>' . xtc_draw_input_field('blacklist_domain_name', $bInfo->blacklist_domain_name,'id="blacklist_domain_name"',true,'text',false));   
    $contents[] = array('align' => 'center', 'text' => '<br /><input type="submit" class="button" onclick="this.blur();" value="' . BUTTON_SAVE . '"/> <a class="button" onclick="this.blur();" href="' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $mInfo->blacklist_id) . '">' . BUTTON_CANCEL . '</a>');        
    break;
  case 'delete':
    $heading[] = array('text' => '<b>' . TEXT_HEADING_DELETE_BLACKLIST_EMAIL_DOMAIN . '</b>');
    $contents = array('form' => xtc_draw_form('blacklisted', FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $bInfo->blacklist_id . '&action=deleteconfirm'));
    $contents[] = array('text' => TEXT_DELETE_INTRO);
    $contents[] = array('text' => '<br /><b>' . $bInfo->blacklist_domain_name . '</b>');
    $contents[] = array('align' => 'center', 'text' => '<br /><input type="submit" class="button" onclick="this.blur();" value="' . BUTTON_DELETE . '"/> <a class="button" onclick="this.blur();" href="' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $bInfo->blacklist_id) . '">' . BUTTON_CANCEL . '</a>');
    break;
  default:
    if (isset($bInfo) && is_object($bInfo)) 
    {
      $heading[] = array('text' => '<b>' . $bInfo->blacklist_domain_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<a class="button" onclick="this.blur();" href="' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $bInfo->blacklist_id . '&action=edit') . '">' . BUTTON_EDIT . '</a> <a class="button" onclick="this.blur();" href="' . xtc_href_link(FILENAME_EMAIL_BLACKLIST, 'page=' . $_GET['page'] . '&bID=' . $bInfo->blacklist_id . '&action=delete') . '">' . BUTTON_DELETE . '</a>');
      $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . xtc_date_short($bInfo->date_added));
      if (xtc_not_null($bInfo->last_modified)) { $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . xtc_date_short($bInfo->last_modified)); }
    }
    break;
}

if ( count($heading) > 0 && count($contents) > 0) 
{
	$box = new box();            
  echo '<td width="25%" valign="top">' . PHP_EOL;  
  echo $box->infoBox($heading, $contents) . PHP_EOL;
  echo '</td>' . PHP_EOL;
  }
?>
        		</tr>
      		</table>
    		</td>
  		</tr>
		</table>
		<!-- body_eof //-->

		<!-- footer //-->
<?php require_once DIR_WS_INCLUDES . 'footer.php'; ?>
		<!-- footer_eof //-->
		<br />
	</body>
</html>
<?php 
require_once DIR_WS_INCLUDES . 'application_bottom.php';