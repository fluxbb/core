<?php

// Language definitions used in admin_groups.php
return array(

'must_enter_title_message'		=>	'You must enter a group title.',
'title_already_exists_message'	=>	'There is already a group with the title <strong>%s</strong>.',
'default_group_redirect'		=>	'Default group set.',
'cannot_remove_default_message'	=>	'The default group cannot be removed. In order to delete this group, you must first setup a different group as the default.',
'group_removed_redirect'		=>	'Group removed.',
'group_added_redirect'			=>	'Group added.',
'group_edited_redirect'			=>	'Group edited.',

'add_groups_head'				=>	'Add/setup groups',
'add_group_subhead'				=>	'Add new group',
'new_group_label'				=>	'Base new group on',
'new_group_help'				=>	'Select a user group from which the new group will inherit its permission settings. The next page will let you fine-tune its settings.',
'default_group_subhead'			=>	'Set default group',
'default_group_label'			=>	'Default group',
'default_group_help'			=>	'This is the default user group, e.g. the group users are placed in when they register. For security reasons, users can\'t be placed in either the moderator or administrator user groups by default.',
'existing_groups_head'			=>	'Existing groups',
'edit_groups_subhead'			=>	'Edit/delete groups',
'edit_groups_info'				=>	'The pre-defined groups Guests, Administrators, Moderators and Members cannot be removed. However, they can be edited. Please note that in some groups, some options are unavailable (e.g. the <em>edit posts</em> permission for guests). Administrators always have full permissions.',
'edit_link'						=>	'Edit',
'delete_link'					=>	'Delete',
'group_delete_head'				=>	'Group delete',
'confirm_delete_subhead'		=>	'Confirm delete group',
'confirm_delete_info'			=>	'Are you sure that you want to delete the group <strong>%s</strong>?',
'confirm_delete_warn'			=>	'WARNING! After you deleted a group you cannot restore it.',
'delete_group_head'				=>	'Delete group',
'move_users_subhead'			=>	'Move users currently in group',
'move_users_info'				=>	'The group <strong>%s</strong> currently has <strong>%s</strong> members. Please select a group to which these members will be assigned upon deletion.',
'move_users_label'				=>	'Move users to',
'delete_group'					=>	'Delete group',

'group_settings_head'			=>	'Group settings',
'group_settings_subhead'		=>	'Setup group options and permissions',
'group_settings_info'			=>	'Below options and permissions are the default permissions for the user group. These options apply if no forum specific permissions are in effect.',
'group_title_label'				=>	'Group title',
'user_title_label'				=>	'User title',
'user_title_help'				=>	'The rank users in this group have attained. Leave blank to use default title ("%s").',
'promote_users_label'			=>	'Promote users',
'promote_users_help'			=>	'You can promote users to a new group automatically if they reach a certain number of posts. Select "%s" to disable. For security reasons, you are not allowed to select an administrator group here. Also note that group changes for users affected by this setting may only take effect after their next post.',
'disable_promotion'				=>	'Disable promoting',
'mod_privileges_label'			=>	'Allow users moderator privileges',
'mod_privileges_help'			=>	'In order for a user in this group to have moderator abilities, he/she must be assigned to moderate one or more forums. This is done via the user administration page of the user\'s profile.',
'edit_profile_label'			=>	'Allow moderators to edit user profiles',
'edit_profile_help'				=>	'If moderator privileges are enabled, allow users in this group to edit user profiles.',
'rename_users_label'			=>	'Allow moderators to rename users',
'rename_users_help'				=>	'If moderator privileges are enabled, allow users in this group to rename users.',
'change_passwords_label'		=>	'Allow moderators to change passwords',
'change_passwords_help'			=>	'If moderator privileges are enabled, allow users in this group to change user passwords.',
'ban_users_label'				=>	'Allow moderators to ban users',
'ban_users_help'				=>	'If moderator privileges are enabled, allow users in this group to ban users.',
'read_board_label'				=>	'Read board',
'read_board_help'				=>	'Allow users in this group to view the board. This setting applies to every aspect of the board and can therefore not be overridden by forum specific settings. If this is set to "No", users in this group will only be able to login/logout and register.',
'view_user_info_label'			=>	'View user information',
'view_user_info_help'			=>	'Allow users to view the user list and user profiles.',
'post_replies_label'			=>	'Post replies',
'post_replies_help'				=>	'Allow users in this group to post replies in topics.',
'post_topics_label'				=>	'Post topics',
'post_topics_help'				=>	'Allow users in this group to post new topics.',
'edit_posts_label'				=>	'Edit posts',
'edit_posts_help'				=>	'Allow users in this group to edit their own posts.',
'delete_posts_label'			=>	'Delete posts',
'delete_posts_help'				=>	'Allow users in this group to delete their own posts.',
'delete_topics_label'			=>	'Delete topics',
'delete_topics_help'			=>	'Allow users in this group to delete their own topics (including any replies).',
'post_links_label'				=>	'Post links',
'post_links_help'				=>	'Allow users in this group to include links in their posts. This setting also applies to signatures and the website field in users\' profiles.',
'set_own_title_label'			=>	'Set own user title',
'set_own_title_help'			=>	'Allow users in this group to set their own user title.',
'user_search_label'				=>	'Use search',
'user_search_help'				=>	'Allow users in this group to use the search feature.',
'user_list_search_label'		=>	'Search user list',
'user_list_search_help'			=>	'Allow users in this group to freetext search for users in the user list.',
'send_e-mails_label'			=>	'Send e-mails',
'send_e-mails_help'				=>	'Allow users in this group to send e-mails to other users.',
'post_flood_label'				=>	'Post flood interval',
'post_flood_help'				=>	'Number of seconds that users in this group have to wait between posts. Set to 0 to disable.',
'search_flood_label'			=>	'Search flood interval',
'search_flood_help'				=>	'Number of seconds that users in this group have to wait between searches. Set to 0 to disable.',
'e-mail_flood_label'			=>	'Email flood interval',
'e-mail_flood_help'				=>	'Number of seconds that users in this group have to wait between emails. Set to 0 to disable.',
'report_flood_label'			=>	'Report flood interval',
'report_flood_help'				=>	'Number of seconds that users in this group have to wait between reports. Set to 0 to disable.',
'moderator_info'				=>	'Please note that in order for a user in this group to have moderator abilities, he/she must be assigned to moderate one or more forums. This is done via the user administration page of the user\'s profile.',

);
