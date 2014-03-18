WebFactoryExceptionsBundle
==========================

[![Build Status](https://travis-ci.org/webfactory/exceptions-bundle.png?branch=master)](https://travis-ci.org/webfactory/exceptions-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/webfactory/exceptions-bundle/badges/quality-score.png?s=1fffd149d27d559a98d2593827453445d9d31995)](https://scrutinizer-ci.com/g/webfactory/exceptions-bundle/)

A bundle to easily develop your custom, user-friendly Symfony error pages.
Why? Because you normally need to go into the ``prod`` app of Symfony (i.e. ``app.php``)
in order to see the user-facing error templates. But this makes developing
these hard: you need to clear your cache manually after each change and if
you make a mistake, you won't see the error easily.

This bundle allows you to easily see the different user-facing error templates
for each status code in the dev environment, so you can easily design them.

For the original blog post that inspired this, see
http://inside.webfactory.de/de/blog/symfony2-exception-handling-and-custom-error-pages-explained.html

Now enjoy these friendly [installation](#installation) steps and then see
[usage details](#usage).

Installation
------------

### Step 1) Get the bundle via Composer

Add the following to composer.json (see http://getcomposer.org/):

    "require-dev" :  {
        // ...
        "webfactory/exceptions-bundle": "@stable"
    }

If you don't have a `require-dev` key in your `composer.json` file, just
add one! You can alternatively add this to your `require` key and things
will work just fine. Confused about the difference? See:
[GetComposer.org: require-dev](https://getcomposer.org/doc/04-schema.md#require-dev).

### Step 2) Enable the bundle in `app/AppKernel.php`:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    // ...
    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        $bundles[] = new Webfactory\Bundle\ExceptionsBundle\WebfactoryExceptionsBundle();
    }
    // ...
}
```

### Step 3) Import the routing into `app/config/routing_dev.yml`:

```yaml
# app/config/routing_dev.yml
webfactory_exceptions:
    resource: "@WebfactoryExceptionsBundle/Resources/config/routing.yml"
```

You rock! Now let's design some error pages!

Usage
-----

Symfony supports different error pages for each HTTP status code. For details
on how to create the different error templates, follow the
[way outlined in Symfony's official cookbook](http://symfony.com/doc/current/cookbook/controller/error_pages.html#customizing-the-404-page-and-other-error-pages).

Suppose you've just created an ``error404.html.twig`` template like described
in the cookbook entry. To view your error page, go to:

    http://localhost/app_dev.php/_error/404

(of course, change ``http://localhost`` to the local URL of your app. In
fact, you can see the error page for any HTTP status code in any format,
thanks to the URL that this bundle gives you:

    /_error/{statuscode}/{format}

Happy error-styling!
