<?php

/**
 * Comment Walker
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

class Amble_Comment_Walker extends Walker_Comment
{

  protected function html5_comment($comment, $depth, $args)
  {
?>
    <div id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent' : ''); ?>>
      <div class="comment-body">
        <div class="comment-header">

          <?php
          if (0 != $args['avatar_size'] && get_option('show_avatars'))
            printf('<div class="comment-avatar">%s</div>', get_avatar($comment, $args['avatar_size']));
          ?>

          <div class="comment-meta">

            <?php printf('<div class="comment-author vcard">%s <span class="says screen-reader-text">%s</span></div>', sprintf('<span class="fn">%s</span>', get_comment_author_link()), esc_html__('says:', 'amble'));

            $by_post_author = amble_is_comment_by_post_author($comment);

            if ($by_post_author) {
              echo '<span class="by-postauthor">' . esc_html__('Post Author', 'amble') . '</span>';
            }
            ?>

            <time class="comment-time" datetime="<?php comment_time('c'); ?>"><?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'amble'), get_comment_date(), get_comment_time()); ?></time>
            <?php edit_comment_link(esc_html__('Edit', 'amble'), '<span class="edit-link comment-meta">', '</span>'); ?>
          </div>

        </div>

        <div class="comment-content">

          <?php comment_text();

          // Comment moderation
          if ('0' == $comment->comment_approved) : ?>
            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'amble'); ?></p>
          <?php endif; ?>

        </div><!-- .comment-content -->


      </div><!-- .comment-body -->

      <?php // Load comment reply
      comment_reply_link(array_merge($args, array(
        'add_below' => 'div-comment',
        'depth'     => $depth,
        'max_depth' => $args['max_depth'],
        'before'    => '<div class="comment-reply">',
        'after'     => '</div>'
      )));
      ?>


  <?php
  }
}
