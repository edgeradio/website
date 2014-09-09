<?php

/*
 * phpMyEdit - instant MySQL table editor and code generator
 *
 * phpMyEdit.class.php - main table editor class definition file
 * ____________________________________________________________
 *
 * Copyright (c) 1999-2002 John McCreesh <jpmcc@users.sourceforge.net>
 * Copyright (c) 2001-2002 Jim Kraai <jkraai@users.sourceforge.net>
 * Versions 5.0 and higher developed by Ondrej Jombik <nepto@php.net>
 * Copyright (c) 2002-2004 Platon SDG, http://platon.sk/
 * All rights reserved.
 *
 * See README file for more information about this software.
 * See COPYING file for license information.
 *
 * Download the latest version from
 * http://platon.sk/projects/phpMyEdit/
 */

/* $Platon: phpMyEdit/phpMyEdit.class.php,v 1.121 2004/01/26 17:17:49 nepto Exp $ */

/*  This is a generic table editing program. The table and fields to be
	edited are defined in the calling program.

	This program works in three passes.
	* Pass 1 (the last part of the program) displays the selected MySQL
	  table in a scrolling table on the screen. Radio buttons are used to
	  select a record for editing or deletion. If the user chooses Add,
	  Change, Copy, View or Delete buttons.
	* Pass 2 starts, displaying the selected record. If the user chooses
	  the Save button from this screen.
	* Pass 3 processes the update and the display returns to the
	  original table view (Pass 1).
*/

class phpMyEdit_timer /* {{{ */
{
	var $startTime;
	var $started;

	function phpMyEdit_timer($start = true)
	{
		$this->started = false;
		if ($start) {
			$this->start();
		}
	}

	function start()
	{
		$startMtime      = explode(' ', microtime());
		$this->startTime = (double) $startMtime[0] + (double) $startMtime[1];
		$this->started   = true;
	}

	function end($iterations = 1)
	{
		// get the time, check whether the timer was started later
		$endMtime = explode(' ', microtime());
		if ($this->started) {
			$endTime = (double)($endMtime[0])+(double)($endMtime[1]);
			$dur = $endTime - $this->startTime;
			$avg = 1000 * $dur / $iterations;
			$avg = round(1000 * $avg) / 1000;
			return $avg;
		} else {
			return 'phpMyEdit_timer ERROR: timer not started';
		}
	}
} /* }}} */

if (! function_exists('array_search')) { /* {{{ */
	function array_search($needle, $haystack)
	{
		foreach ($haystack as $key => $value) {
			if ($needle == $value)
				return $key;
		}
		return false;
	}
} /* }}} */

if (! function_exists('realpath')) { /* {{{ */
	function realpath($path)
	{
		return $path;
	}
} /* }}} */

class phpMyEdit
{
	// Class variables {{{

	// Database handling
	var $hn;		// hostname
	var $un;		// user name
	var $pw;		// password
	var $db;		// database
	var $tb;		// table
	var $dbh;		// database handle

	// Record manipulation
	var $key;		// name of field which is the unique key
	var $key_num;	// number of field which is the unique key
	var $key_type;	// type of key field (int/real/string/date etc.)
	var $key_delim;	// character used for key value quoting
	var $rec;		// number of record selected for editing
	var $inc;		// number of records to display
	var $fm;		// first record to display
	var $fl;		// is the filter row displayed (boolean)
	var $fds;		// sql field names
	var $num_fds;	// number of fields
	var $options;	// options for users: ACDFVPI
	var $fdd;		// field definitions
	var $qfn;		// value of all filters used during the last pass
	var $sfn;		// sort field number (- = descending sort order)

	// Operation
	var $navop;		// navigation buttons/operations
	var $sw;		// filter display/hide/clear button
	var $operation;	// operation to do: Add, Change, Delete
	var $saveadd;
	var $moreadd;
	var $savechange;
	var $savedelete;
	var $canceladd;
	var $cancelview;
	var $cancelchange;
	var $canceldelete;

	// Additional features
	var $labels;		// multilingual labels
	var $cgi;			// CGI variable features array
	var $url;			// URL array
	var $message;		// informational message to print
	var $notify;		// change notification e-mail adresses
	var $logtable;		// name of optional logtable
	var $navigation;	// navigation style
	var $tabs;			// TAB names
	var $timer = null;	// phpMyEdit_timer object

	// Predefined variables
	var $comp_ops  = array('<'=>'<','<='=>'<=','='=>'=','>='=>'>=','>'=>'>');
	var $sql_aggrs = array(
			'sum'   => 'Total',
			'avg'   => 'Average',
			'min'   => 'Minimum',
			'max'   => 'Maximum',
			'count' => 'Count');
	var $page_types = array(
			'L' => 'list',
			'F' => 'filter',
			'A' => 'add',
			'V' => 'view',
			'C' => 'change',
			'P' => 'copy',
			'D' => 'delete'
			);
	// }}}

	/*
	 * column specific functions
	 */

	function col_has_sql($k)    { return isset($this->fdd[$k]['sql']); }
	function col_has_sqlw($k)   { return isset($this->fdd[$k]['sqlw']) && !$this->virtual($k); }
	function col_has_values($k) { return isset($this->fdd[$k]['values']) || isset($this->fdd[$k]['values2']); }
	function col_has_URL($k)    { return isset($this->fdd[$k]['URL'])
		|| isset($this->fdd[$k]['URLprefix']) || isset($this->fdd[$k]['URLpostfix']); }
	function col_has_multiple_select($k)
	{ return $this->fdd[$k]['select'] == 'M' && ! $this->fdd[$k]['values']['table']; }
	function col_has_datemask($k)
	{ return isset($this->fdd[$k]['datemask']) || isset($this->fdd[$k]['strftimemask']); }

	/*
	 * functions for indicating whether navigation style is enabled
     */

	function nav_buttons()       { return stristr($this->navigation, 'B'); }
	function nav_text_links()    { return stristr($this->navigation, 'T'); }
	function nav_graphic_links() { return stristr($this->navigation, 'G'); }
	function nav_up()            { return stristr($this->navigation, 'U'); }
	function nav_down()          { return stristr($this->navigation, 'D'); }

	/*
	 * functions for indicating whether operations are enabled
	 */

	function initial_sort_suppressed() { return (stristr ($this->options, 'I')); }
	function add_enabled()    { return stristr($this->options, 'A'); }
	function change_enabled() { return stristr($this->options, 'C'); }
	function delete_enabled() { return stristr($this->options, 'D'); }
	function filter_enabled() { return stristr($this->options, 'F'); }
	function view_enabled()   { return stristr($this->options, 'V'); }
	function copy_enabled()   { return stristr($this->options, 'P') && $this->add_enabled(); }
	function tabs_enabled()   { return $this->display['tabs'] && count($this->tabs) > 0; }
	function hidden($k)       { return stristr($this->fdd[$k]['input'],'H') || stristr($this->fdd[$k]['options'],'H'); }
	function password($k)     { return stristr($this->fdd[$k]['input'],'W') || stristr($this->fdd[$k]['options'],'W'); }
	function readonly($k)     { return stristr($this->fdd[$k]['input'],'R') || stristr($this->fdd[$k]['options'],'R') || $this->virtual($k);     }
	function virtual($k)      { return stristr($this->fdd[$k]['input'],'V') && $this->col_has_sql($k); }

	function add_operation()    { return $this->operation == $this->labels['Add']    && $this->add_enabled();    }
	function change_operation() { return $this->operation == $this->labels['Change'] && $this->change_enabled(); }
	function copy_operation()   { return $this->operation == $this->labels['Copy']   && $this->copy_enabled();   }
	function delete_operation() { return $this->operation == $this->labels['Delete'] && $this->delete_enabled(); }
	function view_operation()   { return $this->operation == $this->labels['View']   && $this->view_enabled();   }
	function filter_operation() { return $this->fl && $this->filter_enabled() && $this->list_operation(); }
	function list_operation()   { /* covers also filtering page */ return ! $this->change_operation()
										&& ! $this->add_operation()    && ! $this->copy_operation()
										&& ! $this->delete_operation() && ! $this->view_operation(); }
	function next_operation()	{ return $this->navop == $this->labels['Next']; }
	function prev_operation()	{ return $this->navop == $this->labels['Prev']; }
	function first_operation()	{ return $this->navop == $this->labels['First']; }
	function last_operation()	{ return $this->navop == $this->labels['Last']; }
	function goto_operation()	{ return $this->navop == $this->labels['Go to']; }
	function clear_operation()	{ return $this->sw == $this->labels['Clear'];  }

	function add_canceled()    { return $this->canceladd    == $this->labels['Cancel']; }
	function view_canceled()   { return $this->cancelview   == $this->labels['Cancel']; }
	function change_canceled() { return $this->cancelchange == $this->labels['Cancel']; }
	function delete_canceled() { return $this->canceldelete == $this->labels['Cancel']; }

	function is_values2($k, $val = 'X') /* {{{ */
	{
		return $val === null ||
			(isset($this->fdd[$k]['values2']) && !isset($this->fdd[$k]['values']['table']));
	} /* }}} */

	function processed($k) /* {{{ */
	{
		if ($this->virtual($k)) {
			return false;
		}
		$options = @$this->fdd[$k]['options'];
		if (! isset($options)) {
			return true;
		}
		return
			($this->saveadd    == $this->labels['Save']  && stristr($options, 'A')) ||
			($this->moreadd    == $this->labels['More']  && stristr($options, 'A')) ||
			($this->savechange == $this->labels['Save']  && stristr($options, 'C')) ||
			($this->morechange == $this->labels['Apply'] && stristr($options, 'C')) ||
			($this->savechange == $this->labels['Save']  && stristr($options, 'P')) ||
			($this->savedelete == $this->labels['Save']  && stristr($options, 'D'));
	} /* }}} */

	function displayed($k) /* {{{ */
	{
		if (is_numeric($k)) {
			$k = $this->fds[$k];
		}
		$options = @$this->fdd[$k]['options'];
		if (! isset($options)) {
			return true;
		}
		return
			($this->add_operation()    && stristr($options, 'A')) ||
			($this->view_operation()   && stristr($options, 'V')) ||
			($this->change_operation() && stristr($options, 'C')) ||
			($this->copy_operation()   && stristr($options, 'P')) ||
			($this->delete_operation() && stristr($options, 'D')) ||
			($this->filter_operation() && stristr($options, 'F')) ||
			($this->list_operation()   && stristr($options, 'L'));
	} /* }}} */
	
	function debug_var($name, $val) /* {{{ */
	{
		if (is_array($val) || is_object($val)) {
			echo "<pre>$name\n";
			ob_start();
			//print_r($val);
			var_dump($val);
			$content = ob_get_contents();
			ob_end_clean();
			echo htmlspecialchars($content);
			echo "</pre>\n";
		} else {
			echo 'debug_var()::<i>',htmlspecialchars($name),'</i>';
			echo '::<b>',htmlspecialchars($val),'</b>::',"<br>\n";
		}
	} /* }}} */

	function myquery($qry, $line = 0, $debug = 0) /* {{{ */
	{
		global $debug_query;
		if ($debug_query || $debug) {
			$line = intval($line);
			echo '<h4>MySQL query at line ',$line,'</h4>',htmlspecialchars($qry),'<hr>',"\n";
		}
		$ret = @mysql_db_query($this->db, $qry, $this->dbh);
		if (! $ret) {
			echo '<h4>MySQL error ',mysql_errno($this->dbh),'</h4>';
			echo htmlspecialchars(mysql_error($this->dbh)),'<hr>',"\n";
		}
		return $ret;
	} /* }}} */

	function make_language_labels($language) /* {{{ */
	{
		// just try the first language and variant
		// this isn't content-negotiation rfc compliant
		$language = strtoupper(substr($language,0,5));

		// try the full language w/ variant
		$file = $this->dir['lang'].'PME.lang.'.$language.'.inc';

		if (! file_exists($file)) {
			// try the language w/o variant
			$file = $this->dir['lang'].'PME.lang.'.substr($language,0,2).'.inc';
		}
		if (! file_exists($file)) {
			// default to classical English
			$file = $this->dir['lang'].'PME.lang.EN.inc';
		}
		$ret = @include($file);
		if (! is_array($ret)) {
			return $ret;
		}
		$small = array(
				'Search' => 'v',
				'Hide'   => '^',
				'Clear'  => 'X',
				'Query'  => htmlspecialchars('>'));
		if ((!$this->nav_text_links() && !$this->nav_graphic_links())
				|| !isset($ret['Search']) || !isset($ret['Query'])
				|| !isset($ret['Hide'])   || !isset($ret['Clear'])) {
			foreach ($small as $key => $val) {
				$ret[$key] = $val;
			}
		}
		return $ret;
	} /* }}} */

	function set_values($field_num, $prepend = null, $append = null, $strict = false) /* {{{ */
	{
		return (array) $prepend + (array) $this->fdd[$field_num]['values2']
			+ (isset($this->fdd[$field_num]['values']['table']) || $strict
					? $this->set_values_from_table($field_num, $strict)
					: array())
			+ (array) $append;
	} /* }}} */

	function set_values_from_table($field_num, $strict = false) /* {{{ */
	{
		$db    = &$this->fdd[$field_num]['values']['db'];
		$table = &$this->fdd[$field_num]['values']['table'];
		$key   = &$this->fdd[$field_num]['values']['column'];
		$desc  = &$this->fdd[$field_num]['values']['description'];
		isset($db) || $db = $this->db;
		$qparts['type'] = 'select';
		if ($table) {
			$qparts['select'] = 'DISTINCT '.$table.'.'.$key;
			if ($desc && is_array($desc) && is_array($desc['columns'])) {
				$qparts['select'] .= ',CONCAT('; // )
				$num_cols = sizeof($desc['columns']);
				if (isset($desc['divs'][-1])) {
					$qparts['select'] .= '"'.addslashes($desc['divs'][-1]).'",';
				}
				foreach ($desc['columns'] as $key => $val) {
					if ($val) {
						$qparts['select'] .= $val;
						if ($desc['divs'][$key]) {
							$qparts['select'] .= ',"'.addslashes($desc['divs'][$key]).'"';
						}
						$qparts['select'] .= ',';
					}
				}
				$qparts['select']{strlen($qparts['select']) - 1} = ')';
				$qparts['select'] .= ' AS PMEalias'.$field_num;
				$qparts['orderby'] = empty($desc['orderby'])
					? 'PMEalias'.$field_num : $desc['orderby'];
			} else if ($desc && is_array($desc)) {
				// TODO
			} else if ($desc) {
				$qparts['select'] .= ','.$table.'.'.$desc;
				$qparts['orderby'] = $desc;
			} else if ($key) {
				$qparts['orderby'] = $key;
			}
			//$qparts['from'] = "$db.$table.$sel;
			$qparts['from'] = "$db.$table";
			$qparts['where'] = $this->fdd[$field_num]['values']['filters'];
			if ($this->fdd[$field_num]['values']['orderby']) {
				$qparts['orderby'] = $this->fdd[$field_num]['values']['orderby'];
			}
		} else { /* simple value extraction */
			$key = &$this->fds[$field_num];
			$this->virtual($field_num) && $key = $this->fqn($field_num);
			$qparts['select']  = 'DISTINCT '.$key.' AS PMEkey';
			$qparts['orderby'] = 'PMEkey';
			$qparts['from']    = $this->db.'.'.$this->tb;
		}
		$values = array();
		$res    = $this->myquery($this->query_make($qparts), __LINE__);
		while ($row = @mysql_fetch_array($res, MYSQL_NUM)) {
			$values[$row[0]] = $desc ? $row[1] : $row[0];
		}
		return $values;
	} /* }}} */

