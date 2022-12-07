<?php

  /*****************************************************
  ** Title........: Configuration File
  ** Filename.....: config.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.9
  ** Notes........: This file contains the configuration
  ** Last changed.: 2004-04-18
  ** Last change..: Time zone
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
  ** MySQL Details
  *****************************************************/
          $database['host']       = 'localhost';           // Database hostname
          $database['name']       = '';                    // Database name
          $database['user']       = '';                    // Database username
          $database['pass']       = '';                    // Database password
          $database['prefix']     = 'gbs_';





  /*****************************************************
  ** Script configuration - for the documentation of
  ** following variables please take a look at the
  ** documentation file in folder 'docu'.
  *****************************************************/
          $language               = 'en';     // (en, de, sv, tr)

          $results_per_page       = '5';
          $direct_page_links      = '9';
          
          $time_zone              = '0';     // i.e. +1, +5, +12, -3, -8, - 10

          $show_error_messages    = 'yes';    // (yes, no)


          $path['templates']      = '/templates/default/';
          $path['smilies']        = './templates/default/images/smilies/';  // www path

          $file['main_layout']    = 'main_layout.tpl.html';
          $file['sign_form']      = 'sign.tpl.html';
          $file['edit_form']      = 'edit.tpl.html';
          $file['entries']        = 'entries.tpl.html';
          $file['entry_detail']   = 'entry_detail.tpl.html';
          $file['form_detail']    = 'form_detail.tpl.html';
          $file['example_form']   = 'form_detail_example.tpl.html';
          $file['delete']         = 'delete.tpl.html';
          $file['admin_details']  = 'admin_details.tpl.html';
          $file['admin_entries']  = 'admin_entries.tpl.html';
          $file['admin_index']    = 'admin_index.tpl.html';
          $file['login_form']     = 'login.tpl.html';
          $file['database']       = 'database.tpl.html';




  /*****************************************************
  ** Add here further words, text, variables and stuff
  ** that you want to appear in the template.
  *****************************************************/
          $add_text = array(

                              'txt_additional' => 'Additional',  //  {txt_additional}
                              'txt_more'       => 'More',        //  {txt_more}

                              'txt_title'      => $script_title  // {txt_title}

                            );




  /*****************************************************
  ** Emoticon definition
  *****************************************************/
          $smiley['(:-&']         = 'smiley_annoyed.gif';
          $smiley[':-O']          = 'smiley_astonished.gif';
          $smiley[':-o']          = 'smiley_awe.gif';
          $smiley['?:-)']         = 'smiley_baby.gif';
          $smiley['|-)']          = 'smiley_bored.gif';
          $smiley[',-)']          = 'smiley_content.gif';
          $smiley[':-(']          = 'smiley_disappointed.gif';
          $smiley['X-)']          = 'smiley_drunk.gif';
          $smiley['P-)']          = 'smiley_english.gif';
          $smiley['>-)']          = 'smiley_evil.gif';
          $smiley[':-}']          = 'smiley_french.gif';
          $smiley[':-B']          = 'smiley_goofy.gif';
          $smiley[':-)']          = 'smiley_happy.gif';
          $smiley['`:O']          = 'smiley_horror.gif';
          $smiley[']:o)']         = 'smiley_king.gif';
          $smiley['@>-']          = 'smiley_love.gif';
          $smiley['>-(']          = 'smiley_mad.gif';
          $smiley['()-)']         = 'smiley_mask.gif';
          $smiley['B-)']          = 'smiley_nerd.gif';
          $smiley['<-)']          = 'smiley_oriental.gif';
          $smiley['(-(']          = 'smiley_sad.gif';
          $smiley['*-O']          = 'smiley_shocked.gif';
          $smiley[':->']          = 'smiley_sinister.gif';
          $smiley[':-D']          = 'smiley_smile.gif';
          $smiley[',->']          = 'smiley_smug.gif';
          $smiley[':-{']          = 'smiley_stache.gif';
          $smiley['|-(']          = 'smiley_stuckup.gif';
          $smiley['(:-|']         = 'smiley_surprised.gif';
          $smiley[':-|']          = 'smiley_tough.gif';
          $smiley['(:`(']         = 'smiley_upset.gif';




?>