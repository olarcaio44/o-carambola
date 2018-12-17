<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (esc_html__('Please do not load this page directly. Thanks!','anariel'));
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.','anariel'); ?></p>
	<?php
		return;
	}
function anariel_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
	<div class = "specificComment" id="comment-<?php comment_ID(); ?>">
	<div class="blogAuthor">
		<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_avatar($comment, 100); ?></a>
	</div>
	<div class = "right-part">
		<div class ="comment-meta">
			<span class="authorBlogName">	
				<?php echo anariel_security(get_comment_author_link()); ?>  
			</span>
			<span class = "commentsDate"> <?php printf('%1$s at %2$s', get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('(Edit)','anariel'),'  ','') ?>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</span>	
		</div>
		
		<div class="commenttext"><?php comment_text() ?></div>
	</div>
	
	<?php if ($comment->comment_approved == '0') : ?>
	 <em><?php esc_html_e('Your comment is awaiting moderation.','anariel'); ?></em>
	 <br />
	<?php endif; ?>
	 
	</div>
<?php
        }	
?>
<!-- You can start editing here. -->
	<?php 
		$no_comments = get_comments_number( $post->ID );
		$cancel_reply_link = esc_html__('Cancel Reply','anariel');  					
		$title_reply_to = esc_html__('Leave a Reply to','anariel'); 			
		$label_submit = esc_html__('Leave a Comment','anariel');  		
		$translation_comment_website = esc_html__('Website','anariel');  	
		$translation_comment_required = esc_html__('required','anariel');  
		$translation_comment_mail = esc_html__('Mail','anariel'); 	
		$translation_comment_name = esc_html__('Name','anariel');		
		$translation_comment_closed = esc_html__('Comments are closed.','anariel');		
	?>
	
<?php if ( have_comments() ) : ?>
	
	<ol class="commentlist">	
	<div class="titleborderOut">
		<div class="titleborder"></div>
	</div>
	<div class="post-comments-title">
		<h4 class="post-comments" id="comments"><?php comments_number(); ?></h4>	
	</div>
	
	<?php wp_list_comments('type=all&callback=anariel_comment'); ?>
	</ol>
	<div class="commentnav">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php echo esc_html($translation_comment_closed); ?></p>
	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<?php $aria_req = ''; $post_id = ''; $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<div class="commentfield">' .
                '<label for="author">' . $translation_comment_name . '' .
				( $req ? ' <small>('.$translation_comment_required .')</small>' : '' ) .
                '</label><br><input id="author" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '"  tabindex="1"' . $aria_req . ' />' .
                '</div>',
    'email'  => '<div class="commentfield">' .
                '<label for="email">' . $translation_comment_mail . '' .
                ( $req ? ' <small>('.$translation_comment_required .')</small>' : '' ) .
                '</label> <br><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" tabindex="2"' . $aria_req . ' />' .
                '</div>',
    'url'    => '<div class="commentfield">' .
                '<label for="url">' . $translation_comment_website . '</label>' .
                '<br><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  tabindex="3" />' .
                '</div>' ) ),
    'comment_field' => '' .
                '<div>' .
                '<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>' .
                '</div>',
    'must_log_in' => '',
    'logged_in_as' => '
<p class="logged-in-as">' . sprintf(  wp_kses( __('Logged in as <a href="%s">%s</a>. <a title="Log out of this account" href="%s">Log out?</a>
' ,'anariel'), array(  'a' => array( 'href' => array() ) ) ) .'</p>', esc_url(admin_url( 'profile.php' )), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ),
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'id_form' => 'commentform',
    'id_submit' => 'submit',
    'title_reply' => '',
    'title_reply_to' => $title_reply_to,
    'cancel_reply_link' => $cancel_reply_link,
    'label_submit' => $label_submit,
	
	
); ?>
<div id="commentform">
<div class="titleborderOut">
		<div class="titleborder"></div>
	</div>
<div class="post-comments-title">
	<h4 class="post-comments"><?php echo esc_html($label_submit) ?></h4>
</div>
<?php comment_form($defaults); ?>

</div>
<?php endif; // if you delete this the sky will fall on your head ?>
