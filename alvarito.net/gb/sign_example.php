<?php

  /*****************************************************
  ** Title........: Guestbook Script
  ** Filename.....: sign_example.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.1
  ** Notes........:              
  ** Last changed.: 2004-04-04
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
          $script_root  = './';
          $script_title = '';
          $show_form    = 'true';




  /*****************************************************
  ** Send safety signal to included files
  *****************************************************/
          define('IN_SCRIPT', 'true');





  /*****************************************************
  ** Include form field class
  *****************************************************/
          include($script_root . 'inc/common.inc.php');
          include($script_root . 'inc/table_check.inc.php');
          include($script_root . 'form_config_example.php');




  /*****************************************************
  ** Initialyze template class
  *****************************************************/
          $tpl = new template;




  /*****************************************************
  ** Load html template
  *****************************************************/
          $tpl->load_file('form', $script_root . $path['templates'] . $file['example_form']);




  /*****************************************************
  ** Prevent appending session id
  *****************************************************/
          $sid_name = session_name();
          
          if ((isset($_GET[$sid_name]) and $trans_sid != 'no') or isset($_COOKIE[$sid_name])) {
              session_start();
          }




  /*****************************************************
  ** Check for logged-in users
  *****************************************************/
          if (isset($_SESSION['login_status']) and $_SESSION['login_status'] == 'true') {
              $logged_in = 'true';
          }





  /*****************************************************
  ** Initialyze form field class
  *****************************************************/
          $form = new Formfields;




  /*****************************************************
  ** Load form field templates into object
  *****************************************************/
          $form->define_form('sign', $example_form_fields);




  /*****************************************************
  ** Generate form fields
  *****************************************************/
          if (isset($_POST)) {
              $post_data = $_POST;
          } else {
              $post_data = '';
          }
          
          $form->generate_form_fields('sign', $post_data);




  /*****************************************************
  ** Parse form fields in template
  *****************************************************/
          $form_detail = $form->parse_template('sign', $tpl->files['form']);




  /*****************************************************
  ** Initialyze database class
  *****************************************************/
          $db = new Database;




  /*****************************************************
  ** Connect and select database
  *****************************************************/
          if (isset($message) and $db->db_connect($database)) {
              if ($db->db_select($database)) {



                
                  /*****************************************************
                  ** Add data to database
                  *****************************************************/
                          if (isset($_POST) and !empty($_POST)) {
                
                
                
                
                              /*****************************************************
                              ** Generate additional form content
                              *****************************************************/
                                      $ip_address = getenv('REMOTE_ADDR');
                
                                      $additional_form_data = array(
                                                                    'admin_info' => '',
                                                                    'id'         => '',
                                                                    'timestamp'  => mktime(),
                                                                    'ip_address' => $ip_address,
                                                                    'hostname'   => gethostbyaddr($ip_address),
                                                                    'user_agent' => getenv('HTTP_USER_AGENT'),
                                                                    'rowclass'   => 'darkrow'
                                                               );
                
                                      $form_data = array_merge($_POST, $additional_form_data);
                
                
                
                
                                      /*****************************************************
                                      ** Create full text information for flood protection
                                      *****************************************************/
                                              $full_text = $form_data;
                
                                              unset($full_text['timestamp']);
                
                                              $full_text = join(' ', $full_text);
                
                
                
                                      $entry_date = date_elements(mktime());
                
                                      while (list($element, $element_value) = each($entry_date))
                                      {
                                          if (!isset($form_data[$element])) {
                                              $form_data[$element] = $element_value;
                                          }
                                      }
                
                
                
                
                              /*****************************************************
                              ** Handle output
                              *****************************************************/
                                      while (list($key, $val) = each($form_data))
                                      {
                                          $val      = clean_output($val);
                                          $temp_val = explode(' ', $val);
                                          $temp_val = array_map('add_space', $temp_val);
                                          $temp_val = array_map('emoticons', $temp_val);
                                          
                                          $html_form_data['modified:' . $key] = nl2br(join(' ' , $temp_val));
                                          $html_form_data[$key]             = nl2br($val);
                                      }
                
                                      
                
                
                              /*****************************************************
                              ** Check required fields
                              *****************************************************/
                                      if ($required_fields = $form->required_fields('sign', $_POST)) {
                                          if ($required_fields[0] == 'true') {
                                              $message[] = array('message' => $txt['txt_required_fields'], 'addition' => join('<br />', $required_fields[1]));
                                          }
                                      }
                
                
                
                
                              /*****************************************************
                              ** In case no error occured display entry preview
                              *****************************************************/
                                      if (!isset($message) and isset($_POST['preview'])) {
                                          $message[]           = array('message' => $txt['txt_preview'], 'addition' => '');
                                          $guestbook_entries[] = $html_form_data;
                                      }
                
                
                
                              /*****************************************************
                              ** Flood protection
                              *****************************************************/
                                      if (!isset($message) and isset($_POST['send'])) {
                                          $sql = "SELECT full_text FROM " . ENTRY_TABLE . " WHERE full_text = '" . addslashes($full_text) . "'";
                
                                          if ($flood_result = $db->db_search_entries($sql)) {
                
                                              $message[] = array('message' => $txt['txt_entry_already_exists'], 'addition' => '');
                
                                          }
                                      }
                
                
                
                
                              /*****************************************************
                              ** In case no error occured write data to database
                              *****************************************************/
                                      if (!isset($message) and isset($_POST['send'])) {
                
                
                
                
                                          /*****************************************************
                                          ** Write data to database
                                          *****************************************************/
                                                  while (list($key, $val) = each($new_form_fields))
                                                  {
                                                      $field_list[] = $val['name'];
                                                  }
                
                                                  $field_list = array_merge($field_list, array('timestamp', 'ip_address', 'hostname', 'user_agent'));
                
                
                                                  if ($db->add_details($field_list, $form_data, $full_text)) {
                                                      $message[]           = array('message' => $txt['txt_entry_added'], 'addition' => '');
                                                      $guestbook_entries[] = $html_form_data;
                
                                                      unset($show_form);
                                                  } else {
                                                      $message[] = array('message' => $txt['txt_add_entry_failed'], 'addition' => '');
                                                  }
                
                
                
                
                                      }
                
                
                
                
                          }



            
              /*****************************************************
              ** Add data to database
              *****************************************************/
              }
          }




  /*****************************************************
  ** Get emoticon matrix
  *****************************************************/
          $emoticon_matrix = emoticon_list($smiley);





  /*****************************************************
  ** Load entry detail html template
  *****************************************************/
          $tpl->load_file('detail', $script_root . $path['templates'] . $file['entry_detail']);
          $tpl->parse_loop('detail', 'guestbook_entries');

          $entry_detail = $tpl->return_file('detail');




  /*****************************************************
  ** Load html template
  *****************************************************/
          $tpl->load_file('guest', $script_root . $path['templates'] . $file['sign_form']);

          $main_content = $tpl->return_file('guest');




  /*****************************************************
  ** Load main layout html template
  *****************************************************/
          $tpl->load_file('main', $script_root . $path['templates'] . $file['main_layout']);
          $tpl->register('main', 'main_content');
          $tpl->parse('main');

          $tpl->files['guest'] = $tpl->return_file('main');


  /*****************************************************
  ** Parse template
  *****************************************************/
          $tpl->register('guest', array('entry_detail', 'form_detail', 'emoticon_matrix'));
          $tpl->parse_loop('guest', 'message');

          $tpl->parse_if('guest', 'logged_in');
          $tpl->parse_if('guest', 'show_form');




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