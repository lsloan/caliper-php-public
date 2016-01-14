caliper-php
===========

caliper-php is a PHP client for [Caliper](http://www.imsglobal.org) that
provides an implementation of the Caliper SensorAPI™.

## Getting Started

### Pre-requisites for development

* PHP 5.4 required (PHP 5.6 recommended)
* Ensure you have php5 and php5-json installed:  ```sudo apt-get install php5 php5-json```
* Install Composer (for dependency management):  ```curl -sS https://getcomposer.org/installer | php```
* Install dependencies:  ```php composer.phar install```
* Run tests using the Makefile: ```make test-caliper```

    The tests require that the `caliper-common-fixtures-public` project be
    installed in the same parent directory as `caliper-php-public`.  It is
    available at:
    https://github.com/IMSGlobal/caliper-common-fixtures-public.git

### Installing and Using the Library

* Installing: There are two ways to install caliper-php.  Either install by cloning the IMS
Global public version of the caliper-php GitHub repository or use Composer to
install from that same repository.  The steps for each method are explained
below:
    * Cloning caliper-php-public from GitHub
        * Clone the repository from GitHub into your application's directory

            ```sh
            git clone https://github.com/IMSGlobal/caliper-php-public.git
            ```

        * Add the following to your PHP program:

            ```php
            require_once '/path/to/caliper-php/lib/Caliper/Sensor.php';
            ```

    * Use Composer to install caliper-php-public from GitHub
        * Update the `composer.json` file in the root directory of your project as follows:
            * The `require` section should include the following:

                ```json
                {
                    "require": {
                        "php": ">=5.4",
                        "ims-global/caliper-php-public": "1.0.0"
                    }
                }
                ```

            * The `repositories` section should include the following:

                ```json
                {
                    "repositories": [
                        {
                            "type": "vcs",
                            "url": "https://github.com/IMSGlobal/caliper-php-public.git"
                        }
                    ]
                }
                ```

            ***NOTE*** - These package and repository values will not work at
            this time with the IMS Global repositories.  The `composer.json`
            file in caliper-php-public doesn't contain the correct entries. This
            should be corrected with an update in the near future. For U-M
            purposes, substitute the following values for the package
            and repository, respectively:

            ```json
            "umich-its-tl/caliper-php": "1.0.1"
            ```

            ```json
            "url": "https://github.com/tl-its-umich-edu/caliper-php-public"
            ```

            This version of caliper-php-public has been modified for U-M use.
            It includes a new `Options::setHttpHeaders()` feature.
        * Use Composer to install the package with the command:

            ```sh
            composer install
            ```

            Composer will create the `vendor` directory to hold the package and
            other related information.
        * Composer will create PHP classes to help you load Caliper (and any other
            packages it has loaded) into your application.  In your PHP code, use it like:

            ```php
            /*
             * If necessary, use set_include_path() to ensure the directory
             * containing the "vendor" directory is in the PHP include path.
             */
            require_once 'vendor/autoload.php';  // Composer loader for Caliper, etc.
            ```
* After installing Caliper using one of the methods decribed above, initialize
it and send an event as follows:

    ```php
    // Create Caliper sensor object
    $sensor = new Sensor('your_sensor_id');
    // Set sensor options
    $options = (new Options())
        ->setApiKey('your_authentication_key_for_the_datastore')
        ->setDebug(true)
        ->setHost('http://example.org/dataStoreURI');
    // Register a network transport for the sensor
    $sensor->registerClient('your_http_transport_id',
        new Client('your_client_id', $options));
    // TODO: Define $yourCaliperEventObject
    // Send a Caliper event object
    $sensor->send($sensor, $yourCaliperEventObject);

    ```

    Your PHP program needs to create a sensor object only once per request.
    The sensor object can be reused to send multiple events within the same
    request.


### Running an example

A simple example program can be found in `examples/SessionEventSampleApp.php`.

It will attempt to send an event to a data store listener on localhost:8000.
If you have a data store on some other host or port, you can edit the program
to use it instead.  If you don't have a data store, you can run a simple
listener program included in:

```
examples/tools/testListener.sh [optional_port]
```

That will start a simple PHP web server (on port 8000 by default) that listens for POST requests and dumps the raw contents to the terminal.  If you run this in one terminal window and the example program in another terminal window, you will see the request received in the first window.

## Documentation
Documentation is available at
[http://www.imsglobal.org/caliper](https://www.imsglobal.org/caliper).

caliper-php-public includes as much documentation as possible in the
form of PHPDoc comments.  These may appear as pop-up help in many IDEs.
phpDocumentor may be used to turn them into standalone documents.

## Credits

A very special thank you to each of the developers that contributed to this project:

* Prashant Nayak, Intellify Learning
* balachandiran.v / Yoganand-htc
* Lance E Sloan (lsloan at umich dot edu), University of Michigan

©2015 IMS Global Learning Consortium, Inc. All Rights Reserved.
Trademark Information - http://www.imsglobal.org/copyright.html

For license information contact, info@imsglobal.org and read the LICENSE file contained in the repository.
