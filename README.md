caliper-php
================
NOTE: THESE MATERIALS ARE FOR IMS CONTRIBUTING MEMBERS ONLY. THEY MAY NOT BE RELEASED UNTIL APPROVED BY IMS GLOBAL.

caliper-php is a php client for [Caliper](http://www.imsglobal.org) that provides an implementation of the Caliper Sensor API.

## Documentation

## IMPORTANT INFORMATION:
Access to this draft code is reserved for IMS Contributing Members who are active participants of the IMS Learning Analytics Task Force.  Dissemination of this code to outside parties is strictly prohibited. By accessing these materials you agree to abide by these rules. This code is in draft format and will change substantially. 

## Getting Started

### Pre-requisites for development:  

* Ensure you have php5 and php5-json installed.  E.g. sudo apt-get install php5 php5-json
* Install Composer (for dependency management) - curl -sS https://getcomposer.org/installer | php 
* Install dependencies - php composer.phar install
* Run tests using the Makefile

### Installing and using the Library:

To install the library, clone the repository from github into your desired application directory.

git clone https://github.com/IMSGlobal/caliper-php.git

Then, add the following to your PHP script:

```
require_once '/path/to/caliper-php/lib/CaliperSensor.php';
```

Now you're ready to initialize Caliper and send an event as follows:

```
Caliper::init('org.imsglobal.caliper.php.apikey', [
       'host' => 'requestb.in',
       'port' => 80,
       'measureURI' => '/1234abc5',
]);
// TODO: Define $yourCaliperEventObject
Caliper::measure($yourCaliperEventObject);
```

In this example, after you've defined a Caliper event object to be logged by the measure() method,
the serialized object's JSON will be sent to a bin at:

[http://requestb.in/1234abc5](http://requestb.in/1234abc5)

To view the contents of the bin, go to:

[http://requestb.in/1234abc5?inspect](http://requestb.in/1234abc5?inspect)

Your PHP program should call init() only once, when it responds to a request.
All parts of your program will then have access to the same Caliper client.

## Credits

A very special thank you to each of the developers that contributed to this project:

* Prashant Nayak, Intellify Learning
* balachandiran.v / Yoganand-htc
* Lance E Sloan (lsloan at umich dot edu), University of Michigan

©2014 IMS Global Learning Consortium, Inc. All Rights Reserved.
Trademark Information- http://www.imsglobal.org/copyright.html

For license information contact, info@imsglobal.org