<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package calluna
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( 'Comments (%1$s)', get_comments_number(), 'calluna-td' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'calluna-td' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'calluna-td' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'calluna-td' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				//custom comments output is defined in template-tags.php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'callback'   => 'calluna_custom_comments'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'calluna-td' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'calluna-td' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'calluna-td' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'calluna-td' ); ?></p>
	<?php endif; ?>
	
    <?php 
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$required_text = sprintf( ' ' . wp_kses(__('Required fields are marked %s', 'calluna-td'), array( 'span' => array( 'class' => array() ) ) ), '<span class="required">*</span>' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields =  array(
			'author' => '<div class="row"><div class="col-xs-12 col-sm-6"><div class="comment-form-author form-group">' . '<label for="author">' . esc_html__( 'Name', 'calluna-td' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
			'email'  => '<div class="col-xs-12 col-sm-6"><div class="comment-form-email form-group"><label for="email">' . esc_html__( 'Email', 'calluna-td' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div></div>',
			'url'    => '<div class="row"><div class="col-xs-12"><div class="comment-form-url form-group"><label for="url">' . esc_html__( 'Website', 'calluna-td' ) . '</label>' .
        '<input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div></div>',
		);
		 
		$comments_args = array(
			'fields' =>  $fields,
			'comment_notes_after' => '',
			'must_log_in' => '<div class="row"><div class="col-xs-12"><p class="must-log-in">' .  sprintf( wp_kses(__( 'You must be <a href="%s">logged in</a> to post a comment.', 'calluna-td' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ) . '</p></div></div>',
			'logged_in_as' => '<div class="row"><div class="col-xs-12"><p class="logged-in-as">' . sprintf( wp_kses(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'calluna-td' ),array(  'a' => array( 'href' => array() ) ) ) , esc_url( admin_url( 'profile.php' ) ), $user_identity, esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ) . '</p></div></div>',
			'comment_field' =>  '<div class="row"><div class="col-xs-12"><div class="comment-form-comment form-group"><label for="comment">' . esc_html_x( 'Comment', 'noun', 'calluna-td' ) .
    '</label><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true">' .
    '</textarea></div></div></div>',
			'comment_notes_before' => '<div class="row"><div class="col-xs-12"><p class="comment-notes">' .
    esc_html__( 'Your email address will not be published.', 'calluna-td' ) . ( $req ? $required_text : '' ) .
    '</p></div></div>',
		);
 		
		?>
		<?php
                ob_start(); 
                comment_form($comments_args);
                $form = ob_get_clean();
                $button_style = 'class="btn btn-primary ' . get_theme_mod('button_style', 'style-1') . '"';
                echo str_replace('id="submit" class="submit"',$button_style, $form);
                
            ?>

</div><!-- #comments -->
