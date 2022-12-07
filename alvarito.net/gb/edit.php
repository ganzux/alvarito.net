<?php

  /*****************************************************
  ** Title........: Guestbook Script
  ** Filename.....: edit.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.8
  ** Notes........:
  ** Last changed.: 2004-02-02
  ** Last change..: Method required fields 
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




  /*****************************************************
  ** Initialyze template class
  *****************************************************/
          $tpl = new template;




  /*****************************************************
  ** Load html template
  *****************************************************/
          $tpl->load_file('form', $script_root . $path['templates'] . $file['form_detail']);




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
          if (isset($_SESSION['login_status']) and $_SESSION['login_status'] == 'IN') {
              $logged_in = 'true';
          } else {
              $message[] = array('message' => $txt['txt_no_permission'], 'addition' => '');

              unset($show_form);
          }




  /*****************************************************
  ** Check for id in get and post parameter
  *****************************************************/
          if (isset($_GET['id']) and !empty($_GET['id'])) {
              $entry_id = $_GET['id'];
          }

          if (isset($_POST['entry_id']) and !empty($_POST['entry_id'])) {
              $entry_id = $_POST['entry_id'];
          }

          if (!isset($message) and !isset($entry_id)) {
              $message[] = array('message' => $txt['txt_no_entry_selected'], 'addition' => '');

              unset($show_form);
          }




  /*****************************************************
  ** Initialyze database class
  *****************************************************/
          $db = new Database;




  /*****************************************************
  ** Connect to and select database
  *****************************************************/
          $db->db_connect($database);
          $db->db_select($database);




  /*****************************************************
  ** Select entry from database
  *****************************************************/
           // if (!isset($message) and empty($_POST)) {
           if (!isset($message)) {




              /*****************************************************
              ** Select content
              *****************************************************/

                      $sql = "SELECT t1.*, t2.* FROM " . ENTRY_TABLE . " AS t1, " . DATA_TABLE . " AS t2 WHERE t1.entry_id = " . $entry_id . " AND t2.entry_id = t1.entry_id";
                      
                      if ($search_result = $db->db_search_entries($sql)) {

                          //print_a($search_result);

                          while(list($key, $val) = each($search_result))
                          {
                              if (!isset($new_search_result[$val['entry_id']])) {
                                  $new_search_result[$val['entry_id']] = array();
                              }

                              if (!isset($new_search_result[$val['entry_id']]['id'])) {
                                  $new_search_result[$val['entry_id']]['id'] = $val['entry_id'];
                              }

                              $new_search_result[$val['entry_id']][$val['data_name']] = $val['data_content'];
                          }

                          //print_a($new_search_result);
                          //$new_search_result = data_loop($search_result, 'entry_id', 'true');
                          //print_a($new_search_result);
                          
                          $guestbook_entry = array_values($new_search_result);

                      } else {
                          $message[] = array('message' => $txt['txt_entry_not_found'], 'addition' => '');
                      }
           }





  /*****************************************************
  ** Initialyze form field class
  *****************************************************/
          $form = new Formfields;




  /*****************************************************
  ** Load form field templates into object
  *****************************************************/
          $form->define_form('edit', $new_form_fields);




  /*****************************************************
  ** Generate form fields
  *****************************************************/
          $form_content = '';
          
          if (isset($guestbook_entry)) {
              $form_content = $guestbook_entry[0];
          }

          if (!empty($_POST)) {
              $form_content = $_POST;
          }

          $form->generate_form_fields('edit', $form_content);




  /*****************************************************
  ** Parse form fields in template
  *****************************************************/
          $form_detail = $form->parse_template('edit', $tpl->files['form']);




  /*****************************************************
  ** Add data to database
  *****************************************************/
          if (isset($_POST) and !empty($_POST)) {




              /*****************************************************
              ** Generate additional form data
              *****************************************************/
                      $ip_address = getenv('REMOTE_ADDR');

                      $additional_form_data = array(
                                                    'admin_info' => '',
                                                    'id'         => '',
                                                    'timestamp'  => $guestbook_entry[0]['timestamp'],
                                                    'ip_address' => $guestbook_entry[0]['ip_address'],
                                                    'hostname'   => gethostbyaddr($guestbook_entry[0]['ip_address']),
                                                    'user_agent' => $guestbook_entry[0]['user_agent'],
                                                    'rowclass'   => 'darkrow'
                                               );

                      $form_data = array_merge($_POST, $additional_form_data);

                      $entry_date = date_elements($guestbook_entry[0]['timestamp']);

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
                      if ($required_fields = $form->required_fields('edit', $_POST)) {
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

                                  // $field_list = array_merge($field_list, array('timestamp', 'ip_address', 'hostname', 'user_agent'));


                                  if ($db->update_details($field_list, $form_data, $entry_id)) {
                                      $message[]           = array('message' => $txt['txt_entry_updated'], 'addition' => '');
                                      $guestbook_entries[] = $html_form_data;

                                      unset($show_form);
                                  } else {
                                      $message[] = array('message' => $txt['txt_update_entry_failed'], 'addition' => '');
                                  }




                      }




          }




  /*****************************************************
  ** Get emoticon matrix
  *****************************************************/
          $emoticon_matrix = emoticon_list($smiley);




  /*****************************************************
  ** Read and register offset value
  *****************************************************/
          if (isset($_GET['offset']) and !empty($_GET['offset'])) {
              $offset = $_GET['offset'];
          }

          if (isset($_POST['offset']) and !empty($_POST['offset'])) {
              $offset = $_POST['offset'];
          }




  /*****************************************************
  ** Load html template
  *****************************************************/
          $tpl->load_file('guest', $script_root . $path['templates'] . $file['edit_form']);

          $main_content = $tpl->files['guest'];




  /*****************************************************
  ** Load main layout html template
  *****************************************************/
          $tpl->load_file('main', $script_root . $path['templates'] . $file['main_layout']);
          $tpl->register('main', 'main_content');
          $tpl->parse('main');

          $tpl->files['guest'] = $tpl->files['main'];




  /*****************************************************
  ** Load entry detail html template
  *****************************************************/
          $tpl->load_file('detail', $script_root . $path['templates'] . $file['entry_detail']);
          $tpl->parse_loop('detail', 'guestbook_entries');

          $entry_detail = $tpl->files['detail'];




  /*****************************************************
  ** Parse template
  *****************************************************/
          $tpl->register('guest', array('entry_id', 'offset', 'entry_detail', 'form_detail', 'emoticon_matrix'));

          $tpl->parse_loop('guest', 'message');
          $tpl->parse_loop('guest', 'guestbook_entries');

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