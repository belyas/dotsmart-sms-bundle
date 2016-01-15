DotSmartSmsBundle
=====================

Integration of the [**Dot Smart Sms**](http://www.dot-smart.com/documentations/sms/) into Symfony2.


Installation
------------

Require [`dotsmart/sms-bundle`](https://packagist.org/packages/dotsmart-sms-bundle)
to your `composer.json` file:


```json
{
    "require": {
        "dotsmart/sms-bundle": "dev-master"
    }
}
```

Register the bundle in `app/AppKernel.php`:

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new DotSmart\SmsBundle\DotSmartSmsBundle(),
        );
    }


Configuration
-------------

Enable the bundle's configuration in `app/config/config.yml`:

``` yaml
# app/config/config.yml
dot_smart_sms:
    reference: ~
    key: ~ 
    senderid: YASSINE
```

the `reference` section is required and therefor must be set, otherwise you will get an error

the `key` section is required and therefor must be set, otherwise you will get an error

the `senderid` section is required and therefor must be set, otherwise you will get an error


Routing
-------------

Enable the bundle's routing in app/config/routing.yml:

``` yaml
# app/config/routing.yml
dot_smart_sms:
    resource: "@DotSmartSmsBundle/Controller/"
    type:     annotation
```


Simple Test Controller
-----------------------

You can test sending sms throught the controller which contains two methods:

**indexAction**: shows a list of sent sms ( /sms/list )

**sendSmsAction**: here you can send a sms with a simple form ( /sms/send )


Usage
-----

This bundle registers a `dot_smart_sms.send_sms` service which is an instance
of `SenderFactory`. You'll be able to do whatever you want with it but be sure to
configure at least **reference**, **key** and a **senderid** in order to start sending sms.

Here is an example:

```php
<?php

public function sendSmsAction()
{
    $smsSenderService = $this->get('dot_smart_sms.send_sms');
    $result = $smsSenderService->send(array(
        'numbers' => '12345678902',
        'message' => 'Hello world',
        'designation' => 'Something here',
    ));

    return Response($result);
}
```

The **result** variable returned by the service contains all information you need that were returned by the platform.


Reference Configuration
-----------------------

You MUST define the three first sections: reference, key and senderid in other to send sms, all other sections are handled by the bundle if they are not set. 

You'll find the reference configuration below:

``` yaml
# app/config/config.yml
dot_smart_sms:
    reference: ~
    key: ~ 
    senderid: YASSINE
    myid: ~
    date: ~
    time: ~
    life: ~
    format: ~ # by default is json, you can either set json or array
```
for further instructions about its parameters, have a look at [**Dot Smart Sms**](http://www.dot-smart.com/documentations/sms/les-api-soap-php/)