# Jubatus PHP Client

Jubatus is a distributed processing framework and streaming machine learning library.
This is a PHP 5.3+ unofficial client for Jubatus.

## Requirements

This library requires the messagepack PHP extension.
Additionally you will need the msgpackrpc package available via composer (see below)

## Compatibility

This library has been tested with jubatus 0.6.4

## Installation

- Install msgpack PHP extension ([instructions](http://wiki.msgpack.org/display/MSGPACK/QuickStart+for+PHP))
- Add this library as a dependency in your project using composer : `composer require epokmedia/jubatus`

## Usage

TBD
You can look at the tests for example usage.

### Test

- Install PHPUnit

```
$ wget https://phar.phpunit.de/phpunit.phar
$ chmod +x ./phpunit.phar
$ ./phpunit.phar --version
PHPUnit 4.3.4 by Sebastian Bergmann.

$ php composer.phar update --dev
```

- ClassifierClientTest

```
term1$ jubaclassifier -f test/resources/config_classifier.json
term2$  ./phpunit.phar --bootstrap test/Bootstrap.php test/EpkmTest/Jubatus/ClassifierClientTest.php
PHPUnit 4.3.4 by Sebastian Bergmann.

.......

Time: 2.98 seconds, Memory: 3.75Mb

OK (7 tests, 29 assertions)
```


## TODO

- Stat and Graph clients
- Optimization and cleanup

## Licence

Copyright (c) 2013 EPOKMEDIA SARL

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
