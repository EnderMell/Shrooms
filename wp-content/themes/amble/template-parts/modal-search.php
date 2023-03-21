<?php

/**
 * Displays the search form in a modal
 * @package Amble
 * @since 2.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
?>


<div id="searchModal" class="modal fade" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="searchModalLabel"><?php esc_html_e('Search', 'amble'); ?></h3>
        <button type="button" class="searchModal-close-x" data-bs-dismiss="modal" aria-label="Close"><?php amble_theme_svg('close'); ?></button>
      </div>
      <div class="modal-body">
        <?php get_search_form(); ?>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>