<?php

  /*****************************************************
  ** Title........: Guestbook Script Language File
  ** Filename.....: language.de.inc.php (German)
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.2
  ** Notes........: Wenn Sie diese Datei in Ihre Sprache
  **                uebersetzen, wuerden wir uns freuen,
  **                wenn Sie uns die uebersetzte Datei
  **                zukommen lassen koennten.
  ** Last changed.: 2003-12-31 
  ** Last change..:                  
  *****************************************************/



  $txt = array (


                   'txt_charset'                      => 'iso-8859-1',
                   'txt_content_direction'            => 'ltr',
                   'txt_problems'                     => '<p><strong>Auf Probleme gestoßen?</strong> Dokumentation und Installationsanleitung des Scripts: <a href="./docu/index.html" target="_blank">./docu/index.html</a></p><p>Antworten auf Ihre Fragen erhalten Sie auch im <a href="http://www.stadtaus.com/forum/" target="_blank">Support-Forum</a> auf der <a href="http://www.stadtaus.com/" target="_blank">Website des Guestbook Script</a>.</p>',
                   'txt_set_off_note'                 => '<strong>Hinweis:</strong> Sie können die System-Nachrichten abschalten (config.php - <i>$show_error_messages</i>), wenn Sie das Script fertig eingerichtet haben.',
                   'txt_system_message'               => 'System-Nachricht',
                   'txt_wrong_template_path'          => 'Das angegebene Verzeichnis der HTML-Templates konnte nicht gefunden werden. Bitte stellen Sie sicher, dass der Verzeichnis-Pfad zum Template-Ordner (config.php - <i>$path[\'templates\']</i>) korrekt ist.',
                   'txt_wrong_templates'              => 'Folgende HTML-Templates konnten im Template-Verzeichnis nicht gefunden werden. Bitte stellen Sie sicher, dass die Template-Dateien existieren und die Dateinamen korrekt geschrieben wurden (config.php - <i>$file[\'...\']</i>).',

                   'txt_add_entry_failed'             => 'Der Eintrag in das Gästebuch ist fehlgeschlagen.',
                   'txt_admin_interface'              => 'Admin-Bereich',
                   'txt_at'                           => 'um',
                   'txt_author'                       => 'Autor',
                   'txt_by'                           => 'von',
                   'txt_cancel'                       => 'Abbrechen',
                   'txt_comment'                      => 'Kommentar',
                   'txt_date'                         => 'Datum',
                   'txt_delete_entry'                 => 'Eintrag löschen',
                   'txt_display_entries'              => 'Gästebucheinträge anzeigen',
                   'txt_edit_entry'                   => 'Eintrag ändern',
                   'txt_email'                        => 'E-Mail',
                   'txt_entries'                      => 'Einträge',
                   'txt_entry_added'                  => 'Der folgende Text wurde in das Gästebuch eingetragen.',
                   'txt_entry_already_exists'         => 'Der Gästebucheintrag existiert bereits.',
                   'txt_entry_deleted'                => 'Der Eintrag wurde gelöscht',
                   'txt_entry_deletion_failed'        => 'Der Eintrag konnte nicht gelöscht werden.',
                   'txt_entry_not_found'              => 'Der Eintrag konnte nicht gefunden werden.',
                   'txt_entry_updated'                => 'Der Gästebucheintrag wurde aktualisiert.',
                   'txt_first_page'                   => 'Erste Seite',
                   'txt_homepage'                     => 'Homepage',
                   'txt_hostname'                     => 'Hostname',
                   'txt_ip_address'                   => 'IP-Adresse',
                   'txt_last_page'                    => 'Letzte Seite',
                   'txt_location'                     => 'Location',
                   'txt_login'                        => 'Einloggen',
                   'txt_login_welcome'                => 'Sie sind eingeloggt. Ihre Benutzername lautet',
                   'txt_logout'                       => 'Ausloggen',
                   'txt_name'                         => 'Name',
                   'txt_next_page'                    => 'Nächste Seite',
                   'txt_no_entry_selected'            => 'Bitte wählen Sie einen Gästebucheintrag aus.',
                   'txt_no_permission'                => 'Sie haben keine Berechtigung, diese Seite aufzurufen.',
                   'txt_mandatory_fields'             => 'Pflichtfelder',
                   'txt_on'                           => 'am',
                   'txt_page'                         => 'Seite',
                   'txt_page_of'                      => 'von',
                   'txt_posted'                       => 'Eingetragen',
                   'txt_previous_page'                => 'Vorherige Seite',
                   'txt_preview'                      => 'Vorschau',
                   'txt_required_fields'              => 'Bitte füllen Sie folgende(s) Feld(er) aus:',
                   'txt_sign_guestbook'               => 'Ins Gästebuch eintragen',
                   'txt_submit'                       => 'Eintragen',
                   'txt_sure_delete'                  => 'Sind Sie sicher, dass Sie diesen Gästebucheintrag löschen möchten?',
                   'txt_update'                       => 'Aktualisieren',
                   'txt_update_entry'                 => 'Gästebucheintrag aktualisieren',
                   'txt_update_entry_failed'          => 'Die Aktualisierung des Gästebucheintrags ist fehlgeschlagen.',
                   'txt_user_agent'                   => 'User-Agent',
                   'txt_wrong_password'               => 'Das Passwort ist nicht korrekt. Bitte wiederholen Sie Ihre Eingabe.',
                   'txt_wrong_username'               => 'Der Benutzername ist nicht korrekt. Bitte überprüfen Sie Ihre Eingabe.',
                   'txt_yes_sure'                     => 'Ja, ich bin sicher',

                   'txt_access_information'           => 'Stellen Sie bitte sicher, dass Sie die <span style="font-weight:bold;">Zugangsdaten für die Datenbank in die Datei "config.php" ($database) eingetragen</span> haben.',
                   'txt_create_table_successful'      => 'Die Tabelle wurde erfolgreich eingerichtet.',
                   'txt_create_tables'                => 'Möchten Sie die Datenbanktabellen jetzt anlegen?',
                   'txt_create_tables_button'         => 'Ja, Datenbanktabellen einrichten (Hier klicken)',
                   'txt_data'                         => 'Datentabelle',
                   'txt_database'                     => 'Datenbank',
                   'txt_database_host'                => 'Datenbank-Host',
                   'txt_database_host_not_found'      => 'Der Datenbank-Server konnte nicht gefunden werden. Bitte korrigieren Sie den Namen des Datenbank-Servers in der Datei "<i>config.php</i>" - <span class="code">$database[\'host\']</span>.',
                   'txt_database_information'         => 'Datenbank-Informationen',
                   'txt_database_installation'        => 'Datenbank-Installation',
                   'txt_database_name'                => 'Name der Datenbank',
                   'txt_database_not_found'           => 'Die Datenbank konnte nicht gefunden werden. Bitte korrigieren Sie den Namen der Datenbank in der Datei "<i>config.php</i>" - <span class="code">$database[\'name\']</span>.',
                   'txt_database_note'                => 'In diesem Bereich können Sie die Datenbank-Tabellen des Scripts verwalten.',
                   'txt_database_pass'                => 'Passwort',
                   'txt_database_prefix'              => 'Präfix',
                   'txt_database_prefix_note'         => 'Das Präfix soll Ihnen dabei helfen, Ihre bestehenden Datenbank-Tabellen von den Tabellen dieses Scripts zu unterscheiden.',
                   'txt_database_settings_note'       => 'Folgende Datenbank-Informationen wurden in der Datei "<i>config.php</i>" gefunden. Bitte stellen Sie sicher, dass die Daten vollständig sind. Fragen Sie im Zweifel bei Ihrem Webspace-Provider nach und ergänzen Sie die Daten in der Datei "<i>config.php</i>".',
                   'txt_database_tables'              => 'Sollten die folgenden Datenbanktabellen bereits existieren, werden sie gelöscht und neu erstellt. Das Präfix der Tabellennamen können Sie in der Datei "config.php" ändern.',
                   'txt_database_tables_incomplete'   => 'Die Datenbank-Tabellen sind noch nicht vollständig installiert. Sie müssen die Installation im Bereich Datenbank im Admin-Bereich vornehmen, bevor Sie mit dem Script arbeiten können.',
                   'txt_database_tables_note'         => 'Die folgende Übersicht enthält alle vom Script benötigten Datenbank-Tabellen und deren Status. Sollten beim erstmaligen Aufruf dieser Seite bereits installierte Tabellen - möglicherweise von anderen Scripts - in der Liste enthalten sein, sollten Sie die Vorsilbe (Präfix) "<span class="code">$database[\'prefix\']</span>" in der Datei "<i>config.php</i>" ändern, um die Tabellen dieses Scripts eindeutig zu kennzeichnen.',
                   'txt_database_user'                => 'Benutzername',
                   'txt_home'                         => 'Startseite',
                   'txt_install_table'                => 'Tabelle installieren',
                   'txt_login_note'                   => 'Sie sind noch nicht eingeloggt. Bitte geben Sie Ihren Benutzernamen und Ihr Passwort ein.',
                   'txt_no_do_not_remove'             => 'Nein, Tabelle nicht löschen.',
                   'txt_password'                     => 'Passwort',
                   'txt_remove_table_successful'      => 'Die Tabelle wurde erfolgreich gelöscht.',
                   'txt_settings'                     => 'Einstellungen',
                   'txt_sure_delete_table'            => 'Möchten Sie die Tabelle wirklich löschen?',
                   'txt_table_do_not_exist'           => 'Tabelle ist NICHT installiert',
                   'txt_table_exists'                 => 'Tabelle ist installiert',
                   'txt_uninstall_table'              => 'Tabelle löschen',
                   'txt_user_name'                    => 'Benutzername',
                   'txt_yes_remove'                   => 'Ja, Tabelle löschen.'
                   




               );



?>