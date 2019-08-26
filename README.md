# mod-blacklist-mail

Module to block email address at registration process.
Based upon scripts of user Spegeli (https://spegeli.de/) <br/>
https://www.modified-shop.org/forum/index.php?topic=12360

Modified scripts to be compatible with Modified Shop 2

<h2>Installation</h2>

1. Backup your system including database

2. Open your database and query the following statements found in:
sql/table_admin_access.sql
sql/table_email_blacklist.sql
Hint: SQL statements uses the utf-8 charset; if you have a different charset replace utf-8 by your chosen one

3. Copy all files from shoproot to your shop root directory
Hint: since Modified Shop 2 you can habe a different name for your admin directory

4. In Usermanagement set the proper admin rights (check the section tools and activate email_blacklist)

<h2>Usage</h2>

<h3>Adding a domain</h3>
1. Goto Modules -> eMail Domain Blacklist
2. Add a new one by clicking on the button 'Insert'
3. Enter the domain or complete email you like to block
Hint: you can use a whole email address or parts of them. 
I.e. foo@foo, foo@foo.tld @foo.tld, @foo, foo@, .tld or foo
4. Click on the button 'Save'

<h3>Edit a domain</h3>
1. Goto Modules -> eMail Domain Blacklist
2. Choose a domain from the listing and click on it
3. Click on the button 'Edit'
4. Rename the domain
Hint: A domain must contain minimum 1 char. Remember the less chars your are using, the more user you are blocking.
I.e. you enter only the char 'e', every email with this char will be blocked. so edgar@foo.tld can't register anymore.
5. Click on button 'Save'

<h3>Delete a domain</h3>
1. Goto Modules -> eMail Domain Blacklist
2. Choose a domain from the listing and click on it
3. Click on the button 'Delete'
4. Confirm the delete by clicking on the button 'Delete'

