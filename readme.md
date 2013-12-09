I wrote wpjax about one week ago, it's a simple pjax plugin for WordPress.

**It's a beta version!!**

## Plugin Information & License
	Plugin Name: wpjax
	Plugin URI: http://quietgalaxy.me/tech
	Description: A WordPress jQuery.Pjax plugin.
	Version: 0.3
	Author: Shu Ding
	Author URI: http://quietgalaxy.me/world
	License: GPL2
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	
## What's pjax?
>pjax is a jQuery plugin that uses ajax and pushState to deliver a fast browsing experience with real permalinks, page titles, and a working back button.

>pjax works by grabbing html from your server via ajax and replacing the content of a container on your page with the ajax'd html. It then updates the browser's current url using pushState without reloading your page's layout or any resources (js, css), giving the appearance of a fast, full page load. But really it's just ajax and pushState.

From [defunkt/jquery-pjax](https://github.com/defunkt/jquery-pjax#pjax--pushstate--ajax)

So wpjax is the plugin which helps you use jQuery.pjax.js in your website more conveninetly.

##Before Using
You should know something about [jQuery selectors](http://www.w3schools.com/jquery/jquery_ref_selectors.asp).

## Installation
###Download wpjax
Via [github project page](https://github.com/quietshu/wpjax).

This `.zip` file contains

	.zip
	  |- jquery.pjax.js
	  |- readme.txt
	  |- wpjax.php
	  
### Upload it to WordPress
- Open WordPress admin page, choose **plugins** menu.
- Choose **install a plugin** and upload the `.zip` file.
- Enable it.

## Usage
In **settings > wpjax settings**:

### selector
The jQuery selector of the listenning DOM element(s), use `,` to divide several tags.

This DOM element(s) should be `a` tag in your menu bar, or your post title links.

Default: `.entry-title a`.

### container
Your target container.

It should be your content tag.

Default: `#content`.

###cache
It's a Html5 feature that can cache some of dynamic website page.

This form can be only `true` or `false`.

Default: `true`.

###storage
Storage the cache or not.

This form can be only `true` or `false`.

Default: `true`.

###timeout
Set a time limit that fail in loading pjax(ms).

Default: `20000`.

###pjax:start
The JavaScript code in the textarea below will execute when pjax start to load.

Default: `$('#content').animate({opacity:'0'},500);`.

###pjax:end
The JavaScript code in the textarea below will execute when pjax finish loading.

Default: `$('#content').animate({opacity:'1'},500);`.

##Screenshot

![image](http://quietshu.github.io/images/figure1.png)