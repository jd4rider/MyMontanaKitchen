<section id="twitter"
    <?php if ( $tab != 'twitter' ) : ?>style="display: none;"<?php endif ?>
>
    <h3>
        <?php _e( 'Twitter Settings', 'SocialFeeder' ) ?>
    </h3>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Enabled', 'SocialFeeder' ) ?></th>
            <td>
                <input type="checkbox"
                    name="twitter_enabled"
                    value="1"
                    <?php if ( $socialFeeder->is_twitter_setup && $socialFeeder->twitter['enabled'] ) : ?>checked<?php endif ?>
                />
            </td>
        </tr>

    </table>

    <h4>
        <?php _e( 'Application Settings', 'SocialFeeder' ) ?>
    </h4>

    <p class="description">
        <?php _e( 'Configure you Twitter\'s application settings, if you don\'t have one, get one here:', 'SocialFeeder' ) ?>
        <a href="https://apps.twitter.com">
            <?php _e( 'Twitter Apps', 'SocialFeeder' ) ?>
        </a>
    </p>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Consumer Key', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="twitter_api_key"
                    value="<?php echo $socialFeeder->is_twitter_setup ? $socialFeeder->twitter['api_key'] : '' ?>"
                    class="regular-text"
                />
                <br>
                <span class="description">
                    <?php _e( 'API Key.', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Consumer Secret', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="twitter_api_secret"
                    value="<?php echo $socialFeeder->is_twitter_setup ? $socialFeeder->twitter['api_secret'] : '' ?>"
                    class="regular-text"
                />
                <br>
                <span class="description">
                    <?php _e( 'API Secret.', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Access Token', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="twitter_token"
                    value="<?php echo $socialFeeder->is_twitter_setup ? $socialFeeder->twitter['token'] : '' ?>"
                    class="regular-text"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Access Token Secret', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="twitter_token_secret"
                    value="<?php echo $socialFeeder->is_twitter_setup ? $socialFeeder->twitter['token_secret'] : '' ?>"
                    class="regular-text"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Screen name', 'SocialFeeder' ) ?></th>
            <td>
                @<input type="text"
                    name="twitter_screen_name"
                    value="<?php echo $socialFeeder->is_twitter_setup ? $socialFeeder->twitter['screen_name'] : '' ?>"
                    class="regular-text"
                />
                <br>
                <span class="description">
                    <?php _e( 'Twitter\'s username (screen name) without @', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

    </table>

    <h4>
        <?php _e( 'Follow Us', 'SocialFeeder' ) ?>
    </h4>

    <p class="description">
        <?php _e( 'In the default template, follow us icons appear at the bottom of the feeder.', 'SocialFeeder' ) ?>
    </p>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'URL Link', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="twitter_follow_url"
                    value="<?php echo $socialFeeder->is_twitter_setup ? $socialFeeder->twitter['follow_url'] : '' ?>"
                    class="regular-text"
                />
                <br>
                <span class="description">
                    <?php _e( 'URL to redirect the user to when follow us link is clicked.', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

    </table>

</section>