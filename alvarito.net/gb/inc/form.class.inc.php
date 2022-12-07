<?php

  /*****************************************************
  ** Title........: Form field class
  ** Filename.....: formfields.class.inc.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 1.0
  ** Notes........: Generates form fields
  ** Last changed.: 2004-03-06
  ** Last change..: Handle array as form field value
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
  ** Define class
  *****************************************************/
          class Formfields
          {
              var $templates;
              var $form_definition;
              var $pattern;




              /*****************************************************
              ** Get form field templates
              *****************************************************/
                      function Formfields()
                      {                          
                          $this->templates = array(
                                                        'textarea' => '<textarea {attributes}></textarea>',
                                                        'text'     => '<input type="text" {attributes} />',
                                                        'password' => '<input type="password" {attributes} />',
                                                        'radio'    => '<input type="radio" value="{value}" {selected} {attributes} />&nbsp;&nbsp;<span onclick="document.guestbookform.{field_name}[{key}].checked=true;" style="cursor:default;">{label}</span><br />' . "\n",
                                                        'checkbox' => '<input type="checkbox" {selected} {attributes} />',
                                                        'select'   => '<select {attributes}></select>',
                                                        'option'   => '<option value="{value}" {selected}>{text}</option>',
                                                        'hidden'   => '<input type="hidden" {attributes} />',
                                                        'submit'   => '<input type="submit" {attributes} />'
                                                    );
                                                    
                          $this->pattern    = array(
                                                        'email' => '/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,4}|museum)$/i',
                                                        'plz'   => '/^[0-9]{5}$/i'
                                                    );
                      }




              /*****************************************************
              ** Get form field definition
              *****************************************************/
                      function define_form($name, $data)
                      {
                          if (is_array($data)) {
                              while(list($key, $val) = each($data)) {
                                  $this->form_definition[$name][$val['name']] = $val;
                                  $this->form_definition[$name][$val['name']]['output_field'] = '';
                                  $this->form_definition[$name][$val['name']]['output_error'] = '';
                              }
                          }
                      }




              /*****************************************************
              ** Add new form field
              *****************************************************/
                      function generate_form_fields($name, $input = '')
                      {
                          if (!empty($this->form_definition[$name]) and is_array($this->form_definition[$name])) {

                              reset($this->form_definition[$name]);

                              while(list($form_key, $form_data) = each($this->form_definition[$name]))
                              {
                                  $unset_array    = array();                                  
                                  $new_form_field = $this->templates[$form_data['type']];
                                  
                                  if (isset($form_data['value']) and is_string($form_data['value'])) {
                                      $form_data['value'] = stripslashes($form_data['value']);
                                  }

                                  if (!empty($input) and isset($input[$form_data['name']])) {
                                      $input[$form_data['name']] = stripslashes($input[$form_data['name']]);
                                  }




                                  /*****************************************************
                                  ** Add value to text area
                                  *****************************************************/
                                          if ($form_data['type'] == 'textarea') {
                                              
                                              if (isset($form_data['value'])) {
                                                  $textarea_value = $form_data['value'];
                                              }
                                              
                                              if (isset($input[$form_data['name']])) {
                                                  $textarea_value = $input[$form_data['name']];
                                              }
                                              
                                              if (isset($textarea_value)) {
                                                  $new_form_field = preg_replace("#>(.*?)</textarea>#i", '>' . "$1" . $textarea_value . '</textarea>', $new_form_field);
                                                  $unset_array[]  = 'value';
                                              }
                                              
                                          }




                                  /*****************************************************
                                  ** Generate select field option values
                                  *****************************************************/
                                          if ($form_data['type'] == 'select' and isset($form_data['value'])) {

                                              $option_template = $this->templates['option'];
                                              
                                              
                                              if (isset($form_data['selected']) and !empty($form_data['selected'])) {
                                                  $select_value = $form_data['selected'];
                                              }
                                              
                                              if (!empty($input) and isset($input[$form_data['name']]) and !empty($input[$form_data['name']])) {
                                                  $select_value = $input[$form_data['name']];
                                              }
                                              
                                              if (is_array($form_data['value'])) {
                                                  $option_values = $form_data['value'];
                                                  
                                                  reset($option_values);
                                                  
                                                  while (list($key, $val) = each($option_values))
                                                  {
                                                      $option_content = $option_template;
                                                      $current_value  = trim($key);
    
                                                      if (isset($select_value) and $select_value == $current_value) {
                                                          $option_content = str_replace('{selected}', 'selected="selected"', $option_content);
                                                      } else {
                                                          $option_content = str_replace('{selected}', '', $option_content);
                                                      }
    
                                                      $option_content = str_replace('{value}', $current_value, $option_content);
                                                      $option_code[]  = str_replace('{text}', $val, $option_content);
                                                      
                                                  }
                                                  
                                              } else {
                                                  $option_values = explode(',', $form_data['value']);

                                                  for($i = 0; $i < count($option_values); $i++)
                                                  {
                                                      $option_content = $option_template;
                                                      $current_value  = trim($option_values[$i]);
    
                                                      if (isset($select_value) and $select_value == $current_value) {
                                                          $option_content = str_replace('{selected}', 'selected="selected"', $option_content);
                                                      } else {
                                                          $option_content = str_replace('{selected}', '', $option_content);
                                                      }
    
                                                      $option_content = str_replace('{value}', $current_value, $option_content);
                                                      $option_code[]  = str_replace('{text}', $current_value, $option_content);
                                                  }
                                              }

                                              $new_form_field = preg_replace("#>(.*?)</select>#i", '>' . "$1" . join('', $option_code) . '</select>', $new_form_field);
                                              $unset_array[]  = 'value';
                                          }




                                  /*****************************************************
                                  ** Generate radio button fields
                                  *****************************************************/
                                          if ($form_data['type'] == 'radio' and isset($form_data['value'])) {

                                              $radio_button_template = $this->templates['radio'];
                                              $radio_button_values   = explode(',', $form_data['value']);
                                              
                                              
                                              if (isset($form_data['selected']) and !empty($form_data['selected'])) {
                                                  $select_value = $form_data['selected'];
                                              }
                                              
                                              if (isset($input[$form_data['name']]) and !empty($input[$form_data['name']])) {
                                                  $select_value = $input[$form_data['name']];
                                              }
                                              

                                              for($i = 0; $i < count($radio_button_values); $i++)
                                              {
                                                  $radio_button_content = $radio_button_template;
                                                  $current_value        = trim($radio_button_values[$i]);
                                                  
                                                  if (isset($select_value) and $select_value == $current_value) {
                                                      $radio_button_content = str_replace('{selected}', 'checked="checked"', $radio_button_content);
                                                  } else {
                                                      $radio_button_content = str_replace('{selected}', '', $radio_button_content);
                                                  }

                                                  $radio_button_content  = str_replace('{label}', $current_value, $radio_button_content);
                                                  $radio_button_content  = str_replace('{field_name}', $form_data['name'], $radio_button_content);
                                                  $radio_button_content  = str_replace('{key}', $i, $radio_button_content);


                                                  $radio_button_code[]  = str_replace('{value}', $current_value, $radio_button_content);
                                              }

                                              $new_form_field = join('', $radio_button_code);
                                              $unset_array[]  = 'value';
                                          }




                                  /*****************************************************
                                  ** Implement checkbox selection
                                  *****************************************************/
                                          if ($form_data['type'] == 'checkbox') {
                                              
                                              if (isset($input[$form_data['name']]) and !empty($input[$form_data['name']])) {
                                                  $new_form_field = str_replace('{selected}', 'checked="checked"', $new_form_field);
                                              }
                                              
                                              if (!isset($input[$form_data['name']]) and !empty($input)) {
                                                  $new_form_field = str_replace('{selected}', '', $new_form_field);
                                              }
                                              
                                              if (isset($form_data['selected']) and !empty($form_data['selected'])) {
                                                  $new_form_field = str_replace('{selected}', 'checked="checked"', $new_form_field);
                                              }
                                              
                                              $new_form_field = str_replace('{selected}', '', $new_form_field);
                                              
                                          }




                                  /*****************************************************
                                  ** Apply pre-defined values (i.e. post data) to form fields
                                  *****************************************************/
                                          if (!empty($input) and isset($input[$form_data['name']])) {
                                              $form_data['value'] = $input[$form_data['name']];
                                          }




                                  /*****************************************************
                                  ** Unset control values
                                  *****************************************************/
                                          $unset_array = array_merge($unset_array, array('type', 'selected', 'required', 'label', 'output_error', 'output_field'));

                                          while(list($key, $val) = each($unset_array))
                                          {
                                              unset($form_data[$val]);
                                          }





                                  /*****************************************************
                                  ** Add attributes to form field
                                  *****************************************************/
                                          reset($form_data);

                                          while(list($attribute, $value) = each($form_data))
                                          {
                                              $new_form_field = str_replace('{attributes}', $attribute . '="' . $value . '" {attributes}', $new_form_field);
                                          }

                                  
                                          
                                          
                                  $this->form_definition[$name][$form_key]['output_field'] = str_replace('{attributes}', '', $new_form_field);                                  
                              }
                          }

                      }




              /*****************************************************
              ** Parse new form fields in HTML template
              *****************************************************/
                      function parse_template($name, $html)
                      {
                          if (!empty($html)) {
                              reset($this->form_definition[$name]);
                              while (list($key, $val) = each($this->form_definition[$name]))
                              {
                                  $html = preg_replace('#\{field:(.*?)%' . $key . '%(.*?)\}#', "$1" . $val['output_field'] . "$2", $html);
                                  
                                  if (isset($val['label'])) {
                                      $html = preg_replace('#\{label:(.*?)%' . $key . '%(.*?)\}#', "$1" . $val['label'] . "$2", $html);
                                  } else {
                                      $html = preg_replace('#\{label:(.*?)%' . $key . '%(.*?)\}#', "$1 $2", $html);
                                  }
                                  
                                  if (!empty($val['output_error'])) {
                                      $html = preg_replace('#\{error:(.*?)%' . $key . '%(.*?)\}#', "$1" . $val['output_error'] . "$2", $html);
                                  } else {
                                      $html = preg_replace('#\{error:(.*?)%' . $key . '%(.*?)\}#', '', $html);
                                  }
                              }

                              return $html;
                          }
                      }




              /*****************************************************
              ** Check for required fields
              *****************************************************/
                      function required_fields($name, $data)
                      {
                          if (!empty($data) and is_array($data)) {

                              $required_fields = '';

                              reset($this->form_definition[$name]);
                              
                              while (list($key, $val) = each($this->form_definition[$name]))
                              {
                                  if (isset($val['required']) and $val['required'] == 'yes' and (!isset($data[$val['name']]) or empty($data[$val['name']]))) {
                                      
                                      if (isset($val['error_required']) and !empty($val['error_required'])) {
                                          $this->form_definition[$name][$key]['output_error'] = $val['error_required'];
                                      } else {
                                          $required_fields[] = $val['label'];
                                      }
                                      $error = 'TRUE';
                                  }
                              }

                              if (isset($error) and $error = 'TRUE') {
                                  return array('true', $required_fields);
                              }

                          }
                      }




              /*****************************************************
              ** Check syntax
              *****************************************************/
                      function check_syntax($name, $data)
                      {
                          if (!empty($data) and is_array($data)) {
                              
                              $syntax_fields = '';
                              
                              reset($this->form_definition[$name]);
                              while (list($key, $val) = each($this->form_definition[$name]))
                              {
                                  if (isset($val['syntax']) and isset($this->pattern[$val['syntax']]) and !empty($data[$val['name']]) and !preg_match($this->pattern[$val['syntax']], $data[$val['name']])) {
                                      
                                      if (isset($val['error_syntax']) and !empty($val['error_syntax'])) {
                                          $this->form_definition[$name][$key]['output_error'] = $val['error_syntax'];
                                      } else {
                                          $syntax_fields[] = $val['label'];
                                      }
                                      $error = 'TRUE';
                                  }
                              }

                              if (isset($error) and $error = 'TRUE') {
                                  return array('true', $syntax_fields);
                              }

                          }
                      }




              /*****************************************************
              ** Set output error
              *****************************************************/
                      function output_error($name, $field, $data)
                      {
                          $this->form_definition[$name][$field]['output_error'] = $data;
                      }





          } // End class Formfields

?>