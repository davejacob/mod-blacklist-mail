# mod-blacklist-mail

Module to block email address at registration process.<br/>
Based upon scripts of user Spegeli (https://spegeli.de/) <br/>
https://www.modified-shop.org/forum/index.php?topic=12360

Blacklist mail scripts to be compatible with Modified Shop 2

<h2>Installation</h2>

1. Backup your system including database<br/><br/>

2. Open your database and query the following statements found in:<br/>
sql/table_admin_access.sql<br/>
sql/table_email_blacklist.sql<br/>
Hint: SQL statements uses the utf-8 charset; if you have a different charset replace utf-8 by your chosen one<br/>

3. Copy all files from shoproot to your shop root directory<br/>
Hint: since Modified Shop 2 you can habe a different name for your admin directory<br/><br/>

4. In Usermanagement set the proper admin rights (check the section tools and activate email_blacklist)

<h2>Usage</h2>

<h3>Adding a domain</h3>
1. Goto Modules -> eMail Domain Blacklist<br/>

2. Add a new one by clicking on the button 'Insert'<br/>

3. Enter the domain or complete email you like to block<br/>
Hint: you can use a whole email address or parts of them.<br/>
I.e. foo@foo, foo@foo.tld @foo.tld, @foo, foo@, .tld or foo

4. Click on the button 'Save'

<h3>Edit a domain</h3>
1. Goto Modules -> eMail Domain Blacklist

2. Choose a domain from the listing and click on it

3. Click on the button 'Edit'

4. Rename the domain<br/>
Hint: A domain must contain minimum 1 char. Remember the less chars your are using, the more user you are blocking.<br/>
I.e. you enter only the char 'e', every email with this char will be blocked. so edgar@foo.tld can't register anymore.

5. Click on button 'Save'

<h3>Delete a domain</h3>
1. Goto Modules -> eMail Domain Blacklist

2. Choose a domain from the listing and click on it

3. Click on the button 'Delete'

4. Confirm the delete by clicking on the button 'Delete'