	function fqn($field, $dont_desc = false, $dont_cols = false) /* {{{ */
	{
		is_numeric($field) || $field = array_search($field, $this->fds);
		// if read SQL expression exists use it
		if ($this->col_has_sql($field))
			return $this->fdd[$field]['sql'];
		// on copy/change always use simple key retrieving
		if ($this->add_operation()
				|| $this->copy_operation()
				|| $this->change_operation()) {
				$ret = 'PMEtable0.'.$this->fds[$field];
		} else {
			if ($this->fdd[$this->fds[$field]]['values']['description'] && ! $dont_desc) {
				$desc = &$this->fdd[$this->fds[$field]]['values']['description'];
				if (is_array($desc) && is_array($desc['columns'])) {
					$ret      = 'CONCAT('; // )
					$num_cols = sizeof($desc['columns']);
					if (isset($desc['divs'][-1])) {
						$ret .= '"'.addslashes($desc['divs'][-1]).'",';
					}
					foreach ($desc['columns'] as $key => $val) {
						if ($val) {
							$ret .= 'PMEjoin'.$field.'.'.$val;
							if ($desc['divs'][$key]) {
								$ret .= ',"'.addslashes($desc['divs'][$key]).'"';
							}
							$ret .= ',';
						}
					}
					$ret{strlen($ret) - 1} = ')';
				} else if (is_array($desc)) {
					// TODO
				} else {
					$ret = 'PMEjoin'.$field.'.'.$this->fdd[$this->fds[$field]]['values']['description'];
				}
			// TODO: remove me
			} elseif (0 && $this->fdd[$this->fds[$field]]['values']['column'] && ! $dont_cols) {
				$ret = 'PMEjoin'.$field.'.'.$this->fdd[$this->fds[$field]]['values']['column'];
			} else {
				$ret = 'PMEtable0.'.$this->fds[$field];
			}
			// TODO: not neccessary, remove me!
			if (is_array($this->fdd[$this->fds[$field]]['values2'])) {
			}
		}
		return $ret;
	} /* }}} */

	function create_column_list() /* {{{ */
	{
		$fields = array();
		for ($k = 0; $k < $this->num_fds; $k++) {
			if (! $this->displayed[$k] && $k != $this->key_num) {
				continue;
			}
			$fields[] = $this->fqn($k).' AS qf'.$k;
			if ($this->col_has_values($k)) {
				$fields[] = $this->fqn($k, true, true).' AS qf'.$k.'_idx';
			}
			if ($this->col_has_datemask($k)) {
				$fields[] = 'UNIX_TIMESTAMP('.$this->fqn($k).') AS qf'.$k.'_timestamp';
			}
		}
		return join(',', $fields);
	} /* }}} */

	function query_make($parts) /* {{{ */
	{
		foreach ($parts as $k => $v) {
			$parts[$k] = trim($parts[$k]);
		}
		switch ($parts['type']) {
			case 'select':
				$ret  = 'SELECT ';
				if ($parts['DISTINCT'])
					$ret .= 'DISTINCT ';
				$ret .= $parts['select'];
				$ret .= ' FROM '.$parts['from'];
				if ($parts['where'] != '')
					$ret .= ' WHERE '.$parts['where'];
				if ($parts['groupby'] != '')
					$ret .= ' GROUP BY '.$parts['groupby'];
				if ($parts['having'] != '')
					$ret .= ' HAVING '.$parts['having'];
				if ($parts['orderby'] != '')
					$ret .= ' ORDER BY '.$parts['orderby'];
				if ($parts['limit'] != '')
					$ret .= ' LIMIT '.$parts['limit'];
				if ($parts['procedure'] != '')
					$ret .= ' PROCEDURE '.$parts['procedure'];
				break;
			case 'update':
				$ret  = 'UPDATE '.$parts['table'];
				$ret .= ' SET '.$parts['fields'];
				if ($parts['where'] != '')
					$ret .= ' WHERE '.$parts['where'];
				break;
			case 'insert':
				$ret  = 'INSERT INTO '.$parts['table'];
				$ret .= ' VALUES '.$parts['values'];
				break;
			case 'delete':
				$ret  = 'DELETE FROM '.$parts['table'];
				if ($parts['where'] != '')
					$ret .= ' WHERE '.$parts['where'];
				break;
			default:
				die('unknown query type');
				break;
		}
		return $ret;
	} /* }}} */

	function create_join_clause() /* {{{ */
	{
		$tbs[] = $this->tb;
		$join = $this->tb.' AS PMEtable0';
		for ($k = 0,$numfds = sizeof($this->fds); $k<$numfds; $k++) {
			$field = $this->fds[$k];
			if($this->fdd[$field]['values']['db']) {
				$db = $this->fdd[$field]['values']['db'];
			} else {
				$db = $this->db;
			}
			$table = $this->fdd[$field]['values']['table'];
			$id    = $this->fdd[$field]['values']['column'];
			$desc  = $this->fdd[$field]['values']['description'];
			if ($desc != '' && $id != '') {
				$alias = 'PMEjoin'.$k;
				if (!in_array($alias,$tbs)) {
					$join .= " LEFT OUTER JOIN $db.$table AS $alias";
					$join .= " ON $alias.$id = PMEtable0.$field";
					$tbs[]=$alias;
				}
			}
		}
		return $join;
	} /* }}} */

	function make_where_from_query_opts($qp = null, $text = 0) /* {{{ */
	{
		if ($qp == null) {
			$qp = $this->query_opts;
		}
		$where = array();
		foreach ($qp as $field => $ov) {
			if (is_numeric($field)) {
				$tmp_where = array();
				foreach ($ov as $field2 => $ov2) {
					$tmp_where[] = sprintf('%s %s %s', $field2, $ov2['oper'], $ov2['value']);
				}
				$where[] = '('.join(' OR ', $tmp_where).')';
			} else {
				if (is_array($ov['value'])) {
					$tmp_ov_val = '';
					foreach ($ov['value'] as $ov_val) {
						strlen($tmp_ov_val) > 0 && $tmp_ov_val .= ' OR ';
						$tmp_ov_val .= sprintf('FIND_IN_SET("%s",%s)', $ov_val, $field);
					}
					$where[] = "($tmp_ov_val)";
				} else {
					$where[] = sprintf('%s %s %s', $field, $ov['oper'], $ov['value']);
				}
			}
		}
		// Add any coder specified filters
		if (! $text && $this->filters) {
			$where[] = '('.$this->filters.')';
		}
		if (count($where) > 0) {
			if ($text) {
				return str_replace('%', '*', join(' AND ',$where));
			} else {
				return join(' AND ',$where);
			}
		}
		return false;
	} /* }}} */

	function gather_query_opts() /* {{{ */
	{
		$this->query_opts = array();
		$this->prev_qfn   = $this->qfn;
		$this->qfn        = '';
		if ($this->clear_operation()) {
			return;
		}
		// gathers query options into an array, $this->query_opts
		$qo = array();
		for ($k = 0; $k < $this->num_fds; $k++) {
			$l    = 'qf'.$k;
			$lc   = 'qf'.$k.'_comp';
			$li   = 'qf'.$k.'_id';
			$m    = $this->get_cgi_var($l);
			$mc   = $this->get_cgi_var($lc);
			$mi   = $this->get_cgi_var($li);
			if (! isset($m) && ! isset($mi)) {
				continue;
			}
			if (is_array($m) || is_array($mi)) {
				if (is_array($mi)) {
					$m = $mi;
					$l = $li;
				}
				if (in_array('*', $m)) {
					continue;
				}
				if ($this->col_has_values($k) && $this->col_has_multiple_select($k)) {
					foreach (array_keys($m) as $key) {
						$m[$key] = addslashes($m[$key]);
					}
					$qo[$this->fqn($k)] = array('value' => $m);
				} else {
					$qf_op = '';
					foreach (array_keys($m) as $key) {
						if ($qf_op == '') {
							$qf_op   = 'IN';
							$qf_val  = '"'.addslashes($m[$key]).'"';
							$afilter = ' IN ("'.addslashes($m[$key]).'"'; // )
						} else {
							$afilter = $afilter.',"'.addslashes($m[$key]).'"';
							$qf_val .= ',"'.addslashes($m[$key]).'"';
						}
						$this->qfn .= '&'.$l.'['.rawurlencode($key).']='.rawurlencode($m[$key]);
					}
					$afilter = $afilter.')';
					// XXX: $dont_desc and $dont_cols hack
					$dont_desc = isset($this->fdd[$k]['values']['description']);
					$dont_cols = isset($this->fdd[$k]['values']['column']);
					$qo[$this->fqn($k, $dont_desc, $dont_cols)] =
						array('oper'  => $qf_op, 'value' => "($qf_val)"); // )
				}
			} else if (isset($mi)) {
				if ($mi == '*') {
					continue;
				}
				if ($this->fdd[$k]['select'] != 'M' && $this->fdd[$k]['select'] != 'D' && $mi == '') {
					continue;
				}
				$afilter = addslashes($mi);
				$qo[$this->fqn($k, true, true)] = array('oper'  => '=', 'value' => "'$afilter'");
				$this->qfn .= '&'.$li.'='.rawurlencode($mi);
			} else if (isset($m)) {
				if ($m == '*') {
					continue;
				}
				if ($this->fdd[$k]['select'] != 'M' && $this->fdd[$k]['select'] != 'D' && $m == '') {
					continue;
				}
				$afilter = addslashes($m);
				if ($this->fdd[$k]['select'] == 'N') {
					$mc = in_array($mc, $this->comp_ops) ? $mc : '=';
					$qo[$this->fqn($k)] = array('oper' => $mc, 'value' => "'$afilter'");
					$this->qfn .= '&'.$l .'='.rawurlencode($m);
					$this->qfn .= '&'.$lc.'='.rawurlencode($mc);
				} else {
					$afilter = '%'.str_replace('*', '%', $afilter).'%';
					$ids  = array();
					$ar   = array();
					$ar[$this->fqn($k)] = array('oper' => 'LIKE', 'value' => "'$afilter'");
					if (is_array($this->fdd[$k]['values2'])) {
						foreach ($this->fdd[$k]['values2'] as $key => $val) {
							if (strlen($m) > 0 && stristr($val, $m)) {
								$ids[] = '"'.addslashes($key).'"';
							}
						}
						if (count($ids) > 0) {
							$ar[$this->fqn($k, true, true)]
								= array('oper'  => 'IN', 'value' => '('.join(',', $ids).')');
						}
					}
					$qo[] = $ar;
					$this->qfn .= '&'.$l.'='.rawurlencode($m);
				}
			}
		}
		$this->query_opts = $qo;
	} /* }}} */

	/*
	 * Create JavaScripts
	 */

	function form_begin() /* {{{ */
	{
		/*
		   Need a lot of work in here
		   using something like:
		   $fdd['fieldname']['validate']['js_regex']='/something/';
		   $fdd['fieldname']['validate']['php_regex']='something';
		 */
		$page_name = htmlspecialchars($this->page_name);

		if ($this->add_operation() || $this->change_operation() || $this->copy_operation()
				|| $this->view_operation() || $this->delete_operation()) {
			$field_to_tab = '';
			for ($tab = 0, $k = 0; $k < $this->num_fds; $k++) {
				if (isset($this->fdd[$k]['tab'])) {
					if ($tab == 0 && $k > 0) {
						$this->tabs[0] = 'Initial TAB';
						$tab++;
					}
					$this->tabs[$tab] = @$this->fdd[$k]['tab'];
					$tab++;
				}
				$field_to_tab .= max(0, $tab - 1).', ';
			}
			if ($this->tabs_enabled()) {
				// initial TAB styles
				echo '<style type="text/css" media="screen">',"\n";
				echo '	#phpMyEdit_tab0 { display: block; }',"\n";
				for ($i = 1; $i < count($this->tabs); $i++) {
					echo '	#phpMyEdit_tab',$i,' { display: none;  }',"\n";
				}
				echo '</style>',"\n";
				// TAB javascripts
				echo '<script type="text/javascript"><!--',"\n\n";
				echo 'var phpMyEdit_field_to_tab = [',$field_to_tab,'-1];',"\n";
				$css_class_name1 = $this->getCSSclass('tab', $position);
				$css_class_name2 = $this->getCSSclass('tab-selected', $position);
				echo 'var phpMyEdit_current_tab  = "phpMyEdit_tab0";

function phpMyEdit_show_tab(tab_name)
{';
				if ($this->nav_up()) {
					echo '
	document.getElementById(phpMyEdit_current_tab+"_up_label").className = "',$css_class_name1,'";
	document.getElementById(phpMyEdit_current_tab+"_up_link").className = "',$css_class_name1,'";
	document.getElementById(tab_name+"_up_label").className = "',$css_class_name2,'";
	document.getElementById(tab_name+"_up_link").className = "',$css_class_name2,'";';
				}
				if ($this->nav_down()) {
					echo '
	document.getElementById(phpMyEdit_current_tab+"_down_label").className = "',$css_class_name1,'";
	document.getElementById(phpMyEdit_current_tab+"_down_link").className = "',$css_class_name1,'";
	document.getElementById(tab_name+"_down_label").className = "',$css_class_name2,'";
	document.getElementById(tab_name+"_down_link").className = "',$css_class_name2,'";';
				}
				echo '
	document.getElementById(phpMyEdit_current_tab).style.display = "none";
	document.getElementById(tab_name).style.display = "block";
	phpMyEdit_current_tab = tab_name;
}',"\n\n";
				echo '// --></script>', "\n";
			}
		}

		if ($this->add_operation() || $this->change_operation() || $this->copy_operation()) {
			$required_ar = array();
			for ($k = 0; $k < $this->num_fds; $k++) {
				if ($this->displayed[$k] && $this->fdd[$k]['required']
						&& ! $this->readonly($k) && ! $this->hidden($k)) {
					$required_ar[] = $k;
					if (isset($this->fdd[$k]['regex']['js'])) {
						/* TODO: Use a javascript regex to validate it */
					}
				}
			}

			if (count($required_ar) > 0) {
				echo '<script type="text/javascript"><!--',"\n";
				echo '
function phpMyEdit_trim(str)
{
	while (str.substring(0, 1) == " "
			|| str.substring(0, 1) == "\\n"
			|| str.substring(0, 1) == "\\r")
	{
		str = str.substring(1, str.length);
	}
	while (str.substring(str.length - 1, str.length) == " "
			|| str.substring(str.length - 1, str.length) == "\\n"
			|| str.substring(str.length - 1, str.length) == "\\r")
	{
		str = str.substring(0, str.length - 1);
	}
	return str;
}

function phpMyEdit_form_control(theForm)
{',"\n";
				foreach ($required_ar as $field_num) {
					if ($this->col_has_values($field_num)) {
						$condition = 'theForm.%s.selectedIndex == -1';
						$multiple  = $this->col_has_multiple_select($field_num);
					} else {
						$condition = 'phpMyEdit_trim(theForm.%s.value) == ""';
						$multiple  = false;
					}

					/* Multiple selects have their name like ``name[]''.
					   It is not possible to work with them directly, because
					   theForm.name[].something will result into JavaScript
					   syntax error. Following search algorithm is provided
					   as a workaround for this.
					 */
					if ($multiple) {
						echo '
	multiple_select = null;
	for (i = 0; i < theForm.length; i++) {
		if (theForm.elements[i].name == "',$this->fds[$field_num],'[]") {
			multiple_select = theForm.elements[i];
			break;
		}
	}
	if (multiple_select != null && multiple_select.selectedIndex == -1) {
		alert("',$this->labels['Please enter'],' ',$this->fdd[$field_num]['name'],'.");';
						if ($this->tabs_enabled()) {
							echo '
		phpMyEdit_show_tab("phpMyEdit_tab"+phpMyEdit_field_to_tab['.$field_num.']);';
						}
						echo '
		return false;
	}',"\n";
					} else {
						echo '
	if (',sprintf($condition, $this->fds[$field_num]),') {
		alert("',$this->labels['Please enter'],' ',$this->fdd[$field_num]['name'],'.");';
						if ($this->tabs_enabled()) {
							echo '
		phpMyEdit_show_tab("phpMyEdit_tab"+phpMyEdit_field_to_tab['.$field_num.']);';
						}
						echo '
		theForm.',$this->fds[$field_num],'.focus();
		return false;
	}',"\n";
					}
				}
				echo '
	return true;
}',"\n\n";
				echo '// --></script>', "\n";
			}
		}

		if ($this->filter_operation()) {
				echo '<script type="text/javascript"><!--',"\n";
				echo '
function phpMyEdit_filter_handler(theForm, theEvent)
{
	var pressed_key = null;
	if (theEvent.which) {
		pressed_key = theEvent.which;
	} else {
		pressed_key = theEvent.keyCode;
	}
	if (pressed_key == 13) { // enter pressed
		theForm.submit();
		return false;
	}
	return true;
}',"\n\n";
				echo '// --></script>', "\n";
		}

		if ($this->display['form']) {
			echo '<form class="',$this->getCSSclass('form'),'" method="POST"';
			echo ' action="',$page_name,'" name="phpMyEdit_form">',"\n";
		}
		return true;
	} /* }}} */

