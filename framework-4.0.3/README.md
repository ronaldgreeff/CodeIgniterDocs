# What is this?

## My notes getting to grips with CodeIgniter (4)
Along with picking up some PHP / server configuration skills. The code will have many annotations.

# Process

## Install Apache

### What is a Web Server?

A web server is software that listens for requests and returns data (usually a file). When you type “www.mysite.com”, the request is forwarded to a machine running web server software which returns a file back to your browser — such as the contents of index.html. The browser might then make further requests based on the HTML content — like CSS, JavaScript, and graphic files.

Since the web server sits between your browser and the requested file, it can perform processing that’s not possible by opening an HTML file directly. For example, it can parse PHP code which connects to a database and returns data.

### Why Apache?

In general, it’s good to use the web server software that your web host uses. Unless you’re creating ASP.NET applications on Microsoft IIS, your host is likely to use Apache — the most widespread and fully-featured web server available. It’s an open-source project, so it doesn’t cost anything to download or install.

### Set-up
* Apache listens for requests on TCP/IP port 80. Other program can't use that port.
* (Unofficial) Windows binariers @ https://www.apachelounge.com/download/
* Scan & Verify
* Unzip @ `C:/Apache24`
* Config `conf/httpd.conf`:
	* Listen on Port 80: `Listen \*:80`
	* Enable mod-rewrite (optional/useful): `LoadModule rewrite_module modules/mod_rewrite.so`
	* Specify server dommain name: `ServerName localhost:80`
	* Allow `.htaccess` overrides: `AllowOverride All`
* Set Web Page Root: `DocumentRoot "Drive:/Folder"` and `<Directory "Drive:/Folder">`
* Test Installation:
```
# navigate to Apache bin directory
cd /Apache24/bin
# Test httpd.conf validity
httpd -t
```
* Install Apache as a Windows service
```
cd /Apache24/bin
httpd -k install
```
* Test Web server by creating `index.html` in Apache's web page root (`htdocs` or `Drive:/Folder`) and navigating to `http://localhost/`
```
<html>
    <head>
        <title>Testing Apache</title>
    </head>
    <body>
        <p>Apache is working!</p>
    </body>
</html>
```

## Install PHP

### "Cool" PHP facts
* The most widespread and popular server-side programming language on the web
* Has close ties with the MySQL database

### Set-up
* Download latest @ https://www.php.net/downloads.php
* 	*if Windows, make sure you get thread-safe version (needed for running it as a module instead of spawned as separate process using Fast/CGI)*
* Scan for viruses, verify integrity
* Install @ `C:\php`
* Copy `C:\php\php.ini-development` to `C:\php\php.ini and edit`
* Define extension dir as `extension_dir = "C:/php/ext"`
* Enable extensions by removing leading ";" (aka semicolon)
* Enter SMTP server details if wanting to use PHP `mail()` function
* Add `C:\php` to Windows PATH
* `net stop Apache2.4` then in `httpd.conf` add "index.php" to "DirectoryIndex": `DirectoryIndex index.php index.html`
* To the bottom of the file, add the following:
```
# PHP7 module
LoadModule php7_module "c:/php/php7apache2_4.dll"
AddType application/x-httpd-php .php
PHPIniDir "C:/php"
```
* (In Bash),
```
$ cd Apache2bin
$ httpd -t
```
* In web root, create a file `index.php` and add `<?php phpinfo(); ?>` to it and go to `http://localhost/`


## CodeIgniter
* change DocumentRoot to /public in Apache's `conf/httpd.conf`
* Download latest version @ https://github.com/CodeIgniter4/framework/releases/latest
* Unzip as project root
* 
* *follow rest of docs...*

* use `php spark serve`

# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).

This repository holds the distributable version of the framework,
including the user guide. It has been built from the 
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/). 


## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!
The user guide updating and deployment is a bit awkward at the moment, but we are working on it!

## Repository Management

We use Github issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script. 
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/contributing.md) section in the development repository.

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
