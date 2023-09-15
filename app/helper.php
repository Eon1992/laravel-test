<?php

if(!function_exists('get_value')){
    function get_value($variable, $keys = false, $default = NULL, $callable = false, $is_object = false)
    {
        if(is_object($variable))
        {
            $variable = json_decode(json_encode($variable), true);
        }

        if(is_array($keys))
        {
            // Do nothing
        }
        else
        {
            $keys = explode('|', $keys);
        }

        $value = $variable;

        foreach($keys as $key)
        {
            if(isset($value[$key]))
            {
                if($key == end($keys))
                {
                    if($callable && is_callable($callable))
                    {
                        return $callable($value[$key]);
                    }
                    else
                    {
                        return $value[$key];
                    }
                }
                else
                {
                    $value = $value[$key];
                }
            }
            else
            {
                break;
            }
        }

        return $default;
    }
}

if(!function_exists('per_page_options')) {
    function per_page_options(){
        return array(10=>10, 25=>25, 50=>50, 100=>100);
    }
}

if(!function_exists('batch_update')) {
    function batch_update($table, $data, $key){
        $query = '';
        $data_arr = [];

        if (!empty($data)) {

            foreach ($data as $value) {
                foreach ($value as $col => $rval) {
                    if ($col != $key) {
                        $data_arr[$col][] = [$key => $value[$key], 'col_val' => $rval];
                    }
                }
            }

            $query = 'UPDATE '.$table.' SET';

            $i = 1;
            foreach ($data_arr as $dkey => $dvalue) {
                $query .= ' '.$dkey.' = CASE';

                foreach ($dvalue as $col => $rval) {
                    $query .= ' WHEN '.$key.' = '.$rval[$key].' THEN "'.$rval['col_val'].'"';
                }

                $query .= ' ELSE '.$dkey.' END';

                if ($i < count($data_arr)) {
                    $query .= ',';
                }

                $i++;
            }
        }


        if ($query != '') {
            \Illuminate\Support\Facades\DB::update($query);
        }

        return;
    }
}

if(!function_exists('batch_update_mapping')) {
    function batch_update_mapping($table, $data, $key){
        $query = '';
        $data_arr = [];

        if (!empty($data)) {

            foreach ($data as $value) {
                foreach ($value as $col => $rval) {
                    if ($col != $key) {
                        $data_arr[$col][] = [$key => $value[$key], 'col_val' => $rval];
                    }
                }
            }

            $query = 'UPDATE '.$table.' SET';

            $i = 1;
            foreach ($data_arr as $dkey => $dvalue) {
                $query .= ' '.$dkey.' = CASE';

                foreach ($dvalue as $col => $rval) {
                    $query .= " WHEN ".$key." = ".$rval[$key]." THEN '".$rval['col_val']."'";
                }

                $query .= ' ELSE '.$dkey.' END';

                if ($i < count($data_arr)) {
                    $query .= ',';
                }

                $i++;
            }
        }


        if ($query != '') {
            \Illuminate\Support\Facades\DB::update($query);
        }

        return;
    }
}


function helper_array_column($input, $array_index_key = NULL , $array_value = NULL ) 
{
    $result = array();

    if(count($input) > 0)
    {
        foreach( $input as $key => $value )
        {
            if(is_array($value))
            {
                $result[is_null($array_index_key) ? $key : (string)(is_callable($array_index_key)?$array_index_key($value):$value[$array_index_key])] = is_null($array_value) ? $value : (is_callable($array_value)?$array_value($value,$key):$value[$array_value]);
            }
            else if(is_object($value))
            {
                $result[is_null($array_index_key) ? $key : (string)$value->$array_index_key] = is_null($array_value) ? $value : $value->$array_value;
            }
            else
            {
                $result[is_null($array_index_key) ? $key : (string)(is_callable($array_index_key)?$array_index_key($value,$key):$key)] = is_null($array_value) ? $value : (string)(is_callable($array_value)?$array_value($value,$key):$value);
            }    
        }
    }    
    
    return $result;
}

/*
@Description: To generate array_column functionality such as set as multiple key and it's respective value
@Author     : Rahul Arora
@Input      : array , index key and it's values
@Output     : array
@Date       : 25-02-2021
*/ 
function helper_array_column_multiple_key($input, $array_index_key = NULL , $add_extra_key = FALSE ,  $array_value = NULL) 
{
    $result = array();

    $add_extra_key_string = "";

    if($add_extra_key)
    {
        $add_extra_key_string = "[]";
    }

    if(count($input) > 0)
    {
        $key_string = (implode("",array_map(function($value)
        {
            return '[(string)$value["'.$value.'"]]';
        },$array_index_key)).$add_extra_key_string);


        /*foreach( $input as $key => $value)
        {
            if(is_array($value) && $key_string)
            {
                $execution = '$result'.$key_string.' = $value;';
                eval($execution);
            }
        }*/

        foreach( $input as $key => $value)
        {
            if(is_array($value) && $key_string)
            {
                $execution = '$result'.$key_string.' = is_null($array_value) ? $value : $value[$array_value];';
                eval($execution);
            }
        }
    }    
    return $result;
}

// Helping function created for shortcut by Rahul
function pr($data){
    echo '<pre>';
    print_r($data);
    exit();
}

// Helping function created for shortcut by Rahul
function pr1($data){
    echo '<pre>';
    print_r($data);
}

// label type function created by Rahul
function get_label_type(){
    
    $label_types = array(
        'heading'      => 'Heading',
        'heading_line' => 'Heading Line',
        'subheading'   => 'Sub Heading',
        'subheading_line' => 'Sub Heading Line',
        'add_button'   => 'Add Button',
        'edit_button'  => 'Edit Button',
        'save_button'  => 'Save Button',
        'cancel_button'=> 'Cancel Button',
        'save_button'  => 'Save Button',
        'edit_hover'   => 'Edit Hover',
        'delete_hover' => 'Delete Hover',
        'view_hover'   => 'View Hover',
        'radio_button' => 'Radio Button',
        'checkbox'     => 'Checkbox',
        'text_label'   => 'Text Label'
    );

    return $label_types;
}
