<?php

  /*****************************************************
  ** Title........: Guestbook Script Language File
  ** Filename.....: language.en.inc.php (English)
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.2
  ** Notes........: If you have translated this language
  **                file we would be happy if you could
  **                send us the file.
  **
  ** Last changed.: 2003-12-18
  ** Last change..:            
  *****************************************************/



  $txt = array (


                   'txt_charset'                      => 'iso-8859-1',
                   'txt_content_direction'            => 'ltr',
                   'txt_problems'                     => '<p><strong>Run into problems?</strong> Script documentation and instructions: <a href="./docu/index.html" target="_blank">./docu/index.html</a></p><p>Get answers to your questions in the <a href="http://www.stadtaus.com/forum/" target="_blank">support forum</a> on the website of the <a href="http://www.stadtaus.com/en/" target="_blank">Guestbook Script</a>.</p>',
                   'txt_set_off_note'                 => '<strong>Note:</strong> Once the script configuration have been finished you can set off the system messages (config.php - <i>$show_error_messages</i>).',
                   'txt_system_message'               => 'System Message',
                   'txt_wrong_template_path'          => 'The HTML template directory could not be found. Please enter the correct directory path in config.php - <i>$path[\'templates\']</i>.',
                   'txt_wrong_templates'              => 'Following HTML templates could not be found. Please make sure the files exist in the template folder or correct the file names in config.php - <i>$file[\'...\']</i>.',

                   'txt_add_entry_failed'             => 'Save guestbook entry failed.',
                   'txt_admin_interface'              => 'Admin Area',
                   'txt_at'                           => 'at',
                   'txt_author'                       => 'Author',
                   'txt_by'                           => 'by',
                   'txt_cancel'                       => 'Cancel',
                   'txt_comment'                      => 'Comment',
                   'txt_date'                         => 'Date',
                   'txt_delete_entry'                 => 'Delete entry',
                   'txt_display_entries'              => 'Display guestbook entries',
                   'txt_edit_entry'                   => 'Edit entry',
                   'txt_email'                        => 'E-mail',
                   'txt_entries'                      => 'Entries',
                   'txt_entry_added'                  => 'The following guestbook entry has been made.',
                   'txt_entry_already_exists'         => 'This guestbook entry already exists.',
                   'txt_entry_deleted'                => 'Delete entry successful.',
                   'txt_entry_deletion_failed'        => 'Delete entry failed.',
                   'txt_entry_not_found'              => 'Entry not found.',
                   'txt_entry_updated'                => 'The guestbook entry has been updated.',
                   'txt_first_page'                   => 'First page',
                   'txt_homepage'                     => 'Homepage',
                   'txt_hostname'                     => 'Hostname',
                   'txt_ip_address'                   => 'IP Address',
                   'txt_last_page'                    => 'Last page',
                   'txt_location'                     => 'Location',
                   'txt_login'                        => 'Login',
                   'txt_login_welcome'                => 'You are logged in. Your Username is',
                   'txt_logout'                       => 'Logout',
                   'txt_name'                         => 'Name',
                   'txt_next_page'                    => 'Next Page',
                   'txt_no_entry_selected'            => 'Please select a guestbook entry.',
                   'txt_no_permission'                => 'You don\'t have permission to access this page.',
                   'txt_mandatory_fields'             => 'Required fields',
                   'txt_on'                           => 'on',
                   'txt_page'                         => 'Page',
                   'txt_page_of'                      => 'of',
                   'txt_posted'                       => 'Posted',
                   'txt_previous_page'                => 'Previous Page',
                   'txt_preview'                      => 'Preview',
                   'txt_required_fields'              => 'Please fill in following field(s):',
                   'txt_sign_guestbook'               => 'Sign guestbook',
                   'txt_submit'                       => 'Submit',
                   'txt_sure_delete'                  => 'Are you sure you want to delete this guestbook entry?',
                   'txt_update'                       => 'Update',
                   'txt_update_entry'                 => 'Update guestbook entry',
                   'txt_update_entry_failed'          => 'Update guestbook entry failed.',
                   'txt_user_agent'                   => 'User Agent',
                   'txt_wrong_password'               => 'Password incorrect. Please retry.',
                   'txt_wrong_username'               => 'Username incorrect. Please retry.',
                   'txt_yes_sure'                     => 'Yes, I am sure',

                   'txt_access_information'           => 'Please make sure you have entered the <span style="font-weight:bold;">MySQL database access data in the file "config.php" ($database)</span>.',
                   'txt_create_table_successful'      => 'Table successfully created.',
                   'txt_create_tables'                => 'Do you want to create the database tables?',
                   'txt_create_tables_button'         => 'Yes, create database tables (Click here)',
                   'txt_data'                         => 'Data table',
                   'txt_database'                     => 'Database',
                   'txt_database_host'                => 'Database host',
                   'txt_database_host_not_found'      => 'Could not find database server. Please enter the correct hostname of the database server in the configuration file "<i>config.php</i>" - <span class="code">$database[\'host\']</span>.',
                   'txt_database_information'         => 'Database information',
                   'txt_database_installation'        => 'Database installation',
                   'txt_database_name'                => 'Database name',
                   'txt_database_not_found'           => 'Could not find database. Please enter the correct database name in the configuration file "<i>config.php</i>" - <span class="code">$database[\'name\']</span>.',
                   'txt_database_note'                => 'This area is for database table installation.',
                   'txt_database_pass'                => 'Password',
                   'txt_database_prefix'              => 'Prefix',
                   'txt_database_prefix_note'         => 'To tell apart the guestbook script tables from the existing ones you can add a prefix to the database table names.',
                   'txt_database_settings_note'       => 'Following database information could be found in "<i>config.php</i>".  Please make sure, that these data are complete. Ask your webspace provider for these data and enter it in the file "<i>config.php</i>".',
                   'txt_database_tables'              => 'In case the following database tables already exist they will be deleted. The prefix of the table names can be edited in the file "config.php".',
                   'txt_database_tables_incomplete'   => 'The database tables have not been created completely. You need to install the tables on the database page in the admin area, until you can use the script.',
                   'txt_database_tables_note'         => 'Following list contains all database tables needed by the script and their status. Should this list allready contain installed tables after the first call - maybe used by other scripts - you should change the prefix "<span class="code">$database[\'prefix\']</span>" in the file "<i>config.php</i>", to make the table names unique.',
                   'txt_database_user'                => 'Username',
                   'txt_home'                         => 'Home',
                   'txt_install_table'                => 'Install table',
                   'txt_login_note'                   => 'You are not logged in. Please enter username and password.',
                   'txt_no_do_not_remove'             => 'No, do not delete table.',
                   'txt_password'                     => 'Password',
                   'txt_remove_table_successful'      => 'Die Tabelle wurde erfolgreich gelöscht.',
                   'txt_settings'                     => 'Settings',
                   'txt_sure_delete_table'            => 'Do you really want to delete the table?',
                   'txt_table_do_not_exist'           => 'Table is NOT installed',
                   'txt_table_exists'                 => 'Table IS installed',
                   'txt_uninstall_table'              => 'Delete table',
                   'txt_user_name'                    => 'Username',
                   'txt_yes_remove'                   => 'Yes, delete table.'



                   

               );



?>