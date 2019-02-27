# Arunz System


## Installation:
  To install and use this application need to:\n
  -> Download this apllication from repository\n
  -> Move files application to server (e.x. Apache2, nginx or something else)\n
  -> Download file 'janberdy39.sql' and load to database call 'janberdy39'(if not exists, create !) by mysqldump \n
  -> Change detail's connect database in /basic/config/db.php to our data\n
  -> Log as: admin, password: admin
  -> Run and enjoy !\n
 If you want to create virtual host, in vhost file add (for Apache):
 
 <VirtualHost *:80>
    ServerAdmin <your_name_domain>
    DocumentRoot "<absolute_path_app>/basic/web"
    ServerName <your_name_domain>
    ErrorLog "logs/dummy-host2.example.com-error.log"
    CustomLog "logs/dummy-host2.example.com-access.log" common
</VirtualHost>

## Capabilities:
  In this application we can (in shortcut):\n
  -> Plan marathons through the calendar (manage reminder's, move events on calendar and more)\n
  -> Manage users (filtration chosen)\n
  -> Manage road (add, delete, edit )\n

