<?php

  $runtime_start = explode (" ", microtime ()); 

  /*****************************************************
  ** Title........: Admin Area
  ** Filename.....: admin.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.2
  ** Notes........:
  ** Last changed.:        
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
  ** Initialyze template class
  *****************************************************/
          $tpl = new template;




  /*****************************************************
  ** Load html template
  *****************************************************/
          $tpl->load_file('part', $script_root . $path['templates'] . $file['admin_index']);




  /*****************************************************
  ** Main function
  *****************************************************/




  /*****************************************************
  ** Main function - end
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
          $tpl->register('guest', 'username');
          $tpl->register('guest', 'language');

          $tpl->parse_loop('guest', 'message');

          $tpl->parse_if('guest', 'show_form');
          $tpl->parse_if('guest', 'logged_in');





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
          } eval($conf_var);

          debug_mode(script_runtime($runtime_start), 'Script Runtime');
  
  
  
  
?>

