<?php defined('C5_EXECUTE') or die("Access Denied."); 

    $md = new Mobile_Detect();
    $im = Core::make('helper/image');

    /*
     * Custom Padding
     */
    if ($style = $b->getCustomStyle()) {
        $padding_string = '';
        $style = $style->getStyleSet();
        $style_keys = ['paddingTop', 'paddingBottom', 'paddingLeft', 'paddingRight'];

        foreach ($style_keys as $prop) {
            if ($value = $style->{ 'get' . $prop }()) {
                $prop = implode('-', str_split(strtolower($prop), 7));
                $padding_string .= $prop . ': ' . $value . '; ';
            }
        }

        $padding_string .=  PHP_EOL;
    }


    /*
     * Background Image
     */
    if ($image_file) {
        $background_url = $image_file->getUrl();
    }

    /*
     * Mask
     */
    if ($mask_image_file) {
        $mask_url = $mask_image_file->getUrl();
    }

    if ($mask_colour) {
        $rgb = array_map(function ($v) { return trim($v); }, explode(',', substr($mask_colour, 4, -1)));
        $opacity = round($mask_colour_opacity / 100, 2);
        $mask_rgba = "rgba($rgb[0], $rgb[1], $rgb[2], $opacity)";
    }

    /*
     * Content Animations
     */
    if (strlen($content_animation_class) > 0) {
        $content_animation_class = 'animated-css-class animated ' . $content_animation_class; 
    }

    $has_animations = strlen($content_animation_class) > 0 && defined('CSS3_ANIMATION_PACKAGE');
    $content_container_class = ('1' === $content_container ? 'container' : '');
    $content_container_class .= ($has_animations ? ' ' . $content_animation_class : '');

?>
<style>
    div.ccm-custom-style-container.ccm-custom-style-<?php echo strtolower(preg_replace("/[^a-z0-9-]+/i", "", $b->getAreaHandle())); ?>-<?php echo $bID; ?> {
        padding: 0 !important;
    }

    #heroStage<?php echo $bID; ?> .vjs-loading-spinner {
        <?php echo $hide_video_loading ? 'display: none;' : ''; ?>
    }

    #heroStage<?php echo $bID; ?> {
        background-color: <?php echo ($background_colour) ? $background_colour : 'transparent'; ?>;
        background-image: <?php echo (isset($background_url) ? 'url(' . $background_url . ')' : 'none'); ?>;
        background-position: <?php echo ($background_image_position ? $background_image_position : '0% 0%'); ?>;
        background-attachment: <?php echo ($background_image_attachment ? $background_image_attachment : 'scroll'); ?>;
        background-size: <?php echo ($background_image_size ? $background_image_size : 'auto'); ?>;
    }

    #heroStage<?php echo $bID; ?> .hero-mask {
        background-color: <?php echo $mask_colour ? $mask_rgba : 'transparent'; ?>;
        background-image: <?php echo isset($mask_url) ? 'url(' . $mask_url . ')' : 'none'; ?>;
        background-position: <?php echo ($mask_image_position ? $mask_image_position : '0% 0%'); ?>;
        background-attachment: <?php echo ($mask_image_attachment ? $mask_image_attachment : 'scroll'); ?>;
        background-size: <?php echo ($mask_image_size ? $mask_image_size : 'auto'); ?>;
    }

    #heroStage<?php echo $bID; ?> .hero-table {
        height: <?php echo ($min_height > 0) ? $min_height : 0; ?>px;
    }

    #heroStage<?php echo $bID; ?> .hero-table .hero-table-row .hero-table-cell {
        vertical-align: <?php echo ('1' === $center_content) ? 'middle' : 'baseline'; ?>;
    }

    #heroStage<?php echo $bID; ?> .hero-content {
        <?php echo isset($padding_string) ? $padding_string : ''; ?>
    }

    #heroVideo<?php echo $bID; ?> {
        top: 0;
        height: auto;
        position: absolute;
        width: 100%;
        /*min-width: 1380px;*/
        z-index: 0;
        visibility: hidden;
    }
</style>

<div id="heroStage<?php echo $bID; ?>" class="hero-stage">

    <?php if ($video_url) { ?>
        <video id="heroVideo<?php echo $bID; ?>" class="hero-video" preload="auto" loop src="<?php echo $video_url; ?>" poster="<?php echo (isset($background_url) ? $background_url : ""); ?>"></video>
    <?php } ?>

    <div class="hero-table">
        <div class="hero-table-row">
            <div id="heroContent<?php echo $bID; ?>" class="hero-table-cell hero-content">
                <div class="<?php echo $content_container_class; ?>">
                    <?php echo $content; ?>

                    <div class="hero-stack-content">
                        <?php
                            if ($stack) {
                                $stack->display();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="heroMask<?php echo $bID; ?>" class="hero-mask"></div>

</div>

<script>
    (function ($, w) {
        var block = {
            bID                 : '<?php echo $bID; ?>',
            background_parallax : {
                enabled             : '<?php echo "parallax" === $background_type ? "1" : "0"; ?>',
                speed               : '<?php echo floatval($background_parallax_speed); ?>',
            },
            mask_parallax : {
                enabled             : '<?php echo "parallax" === $mask_type ? "1" : "0"; ?>',
                speed               : '<?php echo floatval($mask_parallax_speed); ?>',
            },
            fill_screen         : '<?php echo $fill_screen; ?>',
            fill_screen_offset  : '<?php echo $fill_screen_offset; ?>',
            mobile              : '<?php echo $md->isMobile() ? "1" : "0"; ?>',
            $stage              : $('#heroStage<?php echo $bID; ?>'),
            $content            : $('#heroContent<?php echo $bID; ?>'),
            $mask               : $('#heroMask<?php echo $bID; ?>'),
            $video              : $('#heroVideo<?php echo $bID; ?>'),
        };

        (function boot() {
            if (typeof HeroBlockManager === 'undefined') {
                setTimeout(boot, 100);
                return;
            }
            new HeroBlockManager(block);
        }());

    }(jQuery, window));
</script>