<?php
$language                   = get_bloginfo('language');
$charset                    = get_bloginfo('charset');
$name                       = get_bloginfo('name');
$lecsp_title                = get_option('lecsp_title');
$lecsp_robots_meta          = get_option('lecsp_robots_meta');
$lecsp_heading              = get_option('lecsp_heading');
$lecsp_heading_text_color   = get_option('lecsp_heading_text_color');
$lecsp_coming_soon_text     = get_option('lecsp_coming_soon_text');
$lecsp_show_social_media    = get_option('lecsp_show_social_media');
/*-----Social link-------*/
$lecsp_fb_link              = get_option('lecsp_fb_link');
$lecsp_twiiter_link         = get_option('lecsp_twiiter_link');
$lecsp_insta_link           = get_option('lecsp_insta_link');
$lecsp_pinterest_link       = get_option('lecsp_pinterest_link');
$lecsp_google_link          = get_option('lecsp_google_link');
$lecsp_linkedin_link        = get_option('lecsp_linkedin_link');
$attachment_id              = get_option('body_background_image');
$image_attributes           = wp_get_attachment_image_src($attachment_id, 'full');
?>
<!DOCTYPE html>
<html lang="<?php echo $language; ?>">

<head>
    <meta charset="<?php echo $charset; ?>" />
    <meta name="viewport" content="width=device-width">
    <?php if ($lecsp_robots_meta) { ?>
        <meta name="robots" CONTENT="<?php echo $lecsp_robots_meta; ?>">
    <?php } ?>
    <title><?php echo $lecsp_title; ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="<?php echo esc_url(lecsp_plugin_url . '/css/lecsp-style.css'); ?>" type="text/css" media="all" />
</head>

<body style="background-image:url(<?php echo esc_url($image_attributes[0]); ?>);background-position: center top;
background-size: cover; position: relative;">
    <div id="header">
        <h2>
            <a title="<?php echo esc_attr($name); ?>" href="<?php echo esc_url(site_url()); ?>"><?php echo esc_html($name); ?></a>
        </h2>
    </div>
    <div id="content">
        <?php if ($lecsp_heading) { ?>
            <h1 style="color:<?php echo $lecsp_heading_text_color['button_color']; ?>"><?php echo $lecsp_heading; ?></h1>
        <?php } ?>
        <?php if ($lecsp_coming_soon_text) { ?>
            <p><?php echo $lecsp_coming_soon_text; ?></p>
        <?php } ?>
        <?php if ($lecsp_show_social_media['lecsp_show_social_media'] == 'yes') { ?>
            <ul class="social">
                <?php if ($lecsp_fb_link) { ?>
                    <li>
                        <a href="<?php echo esc_url($lecsp_fb_link); ?>" target="_blank">
                            <img src="<?php echo esc_url(lecsp_plugin_url . '/assets/images/fb.png'); ?>" alt="<?php esc_attr_e('Facebook', 'lecsp-coming-soon-page'); ?>">
                        </a>
                    </li>
                <?php } ?>
                <?php if ($lecsp_twiiter_link) { ?>
                    <li>
                        <a href="<?php echo esc_url($lecsp_twiiter_link); ?>" target="_blank">
                            <img src="<?php echo esc_url(lecsp_plugin_url . '/assets/images/tw.png'); ?>">
                        </a>
                    </li>
                <?php } ?>
                <?php if ($lecsp_insta_link) { ?>
                    <li>
                        <a href="<?php echo esc_url($lecsp_insta_link); ?>" target="_blank">
                            <img src="<?php echo esc_url(lecsp_plugin_url . '/assets/images/insta.png'); ?>">
                        </a>
                    </li>
                <?php } ?>
                <?php if ($lecsp_pinterest_link) { ?>
                    <li>
                        <a href="<?php echo esc_url($lecsp_pinterest_link); ?>" target="_blank">
                            <img src="<?php echo esc_url(lecsp_plugin_url . '/assets/images/pin.png'); ?>">
                        </a>
                    </li>
                <?php } ?>
                <?php if ($lecsp_google_link) { ?>
                    <li>
                        <a href="<?php echo esc_url($lecsp_google_link); ?>" target="_blank">
                            <img src="<?php echo esc_url(lecsp_plugin_url . '/assets/images/gp.png'); ?>">
                        </a>
                    </li>
                <?php } ?>
                <?php if ($lecsp_linkedin_link) { ?>
                    <li>
                        <a href="<?php echo esc_url($lecsp_linkedin_link); ?>" target="_blank">
                            <img src="<?php echo esc_url(lecsp_plugin_url . '/assets/images/linkd.png'); ?>">
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</body>

</html>