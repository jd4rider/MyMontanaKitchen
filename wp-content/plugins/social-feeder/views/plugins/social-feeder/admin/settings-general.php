<section id="general"
    <?php if ( $tab != 'general' ) : ?>style="display: none;"<?php endif ?>
>
    <h3>
        <?php _e( 'General Settings', 'SocialFeeder' ) ?>
    </h3>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Refresh Frequency', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="frequency"
                    value="<?php echo $socialFeeder->frequency ?>"
                    class="regular-text"
                    placeholder="<?php _e( 'in minutes', 'SocialFeeder' ) ?>"
                />
                <br>
                <span class="description">
                    <?php _e( 'How frequently will the feed refresh. Value in minutes (default 60).', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Date Format', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="date_format"
                    value="<?php echo $socialFeeder->date_format ?>"
                    class="regular-text"
                    placeholder="<?php _e( 'i.e. Y-m-d', 'SocialFeeder' ) ?>"
                />
                <br>
                <span class="description">
                    <?php _e( 'Use php formatting:', 'SocialFeeder' ) ?> 
                    <a href="http://php.net/manual/en/function.date.php">
                        <?php _e( 'PHP dates', 'SocialFeeder' ) ?>
                    </a>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Merge', 'SocialFeeder' ) ?></th>
            <td>
                <input type="checkbox"
                    name="merge"
                    value="1"
                    <?php if ( $socialFeeder->merge ) : ?>checked<?php endif ?>
                />
                <br>
                <span class="description">
                    <?php _e( 'Merges all social networks and display the most recent posts in one feed.', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Limit', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="limit"
                    value="<?php echo $socialFeeder->limit ?>"
                    class="regular-text"
                    placeholder="<?php _e( 'i.e. 4, 5, 6', 'SocialFeeder' ) ?>"
                />
                <br>
                <span class="description">
                    <?php _e( 'Limits the amount of items to display in feed.', 'SocialFeeder' ) ?>
                    <br>
                    <?php _e( 'When <strong>merge</strong> is un-selected, the limit will be applied per social network.', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Enqueue styles', 'SocialFeeder' ) ?></th>
            <td>
                <input type="checkbox"
                    name="enqueue_styles"
                    value="1"
                    <?php if ( $socialFeeder->enqueue_styles ) : ?>checked<?php endif ?>
                />
                <br>
                <span class="description">
                    <?php _e( 'Whether or not to enqueue / include the styles that come with the plugin. (IDs "social-feeder" and "font-awesome").', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Show follow us', 'SocialFeeder' ) ?></th>
            <td>
                <input type="checkbox"
                    name="follow_us"
                    value="1"
                    <?php if ( $socialFeeder->follow_us ) : ?>checked<?php endif ?>
                />
                <br>
                <span class="description">
                    <?php _e( 'Whether or not to display the "follow us" links.', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

    </table>

    <input type="hidden"
        name="security_key"
        value="<?php echo $socialFeeder->security_key ? $socialFeeder->security_key : uniqid( '', true ) ?>"
    />

    </table>
</section>