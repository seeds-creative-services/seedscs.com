<?php

return array(

    "name" => array(

        "singular" => "Location",

        "multiple" => "Locations"

    ),

    "slug" => "locations",

    "icon" => "f5a0",

    "glance" => true,

    "public" => false,

    "show" => array(

        "menu" => true,

        "ui" => true

    ),

    "supports" => array(

        "title", "thumbnail"

    ),

    "fields" => function($postType) {

        /**
         * Change the placeholder text for the page title.
         * @since 1.0.0
         */

        add_filter('enter_title_here', function($title) {

            $post_type = basename(__FILE__, ".php");

            $screen = get_current_screen();
            if($post_type == $screen->post_type) $title = "Enter location name";
            return $title;

        });


        /**
         * Add custom meta boxes for the custom post type.
         * @since 1.0.0
         */

        add_action('add_meta_boxes', function() {

            add_meta_box(
                "location_contact_details",
                "Location Details",
                "render_location_contact_details",
                "locations",
                "normal",
                "high"
            );

            function render_location_contact_details() {

                global $post;

                $post_type = basename(__FILE__, ".php");

                $field_name = "${$post_type}_fields";
                $field_nonce = wp_create_nonce(basename(__FILE__));
                $meta = get_post_meta($post->ID, $field_name, true); ?>

                <input type="hidden" name="<?php echo $field_name; ?>_nonce" value="<?php echo $field_nonce; ?>">

                <div class="post-type-grid">

                    <div class="post-type-column">
                        <table class="form-table">
                            <tbody>
                            <tr>
                                <td>
                                    <h3>Location Address</h3>
                                </td>
                            </tr>
                            <tr class="post-type-grid">
                                <td class="post-type-column" style="width:40%">
                                    <label for="<?php echo $field_name; ?>[street]">Street Address</label>
                                    <input class="regular-text full-width" id="<?php echo $field_name; ?>[street]" type="text" name="<?php echo $field_name; ?>[street]" value="<?php echo $meta['street'] ?? ''; ?>">
                                </td>
                                <td class="post-type-column">
                                    <label for="<?php echo $field_name; ?>[city]">City</label>
                                    <input class="regular-text full-width" id="<?php echo $field_name; ?>[city]" type="text" name="<?php echo $field_name; ?>[city]" value="<?php echo $meta['city'] ?? ''; ?>">
                                </td>
                                <td class="post-type-column">
                                    <label for="<?php echo $field_name; ?>[state]">State</label>
                                    <input class="regular-text full-width" id="<?php echo $field_name; ?>[state]" type="text" name="<?php echo $field_name; ?>[state]" value="<?php echo $meta['state'] ?? ''; ?>">
                                </td>
                                <td class="post-type-column">
                                    <label for="<?php echo $field_name; ?>[zip]">Zip</label>
                                    <input class="regular-text full-width" id="<?php echo $field_name; ?>[zip]" type="text" name="<?php echo $field_name; ?>[zip]" value="<?php echo $meta['zip'] ?? ''; ?>">
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="post-type-column">
                        <table class="form-table">
                            <tbody>

                            <tr>
                                <th scope="row">
                                    <label for="<?php echo $field_name; ?>[google]">Google Maps Link</label>
                                </th>
                                <td>
                                    <input class="regular-text full-width" id="<?php echo $field_name; ?>[google]" type="url" name="<?php echo $field_name; ?>[google]" value="<?php echo $meta['google'] ?? ''; ?>">
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="post-type-column">
                        <table class="form-table">
                            <tbody>

                            <tr>
                                <th scope="row">
                                    <label for="<?php echo $field_name; ?>[phone]">Phone Number</label>
                                </th>
                                <td>
                                    <input class="regular-text full-width" id="<?php echo $field_name; ?>[phone]" type="tel" name="<?php echo $field_name; ?>[phone]" value="<?php echo $meta['phone'] ?? ''; ?>">
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            <?php }

        });

        add_action("save_post", function($post_id) {

            $post_type = basename(__FILE__, ".php");

            if(isset($_POST["{$post_type}_fields_nonce"])) {

                /* Verify that the post type nonce exists. */
                if(!wp_verify_nonce($_POST["{$post_type}_fields_nonce"], basename(__FILE__)))
                    return $post_id;

                /* Verify the autosave condition. */
                if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
                    return $post_id;

                /* Verify the post type. */
                if($post_type === $_POST['post_type']) {

                    if(!current_user_can("edit_page", $post_id))
                        return $post_id;

                    $previous_meta = get_post_meta($post_id, "{$post_type}_fields", TRUE);
                    $current_meta  = $_POST['{$post_type}_fields'];

                    if($current_meta && $current_meta !== $previous_meta)
                        update_post_meta($post_id, "{$post_type}_fields", $current_meta);

                    if("" === $current_meta && $previous_meta)
                        delete_post_meta($post_id, "{$post_type}_fields", $previous_meta);

                }

            }

        });

    }

);