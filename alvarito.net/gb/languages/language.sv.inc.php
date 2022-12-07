<?php

  /*****************************************************
  ** Title........: Guestbook Script Language File
  ** Filename.....: language.sv.inc.php (Swedish)
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.1
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
                   'txt_problems'                     => '<p><strong>Stöter du på problem?</strong> Dokumentation och instruktioner: <a href="./docu/index.html" target="_blank">./docu/index.html</a></p><p>Få svar på dina frågor hos<a href="http://www.stadtaus.com/forum/" target="_blank">support forum</a> på Gästbokens hemsida <a href="http://www.stadtaus.com/en/" target="_blank">Gästboks script</a>.</p>',
                   'txt_set_off_note'                 => '<strong>Note:</strong> När du konfigurerat scriptet färdigt kan du ta bort systemmeddelandet i (config.php - <i>$show_error_messages</i>).',
                   'txt_system_message'               => 'System Message',
                   'txt_wrong_template_path'          => 'HTML mallarnas sökväg kunde inte hittas. Var snäll och ange rätt sökväg i config.php - <i>$path[\'templates\']</i>.',
                   'txt_wrong_templates'              => 'Följande HTML mallar kunde inte hittas. Förvissa dig om att filerna finns i foldern template eller korrigera filnmnen i config.php - <i>$file[\'...\']</i>.',

                   'txt_add_entry_failed'             => 'Misslyckades att spara inlägget.',
                   'txt_admin_interface'              => 'Aministration',
                   'txt_at'                           => 'at',
                   'txt_author'                       => 'Författare',
                   'txt_by'                           => 'by',
                   'txt_cancel'                       => 'Avbryt',
                   'txt_comment'                      => 'Kommentar',
                   'txt_date'                         => 'Datum',
                   'txt_delete_entry'                 => 'Ta bort inlägget',
                   'txt_display_entries'              => 'Läs i Gästboken',
                   'txt_edit_entry'                   => 'Redigera inlägg',
                   'txt_email'                        => 'E-mail',
                   'txt_entries'                      => 'Inlägg',
                   'txt_entry_added'                  => 'Följande inlägg har gjorts i Gästboken.',
                   'txt_entry_already_exists'         => 'Denna Gästbok finns redan.',
                   'txt_entry_deleted'                => 'Inlägget borttaget.',
                   'txt_entry_deletion_failed'        => 'Borttagningen misslyckades.',
                   'txt_entry_not_found'              => 'Inlägget hittades inte.',
                   'txt_entry_updated'                => 'Inlägget har blivit uppdaterat.',
                   'txt_first_page'                   => 'Första sidan',
                   'txt_homepage'                     => 'Hemsida',
                   'txt_hostname'                     => 'Värdnamn',
                   'txt_ip_address'                   => 'IP Address',
                   'txt_last_page'                    => 'Sista sidan',
                   'txt_location'                     => 'Hemort',
                   'txt_login'                        => 'Login',
                   'txt_login_welcome'                => 'Du är inloggad. Ditt användarnamn är',
                   'txt_logout'                       => 'Logout',
                   'txt_name'                         => 'Namn',
                   'txt_next_page'                    => 'Nästa sida',
                   'txt_no_entry_selected'            => 'Välj ett Gästboksinlägg.',
                   'txt_no_permission'                => 'You don\'t have permission to access this page.',
                   'txt_mandatory_fields'             => 'Obligatoriska fält',
                   'txt_on'                           => 'on',
                   'txt_page'                         => 'Sida',
                   'txt_page_of'                      => 'av',
                   'txt_posted'                       => 'Postat',
                   'txt_previous_page'                => 'Föregående sida',
                   'txt_preview'                      => 'Förhandsgranska',
                   'txt_required_fields'              => 'Var vänlig fyll i följande fält:',
                   'txt_sign_guestbook'               => 'Skriv i Gästboken',
                   'txt_submit'                       => 'Skicka',
                   'txt_sure_delete'                  => 'Är du säker på att du vill ta bort Gästboksinlägget?',
                   'txt_update'                       => 'Uppdatera',
                   'txt_update_entry'                 => 'Uppdatera GästboksinläggetUpdate guestbook entry',
                   'txt_update_entry_failed'          => 'Uppdateringen av Gästboken misslyckades.',
                   'txt_user_agent'                   => 'Användaragent',
                   'txt_wrong_password'               => 'Felaktigt lösenord. Försök igen.',
                   'txt_wrong_username'               => 'Användarnamn ogilltigt.Försök igen.',
                   'txt_yes_sure'                     => 'Ja jag är säker',

                   'txt_access_information'           => 'Försäkra dig om att du lagt in koderna i<span style="font-weight:bold;">MySQL databas access i filen "config.php" ($database)</span>.',
                   'txt_create_table_successful'      => 'Table successfully created.',
                   'txt_create_tables'                => 'Vill du skapa databasfilerna?',
                   'txt_create_tables_button'         => 'Ja, skapa databasen (Klicka Här)',
                   'txt_data'                         => 'Data table',
                   'txt_database'                     => 'Database',
                   'txt_database_host'                => 'Database host',
                   'txt_database_host_not_found'      => 'Could not find database server. Please enter the correct hostname of the database server in the configuration file "<i>config.php</i>" - <span class="code">$database[\'host\']</span>.',
                   'txt_database_information'         => 'Database information',
                   'txt_database_installation'        => 'Databasinstallation',
                   'txt_database_name'                => 'Database name',
                   'txt_database_not_found'           => 'Could not find database. Please enter the correct database name in the configuration file "<i>config.php</i>" - <span class="code">$database[\'name\']</span>.',
                   'txt_database_note'                => 'This area is for database table installation.',
                   'txt_database_pass'                => 'Password',
                   'txt_database_prefix'              => 'Prefix',
                   'txt_database_prefix_note'         => 'To tell apart the guestbook script tables from the existing ones you can add a prefix to the database table names.',
                   'txt_database_settings_note'       => 'Following database information could be found in "<i>config.php</i>".  Please make sure, that these data are complete. Ask your webspace provider for these data and enter it in the file "<i>config.php</i>".',
                   'txt_database_tables'              => 'I det fall databasfilerna allaredan existerar så kommer de att raderas. Tabellernas prefix kan ändras i filen "config.php".',
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