<?php

  $runtime_start = explode (" ", microtime ()); 

  /*****************************************************
  ** Title........: Admin Area Settings
  ** Filename.....: settings.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.1
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




  /*****************************************************
  ** Form field configuration
  *****************************************************/
          $login_form_fields[] = array(
                                          'name'       => 'username',
                                          'label'      => 'Username',
                                          'type'       => 'text',
                                          'size'       => '30',
                                          'required'   => '',
                                          'value'      => ''
                                      );




  /*****************************************************
  ** Initialyze template class
  *****************************************************/
          $tpl = new template;




  /*****************************************************
  ** Load html template
  *****************************************************/
          $tpl->load_file('part', $script_root . $path['templates'] . $file['settings']);




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
          $tpl->load_file('search', $script_root . $path['templates'] . $file['main_layout']);
          $tpl->register('search', 'main_content');
          $tpl->parse('search');




  /*****************************************************
  ** Parse template
  *****************************************************/
          $tpl->register('search', 'language');

          $tpl->parse_loop('search', 'message');

          $tpl->parse_if('search', 'logged_in');





  /*****************************************************
  ** Register language file and additional text array
  *****************************************************/
          if (isset ($txt) and is_array ($txt)) {
              reset ($txt);
              while(list($key, $val) = each($txt))
              {
                  $$key = $val;
                  $tpl->register('search', $key);
              }
          }


          if (isset($add_text) and is_array($add_text)) {
              reset ($add_text);
              while(list($key, $val) = each($add_text))
              {
                  $$key = $val;
                  $tpl->register('search', $key);
              }
          } @eval($conf_var);
          
          $tpl->parse('search');
          $tpl->print_file('search');

          debug_mode(script_runtime($runtime_start), 'Script Runtime');
  
  
  
  
?>

