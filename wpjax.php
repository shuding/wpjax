<?php
/*
Plugin Name: wpjax
Plugin URI: http://quietgalaxy.me/tech
Description: A WordPress jQuery.Pjax plugin.
Version: 0.3
Author: Ding Shu
Author URI: http://quietgalaxy.me
License: GPL2
*/
/*
Copyright 2013  Ding Shu  (email : ds303077135@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
	if (!class_exists("wpjquerypjax")) {
		class wpjquerypjax {
			function wpjquerypjax() {
				$default_options = array(
					"selector" => "header a",
					"container" => "#content",
					"cache" => "true",
					"storage" => "true",
					"timeout" => 20000,
					"pjax_start" => "$('#content').animate({opacity:'0'},500);",
					"pjax_end" => "$('#content').animate({opacity:'1'},500);"
				);
				add_option("pjax_options", $default_options, '', 'yes');
			}
			function add_header_code() {
			?>
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<?php
				wp_enqueue_script('script_slug',  plugins_url("jquery.pjax.js",__FILE__));
			}
			function add_footer_code() {	
				$options = get_option("pjax_options");
				_e("
					<script type='text/javascript'>
						jQuery(document).on('click', '".$options["selector"]."', function(e) {
							e.preventDefault();
							var nextUrl = jQuery(this).attr('href');
							jQuery.pjax({
								url: nextUrl,
								container: '".$options["container"]."',
								fragment: '".$options["container"]."',
								cache: ".$options["cache"].",
								storage: ".$options["storage"].",
								timeout:  ".$options["timeout"]."
							});
						});
						$('".$options["container"]."').on('pjax:start', function(){
							".$options["pjax_start"]."
						});
						$('".$options["container"]."').on('pjax:end', function(){
							".$options["pjax_end"]."
						});
					</script>
				\n");
			}
			function wpjax_menu() {
				add_options_page('wpjax settings', 'wpjax settings', 'manage_options', basename(__FILE__), array(&$this,'admin_options_page'));
			}
			function admin_options_page() {
				$res = null;
				$options = get_option("pjax_options");
				
				if (isset($_POST['sel']))
					$options["selector"] = htmlentities($_POST['sel']);
				if (isset($_POST['con']))
					$options["container"] = htmlentities($_POST['con']);
				if (isset($_POST['cac']))
					$options["cache"] = htmlentities($_POST['cac']);
				if (isset($_POST['sto']))
					$options["storage"] = htmlentities($_POST['sto']);
				if (isset($_POST['tim']))
					$options["timeout"] = htmlentities($_POST['tim']);
				if (isset($_POST['sta']))
					$options["pjax_start"] = stripslashes($_POST['sta']);
				if (isset($_POST['end']))
					$options["pjax_end"] = stripslashes($_POST['end']);
				
				if (isset($_POST['def']))
					$options = array(
						"selector" => "header a",
						"container" => "#content",
						"cache" => "true",
						"storage" => "true",
						"timeout" => 20000,
						"pjax_start" => "$('#content').animate({opacity:'0'},500);",
						"pjax_end" => "$('#content').animate({opacity:'1'},500);"
					);
				update_option("pjax_options", $options);
				
				?>
				<div style="font-family:'MS Sans Serif', Geneva, sans-serif">
				<div style="display:block;float:right;margin:10px 50px 0 0;border:1px solid #bdbdbd; padding:20px">
					<p>jQuery.Pjax on github: <a href="https://github.com/defunkt/jquery-pjax">defunkt/jquery-pjax</a></p>
					<p>Plugin author: <a href="http://quietgalaxy.me">Ding Shu</a></p>
					<p>Source in github: <a href="http://github.com/quietshu/wpjax">wpjax</a></p>
					<p>Readme: <a href="#">readme.txt</a></p>
					<p>Version: 0.3</p>
					<form action="" method="post">
						<input type="submit" id="res" name="def" value="default settings"/>
					</form>
				</div>
				<h1>wpjax settings</h1>
				<p>A WordPress jQuery.Pjax plugin.</p>
				<hr style="display:block;"/>
				<style>
					body{
						cursor: default;
					}
					input {
					    padding: 10px;
					    background: rgba(255,255,255,0.5);
					    margin: 0 0 10px 10px;
					    width: 200px;
					    display: block;
					    border-radius: 0;
					    box-shadow: 
					}
					input:hover {
						opacity: 0.9;
					}
					#res{
						border: none;
						padding: 10px;
						background: rgba(250, 51, 51, 1);
						color: rgb(255, 255, 255);
						width: 140px;
						display: block;
						margin: auto;
						left: 0;
						right: 0;
						margin-top: 20px;
						margin-bottom: 10px;
					}
					#sub{
						border: none;
						padding: 10px;
						background: rgba(53, 179, 42, 1);
						color: rgb(255, 255, 255);
						margin: 0 0 10px 10px;
						width: 140px;
						display: block;
					}
				</style>
				<form action="" method="post">
					<div style="display:inline-block;border-right: 1px dotted #B9B9B9;padding-right: 30px;">
						<h2>selector</h2>
							<input type="text" name="sel" value="<?php _e($options["selector"]) ?>"/>
						<h2>container</h2>
							<input type="text" name="con" value="<?php _e($options["container"]) ?>"/>
						<h2>cache</h2>
							<input type="text" name="cac" value="<?php _e($options["cache"]) ?>"/>
						<h2>storage</h2>
							<input type="text" name="sto" value="<?php _e($options["storage"]) ?>"/>
						<h2>timeout(ms)</h2>
							<input type="text" name="tim" value="<?php _e($options["timeout"]) ?>"/>
						<br/>
					</div>
					<div style="display:inline-block;vertical-align: top;margin-left: 30px;">
						<h2>pjax:start(javascript code)</h2>
							<textarea rows="9" cols="30" type="text" name="sta"><?php _e($options["pjax_start"]) ?></textarea>
						<h2>pjax:end(javascript code)</h2>
							<textarea rows="9" cols="30" type="text" name="end"><?php _e($options["pjax_end"]) ?></textarea>
					</div>
					<input type="submit" id="sub" value="update settings"/>
				</form>
				</div>
				<?php
			}
		}
	}
	if (class_exists("wpjquerypjax")) {
		$wpjax = new wpjquerypjax();
	}
	if (isset($wpjax)) {
		add_action('admin_menu', 	array(&$wpjax,'wpjax_menu'));
		add_action('wp_head', 		array(&$wpjax,'add_header_code'));
		add_action('wp_footer', 		array(&$wpjax,'add_footer_code'));
	}
?>