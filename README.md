OAuth2DemoApp
------------

This is an application that demos some of the basic OAuth2.0 Workflows.

This library is running the [OAuth2 Server](https://github.com/bshaffer/oauth2-server-php) PHP library.

Installation
------------

Use [Composer](http://getcomposer.org/) to install this application:

	$ git clone https://github.com/emanci/OAuth2DemoApp.git
	$ cd OAuth2DemoApp
	$ curl -s http://getcomposer.org/installer | php
	$ ./composer.phar install

The OAuth2.0 demo app screenshot
<p>The demo app homepage</p>
<img src="https://github.com/emanci/OAuth2DemoApp/blob/master/doc/screenshots/home.png?raw=true" width = "350" alt="hoempage" align=center />

<p>Asks if you'd like to grant the demo app access to your information</p>
<img src="https://github.com/emanci/OAuth2DemoApp/blob/master/doc/screenshots/confirm.png?raw=true" width = "350" alt="confirm" align=center />

<p>If all is successful, your data will be display displayed on the page</p>
<img src="https://github.com/emanci/OAuth2DemoApp/blob/master/doc/screenshots/response.png?raw=true" width = "350" alt="response" align=center />

<p>The authorization failed page</p>
<img src="https://github.com/emanci/OAuth2DemoApp/blob/master/doc/screenshots/failed.png?raw=true" width = "350" alt="failed" align=center />

<p>The error page</p>
<img src="https://github.com/emanci/OAuth2DemoApp/blob/master/doc/screenshots/error.png?raw=true" width = "350" alt="error" align=center />
