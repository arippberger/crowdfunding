<?php
/**
 * Updates
 */

class ATCF_Comment_Updates {
	/**
	 *
	 *
	 * @since Astoundify Crowdfunding 1.7
	 */
	public function __construct() {
		add_filter( 'preprocess_comment', array( $this, 'submit_comment_type' ) );
		add_filter( 'cancel_comment_reply_link', array( $this, 'cancel_comment_reply_link' ), 10, 2 );
	}

	/**
	 *
	 *
	 * @since Astoundify Crowdfunding 1.7
	 *
	 * @return $updates
	 */
	public static function get_updates() {
		global $post;

		if ( ! $post )
			return;

		$updates = get_comments( array(
			'post_id' => $post->ID,
			'order'   => 'ASC',
			'type'    => 'atcf_campaign_update'
		) );

		return $updates;
	}

	/**
	 *
	 *
	 * @since Astoundify Crowdfunding 1.7
	 *
	 * @return $commentdata
	 */
	public function submit_comment_type( $commentdata ) {
		$post_id = $commentdata[ 'comment_post_ID' ];

		if ( 'download' != get_post_type( $post_id ) )
			return $commentdata;

		$commentdata[ 'comment_type' ] = 'atcf_campaign_update';

		return $commentdata;
	}

	/**
	 *
	 *
	 * @since Astoundify Crowdfunding 1.7
	 *
	 * @return mixed
	 */
	public function cancel_comment_reply_link( $link, $text ) {
		global $post;

		if ( 'download' != get_post_type( $post->ID ) )
			return $link;

		return '';
	}
}

new ATCF_Comment_Updates;