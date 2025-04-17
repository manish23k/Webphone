Thank you for choosing WebPhone.
	In order to use WebPhone, upload the code inside this folder into a subdirectory from your Vicidial AGC directory (typically /srv/www/htdocs/agc/WebPhone), 
then point your webphone URL to the absolute or relative path within your server, such as /agc/WebPhone/WebPhone.php
	If you are using WebPhone in conjunction with Vicidial you will need to change this setting in ADMIN &#8594; System Settings.
 
To install on your server for the following commands after changing to your web directory:

git clone https://github.com/manish23k/Webphone.git

chmod -R 744 Webphone

chown -R apache:apache Webphone






