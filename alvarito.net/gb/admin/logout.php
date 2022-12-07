<?php

  /*****************************************************
  ** Title........: Logout Script
  ** Filename.....: logout.php
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
  ** Include form field class
  *****************************************************/
          include($script_root . 'inc/common.inc.php');





  /*****************************************************
  ** Destroy session and unset session data
  *****************************************************/
          session_start();
          session_unset();
          session_destroy();





  /*****************************************************
  ** Redirect to login script
  *****************************************************/
          $path = pathinfo($_SERVER['PHP_SELF']);

          if (isset($_SERVER['HTTP_REFERER']) and !empty($_SERVER['HTTP_REFERER'])) {
              $redirect = $_SERVER['HTTP_REFERER'];
          } else {
              $redirect = 'http://' . getenv('SERVER_NAME') . $path['dirname'] . '/login.php';
          }

          header('Location: ' . $redirect);





?>