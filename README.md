WebfactoryExceptionsBundle
==========================

[![Build Status](https://travis-ci.org/webfactory/exceptions-bundle.png?branch=master)](https://travis-ci.org/webfactory/exceptions-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/webfactory/exceptions-bundle/badges/quality-score.png?s=1fffd149d27d559a98d2593827453445d9d31995)](https://scrutinizer-ci.com/g/webfactory/exceptions-bundle/)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c381412c-205d-41a1-b74f-7e7897a33abe/mini.png)](https://insight.sensiolabs.com/projects/c381412c-205d-41a1-b74f-7e7897a33abe)

A bundle to simplify development of your custom, user-friendly Symfony error pages.

_Why?_

By default, you would need to switch `kernel.debug` to `false` (most probably by using the ``app.php`` front controller and/or using the `prod` environment) in order to see the user-facing error pages. But this also requires you to clear the template cache every time you make a change to your error page template. Additionally, you won't get helpful error messages in case something goes wrong.

This bundle provides a simple way to view error pages for different HTTP status codes also in `kernel.debug` mode, so you can easily design them. It also contains some building blocks to help you get the job done.

Follow the [installation steps](#installation), [view your error pages](#view-your-error-pages) in action and then learn about the [predefined Twig blocks](#predefined-twig-blocks) for more user-friendly error pages.

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

View Your Error Pages
---------------------

Suppose you've just created an ``error404.html.twig`` template like described
in the cookbook entry. To view your error page, go to:

    http://localhost/app_dev.php/_error/404

Of course, change ``http://localhost`` to the local URL of your app. In
fact, you can see the error page for any HTTP status code in any format,
thanks to the URL that this bundle gives you:

    /_error/{statuscode}/{format}
Predefined Twig Blocks
----------------------

Do you know the Symfony Cookbook section
[Customizing the 404 Page and other Error Pages](http://symfony.com/doc/current/cookbook/controller/error_pages.html#customizing-the-404-page-and-other-error-pages)?
Great! Then you know you should place your custom error page templates in `app/Resources/TwigBundle/views/Exception/errorX.html.twig`
and how Symfony determines which template to use. What you probably don't know: the WebFactoryExceptionsBundle features
some Twig blocks we find useful to a) develop error pages swiftly and b) get helpful, user friendly error pages.

Let's say your generic error page extends the base layout of MyWebsiteBundle. Then you may want to have your
`error.html.twig` to look something like this:

    {# error.html.twig #}
    {% extends 'MyWebsiteBundle:Layout:base.html.twig' %}

    {% block myMainContentContainer %}
        {{ block('webfactory_exceptions_standardExceptionPage') }}
    {% endblock %}

The `webfactory_exceptions_standardExceptionPage` block has headings, the translated exception description and provides
the user with a list of alternatives what they can do next: get back (simulating a browser back), get to the homepage,
get to the contact page or google the domain. It may look like this:

![Sample rendering of the webfactory_exceptions_standardExceptionPage block](Resources/doc/images/webfactory_exceptions_standardExceptionPage-example.png)

### Links to homepage and contact page

A default block in the bundle provides a link to the homepage with the default target `/`. If your application does not
start at `/`, you need to set the variable `homepageUrl`.

Also, you may want to set the variable `contactUrl` to get a link to your contact page in the listed alternatives.

    {# error.html.twig #}
    {% extends 'MeineWebsiteBundle:Layout:base.html.twig' %}

    {% set homepageUrl = "http://www.webfactory.de" %}
    {% set contactUrl = path('name_of_a_route') %}

    {# your blocks and definitions... #}

### Filling in blocks of base layouts

If your base layout already features blocks you need to fill with exception specific content, you can do it this way:

    {# error.html.twig #}
    {% extends 'MyWebsiteBundle:Layout:base.html.twig' %}

    {% use "WebfactoryExceptionsBundle:Exception:blocks.html.twig" with
            webfactory_exceptions_error_title as title,
            webfactory_exceptions_error_headline as stage_headline
    %}

This loads the `webfactory_exceptions_error_title` block *directly* into the `title` block of your base layout, as well
as the `webfactory_exceptions_error_headline` block into the `stage_headline` block.



Happy error-styling!

Credits, Copyright and License
------------------------------

This bundle was started at webfactory GmbH, Bonn. It was inspired by the blog post [How Symfony2 turns exceptions into error pages and how to customize those](http://inside.webfactory.de/de/blog/symfony2-exception-handling-and-custom-error-pages-explained.html).

- <http://www.webfactory.de>
- <http://twitter.com/webfactory>

Copyright 2012-2014 webfactory GmbH, Bonn. Code released under [the MIT license](LICENSE).
