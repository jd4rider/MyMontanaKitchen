<section id="snapchat"
    <?php if ( $tab != 'snapchat' ) : ?>style="display: none;"<?php endif ?>
>
    <h3>
        <?php _e( 'Snapchat Settings', 'social-feeder' ) ?>
    </h3>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Enabled', 'social-feeder' ) ?></th>
            <td>
                <input type="checkbox"
                    name="snapchat_enabled"
                    value="1"
                    <?php if ( $socialFeeder->is_snapchat_setup && $socialFeeder->snapchat['enabled'] ) : ?>checked<?php endif ?>
                />
            </td>
        </tr>

    </table>

    <h4>
        <?php _e( 'Application Settings', 'social-feeder' ) ?>
    </h4>

    <p class="description">
        <?php _e( 'Use your snapchat login credentials to continue, for more info visit:', 'social-feeder' ) ?>
        <a href="https://www.snapchat.com/">
            <?php _e( 'Snapchat Website', 'social-feeder' ) ?>
        </a>
    </p>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Username', 'social-feeder' ) ?></th>
            <td>
                <input type="text"
                    name="snapchat_username"
                    value="<?php echo $socialFeeder->is_snapchat_setup ? $socialFeeder->snapchat['username'] : '' ?>"
                    class="regular-text"
                    placeholder="<?php _e( 'Username', 'social-feeder' ) ?>"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Password', 'social-feeder' ) ?></th>
            <td>
                <input type="password"
                    name="snapchat_password"
                    value="<?php echo $socialFeeder->snapchat_password ?>"
                    class="regular-text"
                    placeholder="<?php _e( 'Password', 'social-feeder' ) ?>"
                />
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
        <a href="<?php echo admin_url( 'index.php?trigger=social-feeder&action=auth-snapchat' ) ?>"
            class="button button-auth"
        >
            <?php _e( 'Authenticate', 'SocialFeeder' ) ?>
        </a>
    </div>

</section>