<div class="wrap">

    <h2><?php _e( 'Social Feeder Settings', 'SocialFeeder' ) ?></h2>

    <?php if ( $notice ) : ?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
            <p><strong><?php echo $notice ?></strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'SocialFeeder' ) ?></span>
            </button>
        </div>
    <?php endif ?>

    <?php if ( $error ) : ?>
        <div id="setting-error-settings_updated" class="error settings-error notice is-dismissible"> 
            <p><strong><?php echo $error ?></strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'SocialFeeder' ) ?></span>
            </button>
        </div>
    <?php endif ?>

    <form method="POST">

        <h3 class="nav-tab-wrapper">
            <?php foreach ( $tabs as $key => $name ) : ?>
                <a class="nav-tab <?php if ( $tab == $key ) :?>nav-tab-active<?php endif ?>"
                    href="<?php echo admin_url( 'options-general.php?page=social-feeder-settings&tab=' . $key ) ?>"
                >
                    <?php echo $name ?>
                </a>
            <?php endforeach ?>
        </h3>

        <?php $view->show( 'plugins.social-feeder.admin.settings-general', [ 'tab' => $tab, 'socialFeeder' => $socialFeeder ] ) ?>

        <?php $view->show( 'plugins.social-feeder.admin.settings-facebook', [ 'tab' => $tab, 'socialFeeder' => $socialFeeder, 'config' => $config ] ) ?>

        <?php $view->show( 'plugins.social-feeder.admin.settings-twitter', [ 'tab' => $tab, 'socialFeeder' => $socialFeeder ] ) ?>

        <?php $view->show( 'plugins.social-feeder.admin.settings-instagram', [ 'tab' => $tab, 'socialFeeder' => $socialFeeder ] ) ?>

        <?php submit_button() ?>

    </form>

</div>