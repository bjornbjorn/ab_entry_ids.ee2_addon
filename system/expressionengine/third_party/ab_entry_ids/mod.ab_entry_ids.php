<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * Entry IDs Module Front End File
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Module
 * @author		Bjørn Børresen
 * @link		http://www.addonbakery.com
 */

class Ab_entry_ids {
	
	public $return_data;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
        $sql = $this->EE->TMPL->fetch_param('sql');
        $separator = $this->EE->TMPL->fetch_param('separator', '|');
        $col_name = $this->EE->TMPL->fetch_param('col_name', 'entry_id');
        $results_tag_name = $this->EE->TMPL->fetch_param('results_tag_name', 'entry_ids');
        $tag_prefix = $this->EE->TMPL->fetch_param('tag_prefix', 'ab_');

        if($sql)
        {
            $q = $this->EE->db->query($sql);
            $results_str = '';
            $has_results = FALSE;

            if($q->num_rows())
            {
                $results = array();
                foreach($q->result() as $row)
                {
                    $results[] = $row->$col_name;
                }

                $results_str = implode($separator, $results);
                $has_results = TRUE;
            }

            $vars[] = array(
                $tag_prefix.'has_results' => $has_results,
                $tag_prefix.$results_tag_name => $results_str,
            );

            $this->return_data = $this->EE->TMPL->parse_variables($this->EE->TMPL->tagdata, $vars);
        }

        return $this->return_data;
	}

}
/* End of file mod.entry_ids.php */
/* Location: /system/expressionengine/third_party/entry_ids/mod.entry_ids.php */