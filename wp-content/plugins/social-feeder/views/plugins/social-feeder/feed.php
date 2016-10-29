<div class="social-feeder <?php if ( count( $feeds ) == 0 ) : ?>no-data<?php endif ?>">

    <!-- FEEDS SECTION -->
    <!-- BEGIN ....... -->
    <?php if ( count( $feeds ) > 0 ) : ?>

        <table class="feeds">

            <?php foreach ( $feeds as $feed ) : ?>
                
                <tr class="feed <?php echo $feed->feeder ?>">
                    <td class="network">
                        <?php if ( $feed->feeder == 'twitter' ) : ?>
                            <i class="fa fa-twitter"></i>
                        <?php elseif ( $feed->feeder == 'instagram' ) : ?>
                            <i class="fa fa-instagram"></i>
                        <?php elseif ( $feed->feeder == 'facebook' ) : ?>
                            <i class="fa fa-facebook"></i>
                        <?php endif ?>
                    </td>
                    <td class="item">
                        <a href="<?php echo $feed->url ?>" class="link">
                            <?php if ( $feed->media_url ) : ?>
                                <img src="<?php echo $feed->media_url ?>"
                                    alt="feed <?php echo $feed->feeder ?> <?php echo $feed->date ?>"
                                />
                            <?php endif ?>
                            <span class="date"><?php echo $feed->date ?></span>
                            <div class="content"><?php echo $feed->content ?></div>
                        </a>
                    </td>
                </tr>

            <?php endforeach ?>

        </table>

    <?php endif ?>
    <!-- END ......... -->
    <!-- FEEDS SECTION -->

    <!-- FOLLOW US SECTION -->
    <!-- BEGIN ....... -->
    <?php if ( $socialFeeder->follow_us ) : ?>
        <div class="follow-us">

            <?php if ( $socialFeeder->is_twitter_legible ) : ?>
                <a href="<?php echo $socialFeeder->twitter['follow_url'] ?>"
                    title="<?php _e( 'Follow us on Twitter', 'SocialFeeder' ) ?>"
                >
                    <i class="fa fa-twitter"></i>
                </a>
            <?php endif ?>
            
            <?php if ( $socialFeeder->is_instagram_legible ) : ?>
                <a href="<?php echo $socialFeeder->instagram['follow_url'] ?>"
                    title="<?php _e( 'Follow us on Instagram', 'SocialFeeder' ) ?>"
                >
                    <i class="fa fa-instagram"></i>
                </a>
            <?php endif ?>
            
            <?php if ( $socialFeeder->is_facebook_legible ) : ?>
                <a href="<?php echo $socialFeeder->facebook['follow_url'] ?>"
                    title="<?php _e( 'Follow us on Facebook', 'SocialFeeder' ) ?>"
                >
                    <i class="fa fa-facebook"></i>
                </a>
            <?php endif ?>

        </div>
    <?php endif ?>
    <!-- END ......... -->
    <!-- FOLLOW US SECTION -->

</div>