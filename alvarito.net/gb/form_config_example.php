<?php

  /*****************************************************
  ** Title........: Form field configuration File
  ** Filename.....: form_config_example.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.1
  ** Notes........:                   
  ** Last changed.: 2004-01-07 
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
  ** Form field configuration
  *****************************************************/
          $new_form_fields[] = array(
                                      'name'       => 'name',
                                      'label'      => 'Name',
                                      'type'       => 'text',
                                      'required'   => 'yes',
                                      'value'      => '',
                                      'size'       => '30',
                                      'style'      => 'width:350px;'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'homepage',
                                      'label'      => 'Homepage',
                                      'type'       => 'text',
                                      'required'   => '',
                                      'value'      => 'http://',
                                      'size'       => '30',
                                      'style'      => 'width:350px;'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'comment',
                                      'label'      => $txt['txt_comment'],
                                      'type'       => 'textarea',
                                      'required'   => 'yes',
                                      'value'      => '',
                                      'cols'       => '20',
                                      'rows'       => '10',
                                      'style'      => 'width:350px;border:1px solid #000000;',
                                      'class'      => 'lightrow'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'newsletter',
                                      'label'      => 'Subscribe Newsletter',
                                      'type'       => 'checkbox',
                                      'required'   => '',
                                      'value'      => '',
                                      'checked'    => 'checked'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'color',
                                      'label'      => 'Favorite color',
                                      'type'       => 'select',
                                      'required'   => '',
                                      'value'      => 'Red, Blue, Black, White, Green',
                                      'selected'   => 'Blue',
                                      'style'      => 'width:350px;background-color:#CCCCCC;color:#FF0000;'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'fruit',
                                      'label'      => 'Favorite fruit',
                                      'type'       => 'radio',
                                      'required'   => '',
                                      'value'      => 'Banana, Orange, Apple, Cherry, Grape fruit, Strawberry',
                                      'selected'   => 'Grape fruit'
                                  );




  /*****************************************************
  ** Do not edit below this line
  **
  ** Ab hier bitte keine Aenderungen vornehmen
  *****************************************************/
          $example_form_fields = $new_form_fields;




?>