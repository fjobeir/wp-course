<?php

if (!function_exists('wpc_add_roles')) {
    function wpc_add_roles()
    {
        add_role('company', __('Company', 'wpcourse'), [
            'read' => true,
            'delete_posts' => true,
            'edit_posts' => true,
            'delete_ads' => true,
            'edit_ads' => true,
            'upload_files' => true,
            'assign_ad_groups' => true,
        ]);
        $admin = get_role('administrator');
        $admin->remove_cap('manage_ad_groups');
        $admin->remove_cap('delete_ad_groups');
        $admin->remove_cap('edit_ad_groups');
        $admin->remove_cap('assign_ad_groups');
    }
}

if (!function_exists('wpc_user_additional_fields')) {
    function wpc_user_additional_fields($user)
    {
        ?>
        <h2><?php _e('Social Links', 'wpcourse'); ?></h2>
        <table class="form-table">
            <?php
            $user_meta = get_user_meta($user->ID);
            $networks = ['facebook', 'twitter', 'instagram', 'youtube', 'pinterest'];
            foreach ($networks as $network) {
                $link = '';
                if (!empty($user_meta['wpc_' . $network . '_link'][0])) {
                    $link = esc_url($user_meta['wpc_' . $network . '_link'][0]);
                }
                ?>
                <tr>
                    <th>
                        <label for="wpc_<?php echo $network; ?>_link"><?php _e(ucfirst($network), 'wpcourse'); ?></label>
                    </th>
                    <td>
                        <input type="url" value="<?php echo $link; ?>" name="wpc_<?php echo $network; ?>_link" id="wpc_<?php echo $network; ?>_link">
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    add_action('edit_user_profile', 'wpc_user_additional_fields');
    add_action('show_user_profile', 'wpc_user_additional_fields');
}

if (!function_exists('wpc_update_user_data')) {
    function wpc_update_user_data($user_id)
    {
        $networks = ['facebook', 'twitter', 'instagram', 'youtube', 'pinterest'];
        foreach ($networks as $network) {
            if (isset($_POST['wpc_' . $network . '_link'])) {
                update_user_meta($user_id, 'wpc_' . $network . '_link', esc_url_raw($_POST['wpc_' . $network . '_link'], ['http', 'https']));
            }
        }
    }
    add_action('personal_options_update', 'wpc_update_user_data');
    add_action('edit_user_profile_update', 'wpc_update_user_data');
}