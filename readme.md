<h1>How to configure PHP 7 with HTTP Apahce 2.4 Server in Windows</h1>
<ol>
    <li>Download PHP 7 from the given link: https://windows.php.net/downloads/releases/php-7.3.10-Win32-VC15-x64.zip</li>
    <li>Make a copy of php.ini-developement and remame it php.ini</li>
    <li>Now edit php.ini file and do the following changes</li>
    <ol>
        <li>uncomment extension_dir = "ext"</li>
        <li>Add extension=php_pdo_pgsql.dll</li>
        <li>Add extension=php_pgsql.dll</li>
        <li>Note I am using Postgres SQL so I enabled the above two extensions</li>
    </ol>
    <li>Download Apache HTTP 2.4 from the given link: http://fs3.softfamous.com/downloads/tname-120875cb0f198/software/httpd-2.4.34-win64-VC15.zip</li>
    <li>Edit httpd.conf file in the conf folder and edit: </li>
    <ol>
        <li>SRVROOT right directoy (root folder of Apache HTTP)</li>
        <li>Add LoadModule php7_module "D:/Program Files/php/php7apache2_4.dll"</li>
        <li>Add AddType application/x-httpd-php .php</li>
        <li>PHPIniDir "D:/Program Files/php/"</li>
    </ol>
</ol>