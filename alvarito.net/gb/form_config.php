<?php

  /*****************************************************
  ** Title........: Form field configuration File
  ** Filename.....: form_config.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.3
  ** Notes........:
  ** Last changed.: 2004-01-22
  ** Last change..: Radio button template  
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
                                      'label'      => $txt['txt_name'],
                                      'type'       => 'text',
                                      'required'   => 'yes',
                                      'value'      => '',
                                      'size'       => '30',
                                      'style'      => 'width:350px;',
                                      'tabindex'   => '1'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'location',
                                      'label'      => $txt['txt_location'],
                                      'type'       => 'text',
                                      'required'   => '',
                                      'value'      => '',
                                      'size'       => '30',
                                      'style'      => 'width:350px;',
                                      'tabindex'   => '2'
                                  );


          $new_form_fields[] = array(
                                      'name'          => 'homepage',
                                      'label'         => $txt['txt_homepage'],
                                      'type'          => 'text',
                                      'required'      => '',
                                      'value'         => 'http://',
                                      'size'          => '30',
                                      'style'         => 'width:350px;',
                                      'tabindex'      => '3'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'email',
                                      'label'      => $txt['txt_email'],
                                      'type'       => 'text',
                                      'required'   => '',
                                      'value'      => '',
                                      'size'       => '30',
                                      'style'      => 'width:350px;',
                                      'tabindex'   => '4'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'comment',
                                      'label'      => $txt['txt_comment'],
                                      'type'       => 'textarea',
                                      'required'   => 'yes',
                                      'value'      => '',
                                      'cols'       => '20',
                                      'rows'       => '11',
                                      'style'      => 'width:350px;',
                                      'tabindex'   => '5'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'send',
                                      'type'       => 'submit',
                                      'value'      => $txt['txt_submit'],
                                      'tabindex'   => '7'
                                  );


          $new_form_fields[] = array(
                                      'name'       => 'preview',
                                      'type'       => 'submit',
                                      'value'      => $txt['txt_preview'],
                                      'tabindex'   => '6'
                                  );




?>