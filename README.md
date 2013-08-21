**THIS IS NOT READY FOR PRODUCTION USE**

[![Build Status](https://travis-ci.org/VeggieMeat/php-taxcloud.png?branch=master)](https://travis-ci.org/VeggieMeat/php-taxcloud)

At this point, most of the functionality needed to complete an order has been
implemented. A few things are still left, including Tax Exemptions and Return
processing.

A smoketest is provided that connects to the TaxCloud API using credentials
stored in environment variables. It is intended for quick tests to ensure that
the core of the library works, but it is not a thorough test. **DO NOT RUN THE
SMOKETEST WITH CREDENTIALS FOR A LIVE SITE. IT WILL CREATE TRANSACTIONS.**

The smoketest also provides an excellent set of examples on how to use this
library.

A "stable" release will be considered when tests cover 90% or more of code,
though 100% coverage is the target.
