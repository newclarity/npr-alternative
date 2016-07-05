# NPR Alternative Plugin for WordPress

This plugin is an alternative to the WordPress plugin [NPR Story API](https://wordpress.org/plugins/npr-story-api/) offered by NPR Digital Services.

##Benefits over Official Plugin?
We designed the NPR Alternative plugin to have these contrasts with the official plugin:

1. Works with PHP 5.6 [without throwing errors](https://github.com/nprds/nprapi-wordpress/pull/14)
3. Uses true object-oriented programming style
  - Including objects with declared properties _(Unlike this: 
  [!](https://github.com/nprds/nprapi-wordpress/blob/master/classes/NPRAPI.php#L283)
  [!](https://github.com/nprds/nprapi-wordpress/blob/master/classes/NPRAPI.php#L290)
  [!](https://github.com/nprds/nprapi-wordpress/blob/master/classes/NPRAPI.php#L11) 
  [!](https://github.com/nprds/nprapi-wordpress/blob/master/classes/NPRAPIWordpress.php#L12)
  )_ 
4. Leverages modern PHP programming best practices such as:
  - PHP [**Namespaces**](https://mattstauffer.co/blog/a-brief-introduction-to-php-namespacing)
  - **Class-based Architecture** 
      - Named classes and declared properties for each XML element 
      - But reslient to XML schema changes using PHP magic methods-based extra properties
  - A **Class Autoloader** _(though not a PSR-4 autoloader, to keep deployment simple)_
  - Support for [**Composer**](https://getcomposer.org/)
  
The above benefits result in a plugin that is more robust and easier to debug meaning **less frustration with broken feeds** and 
**less time and money spent on diagnosing problems.**

Want to see more? Just compare the code; I think even a non-programmer will appreciate the differnce in clarity:

- [Offical](https://github.com/nprds/nprapi-wordpress) vs.
- [NPR Alternative](https://github.com/newclarity/npr-alternative/#start-of-content)

Note that we designed NPR Alternative **more for PHP programmers than for end-users**, which means this plugin is more 
like a PHP library comprised of composable functionality than a single set of end-user features.

However a **better end-user experience** will be much easier _(and cheaper)_ to implement on top of the robust core we have created.

##Why Build an Alternative to the Official Plugin?
We built this plugin because it was taking too much time diagnosing problems with the official plugin and 
because at the time of choosing to develop this the team maintaining the official plugin [had not even 
commented on our pull requests](https://github.com/nprds/nprapi-wordpress/pulls/mikeschinkel) 
even though they fix still unfixed bugs in their code. 

##Current Status
It is currently a work-in-progress regarding features and is being developed for the needs of our clients who are NPR affiliates.  

##Interested in More Features and/or Help Using It?
If you are interested in using this plugin and would like help doing so, or would like us to add features, 
please contact us via [info@newclarity.net](mailto:info@newclarity.net).


