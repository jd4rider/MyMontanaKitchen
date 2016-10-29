<section id="instagram"
    <?php if ( $tab != 'instagram' ) : ?>style="display: none;"<?php endif ?>
>
    <h3>
        <?php _e( 'Instagram Settings', 'SocialFeeder' ) ?>
    </h3>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Enabled', 'SocialFeeder' ) ?></th>
            <td>
                <input type="checkbox"
                    name="instagram_enabled"
                    value="1"
                    <?php if ( $socialFeeder->is_instagram_setup && $socialFeeder->instagram['enabled'] ) : ?>checked<?php endif ?>
                />
            </td>
        </tr>

    </table>

    <h4>
        <?php _e( 'Application Settings', 'SocialFeeder' ) ?>
    </h4>

    <p class="description">
        <?php _e( 'Configure you Instagram\'s application settings, if you don\'t have one, get one here:', 'SocialFeeder' ) ?>
        <a href="https://www.instagram.com/developer/">
            <?php _e( 'Instagram for Developers', 'SocialFeeder' ) ?>
        </a>
    </p>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Client ID', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="instagram_client_id"
                    value="<?php echo $socialFeeder->is_instagram_setup ? $socialFeeder->instagram['client_id'] : '' ?>"
                    class="regular-text"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Client Secret', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="instagram_client_secret"
                    value="<?php echo $socialFeeder->is_instagram_setup ? $socialFeeder->instagram['client_secret'] : '' ?>"
                    class="regular-text"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Redirect URL', 'SocialFeeder' ) ?></th>
            <td>
                <p style="color: #FA3D00;"><?php echo admin_url( 'index.php?trigger=instagram-callback' ) ?></p>
                <br>
                <span class="description">
                    <?php _e( 'This should be your redirect url. Setup this setting at your Instagram Developer Dashboard.' ) ?>
                </span>
            </td>
        </tr>

    </table>

    <h4>
        <?php _e( 'Authentication', 'SocialFeeder' ) ?>
    </h4>

    <p class="description">
        <?php _e( 'The plugin will perform authentication if needed. You can force and reset authentication by clicking the following button:', 'SocialFeeder' ) ?>
    </p>

    <div class="authorization">
        <a href="<?php echo admin_url( 'index.php?trigger=social-feeder-settings&trigger=social-feeder&action=auth-instagram' ) ?>"
            class="button button-auth"
        >
            <?php _e( 'Authenticate', 'SocialFeeder' ) ?>
        </a>
    </div>

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
                    name="instagram_follow_url"
                    value="<?php echo $socialFeeder->is_instagram_setup ? $socialFeeder->instagram['follow_url'] : '' ?>"
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