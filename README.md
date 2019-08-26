# mod-blacklist-mail

Module to block email address at registration process (compatible with Modified Shop 2)

Based upon scripts of user [Spegeli](https://spegeli.de/)
[Modified Forum Thread](https://www.modified-shop.org/forum/index.php?topic=12360)

This module isn't update secure due the usage of two systemfiles (create_account.php & create_guest_account.php)
If you updating your system, make sure these changes are not removed. 

In future it could be possible, that an autoloader is available. 
This module will be updated then too.

##Installation

1. Backup your system including database
2. Open your database and query the following statements found in:
sql/table_admin_access.sql
sql/table_email_blacklist.sql
sql/table_configuration.sql
Hint: SQL statements uses the utf-8 charset; if you have a different charset replace utf-8 by your chosen one
3. Copy all files from shoproot to your shop root directory
Hint: since Modified Shop 2 you can have a different name for your admin directory
If you have modified your these files insert the following code behind 
```php
$error = false;
````

```php
//E-Mail Blacklistcheck		  
if (checkEmailBlacklist($email_address)) 
{    	
  $error = true;
  $messageStack->add('create_account', ENTRY_EMAIL_ERROR_DOMAIN_BLACKLIST);  
}
</code>
```
4. In Usermanagement set the proper admin rights (check the section tools and activate email_blacklist)
5. In E-Mail Options -> activate 'Email domain blacklisting', if not all your entered blacklisted values are ignored

##Usage

###Adding a domain
1. Goto Modules -> eMail Domain Blacklist
2. Add a new one by clicking on the button 'Insert'
3. Enter the domain or complete email you like to block
Hint: you can use a whole email address or parts of them.
I.e. foo@foo, foo@foo.tld @foo.tld, @foo, foo@, .tld or foo
4. Click on the button 'Save'

###Edit a domain
1. Goto Modules -> eMail Domain Blacklist
2. Choose a domain from the listing and click on it
3. Click on the button 'Edit'
4. Rename the domain
Hint: A domain must contain minimum 1 char. Remember the less chars your are using, the more user you are blocking.
I.e. you enter only the char 'e', every email with this char will be blocked. so edgar@foo.tld can't register anymore.
5. Click on button 'Save'

###Delete a domain
1. Goto Modules -> eMail Domain Blacklist
2. Choose a domain from the listing and click on it
3. Click on the button 'Delete'
4. Confirm the delete by clicking on the button 'Delete'