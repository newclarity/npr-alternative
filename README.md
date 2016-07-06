# NPR Alternative 

NPR Alternative is a **PHP-based library** and an included **WordPress Plugin** developed to be an alternative to the [NPR Story API](https://wordpress.org/plugins/npr-story-api/) WordPress plugin offered by [NPR Digital Services](http://digitalservices.npr.org/).

##Benefits over Official Plugin?
We designed the NPR Alternative plugin to have these contrasts with the official plugin:

1. Designed for PHP programmers _(vs. WordPress end-users or site builders)_ 
2. Leverages modern PHP programming best practices such as:
  - Works with PHP 5.6
  - Uses PHP [**Namespaces**](https://mattstauffer.co/blog/a-brief-introduction-to-php-namespacing) _(for most classes, but not all)_
  - Provides an **Class Autoloader** _(though not a PSR-4 autoloader, to keep deployment simple)_
  - Supports [**Composer**](https://getcomposer.org/) for PHP
3. Uses True Object-oriented Programming Style
  - **Class-based Architecture** with named classes and declared properties for each XML element 
  - Reslient to XML schema changes using PHP magic methods-based extra properties
4. More flexible, more robust, and easier to diagnose and debug coding errors (vs. changes in the NPR API than the official plugin _(at least in our experience.)_

We think the above benefits result in a library that will be more robust and easier to debug meaning **less frustration with broken feeds** and **less time and money spent on diagnosing problems** than when using the official plugin.

###Regarding End-User Features
Even though we built this library primarily for PHP developers it should be easy and inexpensive to provide a **great end-user experience** on top of the robust core we have created.

##Why Build an Alternative?
Simply because the NPR Story API WordPress plugin did not meet our needs. Further we wanted a more robust solution so we would not have to spend as much time diagnosing unexplained issues with the content imported into WordPress.

##Current Status
This library is currently a work-in-progress regarding features and is being developed for the needs of our clients who are NPR affiliates.  

##Interested in More Features and/or Help Using It?
If you are interested in using this library/plugin but would like us to add sme new features, or you would simply like our help in using it please contact us via [info@newclarity.net](mailto:info@newclarity.net).

###Integration to Other PHP-based CMS or Framework?
We developed this library/plugin to be distinct from WordPress by adding a _"driver"_ model and even included a WordPress driver. Thus it should not be terribly difficult to integrate with another PHP CMS or Framework &mdash; such as Drupal, Joomla or Laravel  &mdash; by adding additional drivers to the library.

So if you are interested in using this library with a PHP-based CMS/Framework other than WordPress and would like help in doing so please contact us via [info@newclarity.net](mailto:info@newclarity.net).  


