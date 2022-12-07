<?php

  /*****************************************************
  ** Title........: Guestbook Script
  ** Filename.....: index.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.9
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
          $query_string = '?';




  /*****************************************************
  ** Send safety signal to included files
  *****************************************************/
          define('IN_SCRIPT', 'true');




  /*****************************************************
  ** Include files
  *****************************************************/
          include($script_root . 'inc/common.inc.php');
          include($script_root . 'inc/table_check.inc.php');




  /*****************************************************
  ** Set file name
  *****************************************************/
          $file_name    = basename($_SERVER['PHP_SELF']);





  /*****************************************************
  ** Initialyze form field class
  *****************************************************/
          $form = new Formfields;




  /*****************************************************
  ** Load form field templates into object
  *****************************************************/
          $form->define_form('sign', $new_form_fields);

          


  /*****************************************************
  ** Initialyze template class
  *****************************************************/
          $tpl = new template;




  /*****************************************************
  ** Prevent appending session id
  *****************************************************/
          $sid_name = session_name();
          
          if ((isset($_GET[$sid_name]) and $trans_sid != 'no') or isset($_COOKIE[$sid_name])) {
              session_start();
          }
          



  /*****************************************************
  ** Load admin html template
  *****************************************************/
          if (isset($_SESSION['login_status']) and $_SESSION['login_status'] == 'IN') {
              $tpl->load_file('admin', $script_root . $path['templates'] . $file['admin_details']);

              $admin_template = $tpl->files['admin'];
              $logged_in      = 'true';
          } else {
              $admin_template = '';
          }




  /*****************************************************
  ** Validate query string and set offset value.
  *****************************************************/
          if (isset($_GET['offset']) and !empty($_GET['offset']) and preg_match("/^[0-9]*$/", $_GET['offset'])) {
              $currentpage = $_GET['offset'];
          } else {
              $currentpage = 1;
          }




  /*****************************************************
  ** Initialyze database class
  *****************************************************/
          $db = new Database;




  /*****************************************************
  ** Connect and select database
  *****************************************************/
          if (!isset($message) and $db->db_connect($database)) {
              
              if ($db->db_select($database)) {




                  /*****************************************************
                  ** Count results
                  *****************************************************/
                          $sql = "SELECT COUNT(entry_id) FROM " . ENTRY_TABLE;
                
                          if ($result_number = $db->db_count_result($sql)) {
                              $result_true   = 'true';
                              $entries       = $result_number;
                
                
                              if (!isset($results_per_page) or empty($results_per_page)) {
                                  $limit = $result_number;
                              } else {
                                  $limit = $results_per_page;
                              }
                
                              $allpages = ceil($result_number / $limit);
                
                
                              if (isset($currentpage) and !empty($currentpage)) {
                                  $start = $result_number - $currentpage * $limit;
                              } else {
                                  $start = $result_number;
                              }
                
                              if ($start < 0) {
                                  $limit       = $result_number - ($allpages - 1) * $limit;
                                  $start       = 0;
                                  $currentpage = $allpages;
                              }
                
                
                
                
                      /*****************************************************
                      ** Set offset value for template (mainly for delete
                      ** and edit entry link in admin template
                      *****************************************************/
                              $offset = $currentpage;
                
                
                
                
                
                      /*****************************************************
                      ** Browse pages - next - previous link
                      *****************************************************/
                              if ($start < $result_number - $limit) {
                                  $previous_start = $currentpage - 1;
                                  $previous_result_page = 'true ';
                              } else {
                                  $previous_result_page = '';
                              }
                
                
                              if ($start > 0) {
                                  $next_start = $currentpage + 1;
                                  $next_result_page = 'true';
                              } else {
                                  $next_result_page = '';
                              }
                
                
                
                      /*****************************************************
                      ** Pre-select results
                      *****************************************************/
                              $sql = "SELECT entry_id FROM " . ENTRY_TABLE . " LIMIT " . $start . ", " . $limit;
                
                
                              if ($result_range = $db->db_search_entries($sql)) {
                
                                  $between_start = $result_range[0]['entry_id'];
                                  $between_end   = $result_range[count($result_range)-1]['entry_id'];
                
                                  $id_range = " AND t1.entry_id BETWEEN " . $between_start . " AND " . $between_end;
                
                              } else {
                                  $id_range = '';
                              }
                
                
                
                
                      /*****************************************************
                      ** Select content
                      *****************************************************/
                              $sql = "SELECT t1.*, t2.* FROM " . ENTRY_TABLE . " AS t1, " . DATA_TABLE . " AS t2 WHERE t2.entry_id = t1.entry_id " . $id_range . " ORDER BY t1.entry_id DESC";
                
                              if ($search_result = $db->db_search_entries($sql)) {
                
                                  $new_search_result = data_loop($search_result, 'entry_id', 'true');
                                  $guestbook_entries = array_values($new_search_result);
                
                              }
                
                
                
                
                      /*****************************************************
                      ** Apply row class
                      *****************************************************/
                              while (list($key, $val) = each($guestbook_entries))
                              {
                                  if (!isset($rowclass) or $rowclass == 'lightrow') {
                                      $rowclass = 'darkrow';
                                  } else {
                                      $rowclass = 'lightrow';
                                  }
                
                                  $guestbook_entries[$key]['rowclass'] = $rowclass;
                              }
                
                
                
                
                      /*****************************************************
                      ** Page statistics
                      *****************************************************/
                              // $currentpage = ceil($start / $results_per_page) + 1;
                
                
                
                
                      /*****************************************************
                      ** Generate direct page link menu
                      *****************************************************/
                              $pagelink = 0;
                              $i        = 1;
                
                              if ($allpages > 1) {
                
                                  while ($i <= $allpages) {
                
                                      if ($i == $currentpage) {
                                          $link_class = 'currentpage';
                                      } else {
                                          $link_class = 'allpages';
                                      }
                
                                      $page_direct[] = array('page'       => $i++,
                                                             'link'       => $pagelink,
                                                             'file_name'  => $file_name,
                                                             'link_class' => $link_class);
                
                                      $pagelink += $results_per_page;
                                  }
                              }
                
                              $start_link = 1;
                              $end_link   = $allpages;
                
                
                
                
                      /*****************************************************
                      ** Cut off oversized direct page links
                      *****************************************************/
                              if (isset($direct_page_links) and !empty($direct_page_links) and isset($page_direct) and count($page_direct) > $direct_page_links) {
                
                                  $half_offset = ceil($direct_page_links / 2 );
                                  $offset_end  = $allpages - $direct_page_links;
                
                                  if ($currentpage <= $half_offset) {
                                      $start_element = 0;
                                  }
                
                                  if (!isset($start_element) and $currentpage > $half_offset and ($currentpage - $half_offset) < $offset_end) {
                                      $start_element = $currentpage - $half_offset;
                                      $page_link_start = 'true';
                                  }
                
                                  if (!isset($start_element) and $currentpage >= $offset_end) {
                                      $start_element = $offset_end;
                                      $page_link_start = 'true';
                                  } else {
                                      $page_link_end = 'true';
                                  }
                
                                  if (isset($start_element)) {
                                      $page_direct = array_slice($page_direct, $start_element, $direct_page_links);
                                  }
                              }
                
                
                
                          } else {
                              $result_number = 0;
                          }




              /*****************************************************
              ** End database connect select if
              *****************************************************/          
              }
          }




  /*****************************************************
  ** Load part html template
  *****************************************************/
          $tpl->load_file('guest', $script_root . $path['templates'] . $file['entries']);

          $main_content = $tpl->return_file('guest');




  /*****************************************************
  ** Load main layout html template
  *****************************************************/
          $tpl->load_file('main', $script_root . $path['templates'] . $file['main_layout']);
          $tpl->register('main', 'main_content');
          $tpl->parse('main');
          
          $tpl->files['guest'] = $tpl->return_file('main');




  /*****************************************************
  ** Load entry detail html template
  *****************************************************/
          $tpl->load_file('detail', $script_root . $path['templates'] . $file['entry_detail']);
          $tpl->parse_loop('detail', 'guestbook_entries');

          $entry_detail = $tpl->return_file('detail');

          $tpl->register('guest', 'entry_detail');




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
          }




  /*****************************************************
  ** Parse template
  *****************************************************/
          $tpl->register('guest', array('query_string',
                                         'previous_start',
                                         'next_start',
                                         'file_name',
                                         'allpages',
                                         'currentpage',
                                         'start_link',
                                         'end_link',
                                         'offset',
                                         'entries'
                                         ));

          $tpl->parse_loop('guest', 'message');

          $tpl->parse_if('guest', 'previous_result_page');
          $tpl->parse_if('guest', 'next_result_page');
          $tpl->parse_if('guest', 'page_link_end');
          $tpl->parse_if('guest', 'page_link_start');
          $tpl->parse_if('guest', 'logged_in');
          $tpl->parse_loop('guest', 'page_direct'); @eval($conf_var);

          debug_mode(script_runtime($runtime_start), 'Script Runtime');




?>