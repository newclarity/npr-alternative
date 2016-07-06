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
4. More flexible, more robust, and easier to diagnose and debug coding errors vs. bugs or changes in the NPR API XML schema than the official plugin _(at least in our experience.)_

We think the above benefits result in a library that will be more robust and easier to debug meaning **less frustration with broken feeds** and **less time and money spent on diagnosing problems** than when using the official plugin.

###Regarding End-User Features
Even though we built this library primarily for PHP developers it should be easy and inexpensive to provide a **great end-user experience** on top of the robust core we have created.

##How to Use.

###For WordPress-specific Use

Clone this repository into your [`/mu-plugins/`](https://premium.wpmudev.org/manuals/wpmu-manual-2/using-mu-plugins/) directory, create a file in the same `/mu-plugins/` directory _(which we typically name)_ `mu-plugin-loader.php` and then include the following code _**being sure to use your own `api_key` and `org_id`:**_


    <?php 
    require __DIR__ . '/npr-alternative/npr-alt-wordpress.php';
    NprAlt::register_settings( array(
        'api_key' => '<Your NPR Digital Services issues API Key Goes Here>',
        'org_id'  => <Your Numeric OrgId goes here>,
    ));

For example:
   
    <?php 
    require __DIR__ . '/npr-alternative/npr-alt-wordpress.php';
    NprAlt_WordPress::register_settings( array(
        'api_key' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!',
        'org_id'  => 123,
    ));

Then to call the NPR API you can call the following somewhere in your code:
	
	$result = NprAlt_WordPress::process_api_queries();
	print_r( $result );
	
From there it is up to you. And that's it!

Of course if you want more features or need help, [**just ask**](#need-help).

###For General PHP Use

Simply clone this repository and require `npr-alternative.php`:

    require '/path/to/npr-alternative/npr-alternative.php';
    
You will likely also want to implement a _"driver"_ and you can find examples [**here**](https://github.com/newclarity/npr-alternative/tree/master/includes/Drivers).  Once you implement a driver you could set the driver as follows after first requiring `npr-alternative.php` as above:

    NprAlt::set_driver( new \YourNamespace\YourDriver() );

You will probably also want to create a child class of `NprAlt` for your implementation so that you can implement the `on_loaded` and `on_shutdown` callbacks. The code for these child classes will be platform specific; e.g. a WordPress support class is different from a potential Drupal support class from a potential Joomla support class, et. al.  Best we can do for your is to point you to our [**WordPress**](https://github.com/newclarity/npr-alternative/blob/master/includes/Drivers/WordPress.php) version as a inspiration and a bit of a guide.

Then to call the NPR API you can call the following somewhere in your code:
	
	$result = NprAlt_WordPress::process_api_queries();
	print_r( $result );
	
From there it is up to you. And that's it!

Of course if you want more features or need help, [**just ask**](#need-help).

##Why Build an Alternative?
Simply because the NPR Story API WordPress plugin did not meet our needs. Further we wanted a more robust solution so we would not have to spend as much time diagnosing unexplained issues with the content imported into WordPress.

##Current Status
This library is currently a work-in-progress regarding features and is being developed for the needs of our clients who are NPR affiliates.  

<a id="need-help"></a>
##Interested in More Features and/or Help Using It?
If you are interested in using this library/plugin but would like us to add sme new features, or you would simply like our help in using it please contact us via [info@newclarity.net](mailto:info@newclarity.net).

###Integration to Other PHP-based CMS or Framework?
We developed this library/plugin to be distinct from WordPress by adding a _"driver"_ model and even included a WordPress driver. Thus it should not be terribly difficult to integrate with another PHP CMS or Framework &mdash; such as Drupal, Joomla or Laravel  &mdash; by adding additional drivers to the library.

So if you are interested in using this library with a PHP-based CMS/Framework other than WordPress and would like help in doing so please contact us via [info@newclarity.net](mailto:info@newclarity.net).  


