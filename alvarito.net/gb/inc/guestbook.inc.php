<?php

  /*****************************************************
  ** Title........: Guestbook Script
  ** Filename.....: guestbook.inc.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.7
  ** Notes........:
  ** Last changed.: 2004-01-17
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
  ** Prevent direct call
  *****************************************************/
          if (!defined('IN_SCRIPT')) {
              die();
          }




  /*****************************************************
  ** Strip slashes from input data
  *****************************************************/
          if (!empty($_POST)) {
              while (list($key, $val) = each($_POST))
              {
                  $_POST[$key] = stripslashes($val);
              }
          }




  /*****************************************************
  ** Add white spaces
  *****************************************************/
          function add_space($content) 
          {
              global $line_break;
              
              if (strlen($content) > $line_break) {
                  $content = chunk_split($content, $line_break, ' ');
              }
              
              return $content;
          }




  /*****************************************************
  ** Replace emoticons
  *****************************************************/
          function emoticons($content) 
          {
              global $smiley, $image_template, $path, $script_root;
              
              reset($smiley);
              
              while (list($key, $val) = each($smiley))
              {
                  $image_content = str_replace('{image_path}', $path['smilies'] . $val, $image_template);
                  $content       = str_replace(htmlentities($key), $image_content, $content);                  
              }
              
              
              return $content;
          }





  /*****************************************************
  ** Generate result array
  *****************************************************/
          function data_loop($data, $id, $nl_to_br = '')
          {
              global $admin_template;
              
              while(list($key, $val) = each($data))
              {
                  if (!isset($new_search_result[$val[$id]])) {
                      $new_search_result[$val[$id]] = array();
                  }

                  if (!isset($new_search_result[$val[$id]]['admin_info'])) {
                      $new_search_result[$val[$id]]['admin_info'] = $admin_template;
                  }

                  if (!isset($new_search_result[$val[$id]]['id'])) {
                      $new_search_result[$val[$id]]['id'] = $val[$id];
                  }

                  if ($val['data_name'] == 'timestamp') {
                      $entry_date = date_elements($val['data_content']);

                      while (list($element, $element_value) = each($entry_date))
                      {
                          if (!isset($new_search_result[$val[$id]][$element])) {
                              $new_search_result[$val[$id]][$element] = $element_value;
                          }
                      }
                  }
                  
                  
                  //$val['data_content'] = clean_output($val['data_content']);
                  
                  $temp_content = explode(' ', $val['data_content']);
                  $temp_content = array_map('add_space', $temp_content);
                  $temp_content = array_map('clean_output', $temp_content);
                  $temp_content = array_map('emoticons', $temp_content);
                  $temp_content = join(' ', $temp_content);
                  $val['data_content'] = emoticons($val['data_content']);


                  if ($nl_to_br == 'true') {
                      $temp_content        = nl2br($temp_content);
                      $val['data_content'] = nl2br($val['data_content']);                      
                  }
                  

                  
                  $new_search_result[$val[$id]]['modified:' . $val['data_name']] = $temp_content;
                  $new_search_result[$val[$id]][$val['data_name']] = $val['data_content'];
              }

              return $new_search_result;
          }





  /*****************************************************
  ** Clean form output
  *****************************************************/
          function clean_output($content)
          {
              //$content = htmlentities($content);
              $content = htmlspecialchars($content);
              //$content = strip_tags($content);

              return $content;
          }





  /*****************************************************
  ** Emoticon list
  *****************************************************/
          function emoticon_list($arr)
          {
              global $smiley_list, $smiley, $path, $script_root;
              
              $root   = ceil(sqrt(count($arr)));
              $count  = 0;
              $list   = '';
              $signs  = array_values(array_flip($smiley));
              $smiley = array_values($smiley);
              
              for ($i = 1; $i <= $root; $i++)
              {
                  for ($k = 1; $k <= $root; $k++)
                  {
                      if (isset($smiley[$count])) {
                          $image_content = str_replace('{image_path}', $path['smilies'] . $smiley[$count], $smiley_list);
                          $image_content = str_replace('{sign}', $signs[$count], $image_content);
                          $list .= $image_content;
                      }
                      
                      $count++;
                  }   
                      
                  $list .= '<br />';                  
              }

              return $list;
          }


?>