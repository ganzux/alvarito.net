<?php

  /*****************************************************
  ** Title........: Database class
  ** Filename.....: db.class.inc.php
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
  ** DB class
  *****************************************************/
          class Database
          {
              var $db_connect_id;
              var $query_result;
              var $fetch_row_result;




              /*****************************************************
              ** Connect to database host
              *****************************************************/
                      function db_connect($database)
                      {

                          if ($this->db_connect_id = @mysql_connect($database['host'], $database['user'], $database['pass'])) { 
                              return $this->db_connect_id;
                          }
                      }




              /*****************************************************
              ** Select database
              *****************************************************/
                      function db_select($database)
                      {
                          if ($this->db_connect_id != '') {
                              if ($database['name'] != '') {
                                  $dbselect = mysql_select_db($database['name']);
                              } else {
                                  $dbselect = '';
                              }
                              if (empty($dbselect)) {
                                  mysql_close($this->db_connect_id);
                                  $this->db_connect_id = $dbselect;
                              } else {
                                  return true;
                              }
                          }
                      }





                      /*****************************************************
                      ** Database query
                      *****************************************************/
                              function db_query($query = '')
                              {
                                  if ($query != '') {
                                      $this->query_result = mysql_query($query);
                                      echo mysql_error();
                                  }

                                  if (isset($this->query_result)) {
                                      return $this->query_result;
                                  }
                              }




                      /*****************************************************
                      ** Database fetch row
                      *****************************************************/
                              function db_fetch_row($query = '')
                              {
                                  if ($query != '') {
                                      $this->fetch_row_result = mysql_fetch_row($query);
                                      echo mysql_error();
                                  }

                                  if (isset($this->fetch_row_result)) {
                                      return $this->fetch_row_result;
                                  }
                              }




                      /*****************************************************
                      ** Database fetch rows
                      *****************************************************/
                              function db_fetch_rows($query = '')
                              {
                                  if ($query != '') {
                                      //$this->fetch_row_result = mysql_fetch_row($query);
                                      $this->new_url_list = array();

                                      while ($data = mysql_fetch_array($query))
                                      {
                                          while(list($key, $val) = each($data))
                                          {
                                              $new_url_list_temp[$key] = $data[$key];
                                          }

                                          $this->new_url_list[] = $new_url_list_temp;

                                          unset($new_url_list_temp);
                                      }

                                      //echo mysql_error();

                                  }

                                  if (isset($this->new_url_list)) {
                                      return $this->new_url_list;
                                  }
                              }




                      /*****************************************************
                      ** Add detail entry
                      *****************************************************/
                              function add_details($data, $content, $full_text)
                              {
                                  /* Add entry to pages table including full text content */
                                  $sql = "INSERT INTO " . ENTRY_TABLE . " (entry_id, full_text) VALUES ('', '" . addslashes($full_text) . "')";

                                  if ($this->db_query($sql)) {

                                      $insert_id = mysql_insert_id();
                                      $status    = '';

                                      while(list($key, $val) = each($data))
                                      {
                                          if (isset($content[$val])) {
                                              if (!$this->db_query("INSERT INTO " . DATA_TABLE . " (entry_id, data_name, data_content) VALUES ('" . $insert_id . "', '" . $val . "', '" . addslashes($content[$val]) . "')")) {
                                                  $status = 'failed';
                                              }
                                          }
                                      }

                                      if ($status != 'failed') {
                                          return TRUE;
                                      }
                                  }
                              }




                      /*****************************************************
                      ** Update detail entry
                      *****************************************************/
                              function update_details($data, $content, $id)
                              {
                                  $status    = '';

                                  while(list($key, $val) = each($data))
                                  {
                                      if (isset($content[$val])) {
                                          if (!$this->db_query("UPDATE " . DATA_TABLE . " SET data_content = '" . addslashes($content[$val]) . "' WHERE entry_id = '" . $id . "' AND data_name = '" . $val . "'")) {
                                              $status = 'failed';
                                          }
                                      }
                                  }

                                  if ($status != 'failed') {
                                      return TRUE;
                                  }
                              }




                      /*****************************************************
                      ** Search entries
                      *****************************************************/
                              function db_search_entries($sql = '')
                              {
                                  if ($query_result = $this->db_query($sql)) {
                                      if ($fetch_result = $this->db_fetch_rows($query_result)) {
                                          if (isset($fetch_result)) {
                                              return $fetch_result;
                                          } else {
                                              return false;
                                          }
                                      }
                                  }
                              }




                      /*****************************************************
                      ** Count result
                      *****************************************************/
                              function db_count_result($query = '')
                              {

                                  if ($query_result = $this->db_query($query)) {
                                      if ($fetch_result = mysql_result($query_result, 0)) {
                                          if (isset($fetch_result)) {
                                              return $fetch_result;
                                          } else {
                                              return false;
                                          }
                                      }
                                  }
                              }



                      /*****************************************************
                      ** List tables
                      *****************************************************/
                              function db_list_tables($query = '')
                              {
                                  if ($query != '') {
                                      $this->query_result = mysql_list_tables($query);
                                      // echo mysql_error();
                                  }

                                  if (isset($this->query_result)) {
                                      return $this->query_result;
                                  }
                              }














          }

?>