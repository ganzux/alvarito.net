<?php

  /*****************************************************
  ** Title........: SQL Strukture
  ** Filename.....: sql.inc.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.2
  ** Notes........:
  ** Last changed.: 2004-03-06
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
  ** SQL statements
  *****************************************************/
          $database_tables['data']        = array(
                                                       'name'        => 'data',
                                                       'sql'         => 'CREATE TABLE IF NOT EXISTS {table_prefix}{table_name} (
                                                                           data_id int(11) NOT NULL auto_increment,
                                                                           entry_id int(11) DEFAULT \'0\' NOT NULL,
                                                                           data_name text NOT NULL,
                                                                           data_content text NOT NULL,
                                                                           PRIMARY KEY (data_id),
                                                                           KEY entry_id (entry_id)
                                                                        );'
                                                  );
                                                  
                                                  
                                                  
                                    
          $database_tables['entries']     = array(
                                                       'name'        => 'entries',
                                                       'sql'         => 'CREATE TABLE IF NOT EXISTS {table_prefix}{table_name} (
                                                                           entry_id int(11) NOT NULL auto_increment,
                                                                           full_text text NOT NULL,
                                                                           PRIMARY KEY (entry_id),
                                                                           KEY entry_id (entry_id)
                                                                        );'
                                                  );






?>