	function form_end() /* {{{ */
	{
		if ($this->display['form']) {
			echo '</form>',"\n";
		}
	} /* }}} */

	function display_tab_labels($position) /* {{{ */
	{
		if (! is_array($this->tabs)) {
			return false;
		}
		echo '<table class="',$this->getCSSclass('tab', $position),'">',"\n";
		echo '<tr class="',$this->getCSSclass('tab', $position),'">',"\n";
		for ($i = 0; $i < count($this->tabs); $i++) {
			$css_class_name = $this->getCSSclass($i ? 'tab' : 'tab-selected', $position);
			echo '<td class="',$css_class_name,'" id="phpMyEdit_tab',$i,'_',$position,'_label">';
			echo '<a class="',$css_class_name,'" id="phpMyEdit_tab',$i,'_',$position,'_link';
			echo '" href="javascript:phpMyEdit_show_tab(\'phpMyEdit_tab',$i,'\')">';
			echo $this->tabs[$i],'</a></td>',"\n";
		}
		echo '<td class="',$this->getCSSclass('tab-end', $position),'">&nbsp;</td>',"\n";
		echo '</tr>',"\n";
		echo '</table>',"\n";
	} /* }}} */

	/*
	 * Display functions
	 */

	function display_add_record() /* {{{ */
	{
		for ($tab = 0, $k = 0; $k < $this->num_fds; $k++) {
			if (isset($this->fdd[$k]['tab']) && $this->tabs_enabled() && $k > 0) {
				$tab++;
				echo '</table>',"\n";
				echo '</div>',"\n";
				echo '<div id="phpMyEdit_tab',$tab,'">',"\n";
				echo '<table class="',$this->getCSSclass('main'),'" summary="',$this->tb,'">',"\n";
			}
			if (! $this->displayed[$k]) {
				continue;
			}
			if ($this->hidden($k)) {
				echo $this->htmlHidden($this->fds[$k], $row["qf$k"]);
				continue;
			}
			$css_postfix    = @$this->fdd[$k]['css']['postfix'];
			$css_class_name = $this->getCSSclass('input', null, 'next', $css_postfix);
			echo '<tr class="',$this->getCSSclass('row', null, true, $css_postfix),'">',"\n";
			echo '<td class="',$this->getCSSclass('key', null, true, $css_postfix),'">',$this->fdd[$k]['name'],'</td>',"\n";
			echo '<td class="',$this->getCSSclass('value', null, true, $css_postfix),'"';
			echo $this->getColAttributes($k),">\n";
			if ($this->col_has_values($k)) {
				$vals       = $this->set_values($k);
				$selected   = @$this->fdd[$k]['default'];
				$multiple   = $this->col_has_multiple_select($k);
				$readonly   = $this->readonly($k);
				$strip_tags = true;
				$escape     = true;
				echo $this->htmlSelect($this->fds[$k], $css_class_name, $vals, $selected,
						$multiple, $readonly, $strip_tags, $escape);
			} elseif (isset ($this->fdd[$k]['textarea'])) {
				echo '<textarea class="',$css_class_name,'" name="',$this->fds[$k],'"';
				echo ($this->readonly($k) ? ' disabled' : '');
				if (intval($this->fdd[$k]['textarea']['rows']) > 0) {
					echo ' rows="',$this->fdd[$k]['textarea']['rows'],'"';
				}
				if (intval($this->fdd[$k]['textarea']['cols']) > 0) {
					echo ' cols="',$this->fdd[$k]['textarea']['cols'],'"';
				}
				if (isset($this->fdd[$k]['textarea']['wrap'])) {
					echo ' wrap="',$this->fdd[$k]['textarea']['wrap'],'"';
				} else {
					echo ' wrap="virtual"';
				}
				echo '>',htmlspecialchars($this->fdd[$k]['default']),'</textarea>',"\n";
			} else {
				// Simple edit box required
				$size_ml_props = '';
				$maxlen = intval($this->fdd[$k]['maxlen']);
				$size   = isset($this->fdd[$k]['size']) ? $this->fdd[$k]['size'] : min($maxlen, 60); 
				$size   && $size_ml_props .= ' size="'.$size.'"';
				$maxlen && $size_ml_props .= ' maxlength="'.$maxlen.'"';
				echo '<input class="',$css_class_name,'" type="text" ';
				echo ($this->readonly($k) ? 'disabled ' : ''),' name="',$this->fds[$k],'"';
				echo $size_ml_props,' value="';
				echo htmlspecialchars($this->fdd[$k]['default']),'">';
			}
			echo '</td>',"\n";
			if ($this->guidance) {
				$css_class_name = $this->getCSSclass('help', null, true, $css_postfix);
				$cell_value     = $this->fdd[$k]['help'] ? $this->fdd[$k]['help'] : '&nbsp;';
				echo '<td class="',$css_class_name,'">',$cell_value,'</td>',"\n";
			}
			echo '</tr>',"\n";
		}
	} /* }}} */

	function display_copy_change_delete_record() /* {{{ */
	{
		/*
		 * For delete or change: SQL SELECT to retrieve the selected record
		 */

		$qparts['type']   = 'select';
		$qparts['select'] = $this->create_column_list();
		$qparts['from']   = $this->create_join_clause();
		$qparts['where']  = '('.$this->fqn($this->key).'='
			.$this->key_delim.$this->rec.$this->key_delim.')';

		$res = $this->myquery($this->query_make($qparts),__LINE__);
		if (! ($row = @mysql_fetch_array($res, MYSQL_ASSOC))) {
			return false;
		}
		for ($tab = 0, $k = 0; $k < $this->num_fds; $k++) {
			if (isset($this->fdd[$k]['tab']) && $this->tabs_enabled() && $k > 0) {
				$tab++;
				echo '</table>',"\n";
				echo '</div>',"\n";
				echo '<div id="phpMyEdit_tab',$tab,'">',"\n";
				echo '<table class="',$this->getCSSclass('main'),'" summary="',$this->tb,'">',"\n";
			}
			if (! $this->displayed[$k]) {
				continue;
			}
			if ($this->copy_operation() || $this->change_operation()) {
				if ($this->hidden($k)) {
					if ($k != $this->key_num) {
						echo $this->htmlHidden($this->fds[$k], $row["qf$k"]);
					}
					continue;
				}
				$css_postfix = @$this->fdd[$k]['css']['postfix'];
				echo '<tr class="',$this->getCSSclass('row', null, 'next', $css_postfix),'">',"\n";
				echo '<td class="',$this->getCSSclass('key', null, true, $css_postfix),'">',$this->fdd[$k]['name'],'</td>',"\n";
				/* There are two possibilities of readonly fields handling:
				   1. Display plain text for readonly timestamps and dates.
				   2. Display disabled input field
				   In all cases particular readonly field will NOT be saved. */
				if ($this->col_has_datemask($k) && $this->readonly($k)) {
					echo $this->display_delete_field($row, $k);
				} elseif ($this->password($k)) {
					echo $this->display_password_field($row, $k);
				} else {
					echo $this->display_change_field($row, $k);
				}
				if ($this->guidance) {
					$css_class_name = $this->getCSSclass('help', null, true, $css_postfix);
					$cell_value     = $this->fdd[$k]['help'] ? $this->fdd[$k]['help'] : '&nbsp;';
					echo '<td class="',$css_class_name,'">',$cell_value,'</td>',"\n";
				}
				echo '</tr>',"\n";
			} elseif ($this->delete_operation() || $this->view_operation()) {
				$css_postfix = @$this->fdd[$k]['css']['postfix'];
				echo '<tr class="',$this->getCSSclass('row', null, 'next', $css_postfix),'">',"\n";
				echo '<td class="',$this->getCSSclass('key', null, true, $css_postfix),'">',$this->fdd[$k]['name'],'</td>',"\n";
				if ($this->password($k)) {
					echo '<td class="',$this->getCSSclass('value', null, true, $css_postfix),'"';
					echo $this->getColAttributes($k),'>',$this->labels['hidden'],'</td>',"\n";
				} else {
					$this->display_delete_field($row, $k);
				}
				if ($this->guidance) {
					$css_class_name = $this->getCSSclass('help', null, true, $css_postfix);
					$cell_value     = $this->fdd[$k]['help'] ? $this->fdd[$k]['help'] : '&nbsp;';
					echo '<td class="',$css_class_name,'">',$cell_value,'</td>',"\n";
				}
				echo '</tr>',"\n";
			}
		}
	} /* }}} */

	function display_change_field($row, $k) /* {{{ */
	{
		$css_postfix    = @$this->fdd[$k]['css']['postfix'];
		$css_class_name = $this->getCSSclass('input', null, true, $css_postfix);
		echo '<td class="',$this->getCSSclass('value', null, true, $css_postfix),'"';
		echo $this->getColAttributes($k),">\n";
		if ($this->col_has_values($k)) {
			$vals       = $this->set_values($k);
			$multiple   = $this->col_has_multiple_select($k);
			$readonly   = $this->readonly($k);
			$strip_tags = true;
			$escape     = true;
			echo $this->htmlSelect($this->fds[$k], $css_class_name, $vals, $row["qf$k"],
					$multiple, $readonly, $strip_tags, $escape);
		} elseif (isset($this->fdd[$k]['textarea'])) {
			echo '<textarea class="',$css_class_name,'" name="',$this->fds[$k],'"';
			echo ($this->readonly($k) ? ' disabled' : '');
			if (intval($this->fdd[$k]['textarea']['rows']) > 0) {
				echo ' rows="',$this->fdd[$k]['textarea']['rows'],'"';
			}
			if (intval($this->fdd[$k]['textarea']['cols']) > 0) {
				echo ' cols="',$this->fdd[$k]['textarea']['cols'],'"';
			}
			if (isset($this->fdd[$k]['textarea']['wrap'])) {
				echo ' wrap="',$this->fdd[$k]['textarea']['wrap'],'"';
			} else {
				echo ' wrap="virtual"';
			}
			echo '>',htmlspecialchars($row["qf$k"]),'</textarea>',"\n";
		} else {
			$size_ml_props = '';
			$maxlen = intval($this->fdd[$k]['maxlen']);
			$size   = isset($this->fdd[$k]['size']) ? $this->fdd[$k]['size'] : min($maxlen, 60); 
			$size   && $size_ml_props .= ' size="'.$size.'"';
			$maxlen && $size_ml_props .= ' maxlength="'.$maxlen.'"';
			echo '<input class="',$css_class_name,'" type="text" ';
			echo ($this->readonly($k) ? 'disabled ' : ''),'name="',$this->fds[$k],'" value="';
			echo htmlspecialchars($row["qf$k"]),'" ',$size_ml_props,'>',"\n";
		}
		echo '</td>',"\n";
	} /* }}} */

	function display_password_field($row, $k) /* {{{ */
	{
		$css_postfix = @$this->fdd[$k]['css']['postfix'];
		echo '<td class="',$this->getCSSclass('value', null, true, $css_postfix),'"';
		echo $this->getColAttributes($k),">\n";
		$size_ml_props = '';
		$maxlen = intval($this->fdd[$k]['maxlen']);
		$size   = isset($this->fdd[$k]['size']) ? $this->fdd[$k]['size'] : min($maxlen, 60); 
		$size   && $size_ml_props .= ' size="'.$size.'"';
		$maxlen && $size_ml_props .= ' maxlength="'.$maxlen.'"';
		echo '<input class="',$this->getCSSclass('value', null, true, $css_postfix),'" type="password" ';
		echo ($this->readonly($k) ? 'disabled ' : ''),'name="',$this->fds[$k],'" value="';
		echo htmlspecialchars($row["qf$k"]),'" ',$size_ml_props,'>',"\n";
		echo '</td>',"\n";
	} /* }}} */

	function display_delete_field($row, $k) /* {{{ */
	{
		$css_postfix    = @$this->fdd[$k]['css']['postfix'];
		$css_class_name = $this->getCSSclass('value', null, true, $css_postfix);
		echo '<td class="',$css_class_name,'"',$this->getColAttributes($k),">\n";
		echo $this->cellDisplay($k, $row, $css_class_name);
		echo '</td>',"\n";
	} /* }}} */

