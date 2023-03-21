/* global wp, jQuery */
/**
 * File customizer.js.
 * Theme Customizer enhancements for a better user experience.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function($) {
  var api = wp.customize,
    $head = $("head");

  /* HEX to RGBA functions
  ==================================================== */

  function hexToRgba(hex, opacity) {
    var red = parseInt(hex.substring(1, 3), 16),
      green = parseInt(hex.substring(3, 5), 16),
      blue = parseInt(hex.substring(5, 7), 16);

    return "rgba( " + red + ", " + green + ", " + blue + ", " + opacity + " )";
  }

  /* SHOW AND HIDE functions
  ==================================================== */
  function hideElement(element) {
    $(element).css({
      clip: "rect(1px, 1px, 1px, 1px)",
      position: "absolute",
      width: "1px",
      height: "1px",
      overflow: "hidden"
    });
  }

  function showElement(element) {
    $(element).css({
      clip: "auto",
      position: "relative",
      width: "auto",
      height: "auto",
      overflow: "visible"
    });
  }

  /* TEXT PREVIEWS
  ==================================================== */

  // Blog Title
  api("blogname", function(value) {
    value.bind(function(to) {
      $(".site-title a").text(to);
    });
  });

  // Tagline
  api("tagline", function(value) {
    value.bind(function(to) {
      $(".tagline").html(to);
    });
  });

  // Copyright
  api("amble_copyright", function(value) {
    value.bind(function(newval) {
      $(".copyright-name").html(newval);
    });
  });

  // Back to top text
  api("amble_back_to_top_text", function(value) {
    value.bind(function(newval) {
      $("#back-to-top").html(newval);
    });
  });

  /* SHOW OR HIDE
  ==================================================== */
  // Hide site title
  api("amble_hide_site_title", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement(".site-title");
      } else {
        hideElement(".site-title");
      }
    });
  });

  // Hide site description
  api("amble_hide_tagline", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement(".site-description");
      } else {
        hideElement(".site-description");
      }
    });
  });

  // Hide archiver prefix
  api("amble_hide_prefix_archive", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement(".archive-prefix");
      } else {
        hideElement(".archive-prefix");
      }
    });
  });

  // Page headings transform
  api("amble_hide_widget_border", function(value) {
    value.bind(function(to) {
      var style = $("#custom-hide-widget-title-border-css");
      style.remove();
      style = $(
        '<style type="text/css" id="#custom-hide-widget-title-border-css">.blog-sidebar .widget-title, .left-sidebar .widget-title, .right-sidebar .widget-title, .bottom-sidebar .widget-title { border:none;' +
          to +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Search Modal
  api("amble_hide_search_modal", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        hideElement(".searchModal-btn");
        hideElement("#searchModal");
      } else {
        showElement(".searchModal-btn");
        showElement("#searchModal");
      }
    });
  });

  // Hide banner captions
  api("amble_hide_banner_caption", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement("#banner-sidebar .wp-caption-text");
      } else {
        hideElement("#banner-sidebar .wp-caption-text");
      }
    });
  });

  // Hide post bio
  api("amble_hide_author_bio", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement(".post-author-info");
      } else {
        hideElement(".post-author-info");
      }
    });
  });

  // Hide post navigation
  api("amble_hide_post_navigation", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement(".navigation.post-navigation");
      } else {
        hideElement(".navigation.post-navigation");
      }
    });
  });

  // Hide back to top
  api("amble_hide_backtotop", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement("#back-to-top-wrapper");
      } else {
        hideElement("#back-to-top-wrapper");
      }
    });
  });




  /* SIZING
  ==================================================== */

  // Logo size
  api("amble_logo_width", function(value) {
    value.bind(function(to) {
      $(".custom-logo").css("width", parseFloat(to) + "px");
    });
  });

  // Site title size
  api("site_title_font_size", function(value) {
    value.bind(function(to) {
      $(".site-title").css("font-size", parseFloat(to) + "rem");
    });
  });

  /* COLOUR
  ==================================================== */

  // Site title colour
  api("amble_site_title_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-site-title-color-css"),
        css = "color: " + to;

      style.remove();
      style = $(
        '<style type="text/css" id="custom-site-title-color-css"> .site-title a { ' +
          css +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Site tagline colour
  api("amble_tagline_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-tagline-color-css"),
        css = "color: " + to;

      style.remove();
      style = $(
        '<style type="text/css" id="custom-tagline-color-css"> .site-description { ' +
          css +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Banner caption colour
  api("amble_banner_caption", function(value) {
    value.bind(function(to) {
      var style = $("#custom-banner-caption-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-banner-caption-colour-css">#banner-sidebar .wp-caption-text { background-color:' +
          hexToRgba(to, 0.7) +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Content background
  api("amble_content_bg_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-content-area-background-color-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-content-area-background-color-css"> .grid-container, .navbar, .navbar li>ul { background-color:' +
          to +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Body text colour
  api("amble_content_area_text_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-content-area-text-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-content-area-text-colour-css">body { color:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Headings colour
  api("amble_headings_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-headings-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-headings-colour-css">h2.entry-title, .entry-title a, .page-title, h1, h2, h3, h4, h5, h6 { color:' +
          to +
          " } h1 a:focus,  h2 a:focus,  h3 a:focus,  h4 a:focus,  h5 a:focus,  h6 a:focus, h1 a:hover,  h2 a:hover,  h3 a:hover,  h4 a:hover,  h5 a:hover, h6 a:hover { color:" +
          hexToRgba(to, 0.8) +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Content links
  api("amble_content_links", function(value) {
    value.bind(function(to) {
      var style = $("#custom-content-links-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-content-links-colour-css"> a, a:visited { color:' +
          to +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Image caption bg colour
  api("amble_image_bg_caption", function(value) {
    value.bind(function(to) {
      var style = $("#custom-image-caption-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-image-caption-colour-css">#banner-sidebar .wp-caption-text, .featured-media .wp-caption-text { background-color:' +
          hexToRgba(to, 0.8) +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Banner caption text colour
  api("amble_caption_text_color", function(value) {
    value.bind(function(to) {
      var style = $("#custom-caption-text-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-caption-text-colour-css"> #banner-sidebar .wp-caption-text, .featured-media .wp-caption-text { color:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Bottom sidebar background
  api("amble_bottom_sidebar_bg", function(value) {
    value.bind(function(to) {
      var style = $("#custom-bottom-sidebar-bg-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-bottom-sidebar-bg-css"> .bottom-sidebar { background:' +
          to +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Bottom sidebar text
  api("amble_bottom_sidebar_text", function(value) {
    value.bind(function(to) {
      var style = $("#custom-bottom-sidebar-text-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-bottom-sidebar-text-css">.bottom-sidebar, .bottom-sidebar .widget-title, .bottom-sidebar a { color:' +
          hexToRgba(to, 1) +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Widget Title Line
  api("amble_bottom_widget_title_line", function(value) {
    value.bind(function(to) {
      var style = $("#custom-bottom-widget-title-line-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-bottom-widget-title-line-css">.bottom-sidebar .widget-title { border-color:' +
          hexToRgba(to, 1) +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Widget Title Line
  api("amble_widget_title_line", function(value) {
    value.bind(function(to) {
      var style = $("#custom-widget-title-line-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-widget-title-line-css"> .blog-sidebar .widget-title, .left-sidebar .widget-title, .right-sidebar .widget-title, .bottom-sidebar .widget-title { border-color:' +
          hexToRgba(to, 1) +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Search icon bg
  api("amble_search_icon_bg", function(value) {
    value.bind(function(to) {
      var style = $("#custom-search-icon-bg-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-search-icon-bg-css"> .searchModal-btn { background:' +
          hexToRgba(to, 1) +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Footer bg
  api("amble_footer_bg", function(value) {
    value.bind(function(to) {
      var style = $("#custom-footer-bg-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-footer-bg-css"> .site-footer, #back-to-top-wrapper { background:' +
          hexToRgba(to, 1) +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Footer text
  api("amble_footer_text", function(value) {
    value.bind(function(to) {
      var style = $("#custom-footer-text-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-footer-text-css"> .site-footer, .site-footer a, .site-footer a:visited { color:' +
          hexToRgba(to, 0.8) +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Primary menu link colour
  api("amble_nav_link_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-nav-link-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-nav-link-colour-css"> :root { --amble-navbar-link:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });
})(jQuery);
