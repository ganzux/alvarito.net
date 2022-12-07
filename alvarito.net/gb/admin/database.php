<?php

  $runtime_start = explode (" ", microtime ()); 

  /*****************************************************
  ** Title........: Administration Database
  ** Filename.....: database.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.3
  ** Notes........: 
  ** Last changed.: 2004-04-18
  ** Last change..: 
  *****************************************************/

  /*****************************************************
  **
  ** THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
  ** OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
  ** LIMITED   TO  THE WARRANTIES  OF  MERCHANTABILITY,
  ** FITNESS    FOR    A    PARTICULAR    PURPOSE   AND
  ** NONINFRINGEMENT.  IN NO EVENT SHALL THE AUTHORS OR
  ** COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES
  ** OR  OTHER  LIABILITY,  WHETHER  IN  AN  ACTION  OF
  ** CONTRACT,  TORT OR OTHERWISE, ARISING FROM, OUT OF
  ** OR  IN  CONNECTION WITH THE SOFTWARE OR THE USE OR
  ** OTHER DEALINGS IN THE SOFTWARE.
  **
  *****************************************************/





  /*****************************************************
  ** Settings
  *****************************************************/
          $script_root  = './../';
          $script_title = '';




  /*****************************************************
  ** Send safety signal to included files
  *****************************************************/
          define('IN_SCRIPT', 'true');




  /*****************************************************
  ** Include files
  *****************************************************/
          include($script_root . 'inc/common.inc.php');
          include($script_root . 'inc/login.inc.php');
          include($script_root . 'inc/table_check.inc.php');




  /*****************************************************
  ** Display database information
  *****************************************************/
          while (list($key, $val) = each($database))
          {
              if ($key == 'prefix') {
                  $val = strtolower($val);
              }
              
              $database_information[] = array('name'     => $txt['txt_database_' . $key], 
                                              'value'    => $val,
                                              'variable' => '$database[\'' . $key . '\']');
          }




  /*****************************************************
  ** Connect to database server and select database
  *****************************************************/
          //$db = new Database();
          
          if ($db->db_connect($database)) {
              
              if ($db->db_select($database)) {




                  /*****************************************************
                  ** Create table
                  *****************************************************/
                          if (isset($_POST['mode']) and $_POST['mode'] == 'install') {
                              if (isset($_POST['table_name']) and !empty($_POST['table_name'])) {
                                  $table_data = $database_tables[$_POST['table_name']];
                                  $sql = str_replace('{table_name}', $table_data['name'], str_replace('{table_prefix}', strtolower($database['prefix']), $table_data['sql']));
                                  
                                  if ($db->db_query($sql)) {
                                      $table_message[] = array('message' => $txt['txt_create_table_successful']);
                                  } else {
                                      $table_message[] = array('message' => $txt['txt_create_table_failed']);
                                  }
                              }
                          }




                  /*****************************************************
                  ** Remove table
                  *****************************************************/
                          if (isset($_POST['mode']) and $_POST['mode'] == 'uninstall') {
                              if (!isset($_POST['confirm']) and !isset($_POST['cancel'])) {
                                  $table_message[]    = array('message' => $txt['txt_sure_delete_table']);                                  
                                  $confirm_table_name = $database_tables[$_POST['table_name']]['name'];
                                  $confirm_form       = 'TRUE';
                              }
                              
                              if (isset($_POST['confirm']) and isset($_POST['table_name']) and !empty($_POST['table_name'])) {
                                  $sql = "DROP TABLE IF EXISTS " . strtolower($database['prefix']) . $database_tables[$_POST['table_name']]['name'];
                                  
                                  if ($db->db_query($sql)) {
                                      $table_message[] = array('message' => $txt['txt_remove_table_successful']);
                                  } else {
                                      $table_message[] = array('message' => $txt['txt_remove_table_failed']);
                                  }
                              }
                          }



                
                  /*****************************************************
                  ** Get table list and check the existence of the
                  ** script tables (based on the prefix setting in
                  ** config.php and the SQL configuration in 
                  ** sql.inc.php).
                  *****************************************************/
                          $existing_tables = array();
                  
                          if ($result = $db->db_list_tables($database['name'])) {                              
                              while ($data = $db->db_fetch_row($result))
                              {
                                  $existing_tables[] = $data[0];
                              }
                          }
                          
                          
                          $num               = count($existing_tables);                          
                          $status            = $txt['txt_table_do_not_exist'];
                          $disable_install   = '';
                          $disable_uninstall = 'disabled="disabled"';
                          

                          reset($database_tables);
                                                   
                          while (list($key, $val) = each($database_tables))
                          {
                              $current_table = strtolower($database['prefix'] . $val['name']);
                              
                              for ($i = 0; $i < $num; $i++)
                              {
                                  if ($existing_tables[$i] == $current_table) {
                                      $status            = $txt['txt_table_exists'];
                                      $disable_install   = 'disabled="disabled"';
                                      $disable_uninstall = '';
                                      break;
                                  } else {
                                      $status = $txt['txt_table_do_not_exist'];
                                      $disable_install   = '';
                                      $disable_uninstall = 'disabled="disabled"';
                                  }
                              }
                                            
                              $database_table_information[] = array(
                                                                            'name'              => $val['name'],
                                                                            'caption'           => $val['caption'],
                                                                            'full_name'         => $current_table,
                                                                            'status'            => $status,
                                                                            'sql'               => $val['sql'],
                                                                            'disable_install'   => $disable_install,
                                                                            'disable_uninstall' => $disable_uninstall,
                                                                       );
                          }
                  
              } // else {
              //    $message[] = array('message' => $txt['txt_database_not_found'], 'addition' => $txt['txt_database_name'] . ': "' . $database['name'] . '"?');
              //}
              
          } // else {
          //    $message[] = array('message' =>$txt['txt_database_host_not_found'], 'addition' => $txt['txt_database_host'] . ': "' . $database['host'] . '"?');
          //}




  /*****************************************************
  ** Some variables
  *****************************************************/
          $script_self  = $_SERVER['PHP_SELF'];
          $table_prefix = strtolower($database['prefix']);



  /*****************************************************
  ** Initialyze template class
  *****************************************************/
          $tpl = new template;




  /*****************************************************
  ** Load html template
  *****************************************************/
          $tpl->load_file('part', $script_root . $path['templates'] . $file['database']);




  /*****************************************************
  **
  *****************************************************/
          $main_content = $tpl->files['part'];




  /*****************************************************
  ** Load main layout html template
  *****************************************************/
          $tpl->load_file('guest', $script_root . $path['templates'] . $file['main_layout']);
          $tpl->register('guest', 'main_content');
          $tpl->parse('guest');




  /*****************************************************
  ** Parse template
  *****************************************************/
          $tpl->register('guest', 'script_self');
          $tpl->register('guest', 'confirm_table_name');
          $tpl->register('guest', 'table_prefix');

          $tpl->parse_loop('guest', 'message');
          $tpl->parse_loop('guest', 'table_message');
          $tpl->parse_loop('guest', 'database_information');
          $tpl->parse_loop('guest', 'database_table_information');

          $tpl->parse_if('guest', 'logged_in');
          $tpl->parse_if('guest', 'confirm_form');





  /*****************************************************
  ** Register language file and additional text array
  *****************************************************/
          if (isset ($txt) and is_array ($txt)) {
              reset ($txt);
              while(list($key, $val) = each($txt))
              {
                  $$key = $val;
                  $tpl->register('guest', $key);
              }
          }


          if (isset($add_text) and is_array($add_text)) {
              reset ($add_text);
              while(list($key, $val) = each($add_text))
              {
                  $$key = $val;
                  $tpl->register('guest', $key);
              }
          } @eval($conf_var);

          debug_mode(script_runtime($runtime_start), 'Script Runtime');
  
  
  
  
?>