	/**
	 * Returns CSS class name
	 */
	function getCSSclass($name, $position  = null, $divider = null, $postfix = null) /* {{{ */
	{
		static $div_idx = -1;
		$elements = array($this->css['prefix'], $name);
		if ($this->page_type && $this->css['page_type']) {
			if ($this->page_type != 'L' && $this->page_type != 'F') {
				$elements[] = $this->page_types[$this->page_type];
			}
		}
		if ($position && $this->css['position']) {
			$elements[] = $position;
		}
		if ($divider && $this->css['divider']) {
			if ($divider === 'next') {
				$div_idx++;
				if ($this->css['divider'] > 0 && $div_idx >= $this->css['divider']) {
					$div_idx = 0;
				}
			}
			$elements[] = $div_idx;
		}
		if ($postfix) {
			$elements[] = $postfix;
		}
		return join($this->css['separator'], $elements);
	} /* }}} */

	/**
	 * Returns field cell HTML attributes
	 */
	function getColAttributes($k) /* {{{ */
	{
		$colattrs = '';
		if (isset($this->fdd[$k]['colattrs'])) {
			$colattrs .= ' ';
			$colattrs .= trim($this->fdd[$k]['colattrs']);
		}
		if (isset($this->fdd[$k]['nowrap'])) {
			$colattrs .= ' nowrap';
		}
		return $colattrs;
	} /* }}} */

	/**
	 * Substitutes variables in string
	 * (this is very simple but secure eval() replacement)
	 */
	function substituteVars($str, $subst_ar) /* {{{ */
	{
		$array = preg_split('/\\$(\w+)/', $str, -1, PREG_SPLIT_DELIM_CAPTURE);
		for ($i = 1; $i < count($array); $i += 2) {
			if (isset($subst_ar[$array[$i]]))
				$array[$i] = $subst_ar[$array[$i]];
		}
		return join('', $array);
	} /* }}} */

	/**
	 * Print URL
	 */
	function urlDisplay($k, $link_val, $disp_val, $css, $key) /* {{{ */
	{
		$ret  = '';
		$name = $this->fds[$k];
		$page = $this->page_name;
		$url  = 'rec='.$key.'&fm='.$this->fm.'&fl='.$this->fl;
		$url .= '&qfn='.rawurlencode($this->qfn).$this->qfn;
		$url .= '&'.$this->get_sfn_cgi_vars().$this->cgi['persist'];
		$ar   = array(
				'key'   => $key,
				'name'  => $name,
				'link'  => $link_val,
				'value' => $disp_val,
				'css'   => $css,
				'page'  => $page,
				'url'   => $url
				);
		$urllink = isset($this->fdd[$k]['URL'])
			?  $this->substituteVars($this->fdd[$k]['URL'], $ar)
			: $link_val;
		$urldisp = isset($this->fdd[$k]['URLdisp'])
			?  $this->substituteVars($this->fdd[$k]['URLdisp'], $ar)
			: $disp_val;
		$target = isset($this->fdd[$k]['URLtarget'])
			? 'target="'.htmlspecialchars($this->fdd[$k]['URLtarget']).'" '
			: '';
		$prefix_found  = false;
		$postfix_found = false;
		$prefix_ar     = @$this->fdd[$k]['URLprefix'];
		$postfix_ar    = @$this->fdd[$k]['URLpostfix'];
		is_array($prefix_ar)  || $prefix_ar  = array($prefix_ar);
		is_array($postfix_ar) || $postfix_ar = array($postfix_ar);
		foreach ($prefix_ar as $prefix) {
			if (! strncmp($prefix, $urllink, strlen($prefix))) {
				$prefix_found = true;
				break;
			}
		}
		foreach ($postfix_ar as $postfix) {
			if (! strncmp($postfix, $urllink, strlen($postfix))) {
				$postfix_found = true;
				break;
			}
		}
		$prefix_found  || $urllink = array_shift($prefix_ar).$urllink;
		$postfix_found || $urllink = $urllink.array_shift($postfix_ar);
		if (strlen($urllink) <= 0 || strlen($urldisp) <= 0) {
			$ret = '&nbsp;';
		} else {
			$urllink = htmlspecialchars($urllink);
			$urldisp = htmlspecialchars($urldisp);
			$ret = '<a '.$target.'class="'.$css.'" href="'.$urllink.'">'.$urldisp.'</a>';
		}
		return $ret;
	} /* }}} */

	function cellDisplay($k, $row, $css) /* {{{ */
	{
		$escape  = isset($this->fdd[$k]['escape']) ? $this->fdd[$k]['escape'] : true;
		$key_rec = $row['qf'.$this->key_num];
		if (@$this->fdd[$k]['datemask']) {
			$value = intval($row["qf$k".'_timestamp']);
			$value = $value ? @date($this->fdd[$k]['datemask'], $value) : '';
		} else if (@$this->fdd[$k]['strftimemask']) {
			$value = intval($row["qf$k".'_timestamp']);
			$value = $value ? @strftime($this->fdd[$k]['strftimemask'], $value) : '';
		} else if ($this->is_values2($k, $row["qf$k"])) {
			$value = $row['qf'.$k.'_idx'];
			if ($this->fdd[$k]['select'] == 'M') {
				$value_ar  = explode(',', $value);
				$value_ar2 = array();
				foreach ($value_ar as $value_key) {
					if (isset($this->fdd[$k]['values2'][$value_key])) {
						$value_ar2[$value_key] = $this->fdd[$k]['values2'][$value_key];
						$escape = false;
					}
				}
				$value = join(', ', $value_ar2);
			} else {
				if (isset($this->fdd[$k]['values2'][$value])) {
					$value  = $this->fdd[$k]['values2'][$value];
					$escape = false;
				}
			}
		} else {
			$value = $row["qf$k"];
		}
		$original_value = $value;
		if (@$this->fdd[$k]['strip_tags']) {
			$value = strip_tags($value);
		}
		if (intval($this->fdd[$k]['trimlen']) > 0 && strlen($value) > $this->fdd[$k]['trimlen']) {
			$value = ereg_replace("[\r\n\t ]+",' ',$value);
			$value = substr($value, 0, $this->fdd[$k]['trimlen'] - 3).'...';
		}
		if (@$this->fdd[$k]['mask']) {
			$value = sprintf($this->fdd[$k]['mask'], $value);
		}
		if ($this->col_has_URL($k)) {
			return $this->urlDisplay($k, $original_value, $value, $css, $key_rec);
		}
		if (strlen($value) <= 0) {
			return '&nbsp;';
		}
		if ($escape) {
			$value = htmlspecialchars($value);
		}
		return nl2br($value);
	} /* }}} */

	/**
	 * Creates HTML submit input element
	 *
	 * @param	name			element name
	 * @param	label			key in the language hash used as label
	 * @param	css_class_name	CSS class name
	 * @param	js_validation	if add JavaScript validation subroutine to button
	 * @param	disabled		if mark the button as disabled
	 */
	function htmlSubmit($name, $label, $css_class_name, $js_validation = true, $disabled = false) /* {{{ */
	{
		// Note that <input disabled> isn't valid HTML, but most browsers support it
		$markdisabled = $disabled ? ' disabled' : '';
		$ret = '<input'.$markdisabled.' type="submit" class="'.$css_class_name
			.'" name="'.ltrim($markdisabled).$name
			.'" value="'.(isset($this->labels[$label]) ? $this->labels[$label] : $label);
		if ($js_validation) {
			$ret .= '" onClick="return phpMyEdit_form_control(this.form);';
		}
		$ret .= '">';
		return $ret;
	} /* }}} */

	/**
	 * Creates HTML hidden input element
	 *
	 * @param	name	element name
	 * @param	value	value
	 */
	function htmlHidden($name, $value) /* {{{ */
	{
		return '<input type="hidden" name="'.htmlspecialchars($name)
			.'" value="'.htmlspecialchars($value).'">'."\n";
	} /* }}} */

	/**
	 * Creates HTML select element (tag)
	 *
	 * @param	name		element name
	 * @param	css			CSS class name
	 * @param	kv_array	key => value array
	 * @param	selected	selected key (it can be single string, array of
	 *						keys or multiple values separated by comma)
	 * @param	multiple	bool for multiple selection
	 * @param	readonly	bool for readonly/disabled selection
	 * @param	strip_tags	bool for stripping tags from values
	 * @param	escape		bool for HTML escaping values
	 */
	function htmlSelect($name, $css, $kv_array, $selected = null, /* ...) {{{ */
			/* booleans: */ $multiple = false, $readonly = false, $strip_tags = false, $escape = true)
	{
		$ret = '<select class="'.htmlspecialchars($css).'" name="'.htmlspecialchars($name);
		if ($multiple) {
			$ret  .= '[]" multiple size="'.$this->multiple;
			if (! is_array($selected) && $selected !== null) {
				$selected = explode(',', $selected);
			}
		}
		$ret .= '"'.($readonly ? ' disabled' : '').'>'."\n";
		if (! is_array($selected)) {
			$selected = $selected === null ? array() : array($selected);
		}
		$found = false;
		foreach ($kv_array as $key => $value) {
			$ret .= '<option value="'.htmlspecialchars($key).'"';
			if ((! $found || $multiple) && in_array((string) $key, $selected, 1)
					|| (count($selected) == 0 && ! $found && ! $multiple)) {
				$ret  .= ' selected';
				$found = true;
			}
			$strip_tags && $value = strip_tags($value);
			$escape     && $value = htmlspecialchars($value);
			$ret .= '>'.$value.'</option>'."\n";
		}
		$ret .= '</select>';
		return $ret;
	} /* }}} */

    /**
     * Returns original variables HTML code for use in forms or links.
     *
     * @param   mixed   $origvars       string or array of original varaibles
     * @param   string  $method         type of method ("POST" or "GET")
     * @param   mixed   $default_value  default value of variables
     *                                  if null, empty values will be skipped
     * @return                          get HTML code of original varaibles
     */
    function get_origvars_html($origvars, $method = 'POST', $default_value = '') /* {{{ */
    {
        $ret    = '';
        $method = strtoupper($method);
        if ($method == 'POST') {
            if (! is_array($origvars)) {
                $new_origvars = array();
                foreach (explode('&', $origvars) as $param) {
                    $parts = explode('=', $param, 2);
                    if (! isset($parts[1])) {
                        $parts[1] = $default_value;
                    }
                    if (strlen($parts[0]) <= 0) {
                        continue;
                    }
                    $new_origvars[$parts[0]] = $parts[1];
                }
                $origvars =& $new_origvars;
            }
            foreach ($origvars as $key => $val) {
                if (strlen($val) <= 0 && $default_value === null) {
                    continue;
                }
                $key = rawurldecode($key);
                $val = rawurldecode($val);
                $ret .= '<input type="hidden" name="';
                $ret .= htmlspecialchars($key).'"';
                $ret .= ' value="'.htmlspecialchars($val).'"';
                $ret .= " />\n";
            }
        } else if (! strncmp('GET', $method, 3)) {
            if (! is_array($origvars)) {
                $ret .= $origvars;
            } else {
                foreach ($origvars as $key => $val) {
                    if (strlen($val) <= 0 && $default_value === null) {
                        continue;
                    }
                    $ret == '' || $ret .= '&amp;';
                    $ret .= htmlspecialchars(rawurlencode($key));
                    $ret .= '=';
                    $ret .= htmlspecialchars(rawurlencode($val));
                }
            }
            if ($method[strlen($method) - 1] == '+') {
                $ret = "?$ret";
            }
        } else {
            trigger_error('Unsupported Platon::get_origvars_html() method: '
                    .$method, E_USER_ERROR);
        }
        return $ret;
    } /* }}} */

	function get_sfn_cgi_vars($alternative_sfn = null) /* {{{ */
	{
		if ($alternative_sfn == null) { // FAST! (cached return value)
			static $ret = null;
			$ret == null && $ret = $this->get_sfn_cgi_vars($this->sfn);
			return $ret;
		}
		$ret = '';
		$i   = 0;
		foreach ($alternative_sfn as $val) {
			$ret != '' && $ret .= '&';
			$ret .= "sfn[$i]=".rawurlencode($val);
			$i++;
		}
		return $ret;
	} /* }}} */

	function get_cgi_var($name, $default_value = null) /* {{{ */
	{
		if (isset($this) && isset($this->cgi['overwrite'][$name])) {
			return $this->cgi['overwrite'][$name];
		}

		static $magic_quotes_gpc = null;
		if ($magic_quotes_gpc === null) {
			$magic_quotes_gpc = get_magic_quotes_gpc();
		}
		global $HTTP_GET_VARS;
		$var = @$HTTP_GET_VARS[$name];
		if (! isset($var)) {
			global $HTTP_POST_VARS;
			$var = @$HTTP_POST_VARS[$name];
		}
		if (isset($var)) {
			if ($magic_quotes_gpc) {
				if (is_array($var)) {
					foreach (array_keys($var) as $key) {
						$var[$key] = stripslashes($var[$key]);
					}
				} else {
					$var = stripslashes($var);
				}
			}
		} else {
			$var = @$default_value;
		}

		if (isset($this) && $var === null && isset($this->cgi['append'][$name])) {
			return $this->cgi['append'][$name];
		}
		return $var;
	} /* }}} */

	function get_server_var($name) /* {{{ */
	{
		if (isset($_SERVER[$name])) {
			return $_SERVER[$name];
		}
		global $HTTP_SERVER_VARS;
		if (isset($HTTP_SERVER_VARS[$name])) {
			return $HTTP_SERVER_VARS[$name];
		}
		global $$name;
		if (isset($$name)) {
			return $$name;
		}
		return null;
	} /* }}} */

	/*
	 * Debug functions
	 */

