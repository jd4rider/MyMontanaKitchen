<section id="facebook"
    <?php if ( $tab != 'facebook' ) : ?>style="display: none;"<?php endif ?>
>
    <h3>
        <?php _e( 'Facebook Settings', 'SocialFeeder' ) ?>
    </h3>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Enabled', 'SocialFeeder' ) ?></th>
            <td>
                <input type="checkbox"
                    name="facebook_enabled"
                    value="1"
                    <?php if ( $socialFeeder->is_facebook_setup && $socialFeeder->facebook['enabled'] ) : ?>checked<?php endif ?>
                />
            </td>
        </tr>

    </table>

    <h4>
        <?php _e( 'Application Settings', 'SocialFeeder' ) ?>
    </h4>

    <p class="description">
        <?php _e( 'Configure you facebook\'s application settings, if you don\'t have one, get one here:', 'SocialFeeder' ) ?>
        <a href="https://developers.facebook.com/apps">
            <?php _e( 'Facebook Developer Apps', 'SocialFeeder' ) ?>
        </a>
        <br>
        <?php _e( 'The following additional Facebook permissions are required. (Set them at <i>Status and Review</i> in Facebook Developer Apps Dashboard)' ) ?>
        <br>
        <ol>
            <li>
                <strong>user_posts</strong> - <?php _e( 'Needed to display your primary account\'s feed.' ) ?>
            </li>
            <li>
                <strong>manage_pages</strong> - <?php _e( 'Needed to display feed from pages you manage.' ) ?>
            </li>
        </ol>
    </p>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'App ID', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="facebook_app_id"
                    value="<?php echo $socialFeeder->is_facebook_setup ? $socialFeeder->facebook['app_id'] : '' ?>"
                    class="regular-text"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'App secret', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="facebook_app_secret"
                    value="<?php echo $socialFeeder->is_facebook_setup ? $socialFeeder->facebook['app_secret'] : '' ?>"
                    class="regular-text"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Api Version', 'SocialFeeder' ) ?></th>
            <td>
                <input type="text"
                    name="facebook_api_version"
                    value="<?php echo $socialFeeder->is_facebook_setup ? $socialFeeder->facebook['api_version'] : '' ?>"
                    class="regular-text"
                    placeholder="i.e. v2.5"
                />
                <br>
                <span class="description">
                    <?php _e( 'If non set, plugin will default it to v2.5.', 'SocialFeeder' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'OAuth redirect URL', 'SocialFeeder' ) ?></th>
            <td>
                <p style="color: #FA3D00;"><?php echo admin_url( 'index.php?trigger=facebook-callback' ) ?></p>
                <br>
                <span class="description">
                    <?php _e( 'This should be your <strong>Valid OAuth redirect url</strong>. Setup this setting at your Facebook Developer Apps Dashboard, section:' ) ?>
                    <br>
                    <i><?php _e( 'Login with Facebook Settings-> Advanced-> Client OAuth Settings' ) ?></i>
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
        <a href="<?php echo admin_url( 'index.php?trigger=social-feeder-settings&trigger=social-feeder&action=auth-facebook' ) ?>"
            class="button button-auth"
        >
            <?php _e( 'Authenticate', 'SocialFeeder' ) ?>
        </a>
    </div>

    <?php if ( $socialFeeder->has_facebook_pages ) : ?>

        <h4>
            <?php _e( 'Profile', 'SocialFeeder' ) ?>
        </h4>

        <p class="description">
            <?php _e( 'Select the profile you want to display feeds from:', 'SocialFeeder' ) ?>
        </p>

        <table class="form-table">

            <tr valign="top">
                <th scope="row"><?php _e( 'Options', 'SocialFeeder' ) ?></th>
                <td>
                    <input type="radio"
                        name="facebook_profile"
                        value="<?php echo $socialFeeder->facebook_accounts['me']['id'] ?>"
                        <?php if ( $socialFeeder->is_facebook_me ) : ?>checked<?php endif ?>
                    /> <?php echo $socialFeeder->facebook_accounts['me']['name'] ?>
                    <br>
                    <br>
                    <input type="radio"
                        name="facebook_profile"
                        value="page"
                        <?php if ( ! $socialFeeder->is_facebook_me ) : ?>checked<?php endif ?>
                    /> <?php _e( 'Page', 'SocialFeeder' ) ?>:
                    <select name="facebook_page">
                        <?php foreach ( $socialFeeder->facebook_accounts['pages'] as $page ) : ?>
                            <option value="<?php echo $page['id'] ?>"
                                <?php if ( $socialFeeder->facebook_page == $page['id'] ) : ?>selected<?php endif ?>
                            >
                                <?php echo $page['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>

        </table>

    <?php endif ?>

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
                    name="facebook_follow_url"
                    value="<?php echo $socialFeeder->is_facebook_setup ? $socialFeeder->facebook['follow_url'] : '' ?>"
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