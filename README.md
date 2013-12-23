caliper-php
================

caliper-php is a php client for [Caliper](http://www.imsglobal.org) that provides an implementation of the Caliper Sensor API.

## Documentation

### Getting Started

Pre-requisites:  Ensure you have php5 and php5-json installed

e.g. sudo apt-get install php5 php5-json

To install the library, clone the repository from github into your desired application directory.

git clone https://github.com/TBD

Then, add the following to your PHP script:

require_once("/path/to/caliper-php/lib/Caliper.php");

Now, you're ready to initialize the Caliper module as follows:

Caliper::init("SOME_API_KEY");

You only need to call init once when your php file is requested. All of your files will then have access to the same Caliper client.

©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
For license information contact, info@imsglobal.org

