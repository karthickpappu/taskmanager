<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datatable {
	
    public function __construct()
    {
        $this->CI =& get_instance();
    }
	
    public function render_table($result_table, $columns_list=null, $table_name="mast_tb")
    {
        $html = "";
        $colno = 0;
        if($result_table && count($result_table) > 0 && $columns_list)
        {
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns_list as $column_info)
                {
                    $html = $html.$this->render_column($column_info["field_data"], $column_info, $row);
                    /*
                    if($column_info["type"] == "label")
                    {
                        $html = $html.'<td>'.$row[$column_info["field_data"]].'</td>';
                    }
                    else if($column_info["type"] == "custom")
                    {
                        $html = $html.'<td>'.$column_info["field_data"].'</td>';
                    }*/					
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';			
        }
        else if($result_table && count($result_table) > 0)
        {
            /* Get the list of columns in table */
            foreach ($result_table[0] as $field=>$c)
            {
                $columns[$colno] = $field;
                $colno++;
            }
            /* render table header */
            $html = '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
            /* render table footer */
            $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            /* render table data */

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns as $column)
                {
                    $html = $html.'<td>'.$row[$column].'</td>';
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';
        }
        return $html;
    }
    
    
     public function render_table2($result_table, $columns_list=null, $table_name="mast_tb1")
    {
        $html = "";
        $colno = 0;
        if($result_table && count($result_table) > 0 && $columns_list)
        {
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns_list as $column_info)
                {
                    $html = $html.$this->render_column($column_info["field_data"], $column_info, $row);
                    /*
                    if($column_info["type"] == "label")
                    {
                        $html = $html.'<td>'.$row[$column_info["field_data"]].'</td>';
                    }
                    else if($column_info["type"] == "custom")
                    {
                        $html = $html.'<td>'.$column_info["field_data"].'</td>';
                    }*/					
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';			
        }
        else if($result_table && count($result_table) > 0)
        {
            /* Get the list of columns in table */
            foreach ($result_table[0] as $field=>$c)
            {
                $columns[$colno] = $field;
                $colno++;
            }
            /* render table header */
            $html = '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
            /* render table footer */
            $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            /* render table data */

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns as $column)
                {
                    $html = $html.'<td>'.$row[$column].'</td>';
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';
        }
        return $html;
    }
     public function render_table3($result_table, $columns_list=null, $table_name="mast_tb2")
    {
        $html = "";
        $colno = 0;
        if($result_table && count($result_table) > 0 && $columns_list)
        {
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead >';
            $html = $html.'<tr >';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
              $html = $html.'<tbody>';
           
           
            			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns_list as $column_info)
                {
                    $html = $html.$this->render_column($column_info["field_data"], $column_info, $row);
                    /*
                    if($column_info["type"] == "label")
                    {
                        $html = $html.'<td>'.$row[$column_info["field_data"]].'</td>';
                    }
                    else if($column_info["type"] == "custom")
                    {
                        $html = $html.'<td>'.$column_info["field_data"].'</td>';
                    }*/					
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
          $html = $html.'<tfoot >';
            $html = $html.'<tr >';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            
            $html = $html.'</table>';			
        }
        else if($result_table && count($result_table) > 0)
        {
            /* Get the list of columns in table */
            foreach ($result_table[0] as $field=>$c)
            {
                $columns[$colno] = $field;
                $colno++;
            }
            /* render table header */
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
            /* render table footer */
            $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            /* render table data */

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns as $column)
                {
                    $html = $html.'<td>'.$row[$column].'</td>';
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
             $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            $html = $html.'</table>';
        }
        return $html;
    }
     public function render_table4($result_table, $columns_list=null, $table_name="mast_tb3")
   {
        $html = "";
        $colno = 0;
        if($result_table && count($result_table) > 0 && $columns_list)
        {
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead >';
            $html = $html.'<tr >';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
              $html = $html.'<tbody>';
           
           
            			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns_list as $column_info)
                {
                    $html = $html.$this->render_column($column_info["field_data"], $column_info, $row);
                    /*
                    if($column_info["type"] == "label")
                    {
                        $html = $html.'<td>'.$row[$column_info["field_data"]].'</td>';
                    }
                    else if($column_info["type"] == "custom")
                    {
                        $html = $html.'<td>'.$column_info["field_data"].'</td>';
                    }*/					
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
          $html = $html.'<tfoot >';
            $html = $html.'<tr >';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            
            $html = $html.'</table>';			
        }
        else if($result_table && count($result_table) > 0)
        {
            /* Get the list of columns in table */
            foreach ($result_table[0] as $field=>$c)
            {
                $columns[$colno] = $field;
                $colno++;
            }
            /* render table header */
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
            /* render table footer */
            $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            /* render table data */

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns as $column)
                {
                    $html = $html.'<td>'.$row[$column].'</td>';
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
             $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            $html = $html.'</table>';
        }
        return $html;
    }
	
    protected function render_column($field_name, $c, $r)
    {
        if(!isset($r[$field_name]) || empty($r[$field_name])){ 
            return '<td></td>'; 
        }
		
        $field_value = trim($r[$field_name]); //(isset($c['strip_tag']) && $c['strip_tag'] == TRUE) ? strip_tags($r[$field_name]) : trim($r[$field_name]); 
        $field_type = $c['type'];
        $align = isset($c['align']) ? $c['align'] : '';
        $html = '<div style="padding-right:50px;"><td align="'.$align.'">';
        switch($field_type){
            case "label":
                $html .= $field_value;
                break;
            
            /*case "link":
                $this->CI->load->library('parser');
                $field_href = isset($c['href']) && !empty($c['href']) ? $this->CI->parser->parse_string($c['href'], $r, TRUE) : $field_value;
                $field_value = isset($c['link_name']) && !empty($c['link_name']) ? $c['link_name'] : $field_value;
                $field_target = isset($c['target']) ? $c['target'] : '';
                $html .= '<a href="'.$field_href.'" target="'.$field_target.'">'.$field_value.'</a>'; 
                break;
            */
            case "custom":
                $this->CI->load->library('parser');
                $html .= isset($c['html']) ? $this->CI->parser->parse_string($c['html'], $r, TRUE) : '';
                break;
            /*
            case "image":
                $field_image_width = isset($c['image_width']) ? $c['image_width'] : '';
                $field_image_height = isset($c['image_height']) ? $c['image_height'] : '';
                $img_default = !empty($c['image_default']) ? '<img src="'.$c['image_default'].'" />': '';
                $html .= !empty($field_value) ? '<img src="'.$field_value.'" width="'.$field_image_width.'" height="'.$field_image_height.'" />' : $img_default;
                break;
            
            case "html":
                $html .= '<code>'.htmlentities($field_value).'</code>';
                break;
            
            case "code":
                $html .= '<pre>'.$field_value.'</pre>';
                break;
            
            case "enum":
					$html .= (is_array($c['source']) && isset($c['source'][$field_value])) ? $c['source'][$field_value] : $field_value;
                break;
            
            case "progressbar":
                $field_maximum_value = isset($c['maximum_value']) ? $c['maximum_value'] : 100;
                $show_value = isset($c['show_value']) ? $c['show_value'] : false;
                $style = isset($c['style']) ? $c['style'] : 'progress-bar-default';
                $progress_value = ($field_value/$field_maximum_value * 100);
                if($show_value !== false){
                    $html .= '<div class="clearfix">
                                <small class="pull-left">'.(($field_value > 0) ? $field_value : "").'</small>
                              </div>';    
                }
                $html .= '<div class="progress  xs" style="height: 8px;" title="'.$field_value.'">
                            <div class="progress-bar '.$style.'" role="progressbar" aria-valuenow="'.$progress_value.'" aria-valuemin="0" aria-valuemax="'.$field_maximum_value.'" style="width: '.$progress_value.'%;"></div>
                          </div>';
                break;
                
            case "date":
                $format_to = isset($c['date_format']) ? $c['date_format'] : '';
                $format_from = isset($c['date_format_from']) ? $c['date_format_from'] : "Y-m-d H:i:s";
                $html .= !empty($format_to) ? $this->get_date_formated($field_value, $format_from, $format_to) : $field_value;
                break;
            
            case "relativedate":
                $this->CI->load->helper('date');
                $html .= $this->get_relative_date($field_value);
                break;
            
            case "money": 
                $field_money_sign = isset($c['sign']) ? $c['sign'] : '';
                $field_decimal_places = isset($c['decimal_places']) ? $c['decimal_places'] : 2;
                $field_dec_separator = isset($c['decimal_separator']) ? $c['decimal_separator'] : '.';
                $field_thousands_separator = isset($c['thousands_separator']) ? $c['thousands_separator'] : ',';                        
                $html .= $field_money_sign.number_format($field_value, $field_decimal_places, $field_dec_separator, $field_thousands_separator);
                break;  
            
            case "password":
            case "mask":
                $field_symbol = isset($c['symbol']) ? $c['symbol'] : '*';
                $html .= str_repeat($field_symbol, strlen($field_value));
                break;
            */                    
            default:
                $html .= $field_value;
                break;
        }
        $html .= '</td></div>'; 
        return $html;
    }
	     public function render_table5($result_table, $columns_list=null, $table_name="mast_tb4")
    {
        $html = "";
        $colno = 0;
        if($result_table && count($result_table) > 0 && $columns_list)
        {
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns_list as $column_info)
                {
                    $html = $html.$this->render_column($column_info["field_data"], $column_info, $row);
                    /*
                    if($column_info["type"] == "label")
                    {
                        $html = $html.'<td>'.$row[$column_info["field_data"]].'</td>';
                    }
                    else if($column_info["type"] == "custom")
                    {
                        $html = $html.'<td>'.$column_info["field_data"].'</td>';
                    }*/					
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';			
        }
        else if($result_table && count($result_table) > 0)
        {
            /* Get the list of columns in table */
            foreach ($result_table[0] as $field=>$c)
            {
                $columns[$colno] = $field;
                $colno++;
            }
            /* render table header */
            $html = '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
            /* render table footer */
            $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            /* render table data */

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns as $column)
                {
                    $html = $html.'<td>'.$row[$column].'</td>';
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';
        }
        return $html;
    }
    
	 public function render_table6($result_table, $columns_list=null, $table_name="mast_tb5")
    {
        $html = "";
        $colno = 0;
        if($result_table && count($result_table) > 0 && $columns_list)
        {
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns_list as $column_info)
                {
                    $html = $html.$this->render_column($column_info["field_data"], $column_info, $row);
                    /*
                    if($column_info["type"] == "label")
                    {
                        $html = $html.'<td>'.$row[$column_info["field_data"]].'</td>';
                    }
                    else if($column_info["type"] == "custom")
                    {
                        $html = $html.'<td>'.$column_info["field_data"].'</td>';
                    }*/					
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';			
        }
        else if($result_table && count($result_table) > 0)
        {
            /* Get the list of columns in table */
            foreach ($result_table[0] as $field=>$c)
            {
                $columns[$colno] = $field;
                $colno++;
            }
            /* render table header */
            $html = '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
            /* render table footer */
            $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            /* render table data */

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns as $column)
                {
                    $html = $html.'<td>'.$row[$column].'</td>';
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';
        }
        return $html;
    }
    
    
     public function render_table7($result_table, $columns_list=null, $table_name="mast_tb6")
    {
        $html = "";
        $colno = 0;
        if($result_table && count($result_table) > 0 && $columns_list)
        {
            $html = '<table id="'.$table_name.'" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns_list as $column_info)
            {
                $html = $html.'<th>'.$column_info["header"].'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns_list as $column_info)
                {
                    $html = $html.$this->render_column($column_info["field_data"], $column_info, $row);
                    /*
                    if($column_info["type"] == "label")
                    {
                        $html = $html.'<td>'.$row[$column_info["field_data"]].'</td>';
                    }
                    else if($column_info["type"] == "custom")
                    {
                        $html = $html.'<td>'.$column_info["field_data"].'</td>';
                    }*/					
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';			
        }
        else if($result_table && count($result_table) > 0)
        {
            /* Get the list of columns in table */
            foreach ($result_table[0] as $field=>$c)
            {
                $columns[$colno] = $field;
                $colno++;
            }
            /* render table header */
            $html = '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $html = $html.'<thead>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</thead>';
            /* render table footer */
            $html = $html.'<tfoot>';
            $html = $html.'<tr>';
            foreach($columns as $column)
            {
                $html = $html.'<th>'.$column.'</th>';
            }
            $html = $html.'</tr>';
            $html = $html.'</tfoot>';
            /* render table data */

            $html = $html.'<tbody>';			
            foreach($result_table as $row)
            {
                $html = $html.'<tr>';
                foreach($columns as $column)
                {
                    $html = $html.'<td>'.$row[$column].'</td>';
                }				
                $html = $html.'</tr>';
            }
            $html = $html.'</tbody>';
            $html = $html.'</table>';
        }
        return $html;
    }
    
}
?>