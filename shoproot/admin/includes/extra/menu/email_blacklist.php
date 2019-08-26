<?php
/* -----------------------------------------------------------------------------------------
   $Id: email_blacklist.php  2019-08-26 11:11:00Z dazzen $

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]      
   -----------------------------------------------------------------------------------------
   Third Party contribution:
   
   Copyright (c) 2019 David Jacob https://www.dev-man.de
   
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

defined( '_VALID_XTC' ) or die( 'Direct Access to this location is not allowed.' );

$add_contents[BOX_HEADING_MODULES][] = array( 
    'admin_access_name' => 'email_blacklist',   //Eintrag fuer Adminrechte
    'filename' => FILENAME_EMAIL_BLACKLIST,
    'boxname' => BOX_TOOLS_EMAIL_BLACKLIST,
    'parameters' => '',
    'ssl' => 'SSL'
);