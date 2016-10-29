<?php
/*
Plugin Name: Bottom of every post
Plugin URI: http://www.tacticaltechnique.com/wordpress/bottom-of-every-post/
Description: Add some content to the bottom of each post.
Version: 1.0.2
Author: Corey Salzano
Author URI: http://profiles.wordpress.org/users/salzano/
License: GPL2
*/


/*
	avoid a name collision, make sure this function is not
	already defined */

if( !function_exists("bottom_of_every_post")){
	function bottom_of_every_post($content){

	/*	there is a text file in the same directory as this script */

		$fileName = dirname(__FILE__) ."/bottom_of_every_post.txt";

	/*	we want to change `the_content` of posts, not pages
		and the text file must exist for this to work */

		if( !is_page( ) && file_exists( $fileName )){

		/*	open the text file and read its contents */

			$theFile = fopen( $fileName, "r");
			$msg = fread( $theFile, filesize( $fileName ));
			fclose( $theFile );
			
			/* detect the old message in code to try and eradicate my name and #
			showing up on strange websites that are run by lazy people */
			
			if( $msg == "<p>Call for an estimate 724-498-1551<br><a href=\"mailto:corey.salzano@gmail.com\">corey.salzano@gmail.com</a></p>" ){
				$msg = "<p>Thank you for installing the Bottom of every post WordPress plugin. To find out how to change or remove this message, read <a href=\"http://wordpress.org/extend/plugins/bottom-of-every-post/installation/\">the instructions</a>.</p>";
			}

		/*	append the text file contents to the end of `the_content` */
			return $content . stripslashes( $msg );
		} else{

		/*	if `the_content` belongs to a page or our file is missing
			the result of this filter is no change to `the_content` */

			return $content;
		}
	}

	/*	add our filter function to the hook */

	add_filter('the_content', 'bottom_of_every_post');
}

?>