	function print_get_vars ($miss = 'No GET variables found') // debug only /* {{{ */
	{
		global $HTTP_GET_VARS;

		// we parse form GET variables
		if (is_array($HTTP_GET_VARS)) {
			echo "<p> Variables per GET ";
			foreach ($HTTP_GET_VARS as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $akey => $aval) {
						// $HTTP_GET_VARS[$k][$akey] = strip_tags($aval);
						// $$k[$akey] = strip_tags($aval);
						echo "$k\[$akey\]=$aval   ";
					}
				} else {
					// $HTTP_GET_VARS[$k] = strip_tags($val);
					// $$k = strip_tags($val);
					echo "$k=$v   ";
				}
			}
			echo '</p>';
		} else {
			echo '<p>';
			echo $miss;
			echo '</p>';
		}
	} /* }}} */

	function print_post_vars($miss = 'No POST variables found')  // debug only /* {{{ */
	{
		global $HTTP_POST_VARS;
		// we parse form POST variables
		if (is_array($HTTP_POST_VARS)) {
			echo "<p>Variables per POST ";
			foreach ($HTTP_POST_VARS as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $akey => $aval) {
						// $HTTP_POST_VARS[$k][$akey] = strip_tags($aval);
						// $$k[$akey] = strip_tags($aval);
						echo "$k\[$akey\]=$aval   ";
					}
				} else {
					// $HTTP_POST_VARS[$k] = strip_tags($val);
					// $$k = strip_tags($val);
					echo "$k=$v   ";
				}
			}
			echo '</p>';
		} else {
			echo '<p>';
			echo $miss;
			echo '</p>';
		}
	} /* }}} */

	function print_vars ($miss = 'Current instance variables')  // debug only /* {{{ */
	{
		echo "$miss   ";
		echo 'page_name=',$this->page_name,'   ';
		echo 'hn=',$this->hn,'   ';
		echo 'un=',$this->un,'   ';
		echo 'pw=',$this->pw,'   ';
		echo 'db=',$this->db,'   ';
		echo 'tb=',$this->tb,'   ';
		echo 'key=',$this->key,'   ';
		echo 'key_type=',$this->key_type,'   ';
		echo 'inc=',$this->inc,'   ';
		echo 'options=',$this->options,'   ';
		echo 'fdd=',$this->fdd,'   ';
		echo 'fl=',$this->fl,'   ';
		echo 'fm=',$this->fm,'   ';
		echo 'sfn=',htmlspecialchars($this->get_sfn_cgi_vars()),'   ';
		echo 'qfn=',$this->qfn,'   ';
		echo 'sw=',$this->sw,'   ';
		echo 'rec=',$this->rec,'   ';
		echo 'navop=',$this->navop,'   ';
		echo 'saveadd=',$this->saveadd,'   ';
		echo 'moreadd=',$this->moreadd,'   ';
		echo 'canceladd=',$this->canceladd,'   ';
		echo 'savechange=',$this->savechange,'   ';
		echo 'morechange=',$this->morechange,'   ';
		echo 'cancelchange=',$this->cancelchange,'   ';
		echo 'savedelete=',$this->savedelete,'   ';
		echo 'canceldelete=',$this->canceldelete,'   ';
		echo 'cancelview=',$this->cancelview,'   ';
		echo 'operation=',$this->operation,'   ';
		echo "\n";
	} /* }}} */

	/*
	 * Display buttons at top and bottom of page
	 */
	function display_list_table_buttons($total_recs, $position) /* {{{ */
	{
		echo '<table class="',$this->getCSSclass('navigation', $position),'">',"\n";
		echo '<tr class="',$this->getCSSclass('navigation', $position),'">',"\n";
		echo '<td class="',$this->getCSSclass('buttons', $position),'">',"\n";
		$listall      = $this->inc <= 0; // Are we doing a listall?
		$disabledprev = !($this->fm > 0 && !$listall);
		$disablednext = !($this->fm + $this->inc < $total_recs && ! $listall);
		$disabledgoto = !($listall || ($disablednext && $disabledprev)) ? '' : ' disabled';
		$current_page = intval($this->fm / $this->inc) + 1;
		$total_pages  = max(1, ceil($total_recs / abs($this->inc)));
		if (!$listall) {
			echo $this->htmlSubmit('navop', 'First', $this->getCSSclass('first', $position), false, $disabledprev), '&nbsp;';
			echo $this->htmlSubmit('navop', 'Prev', $this->getCSSclass('prev', $position), false, $disabledprev), '&nbsp;';
		}
		if ($this->add_enabled()) {
			echo $this->htmlSubmit('operation', 'Add', $this->getCSSclass('add', $position), false, false), '&nbsp;';
		}
		if ($this->nav_buttons()) {
			if ($this->view_enabled()) {
				echo $this->htmlSubmit('operation', 'View', $this->getCSSclass('view', $position), false, !$total_recs), '&nbsp;';
			}
			if ($this->change_enabled()) {
				echo $this->htmlSubmit('operation', 'Change', $this->getCSSclass('change', $position), false, !$total_recs), '&nbsp;';
			}
			if ($this->copy_enabled()) {
				echo $this->htmlSubmit('operation', 'Copy', $this->getCSSclass('copy', $position), false, !$total_recs), '&nbsp;';
			}
			if ($this->delete_enabled()) {
				echo $this->htmlSubmit('operation', 'Delete', $this->getCSSclass('delete', $position), false, !$total_recs), '&nbsp;';
			}
		}
		if (!$listall) { //nav buttons are not displayed if explicit listall
			echo $this->htmlSubmit('navop', 'Next', $this->getCSSclass('next', $position), false, $disablednext), '&nbsp;';
			echo $this->htmlSubmit('navop', 'Last', $this->getCSSclass('last', $position), false, $disablednext), '&nbsp;';
			echo $this->htmlSubmit('navop', 'Go to', $this->getCSSclass('goto', $position), false,
				($listall || ($disablednext && $disabledprev)));
			echo '<select',$disabledgoto,' class="',$this->getCSSclass('goto', $position);
			echo '" name="',ltrim($disabledgoto),'navfm',$position,'" onChange="return this.form.submit();">',"\n";
			for ($i = 0; $i < $total_pages; $i++) {
				echo '<option',($this->fm == $this->inc * $i) ? ' selected' : '';
				echo ' value="',$this->inc * $i,'">',$i + 1,'</option>',"\n";
			}
			echo '</select>';
		}
		echo '</td>',"\n";
		// Message is now written here
		if (strlen(@$this->message) > 0) {
			echo '<td class="',$this->getCSSclass('message', $position),'">',$this->message,'</td>',"\n";
		}
		// Display page and records statistics
		echo '<td class="',$this->getCSSclass('stats', $position),'">',"\n";
		if ($listall) {
			echo $this->labels['Page'],':&nbsp;1&nbsp;',$this->labels['of'],'&nbsp;1';
		} else {
			echo $this->labels['Page'],':&nbsp;',$current_page;
			echo '&nbsp;',$this->labels['of'],'&nbsp;',$total_pages;
		}
		echo '&nbsp; ',$this->labels['Records'],':&nbsp;',$total_recs;
		echo '</td></tr></table>',"\n";
	} /* }}} */

	/*
	 * Display buttons at top and bottom of page
	 */
	function display_record_buttons($position) /* {{{ */
	{
		echo '<table class="',$this->getCSSclass('navigation', $position),'">',"\n";
		echo '<tr class="',$this->getCSSclass('navigation', $position),'">',"\n";
		echo '<td class="',$this->getCSSclass('buttons', $position),'">',"\n";
		if ($this->change_operation()) {
			echo $this->htmlSubmit('savechange', 'Save', $this->getCSSclass('save', $position), true), '&nbsp;';
			echo $this->htmlSubmit('morechange', 'Apply', $this->getCSSclass('more', $position), true), '&nbsp;';
			echo $this->htmlSubmit('cancelchange', 'Cancel', $this->getCSSclass('cancel', $position), false);
		} elseif ($this->add_operation()) {
			echo $this->htmlSubmit('saveadd', 'Save', $this->getCSSclass('save', $position), true), '&nbsp;';
			echo $this->htmlSubmit('moreadd', 'More', $this->getCSSclass('more', $position), true), '&nbsp;';
			echo $this->htmlSubmit('canceladd', 'Cancel', $this->getCSSclass('cancel', $position), false);
		} elseif ($this->copy_operation()) {
			echo $this->htmlSubmit('saveadd', 'Save', $this->getCSSclass('save', $position), true), '&nbsp;';
			echo $this->htmlSubmit('canceladd', 'Cancel', $this->getCSSclass('cancel', $position), false);
		} elseif ($this->delete_operation()) {
			echo $this->htmlSubmit('savedelete', 'Delete', $this->getCSSclass('save', $position), true), '&nbsp;';
			echo $this->htmlSubmit('canceldelete', 'Cancel', $this->getCSSclass('cancel', $position), false);
		} elseif ($this->view_operation()) {
			if ($this->change_enabled()) {
				echo $this->htmlSubmit('operation', 'Change', $this->getCSSclass('save', $position), true), '&nbsp;';
			}
			echo $this->htmlSubmit('cancelview', 'Cancel', $this->getCSSclass('cancel', $position), false);
		}
		// Message is now written here
		echo '</td>',"\n";
		if (strlen(@$this->message) > 0) {
			echo '<td class="',$this->getCSSclass('message', $position),'">',$this->message,'</td>',"\n";
		}
		echo '</tr></table>',"\n";
	} /* }}} */

	/*
	 * Table Page Listing
	 */
	function list_table() /* {{{ */
	{
		// Cancel Triggers
		if ($this->add_canceled() && isset($this->triggers['insert']['cancel'])) {
			include($this->triggers['insert']['cancel']);
		}
		if ($this->view_canceled() && isset($this->triggers['select']['cancel'])) {
			include($this->triggers['select']['cancel']);
		}
		if ($this->change_canceled() && isset($this->triggers['update']['cancel'])) {
			include($this->triggers['update']['cancel']);
		}
		if ($this->delete_canceled() && isset($this->triggers['delete']['cancel'])) {
			include($this->triggers['delete']['cancel']);
		}
		if ($this->fm == '') {
			$this->fm = 0;
		}
		if ($this->prev_operation()) {
			$this->fm = $this->fm - $this->inc;
			if ($this->fm < 0) {
				$this->fm = 0;
			}
		}
		if ($this->first_operation()) {
			$this->fm = 0;
		} // last operation must be performed below, after retrieving total_recs
		if ($this->next_operation()) {
			$this->fm += $this->inc;
		}
		if ($this->goto_operation()) {
			$this->fm = $this->navfm;
		}
		// If sort sequence has changed, restart listing
		$this->qfn != $this->prev_qfn && $this->fm = 0;
		if (0) { // DEBUG
			echo 'qfn vs. prev_qfn comparsion ';
			echo '[<b>',htmlspecialchars($this->qfn),'</b>]';
			echo '[<b>',htmlspecialchars($this->prev_qfn),'</b>]<br>';
			echo 'comparsion <u>',($this->qfn == $this->prev_qfn ? 'proved' : 'failed'),'</u>';
			echo '<hr>';
		}
		/*
		 * If user is allowed to Change/Delete records, we need an extra column
		 * to allow users to select a record
		 */
		$select_recs = $this->key != '' &&
			($this->change_enabled() || $this->delete_enabled() || $this->view_enabled());
		// Are we doing a listall?
		$listall = $this->inc <= 0;
		/*
		 * Display the MySQL table in an HTML table
		 */
		$this->form_begin();
		echo $this->get_origvars_html($this->get_sfn_cgi_vars());
		echo '<input type="hidden" name="fl" value="',$this->fl,'">',"\n";
		// Display buttons at top and/or bottom of page.
		// Setup query to get num_rows. (sparky)
		$total_recs  = 0;
		$count_parts = array(
				'type'   => 'select',
				'select' => 'count(*)',
				'from'   => $this->create_join_clause(),
				'where'  => $this->make_where_from_query_opts());
		$res = $this->myquery($this->query_make($count_parts), __LINE__);
		$row = @mysql_fetch_array($res, MYSQL_NUM);
		$total_recs = $row[0];
		if ($this->last_operation()) {
			$this->fm = (int)(($total_recs-1)/$this->inc)*$this->inc;
		}
		if ($this->nav_up()) {
			$this->display_list_table_buttons($total_recs, 'up');
			echo '<hr class="',$this->getCSSclass('hr', 'up'),'">',"\n";
		}
		if ($this->cgi['persist'] != '') {
			echo $this->get_origvars_html($this->cgi['persist']);
		}
		if (! $this->filter_operation()) {
			echo $this->get_origvars_html($this->qfn);
		}
		echo '<input type="hidden" name="qfn" value="',htmlspecialchars($this->qfn),'">',"\n";
		echo '<input type="hidden" name="fm" value="',htmlspecialchars($this->fm),'">',"\n";
		echo '<table class="',$this->getCSSclass('main'),'" summary="',$this->tb,'">',"\n";
		echo '<tr class="',$this->getCSSclass('header'),'">',"\n";
		/*
		 * System (navigation, selection) columns counting
		 */
		$sys_cols  = 0;
		$sys_cols += intval($this->filter_enabled() || $select_recs);
		if ($sys_cols > 0) {
			$sys_cols += intval($this->nav_buttons()
					&& ($this->nav_text_links() || $this->nav_graphic_links()));
		}
		/*
		 * We need an initial column(s) (sys columns)
		 * if we have filters, Changes or Deletes enabled
		 */
		if ($sys_cols) {
			echo '<th class="',$this->getCSSclass('header'),'" colspan="',$sys_cols,'">';
			if ($this->filter_enabled()) {
				if ($this->filter_operation()) {
					echo '<input class="',$this->getCSSclass('hide'),'" type="submit" name="sw" value="';
					echo $this->labels['Hide'],'">';
					echo '<input class="',$this->getCSSclass('clear'),'" type="submit" name="sw" value="';
					echo $this->labels['Clear'],'">';
				} else {
					echo '<input class="',$this->getCSSclass('search'),'" type="submit" name="sw" value="';
					echo $this->labels['Search'],'">';
				}
			} else {
				echo '&nbsp;';
			}
			echo '</th>',"\n";
		}
		for ($k = 0; $k < $this->num_fds; $k++) {
			$fd = $this->fds[$k];
			if ($this->displayed[$k]) {
				$css_postfix    = @$this->fdd[$k]['css']['postfix'];
				$css_class_name = $this->getCSSclass('header', null, null, $css_postfix);
				$fdn = $this->fdd[$fd]['name'];
				if (! $this->fdd[$fd]['sort'] || $this->password($fd)) {
					echo '<th class="',$css_class_name,'">',$fdn,'</th>',"\n";
				} else {
					// Clicking on the current sort field reverses the sort order
					$new_sfn = $this->sfn;
					array_unshift($new_sfn, in_array("$k", $new_sfn, 1) ? "-$k" : $k);
					echo '<th class="',$css_class_name,'">';
					echo '<a class="',$css_class_name,'" href="';
					echo htmlspecialchars($this->page_name.'?fm=0&fl='.$this->fl
							.'&qfn='.rawurlencode($this->qfn).$this->qfn
							.'&'.$this->get_sfn_cgi_vars($new_sfn).$this->cgi['persist']);
					echo '">',$fdn,'</a></th>',"\n";
				}
			}
		}
		echo '</tr>',"\n";

		/*
		 * Prepare the SQL Query from the data definition file
		 */
		$qparts['type']   = 'select';
		$qparts['select'] = $this->create_column_list();
		// Even if the key field isn't displayed, we still need its value
		if ($select_recs) {
			if (!in_array ($this->key, $this->fds)) {
				$qparts['select'] .= ','.$this->fqn($this->key);
			}
		}
		$qparts['from']  = $this->create_join_clause();
		$qparts['where'] = $this->make_where_from_query_opts();
		// build up the ORDER BY clause
		if (isset($this->sfn)) {
			// WTF $raw_sort_fields?
			//$raw_sort_fields = array();
			$sort_fields     = array();
			$sort_fields_w   = array();
			foreach ($this->sfn as $field) {
				if ($field[0] == '-') {
					$field = substr($field, 1);
					$desc  = true;
				} else {
					$field = $field;
					$desc  = false;
				}
				//$raw_sort_field = 'qf'.$field;
				$sort_field   = $this->fqn($field);
				$sort_field_w = $this->fdd[$field]['name'];
				$this->col_has_sql($field) && $sort_field_w .= ' (sql)';
				if ($desc) {
					$sort_field   .= ' DESC';
					$sort_field_w .= ' '.$this->labels['descending'];
				} else {
					$sort_field_w .= ' '.$this->labels['ascending'];
				}
				//$raw_sort_fields[] = $raw_sort_field;
				$sort_fields[]     = $sort_field;
				$sort_fields_w[]   = $sort_field_w;
			}
			if (count($sort_fields) > 0) {
				$qparts['orderby'] = join(',', $sort_fields);
			}
		}
		$to = $this->fm + $this->inc;
		if ($listall) {
			$qparts['limit'] = $this->fm.',-1';
		} else {
			$qparts['limit'] = $this->fm.','.$this->inc;
		}

		/*
		 * Main list_table() query
		 *
		 * Each row of the HTML table is one record from the SQL query. We must
		 * perform this query before filter printing, because we want to use
		 * mysql_field_len() function. We will also fetch the first row to get
		 * the field names.
		 */
		$query = $this->query_make($qparts);
		$res   = $this->myquery($query, __LINE__);
		if ($res == false) {
			$this->error('invalid SQL query', $query);
			return false;
		}
		$row = @mysql_fetch_array($res, MYSQL_ASSOC);

		/* FILTER {{{
		 *
		 * Draw the filter and fill it with any data typed in last pass and stored
		 * in the array parameter keyword 'filter'. Prepare the SQL WHERE clause.
		 */
		if ($this->filter_operation()) {
			// Filter row retrieval
			$fields     = false;
			$filter_row = $row;
			if (! is_array($filter_row)) {
				unset($qparts['where']);
				$query = $this->query_make($qparts);
				$res   = $this->myquery($query, __LINE__);
				if ($res == false) {
					$this->error('invalid SQL query', $query);
					return false;
				}
				$filter_row = @mysql_fetch_array($res, MYSQL_ASSOC);
			}
			/* Variable $fields is used to get index of particular field in
			   result. That index can be passed in example to mysql_field_len()
			   function. Use field names as indexes to $fields array. */
			if (is_array($filter_row)) {
				$fields = array_flip(array_keys($filter_row));
			}
			if ($fields != false) {
				$css_class_name = $this->getCSSclass('filter');
				echo '<tr class="',$css_class_name,'">',"\n";
				echo '<td class="',$css_class_name,'" colspan="',$sys_cols,'">';
				echo '<input class="',$this->getCSSclass('query'),'" type="submit" name="filter" value="';
				echo $this->labels['Query'],'"></td>',"\n";
				for ($k = 0; $k < $this->num_fds; $k++) {
					if (! $this->displayed[$k]) {
						continue;
					}
					$css_postfix      = @$this->fdd[$k]['css']['postfix'];
					$css_class_name   = $this->getCSSclass('filter', null, null, $css_postfix);
					$this->field_name = $this->fds[$k];
					$fd               = $this->field_name;
					$this->field      = $this->fdd[$fd];
					$l  = 'qf'.$k;
					$lc = 'qf'.$k.'_comp';
					$li = 'qf'.$k.'_id';
					if ($this->clear_operation()) {
						$m  = null;
						$mc = null;
						$mi = null;
					} else {
						$m  = $this->get_cgi_var($l);
						$mc = $this->get_cgi_var($lc);
						$mi = $this->get_cgi_var($li);
					}
					echo '<td class="',$css_class_name,'">';
					if ($this->password($k)) {
						echo '&nbsp;';
					} else if ($this->fdd[$fd]['select'] == 'D' || $this->fdd[$fd]['select'] == 'M') {
						// Multiple fields processing
						// Default size is 2 and array required for values.
						$from_table = ! $this->col_has_values($k) || isset($this->fdd[$k]['values']['table']);
						$vals       = $this->set_values($k, array('*' => '*'), null, $from_table);
						$selected   = $mi;
						$multiple   = $this->col_has_multiple_select($k);
						$multiple  |= $this->fdd[$fd]['select'] == 'M';
						$readonly   = false;
						$strip_tags = true;
						$escape     = true;
						echo $this->htmlSelect($l.'_id', $css_class_name, $vals,
								$selected, $multiple, $readonly, $strip_tags, $escape);
					} elseif ($this->fdd[$fd]['select'] == 'N' || $this->fdd[$fd]['select'] == 'T') {
						$size_ml_props = '';
						$maxlen = intval($this->fdd[$k]['maxlen']);
						$maxlen > 0 || $maxlen = intval(@mysql_field_len($res, $fields["qf$k"]));
						$size = isset($this->fdd[$k]['size']) ? $this->fdd[$k]['size']
							: ($maxlen < 30 ? min($maxlen, 8) : 12);
						$size   && $size_ml_props .= ' size="'.$size.'"';
						$maxlen && $size_ml_props .= ' maxlength="'.$maxlen.'"';
						if ($this->fdd[$fd]['select'] == 'N') {
							$mc = in_array($mc, $this->comp_ops) ? $mc : '=';
							echo $this->htmlSelect($l.'_comp', $css_class_name, $this->comp_ops, $mc);
						}
						echo '<input class="',$css_class_name,'" value="';
						echo htmlspecialchars(@$m),'" type="text" name="qf',$k,'"',$size_ml_props;
						echo ' onKeyPress="return phpMyEdit_filter_handler(this.form, event);">';
					} else {
						echo '&nbsp;';
					}
					echo '</td>',"\n";
				}
				echo '</tr>',"\n";
			}
		} // }}}
		
		/*
		 * Display sorting sequence
		 */
		if ($qparts['orderby'] && $this->display['sort']) {
			$css_class_name = $this->getCSSclass('sortinfo');
			echo '<tr class="',$css_class_name,'">',"\n";
			echo '<td class="',$css_class_name,'" colspan="',$sys_cols,'">';
			echo '<a class="',$css_class_name,'" href="';
			echo htmlspecialchars($this->get_server_var('PHP_SELF').'?fl='.$this->fl.'&fm='.$this->fm
					.'&qfn='.rawurlencode($this->qfn).$this->qfn.$this->cgi['persist']);
			echo '">',$this->labels['Clear'],'</a></td>',"\n";
			echo '<td class="',$css_class_name,'" colspan="',$this->num_fields_displayed,'">';
			echo $this->labels['Sorted By'],': ',join(', ', $sort_fields_w),'</td></tr>',"\n";
		}

		/*
		 * Display the current query
		 */
		$text_query = $this->make_where_from_query_opts(null, true);
		if ($text_query != '' && $this->display['query']) {
			$css_class_name = $this->getCSSclass('queryinfo');
			echo '<tr class="',$css_class_name,'">',"\n";
			echo '<td class="',$css_class_name,'" colspan="',$sys_cols,'">';
			echo '<a class="',$css_class_name,'" href="';
			echo htmlspecialchars($this->get_server_var('PHP_SELF').'?fl='.$this->fl.'&fm='.$this->fm
					.'&qfn='.rawurlencode($this->qfn).'&'.$this->get_sfn_cgi_vars().$this->cgi['persist']);
			echo '">',$this->labels['Clear'],'</a></td>',"\n";
			echo '<td class="',$css_class_name,'" colspan="',$this->num_fields_displayed,'">';
			echo $this->labels['Current Query'],': ',htmlspecialchars($text_query),'</td></tr>',"\n";
		}

		if ($this->nav_text_links() || $this->nav_graphic_links()) {
			$qstrparts = array();
			strlen($this->fl)             > 0 && $qstrparts[] = 'fl='.$this->fl;
			strlen($this->fm)             > 0 && $qstrparts[] = 'fm='.$this->fm;
			count($this->sfn)             > 0 && $qstrparts[] = $this->get_sfn_cgi_vars();
			strlen($this->cgi['persist']) > 0 && $qstrparts[] = $this->cgi['persist'];
			$qpview      = $qstrparts;
			$qpcopy      = $qstrparts;
			$qpchange    = $qstrparts;
			$qpdelete    = $qstrparts;
			$qpview[]    = 'operation='.$this->labels['View'];
			$qpcopy[]    = 'operation='.$this->labels['Copy'];
			$qpchange[]  = 'operation='.$this->labels['Change'];
			$qpdelete[]  = 'operation='.$this->labels['Delete'];
			$qpviewStr   = '?'.join('&',$qpview).$this->qfn;
			$qpcopyStr   = '?'.join('&',$qpcopy).$this->qfn;
			$qpchangeStr = '?'.join('&',$qpchange).$this->qfn;
			$qpdeleteStr = '?'.join('&',$qpdelete).$this->qfn;
		}

		$fetched  = true;
		$first    = true;
		$rowCount = 0;
		while ((!$fetched && ($row = @mysql_fetch_array($res, MYSQL_ASSOC)) != false)
				|| ($fetched && $row != false)) {
			$fetched = false;
			echo '<tr class="',$this->getCSSclass('row', null, 'next'),'">',"\n";
			if ($sys_cols) { /* {{{ */
				$key_rec    = $row['qf'.$this->key_num];
				$qviewStr   = $qpviewStr   . '&rec='.$key_rec;
				$qcopyStr   = $qpcopyStr   . '&rec='.$key_rec;
				$qchangeStr = $qpchangeStr . '&rec='.$key_rec;
				$qdeleteStr = $qpdeleteStr . '&rec='.$key_rec;
				$css_class_name = $this->getCSSclass('navigation', null, true);
				if ($select_recs) {
					if (! $this->nav_buttons() || $sys_cols > 1) {
						echo '<td class="',$css_class_name,'">';
					}
					if ($this->nav_graphic_links()) {
						$printed_out = false;
						if ($this->view_enabled()) {
							$printed_out = true;
							echo '<a class="',$css_class_name,'" href="';
							echo htmlspecialchars($this->page_name.$qviewStr),'"><img class="';
							echo $css_class_name,'" src="',$this->url['images'];
							echo 'pme-view.png" height="15" width="16" border="0" alt="';
							echo htmlspecialchars($this->labels['View']),'" title="';
							echo htmlspecialchars($this->labels['View']),'"></a>';
						}
						if ($this->change_enabled()) {
							$printed_out && print('&nbsp;');
							$printed_out = true;
							echo '<a class="',$css_class_name,'" href="';
							echo htmlspecialchars($this->page_name.$qchangeStr),'"><img class="';
							echo $css_class_name,'" src="',$this->url['images'];
							echo 'pme-change.png" height="15" width="16" border="0" alt="';
							echo htmlspecialchars($this->labels['Change']),'" title="';
							echo htmlspecialchars($this->labels['Change']),'"></a>';
						}
						if ($this->copy_enabled()) {
							$printed_out && print('&nbsp;');
							$printed_out = true;
							echo '<a class="',$css_class_name,'" href="';
							echo htmlspecialchars($this->page_name.$qcopyStr),'"><img class="';
							echo $css_class_name,'" src="',$this->url['images'];
							echo 'pme-copy.png" height="15" width="16" border="0" alt="';
							echo htmlspecialchars($this->labels['Copy']),'" title="';
							echo htmlspecialchars($this->labels['Copy']),'"></a>';
						}
						if ($this->delete_enabled()) {
							$printed_out && print('&nbsp;');
							$printed_out = true;
							echo '<a class="',$css_class_name,'" href="';
							echo htmlspecialchars($this->page_name.$qdeleteStr),'"><img class="';
							echo $css_class_name,'" src="',$this->url['images'];
							echo 'pme-delete.png" height="15" width="16" border="0" alt="';
							echo htmlspecialchars($this->labels['Delete']),'" title="';
							echo htmlspecialchars($this->labels['Delete']),'"></a>';
						}
					}
					if ($this->nav_text_links()) {
						if ($this->nav_graphic_links()) {
							echo '<br class="',$css_class_name,'">';
						}
						$printed_out = false;
						if ($this->view_enabled()) {
							$printed_out = true;
							echo '<a class="',$css_class_name,'" href="';
							echo htmlspecialchars($this->page_name.$qviewStr),'">V</a>&nbsp;';
						}
						if ($this->change_enabled()) {
							$printed_out && print('&nbsp;');
							$printed_out = true;
							echo '<a class="',$css_class_name,'" href="';
							echo htmlspecialchars($this->page_name.$qchangeStr),'">C</a>&nbsp;';
						}
						if ($this->copy_enabled()) {
							$printed_out && print('&nbsp;');
							$printed_out = true;
							echo '<a class="',$css_class_name,'" href="';
							echo htmlspecialchars($this->page_name.$qcopyStr),'">P</a>&nbsp;';
						}
						if ($this->delete_enabled()) {
							$printed_out && print('&nbsp;');
							$printed_out = true;
							echo '<a class="',$css_class_name,'" href="';
							echo htmlspecialchars($this->page_name.$qdeleteStr),'">D</a>';
						}
					}
					if (! $this->nav_buttons() || $sys_cols > 1) {
						echo '</td>',"\n";
					}
					if ($this->nav_buttons()) {
						echo '<td class="',$css_class_name,'"><input class="',$css_class_name;
						echo '" type="radio" name="rec" value="',htmlspecialchars($key_rec),'"';
						if ($first) {
							echo ' checked';
							$first = false;
						}
						echo '></td>',"\n";
					}
				} elseif ($this->filter_enabled()) {
					echo '<td class="',$css_class_name,'" colspan=',$sys_cols,'>&nbsp;</td>',"\n";
				}
			} /* }}} */
			for ($k = 0; $k < $this->num_fds; $k++) { /* {{{ */
				$fd = $this->fds[$k];
				if (! $this->displayed[$k]) {
					continue;
				}
				$css_postfix    = @$this->fdd[$k]['css']['postfix'];
				$css_class_name = $this->getCSSclass('cell', null, true, $css_postfix);
				if ($this->password($k)) {
					echo '<td class="',$css_class_name,'">',$this->labels['hidden'],'</td>',"\n";
					continue;
				}
				echo '<td class="',$css_class_name,'"',$this->getColAttributes($fd),'>';
				echo $this->cellDisplay($k, $row, $css_class_name);
				echo '</td>',"\n";
			} /* }}} */
			echo '</tr>',"\n";
		}

		/*
		 * Display and accumulate column aggregation info, do totalling query
		 * XXX this feature does not work yet!!!
		 */
		// aggregates listing (if any)
		if ($$var_to_total) {
			// do the aggregate query if necessary
			//if ($vars_to_total) {
				$qp = array();
				$qp['type'] = 'select';
				$qp['select'] = $aggr_from_clause;
				$qp['from'] = $this->create_join_clause ();
				$qp['where'] = $this->make_where_from_query_opts();
				$tot_query = $this->query_make($qp);
				$totals_result = $this->myquery($tot_query,__LINE__);
				$tot_row       = @mysql_fetch_array($totals_result, MYSQL_ASSOC);
			//}
			$qp_aggr = $qp;
			echo "\n",'<tr class="TODO-class">',"\n",'<td class="TODO-class">&nbsp;</td>',"\n";
			/*
			echo '<td>';
			echo printarray($qp_aggr);
			echo printarray($vars_to_total);
			echo '</td>';
			echo '<td colspan="'.($this->num_fds-1).'">'.$var_to_total.' '.$$var_to_total.'</td>';
			*/
			// display the results
			for ($k=0;$k<$this->num_fds;$k++) {
				$fd = $this->fds[$k];
				if (stristr($this->fdd[$fd]['options'],'L') or !isset($this->fdd[$fd]['options'])) {
					echo '<td>';
					$aggr_var  = 'qf'.$k.'_aggr';
					$$aggr_var = $this->get_cgi_var($aggr_var);
					if ($$aggr_var) {
						echo $this->sql_aggrs[$$aggr_var],': ',$tot_row[$aggr_var];
					} else {
						echo '&nbsp;';
					}
					echo '</td>',"\n";
				}
			}
			echo '</tr>',"\n";
		}
		echo '</table>',"\n"; // end of table rows listing
		if ($this->nav_down()) {
			echo '<hr class="',$this->getCSSclass('hr', 'down'),'">',"\n";
			$this->display_list_table_buttons($total_recs, 'down');
		}
		$this->form_end();
	} /* }}} */

	function display_record() /* {{{ */
	{
		// PRE Triggers
		$ret = true;
		if ($this->change_operation() && isset($this->triggers['update']['pre'])) {
			$ret = include($this->triggers['update']['pre']);
			// if PRE update fails, then back to view operation
			if (! $ret) {
				$this->operation = $this->labels['View'];
				$ret = true;
			}
		}
		if (($this->add_operation() || $this->copy_operation())
				&& isset($this->triggers['insert']['pre'])) {
			$ret = include($this->triggers['insert']['pre']);
		}
		if ($this->view_operation() && isset($this->triggers['select']['pre'])) {
			$ret = include($this->triggers['select']['pre']);
		}
		if ($this->delete_operation() && isset($this->triggers['delete']['pre'])) {
			$ret = include($this->triggers['delete']['pre']);
		}
		// if PRE insert/view/delete fail, then back to the list
		if ($ret == false) {
			$this->operation = '';
			$this->list_table();
			return;
		}
		$this->form_begin();
		if ($this->cgi['persist'] != '') {
			echo $this->get_origvars_html($this->cgi['persist']);
		}
		echo $this->get_origvars_html($this->get_sfn_cgi_vars());
		echo $this->get_origvars_html($this->qfn);
		echo '<input type="hidden" name="qfn" value="',htmlspecialchars($this->qfn),'">',"\n";
		echo '<input type="hidden" name="rec" value="',($this->copy_operation()?'':$this->rec),'">',"\n";
		echo '<input type="hidden" name="fm" value="',$this->fm,'">',"\n";
		echo '<input type="hidden" name="fl" value="',$this->fl,'">',"\n";
		if ($this->nav_up()) {
			$this->display_record_buttons('up');
			echo '<hr class="',$this->getCSSclass('hr', 'up'),'">',"\n";
			if ($this->tabs_enabled()) {
				$this->display_tab_labels('up');
			}
		}
		if ($this->tabs_enabled()) {
			echo '<div id="phpMyEdit_tab0">',"\n";
		}
		echo '<table class="',$this->getCSSclass('main'),'" summary="',$this->tb,'">',"\n";
		if ($this->add_operation()) {
			$this->display_add_record();
		} else {
			$this->display_copy_change_delete_record();
		}
		echo '</table>',"\n";
		echo '</div>',"\n";
		if ($this->nav_down()) {
			if ($this->tabs_enabled()) {
				$this->display_tab_labels('down');
			}
			echo '<hr class="',$this->getCSSclass('hr', 'down'),'">',"\n";
			$this->display_record_buttons('down');
		}
		$this->form_end();
	} /* }}} */

	/*
	 * Action functions
	 */

	function do_add_record() /* {{{ */
	{
		// Preparing query
		$query       = '';
		$key_col_val = '';
		for ($k = 0; $k < $this->num_fds; $k++) {
			if ($this->processed($k)) {
			}
		}
		$vals_quoted = array();
		$newvals     = array();
		for ($k = 0; $k < $this->num_fds; $k++) {
			if ($this->processed($k)) {
				$fd = $this->fds[$k];
				if ($this->readonly($k)) {
					$fn = (string) @$this->fdd[$k]['default'];
				} else {
					$fn = $this->get_cgi_var($this->fds[$k]);
				}
				if ($fd == $this->key) {
					$key_col_val = $fn;
				}
				if ($query == '') {
					$query = 'INSERT INTO '.$this->tb.' ('.$fd; // )
				} else {
					$query .= ','.$fd;
				}
				$newvals[$this->fds[$k]] = is_array($fn) ? join(',',$fn) : $fn;
				if ($this->col_has_sqlw($k)) {
					$val     = $newvals[$this->fds[$k]];
					$val_as  = addslashes($val);
					$val_qas = '"'.addslashes($val).'"';
					$vals_quoted[$k] = $this->substituteVars(
							$this->fdd[$k]['sqlw'], array(
								'val_qas' => $val_qas,
								'val_as'  => $val_as,
								'val'     => $val
								));
				} else {
					$vals_quoted[$k] = addslashes($newvals[$this->fds[$k]]);
					$vals_quoted[$k] = "'".$vals_quoted[$k]."'";
				}
			}
		}
		// Creating array of changed keys ($changed)
		$changed = array_keys($newvals);
		// Before trigger
		if (isset($this->triggers['insert']['before'])) {
			$ret = include($this->triggers['insert']['before']);
			if ($ret == false) {
				return false;
			}
		}
		// Real query (no additional query in this method)
		$query .= ') VALUES ('.join(',',$vals_quoted).')'; // )
		$res    = $this->myquery($query, __LINE__);
		$this->message = @mysql_affected_rows($this->dbh).' '.$this->labels['record added'];
		if (! $res) {
			return false;
		}
		// Notify list
		if (@$this->notify['insert'] || @$this->notify['all']) {
			$this->email_notify(false, $newvals);
		}
		// Note change in log table
		if ($this->logtable) {
			$query = sprintf('INSERT INTO %s'
					.' (updated, user, host, operation, tab, rowkey, col, oldval, newval)'
					.' VALUES (NOW(), "%s", "%s", "insert", "%s", "%s", "", "", "%s")',
					$this->logtable, addslashes($this->get_server_var('REMOTE_USER')),
					addslashes($this->get_server_var('REMOTE_ADDR')), addslashes($this->tb),
					addslashes($key_col_val), addslashes(serialize($newvals)));
			$this->myquery($query, __LINE__);
		}
		// After trigger
		if (isset($this->triggers['insert']['after'])) {
			$ret = include($this->triggers['insert']['after']);
			if ($ret == false) {
				return false;
			}
		}
		return true;
	} /* }}} */

	function do_change_record() /* {{{ */
	{
		// Preparing queries
		$query_real   = '';
		$query_oldrec = '';
		$newvals      = array();
		$oldvals      = array();
		$changed      = array();
		for ($k = 0; $k < $this->num_fds; $k++) {
			if ($this->processed($k) && !$this->readonly($k)) {
				$fd = $this->fds[$k];
				$fn = $this->get_cgi_var($fd);
				$newvals[$this->fds[$k]] = is_array($fn) ? join(',',$fn) : $fn;
				if ($this->col_has_sqlw($k)) {
					$val      = $newvals[$this->fds[$k]];
					$val_as   = addslashes($val);
					$val_qas  = '"'.addslashes($val).'"';
					$newValue = $this->substituteVars(
							$this->fdd[$k]['sqlw'], array(
								'val_qas' => $val_qas,
								'val_as'  => $val_as,
								'val'     => $val
								));
				} else {
					$newValue = $newvals[$this->fds[$k]];
					$newValue = "'".addslashes($newValue)."'";
				}
				if ($query_real == '') {
					$query_real   = 'UPDATE '.$this->tb.' SET '.$fd.'='.$newValue;
					$query_oldrec = 'SELECT '.$fd;
				} else {
					$query_real   .= ','.$fd.'='.$newValue;
					$query_oldrec .= ','.$fd;
				}
			}
		}
		$where_part = " WHERE (".$this->key.'='.$this->key_delim.$this->rec.$this->key_delim.')';
		$query_real   .= $where_part;
		$query_oldrec .= ' FROM ' . $this->tb . $where_part;
		// Additional query (must go before real query)
		$res     = $this->myquery($query_oldrec, __LINE__);
		$oldvals = @mysql_fetch_array($res, MYSQL_ASSOC);
		@mysql_free_result($res);
		// Creating array of changed keys ($changed)
		for ($k = 0; $k < $this->num_fds; $k++) {
			$key = $this->fds[$k];
			if (! $this->processed($k) || $this->readonly($k) || $oldvals[$key] == $newvals[$key]) {
				continue;
			}
			$changed[] = $key;
		}
		// Before trigger
		if (isset($this->triggers['update']['before'])) {
			$ret = include($this->triggers['update']['before']);
			if ($ret == false) {
				return false;
			}
		}
		// Real query
		$res = $this->myquery($query_real, __LINE__);
		$this->message = @mysql_affected_rows($this->dbh).' '.$this->labels['record changed'];
		if (! $res) {
			return false;
		}
		// Another additional query (must go after real query)
		$res     = $this->myquery($query_oldrec, __LINE__);
		$newvals = @mysql_fetch_array($res, MYSQL_ASSOC);
		@mysql_free_result($res);
		// Creating array of changed keys ($changed)
		$changed = array();
		for ($k = 0; $k < $this->num_fds; $k++) {
			$key = $this->fds[$k];
			if (! $this->processed($k) || $this->readonly($k) || $oldvals[$key] == $newvals[$key]) {
				continue;
			}
			$changed[] = $key;
		}
		// Notify list
		if (@$this->notify['update'] || @$this->notify['all']) {
			if (count($changed) > 0) {
				$this->email_notify($oldvals, $newvals);
			}
		}
		// Note change in log table
		if ($this->logtable) {
			foreach ($changed as $key) {
				$qry = sprintf('INSERT INTO %s'
						.' (updated, user, host, operation, tab, rowkey, col, oldval, newval)'
						.' VALUES (NOW(), "%s", "%s", "update", "%s", "%s", "%s", "%s", "%s")',
						$this->logtable, addslashes($this->get_server_var('REMOTE_USER')),
						addslashes($this->get_server_var('REMOTE_ADDR')), addslashes($this->tb),
						addslashes($this->rec), addslashes($key),
						addslashes($oldvals[$key]), addslashes($newvals[$key]));
				$this->myquery($qry, __LINE__);
			}
		}
		// After trigger
		if (isset($this->triggers['update']['after'])) {
			$ret = include($this->triggers['update']['after']);
			if ($ret == false) {
				return false;
			}
		}
		return true;
	} /* }}} */

	function do_delete_record() /* {{{ */
	{
		// Additional query
		$query   = 'SELECT * FROM '.$this->tb.' WHERE ('.$this->key.' = '
				.$this->key_delim.$this->rec.$this->key_delim.')'; // )
		$res     = $this->myquery($query, __LINE__);
		$oldvals = @mysql_fetch_array($res, MYSQL_ASSOC);
		@mysql_free_result($res);
		// Creating array of changed keys ($changed)
		$changed = array_keys($oldvals);
		// Before trigger
		if (isset($this->triggers['delete']['before'])) {
			$ret = include($this->triggers['delete']['before']);
			if ($ret == false) {
				return false;
			}
		}
		// Real query
		$query = 'DELETE FROM '.$this->tb.' WHERE ('.$this->key.' = '
				.$this->key_delim.$this->rec.$this->key_delim.')'; // )
		$res = $this->myquery($query, __LINE__);
		$this->message = @mysql_affected_rows($this->dbh).' '.$this->labels['record deleted'];
		if (! $res) {
			return false;
		}
		// Notify list
		if (@$this->notify['delete'] || @$this->notify['all']) {
			$this->email_notify($oldvals, false);
		}
		// Note change in log table
		if ($this->logtable) {
			$query = sprintf('INSERT INTO %s'
					.' (updated, user, host, operation, tab, rowkey, col, oldval, newval)'
					.' VALUES (NOW(), "%s", "%s", "delete", "%s", "%s", "%s", "%s", "")',
					$this->logtable, addslashes($this->get_server_var('REMOTE_USER')),
					addslashes($this->get_server_var('REMOTE_ADDR')), addslashes($this->tb),
					addslashes($this->rec), addslashes($key), addslashes(serialize($oldvals)));
			$this->myquery($query, __LINE__);
		}
		// After trigger
		if (isset($this->triggers['delete']['after'])) {
			$ret = include($this->triggers['delete']['after']);
			if ($ret == false) {
				return false;
			}
		}
		return true;
	} /* }}} */

	function email_notify($old_vals, $new_vals) /* {{{ */
	{
		if (! function_exists('mail')) {
			return false;
		}
		if ($old_vals != false && $new_vals != false) {
			$action  = 'update';
			$subject = 'Record updated in';
			$body    = 'An item with '.$this->fdd[$this->key]['name'].' = '
				.$this->key_delim.$this->rec.$this->key_delim .' was updated in';
			$vals    = $new_vals;
		} elseif ($new_vals != false) {
			$action  = 'insert';
			$subject = 'Record added to';
			$body    = 'A new item was added into';
			$vals    = $new_vals;
		} elseif ($old_vals != false) {
			$action  = 'delete';
			$subject = 'Record deleted from';
			$body    = 'An item was deleted from';
			$vals    = $old_vals;
		} else {
			return false;
		}
		$addr  = $this->get_server_var('REMOTE_ADDR');
		$user  = $this->get_server_var('REMOTE_USER');
		$body  = 'This notification e-mail was automatically generated by phpMyEdit.'."\n\n".$body;
		$body .= ' table '.$this->tb.' in MySQL database '.$this->db.' on '.$this->page_name;
		$body .= ' by '.($user == '' ? 'unknown user' : "user $user").' from '.$addr;
		$body .= ' at '.date('d/M/Y H:i').' with the following fields:'."\n\n";
		$i = 1;
		foreach ($vals as $k => $text) {
			$name = isset($this->fdd[$k]['name~'])
				? $this->fdd[$k]['name~'] : $this->fdd[$k]['name'];
			if ($action == 'update') {
				if ($old_vals[$k] == $new_vals[$k]) {
					continue;
				}
				$body .= sprintf("[%02s] %s (%s)\n      WAS: %s\n      IS:  %s\n",
						$i, $name, $k, $old_vals[$k], $new_vals[$k]);
			} else {
				$body .= sprintf('[%02s] %s (%s): %s'."\n", $i, $name, $k, $text);
			}
			$i++;
		}
		$body    .= "\n--\r\n"; // \r is needed for signature separating
		$body    .= "phpMyEdit\ninstant MySQL table editor and code generator\n";
		$body    .= "http://www.platon.sk/projects/phpMyEdit/\n\n";
		$subject  = @$this->notify['prefix'].$subject.' '.$this->db.'.'.$this->tb;
		$subject  = trim($subject); // just for sure
		$wrap_w   = intval(@$this->notify['wrap']);
	   	$wrap_w > 0 || $wrap_w = 72;
		$from     = (string) @$this->notify['from'];
		$from != '' || $from = 'webmaster@'.strtolower($this->get_server_var('SERVER_NAME'));
		$headers  = 'From: '.$from."\n".'X-Mailer: PHP/'.phpversion().' (phpMyEdit)';
		$body     = wordwrap($body, $wrap_w, "\n", 1);
		$emails   = (array) $this->notify[$action] + (array) $this->notify['all'];
		foreach ($emails as $email) {
			if (! empty($email)) {
				mail(trim($email), $subject, $body, $headers);
			}
		}
		return true;
	} /* }}} */

	/*
	 * Recreate functions
	 */
	function recreate_fdd() /* {{{ */
	{
		// TODO: one level deeper browsing
		$this->page_type = 'L'; // list by default
		$this->filter_operation() && $this->page_type = 'F';
		$this->view_operation()   && $this->page_type = 'V';
		$this->delete_operation() && $this->page_type = 'D';
		$this->add_operation()    && $this->page_type = 'A';
		$this->change_operation() && $this->page_type = 'C';
		$this->copy_operation()   && $this->page_type = 'P';
		// Restore backups (if exists)
		foreach (array_keys($this->fdd) as $column) {
			foreach (array_keys($this->fdd[$column]) as $col_option) {
				if ($col_option[strlen($col_option) - 1] != '~')
					continue;

				$this->fdd[$column][substr($col_option, 0, strlen($col_option) - 1)]
					= $this->fdd[$column][$col_option];
				unset($this->fdd[$column][$col_option]);
			}
		}
		foreach (array_keys($this->fdd) as $column) {
			foreach (array_keys($this->fdd[$column]) as $col_option) {
				if (! strchr($col_option, '|')) {
					continue;
				}
				$col_ar = explode('|', $col_option, 2);
				if (! stristr($col_ar[1], $this->page_type)) {
					continue;
				}
				// Make field backups
				$this->fdd[$column][$col_ar[0] .'~'] = $this->fdd[$column][$col_ar[0]];
				$this->fdd[$column][$col_option.'~'] = $this->fdd[$column][$col_option];
				// Set particular field
				$this->fdd[$column][$col_ar[0]] = $this->fdd[$column][$col_option];
				unset($this->fdd[$column][$col_option]);
			}
		}
	} /* }}} */

	function recreate_displayed() /* {{{ */
	{
		$field_num            = 0;
		$num_fields_displayed = 0;
		$this->fds            = array();
		$this->displayed      = array();
		$this->guidance       = false;
		foreach (array_keys($this->fdd) as $key) {
			if (preg_match('/^\d*$/', $key)) { // skipping numeric keys
				continue;
			}
			$this->fds[$field_num] = $key;
			/* We must use here displayed() function, because displayed[] array
			   is not created yet. We will simultaneously create that array as well. */
			if ($this->displayed[$field_num] = $this->displayed($field_num)) {
				$num_fields_displayed++;
			}
			if (is_array(@$this->fdd[$key]['values']) && ! isset($this->fdd[$key]['values']['table'])) {
				foreach ($this->fdd[$key]['values'] as $val) {
					$this->fdd[$key]['values2'][$val] = $val;
				}
				unset($this->fdd[$key]['values']);
			}
			isset($this->fdd[$key]['help']) && $this->guidance = true;
			$this->fdd[$field_num] = $this->fdd[$key];
			$field_num++;
		}
		$this->num_fds              = $field_num;
		$this->num_fields_displayed = $num_fields_displayed;
		$this->key_num              = array_search($this->key, $this->fds);
		/* Adds first displayed column into sorting fields by replacing last
		   array entry. Also remove duplicite values and change column names to
		   their particular field numbers.

		   Note that entries like [0]=>'9' [1]=>'-9' are correct and they will
		   have desirable sorting behaviour. So there is no need to remove them.
		 */
		for ($k = 0; ! $this->displayed[$k]; $k++);
		$this->sfn[count($this->sfn) - 1] = "$k"; // important quotes
		$this->sfn = array_unique($this->sfn);
		$check_ar = array();
		foreach ($this->sfn as $key => $val) {
			if (preg_match('/^[-]?\d*$/', $val)) { // skipping numeric keys
				$val = abs($val);
				if (in_array($val, $check_ar) || $this->password($val)) {
					unset($this->sfn[$key]);
				} else {
					$check_ar[] = $val;
				}
				continue;
			}
			if ($val[0] == '-') {
				$val = substr($val, 1);
				$minus = '-';
			} else {
				$minus = '';
			}
			if (($val = array_search($val, $this->fds)) === false || $this->password($val)) {
				unset($this->sfn[$key]);
			} else {
				$val = intval($val);
				if (in_array($val, $check_ar)) {
					unset($this->sfn[$key]);
				} else {
					$this->sfn[$key] = $minus.$val;
					$check_ar[] = $val;
				}
			}
		}
		$this->sfn = array_unique($this->sfn);
		return true;
	} /* }}} */

	/*
	 * Error handling function
	 */
	function error($message, $additional_info = '') /* {{{ */
	{
		echo '<h1>phpMyEdit error: ',htmlspecialchars($message),'</h1>',"\n";
		if ($additional_info != '') {
			echo '<hr>',htmlspecialchars($additional_info);
		}
		return false;
	} /* }}} */

	/*
	 * Database connection function
	 */
	function connect() /* {{{ */
	{
		if (!isset($this->db)) {
			$this->error('no database defined');
			return false;
		}
		if (!isset ($this->tb)) {
			$this->error('no table defined');
			return false;
		}
		if ($this->dbh = @mysql_pconnect($this->hn, $this->un, $this->pw)) {
		} else {
			$this->error('could not connect to MySQL');
			return false;
		}
		return true;
	} /* }}} */

	/*
	 * Database disconnection function
	 */
	function disconnect() /* {{{ */
	{
		@mysql_close($this->dbh);
		unset($this->dbh);
	} /* }}} */

	/*
	 * The workhorse
	 */
	function execute() /* {{{ */
	{
		//  DEBUG -  uncomment to enable
		/*
		//phpinfo();
		$this->print_get_vars();
		$this->print_post_vars();
		$this->print_vars();
		echo "<pre>query opts:\n";
		echo print_r($this->query_opts);
		echo "</pre>\n";
		echo "<pre>get vars:\n";
		echo print_r($this->get_opts);
		echo "</pre>\n";
		 */

		// Let's do explicit quoting - it's safer
		set_magic_quotes_runtime(0);
		// Checking if language file inclusion was successful
		if (! is_array($this->labels)) {
			$this->error('could not locate language files', 'searched path: '.$this->dir['lang']);
			return false;
		}
		// Database connection
		if ($this->connect() == false) {
			return false;
		}

		/*
		 * ======================================================================
		 * Pass 3: process any updates generated if the user has selected
		 * a save button during Pass 2
		 * ======================================================================
		 */
		if ($this->saveadd == $this->labels['Save']) {
			$this->add_enabled() && $this->do_add_record();
		}
		elseif ($this->moreadd == $this->labels['More']) {
			$this->add_enabled() && $this->do_add_record();
			$this->operation = $this->labels['Add']; // to force add operation
			$this->recreate_fdd();
			$this->recreate_displayed();
		}
		elseif ($this->savechange == $this->labels['Save']) {
			$this->change_enabled() && $this->do_change_record();
		}
		elseif ($this->morechange == $this->labels['Apply']) {
			$this->change_enabled() && $this->do_change_record();
			$this->operation = $this->labels['Change']; // to force change operation
			$this->recreate_fdd();
			$this->recreate_displayed();
		}
		elseif ($this->savedelete == $this->labels['Delete']) {
			$this->delete_enabled() && $this->do_delete_record();
		}

		/*
		 * ======================================================================
		 * Pass 2: display an input/edit/confirmation screen if the user has
		 * selected an editing button on Pass 1 through this page
		 * ======================================================================
		 */
		if ($this->add_operation()
				|| $this->change_operation() || $this->delete_operation()
				|| $this->view_operation()   || $this->copy_operation()) {
			$this->display_record();
		}

		/*
		 * ======================================================================
		 * Pass 1 and Pass 3: display the MySQL table in a scrolling window on
		 * the screen (skip this step in 'Add More' mode)
		 * ======================================================================
		 */
		else {
			$this->list_table();
		}

		$this->disconnect();
		if ($this->display['time'] && $this->timer != null) {
			echo $this->timer->end(),' miliseconds';
		}
	} /* }}} */

	/*
	 * Class constructor
	 */
	function phpMyEdit($opts) /* {{{ */
	{
		// Set desirable error reporting level
		$error_reporting = @error_reporting(E_ALL & ~E_NOTICE);
		// Instance class variables
		$this->hn        = $opts['hn'];
		$this->un        = $opts['un'];
		$this->pw        = $opts['pw'];
		$this->db        = $opts['db'];
		$this->tb        = $opts['tb'];
		$this->key       = $opts['key'];
		$this->key_type  = $opts['key_type'];
		$this->inc       = $opts['inc'];
		$this->options   = $opts['options'];
		$this->fdd       = $opts['fdd'];
		$this->multiple  = intval($opts['multiple']);
		$this->multiple <= 0 && $this->multiple = 2;
		$this->filters   = @$opts['filters'];
		$this->triggers  = @$opts['triggers'];
		$this->notify    = @$opts['notify'];
		$this->logtable  = @$opts['logtable'];
		$this->page_name = @$opts['page_name'];
		if (! isset($this->page_name)) {
			$this->page_name = basename($this->get_server_var('PHP_SELF'));
			isset($this->page_name) || $this->page_name = $this->tb;
		} 
		$this->display['query'] = @$opts['display']['query'];
		$this->display['sort']  = @$opts['display']['sort'];
		$this->display['time']  = @$opts['display']['time'];
		if ($this->display['time']) {
			$this->timer = new phpMyEdit_timer();
		}
		$this->display['tabs'] = isset($opts['display']['tabs'])
			? $opts['display']['tabs'] : true;
		$this->display['form'] = isset($opts['display']['form'])
			? $opts['display']['form'] : true;
		// Creating directory variables
		$this->dir['root'] = dirname(realpath(__FILE__))
			. (strlen(dirname(realpath(__FILE__))) > 0 ? '/' : '');
		$this->dir['lang'] = $this->dir['root'].'lang/';
		// Creating URL variables
		$this->url['images'] = 'images/';
		isset($opts['url']['images']) && $this->url['images'] = $opts['url']['images'];
		// CSS classes policy
		$this->css = @$opts['css'];
		!isset($this->css['separator']) && $this->css['separator'] = '-';
		!isset($this->css['prefix'])    && $this->css['prefix']    = 'pme';
		!isset($this->css['page_type']) && $this->css['page_type'] = false;
		!isset($this->css['position'])  && $this->css['position']  = false;
		!isset($this->css['divider'])   && $this->css['divider']   = 2;
		$this->css['divider'] = intval(@$this->css['divider']);
		// Navigation
		$this->navigation = @$opts['navigation'];
		if (! $this->nav_buttons() && ! $this->nav_text_links() && ! $this->nav_graphic_links()) {
			$this->navigation .= 'B'; // buttons are default
		}
		if (! $this->nav_up() && ! $this->nav_down()) {
			$this->navigation .= 'D'; // down position is default
		}
		// Language labels (must go after navigation)
		$this->labels = $this->make_language_labels(isset($opts['language'])
				? $opts['language'] : $this->get_server_var('HTTP_ACCEPT_LANGUAGE'));
		// CGI variables
		$this->cgi['append']    = @$opts['cgi']['append'];
		$this->cgi['overwrite'] = @$opts['cgi']['overwrite'];
		$this->cgi['persist']   = '';
		if (@is_array($opts['cgi']['persist'])) {
			foreach ($opts['cgi']['persist'] as $key => $val) {
				$this->cgi['persist'] .= '&'.urlencode($key).'='.urlencode($val);
			}
		}
		// Sorting variables
		$this->sfn   = $this->get_cgi_var('sfn');
		isset($this->sfn)             || $this->sfn          = array();
		is_array($this->sfn)          || $this->sfn          = array($this->sfn);
		isset($opts['sort_field'])    || $opts['sort_field'] = array();
		is_array($opts['sort_field']) || $opts['sort_field'] = array($opts['sort_field']);
		$this->sfn   = array_merge($this->sfn, $opts['sort_field']);
		$this->sfn[] = '0'; // this last entry will be replaced in recreate_displayed()
		// Form variables all around
		$this->fl   = intval($this->get_cgi_var('fl'));
		$this->fm   = intval($this->get_cgi_var('fm'));
		$this->qfn  = $this->get_cgi_var('qfn');
		$this->sw   = $this->get_cgi_var('sw');
		$this->rec  = $this->get_cgi_var('rec', '');
		$this->navop = $this->get_cgi_var('navop');
		if (($this->navfm = $this->get_cgi_var('navfmup', $this->fm)) != $this->fm) {
			$this->navop = $this->labels['Go to'];
		} else if (($this->navfm = $this->get_cgi_var('navfmdown', $this->navfm)) != $this->fm) {
			$this->navop = $this->labels['Go to'];
		}
		$this->operation    = $this->get_cgi_var('operation');
		$this->saveadd      = $this->get_cgi_var('saveadd');
		$this->moreadd      = $this->get_cgi_var('moreadd');
		$this->canceladd    = $this->get_cgi_var('canceladd');
		$this->savechange   = $this->get_cgi_var('savechange');
		$this->morechange   = $this->get_cgi_var('morechange');
		$this->cancelchange = $this->get_cgi_var('cancelchange');
		$this->savedelete   = $this->get_cgi_var('savedelete');
		$this->canceldelete = $this->get_cgi_var('canceldelete');
		$this->cancelview   = $this->get_cgi_var('cancelview');
		// Filter setting
		if (isset($this->sw)) {
			$this->sw == $this->labels['Search'] && $this->fl = 1;
			$this->sw == $this->labels['Hide']   && $this->fl = 0;
			//$this->sw == $this->labels['Clear']  && $this->fl = 0;
		}
		// TAB names
		$this->tabs = array();
		// Setting key_delim according to key_type
		if ($this->key_type == 'real') {
			/* If 'real' key_type does not work,
			   try change MySQL datatype from float to double */
			$this->rec = doubleval($this->rec);
			$this->key_delim = '';
		} elseif ($this->key_type == 'int') {
			$this->rec = intval($this->rec);
			$this->key_delim = '';
		} else {
			$this->key_delim = '"';
			// $this->rec remains unmodified
		}
		// Specific $fdd modifications depending on performed action
		$this->recreate_fdd();
		// Extract SQL Field Names and number of fields
		$this->recreate_displayed();
		// Gathering query options
		$this->gather_query_opts();
		// Call to action
		!isset($opts['execute']) && $opts['execute'] = 1;
		$opts['execute'] && $this->execute();
		// Restore original error reporting level
		@error_reporting($error_reporting);
	} /* }}} */

}

/* Modeline for ViM {{{
 * vim:set ts=4:
 * vim600:fdm=marker fdl=0 fdc=0:
 * }}} */

?>
