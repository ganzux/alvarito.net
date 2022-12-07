<?php

  $runtime_start = explode (" ", microtime ()); 

  /*****************************************************
  ** Title........: Test database table existance
  ** Filename.....: table_check.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.4
  ** Notes........: 
  ** Last changed.: 2004-04-18
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
  ** Connect to database server and select database
  *****************************************************/
          $db = new Database();
          
          if ($db->db_connect($database)) {
              
              if ($db->db_select($database)) {



                
                  /*****************************************************
                  ** Get table list and check the existence of the
                  ** script tables (based on the prefix setting in
                  ** config.php and the SQL configuration in 
                  ** sql.inc.php).
                  *****************************************************/
                          if ($result = $db->db_list_tables($database['name'])) {                              
                              while ($data = $db->db_fetch_row($result))
                              {
                                  $existing_tables[] = $data[0];
                              }
                          }
                          
                      
                          $tables_incomplete = '';
                          $table_number = 0;
                              
                          
                          if (isset($existing_tables)) {
                          
                              $num = count($existing_tables);
    
                              reset($database_tables);
                                                       
                              while (list($key, $val) = each($database_tables))
                              {
                                  $current_table = strtolower($database['prefix'] . $val['name']);
                                  
                                  for ($i = 0; $i < $num; $i++)
                                  {
                                      if ($existing_tables[$i] == $current_table) {
                                          ++$table_number;
                                      }
                                  }
                              }

                          }
                              
                          if ($table_number < count($database_tables)) {
                              $message[] = array('message' => $txt['txt_database_tables_incomplete'], 'addition' => '', 'fields' => '');
                          }
                  
              } else {
                  $message[] = array('message' => $txt['txt_database_not_found'], 'addition' => $txt['txt_database_name'] . ': "' . $database['name'] . '"?', 'fields' => '');
              }
              
          } else {
              $message[] = array('message' =>$txt['txt_database_host_not_found'], 'addition' => $txt['txt_database_host'] . ': "' . $database['host'] . '"?', 'fields' => '');
          }
  
  
  
  
?>