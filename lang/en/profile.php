<?php

// Language definitions used in profile.php
return array(

// Navigation and sections
'profile_menu'					=>	'Profile menu',
'section_essentials'			=>	'Essentials',
'section_personal'				=>	'Personal',
'section_messaging'				=>	'Messaging',
'section_personality'			=>	'Personality',
'section_display'				=>	'Display',
'section_privacy'				=>	'Privacy',
'section_admin'					=>	'Administration',

// Miscellaneous
'contact_details_legend'		=>	'Enter your messaging details',

// Password stuff
'pass_key_bad'					=>	'The specified password activation key was incorrect or has expired. Please re-request a new password. If that fails, contact the forum administrator at',
'pass_updated'					=>	'Your password has been updated. You can now login with your new password.',
'pass_updated_redirect'			=>	'Password updated.',
'wrong_pass'					=>	'Wrong old password.',
'change_pass_legend'			=>	'Enter and confirm your new password',
'old_pass'						=>	'Old password',
'new_pass'						=>	'New password',
'confirm_new_pass'				=>	'Confirm new password',
'pass_info'						=>	'Passwords must be at least 4 characters long. Passwords are case sensitive.',

// Email stuff
'email_key_bad'					=>	'The specified email activation key was incorrect or has expired. Please re-request change of email address. If that fails, contact the forum administrator at',
'email_updated'					=>	'Your email address has been updated.',
'activate_email_sent'			=>	'An email has been sent to the specified address with instructions on how to activate the new email address. If it doesn\'t arrive you can contact the forum administrator at',
'email_legend'					=>	'Enter your new email address',
'email_instructions'			=>	'An email will be sent to your new address with an activation link. You must click the link in the email you receive to activate the new address.',
'change_email'					=>	'Change email address',
'new_email'						=>	'New email',

// Avatar upload stuff
'avatars_disabled'				=>	'The administrator has disabled avatar support.',
'too_large_ini'					=>	'The selected file was too large to upload. The server didn\'t allow the upload.',
'partial_upload'				=>	'The selected file was only partially uploaded. Please try again.',
'no_tmp_directory'				=>	'PHP was unable to save the uploaded file to a temporary location.',
'no_file'						=>	'You did not select a file for upload.',
'bad_type'						=>	'The file you tried to upload is not of an allowed type. Allowed types are gif, jpeg and png.',
'too_wide_or_high'				=>	'The file you tried to upload is wider and/or higher than the maximum allowed',
'too_large'						=>	'The file you tried to upload is larger than the maximum allowed',
'pixels'						=>	'pixels',
'bytes'							=>	'bytes',
'move_failed'					=>	'The server was unable to save the uploaded file. Please contact the forum administrator at',
'unknown_failure'				=>	'An unknown error occurred. Please try again.',
'avatar_upload_redirect'		=>	'Avatar uploaded.',
'avatar_deleted_redirect'		=>	'Avatar deleted.',
'avatar_desc'					=>	'An avatar is a small image that will be displayed under your username in your posts. It must not be any bigger than',
'upload_avatar'					=>	'Upload avatar',
'upload_avatar_legend'			=>	'Enter an avatar file to upload',
'delete_avatar'					=>	'Delete avatar', // only for admins
'file'							=>	'File',
'upload'						=>	'Upload', // submit button

// Form validation stuff
'forbidden_title'				=>	'The title you entered contains a forbidden word. You must choose a different title.',
'profile_redirect'				=>	'Profile updated.',

// Profile essentials stuff
'username_and_pass_legend'		=>	'Enter your username and password',
'username'							=>	'Username',
'change_password'				=>	'Change password',
'email_legend'				=>	'Enter a valid email address',
'email'								=>	'Email',
'send_email'						=>	'Send email',
'localisation_legend'		=>	'Set your localisation options',
'time_zone'					=>	'Time zone',
'time_zone_info'			=>	'For the forum to display times correctly you must select your local time zone. If Daylight Savings Time is in effect you should also check the option provided which will advance times by 1 hour.',
'dst'						=>	'Daylight Savings Time is in effect (advance time by 1 hour).',
'time_format'				=>	'Time format',
'date_format'				=>	'Date format',
'user_activity'					=>	'User activity',
'registered_info'				=>	'Registered: %s',
'last_post_info'				=>	'Last post: %s',
'last_visit_info'				=>	'Last visit: %s',
'posts_info'					=>	'Posts: %s',
'show_posts'					=>	'Show all posts',
'show_topics'					=>	'Show all topics',
'show_subscriptions'			=>	'Show all subscriptions',

// Profile personal stuff
'personal_details_legend'		=>	'Enter your personal details',
'realname'						=>	'Real name',
'title'								=>	'Title',
'location'						=>	'Location',
'website'						=>	'Website',

// Profile display stuff
'users_profile'					=>	'%s\'s profile',
'username_info'					=>	'Username: %s',
'email_info'					=>	'Email: %s',
'invalid_website_url'			=>	'The website URL you entered is invalid.',
'website_not_allowed'			=>	'You are not allowed to add a website to your profile yet.',
'jabber'						=>	'Jabber',
'icq'							=>	'ICQ',
'msn'							=>	'MSN Messenger',
'aol_im'						=>	'AOL IM',
'yahoo'							=>	'Yahoo! Messenger',
'avatar'						=>	'Avatar',
'signature'						=>	'Signature',
'sig_max_size'					=>	'Max length: %s characters / Max lines: %s',
'avatar_legend'					=>	'Set your avatar display options',
'avatar_info'					=>	'An avatar is a small image that will be displayed with all your posts. You can upload an avatar by clicking the link below.',
'change_avatar'					=>	'Change avatar',
'signature_legend'				=>	'Compose your signature',
'signature_info'				=>	'A signature is a small piece of text that is attached to your posts. In it, you can enter just about anything you like. Perhaps you would like to enter your favourite quote or your star sign. It\'s up to you! In your signature you can use BBCode if it is allowed in this particular forum. You can see the features that are allowed/enabled listed below whenever you edit your signature.',
'sig_preview'					=>	'Current signature preview:',
'no_sig'						=>	'No signature currently stored in profile.',
'signature_quote/code/list/h'	=>	'The quote, code, list, and heading BBCodes are not allowed in signatures.',
'topics_per_page'				=>	'Topics',
'posts_per_page'				=>	'Posts',
'pagination_legend'				=>	'Enter your pagination options',
'paginate_info'					=>	'Enter the number of topics and posts you wish to view on each page.',
'leave_blank'					=>	'Leave blank to use forum default.',
'show_smilies'					=>	'Show smilies as graphic icons.',
'show_images'					=>	'Show images in posts.',
'show_images_sigs'				=>	'Show images in user signatures.',
'show_avatars'					=>	'Show user avatars in posts.',
'show_sigs'						=>	'Show user signatures.',
'style_legend'					=>	'Select your preferred style',
'styles'						=>	'Styles',
'admin_note'					=>	'Admin note',
'post_display_legend'			=>	'Set your options for viewing posts',
'post_display_info'				=>	'If you are on a slow connection, disabling these options, particularly showing images in posts and signatures, will make pages load faster.',
'instructions'					=>	'When you update your profile, you will be redirected back to this page.',

// Profile privacy stuff
'options_legend'	=>	'Set your privacy options',
'options_info'		=>	'Select whether you want your email address to be viewable to other users or not and if you want other users to be able to send you email via the forum (form email) or not.',
'email_settings_1'			=>	'Display your email address.',
'email_settings_2'			=>	'Hide your email address but allow form email.',
'email_settings_3'			=>	'Hide your email address and disallow form email.',
'subscription_legend'			=>	'Set your subscription options',
'notify_full'					=>	'Include a plain text version of new posts in subscription notification emails.',
'auto_notify_full'				=>	'Automatically subscribe to every topic you post in.',

// Administration stuff
'group_membership_legend'		=>	'Choose user group',
'save'							=>	'Save',
'set_mods_legend'				=>	'Set moderator access',
'moderator_in_info'				=>	'Choose which forums this user should be allowed to moderate. Note: This only applies to moderators. Administrators always have full permissions in all forums.',
'update_forums'					=>	'Update forums',
'delete_ban_legend'				=>	'Delete (administrators only) or ban user',
'delete_user'					=>	'Delete user',
'ban_user'						=>	'Ban user',
'confirm_delete_legend'			=>	'Important: read before deleting user',
'confirm_delete_user'			=>	'Confirm delete user',
'confirmation_info'				=>	'Please confirm that you want to delete the user', // the username will be appended to this string
'delete_warning'				=>	'Warning! Deleted users and/or posts cannot be restored. If you choose not to delete the posts made by this user, the posts can only be deleted manually at a later time.',
'delete_posts'					=>	'Delete any posts and topics this user has made.',
'delete'						=>	'Delete', // submit button (confirm user delete)
'user_delete_redirect'			=>	'User deleted.',
'group_membership_redirect'		=>	'Group membership saved.',
'update_forums_redirect'		=>	'Forum moderator rights updated.',
'ban_redirect'					=>	'Redirecting …',
'no_delete_admin_message'		=>	'Administrators cannot be deleted. In order to delete this user, you must first move him/her to a different user group.',

);
