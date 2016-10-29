<div class="social-feeder">

    <p>
        <label for="<?php echo $widget->get_field_id( 'count' ) ?>">
            <?php _e( 'Feed count:', 'SocialFeeder' ) ?>
        </label>

        <input id="<?php echo $widget->get_field_id( 'count' ) ?>"
            name="<?php echo $widget->get_field_name( 'count' ) ?>"
            class="widefat"
            type="text"
            value="<?php echo $instance['count'] ?>"
        >
        <br>
        <span class="description">
            <?php _e( 'Amount of feed items to display.', 'SocialFeeder' ) ?>
        </span>
    </p>

</div>