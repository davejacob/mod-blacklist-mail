<?php
/* -----------------------------------------------------------------------------------------
   $Id: email_blacklist.php  2019-08-26 11:11:00Z dazzen $

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]      
   -----------------------------------------------------------------------------------------
   Third Party contribution:
   
   Copyright (c) 2011 Spegeli https://spegeli.de (Modified 1.6)
   Copyright (c) 2019 David Jacob https://www.dev-man.de (Modified 2)
   
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

/**
 * checkEmailBlacklist
 * 
 * Checks whether an email contains a blocked domain or nor.
 * The whole email string is checked!
 * 
 * @param string $email the email to check for
 * @return boolean true|false
 */
function checkEmailBlacklist($email)
{
	$sql = "SELECT GROUP_CONCAT(blacklist_domain_name SEPARATOR '|') AS domains  FROM " . TABLE_EMAIL_BLACKLIST . ";";
	$rs = xtc_db_query($sql);	
	if (xtc_db_num_rows($rs) > 0)
	{
		$row = xtc_db_fetch_array($rs);				
		if (preg_match('/' . $row['domains'] . '/', $email)) { return true; }
	}
	return false;
}