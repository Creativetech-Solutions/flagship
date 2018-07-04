<?php
/**
 * Created by PhpStorm.
 * User: COD3R
 * Date: 9/16/2015
 * Time: 4:23 PM
 */

/**
 * Class Common_model
 * @property CI_DB_driver $db
 * @property Datatables $datatables
 */

class Cruise_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        //$this->load->library('Datatables');
    }

    // Select Queries
    function select($tbl = '')
    { 
        $query = $this->cruiseDb->get($tbl);
        return $query->result();
    }

    function select_fields($tbl = '', $data, $single = FALSE,$group_by = '',$order_by = '',$resultArray = false)
    {
        if(is_array($data)){
            $this->cruiseDb->select($data[0],$data[1]);


        }else{
            $this->cruiseDb->select($data);
        }

        if($group_by !== ''){
            $this->cruiseDb->group_by($group_by);
        }
        if($order_by !== ''){
            if(is_array($order_by)){
                $this->cruiseDb->order_by($order_by[0],$order_by[1]);
            }else{
                $this->cruiseDb->order_by($order_by);
            }
        }
        $query = $this->cruiseDb->get($tbl);print_r($this->cruiseDb->last_query());
        //return $this->cruiseDb->last_query();
        if ($query) {
            if ($single == TRUE) {
                if($resultArray === false) {
                    return $query->row();
                }elseif($resultArray === true){
                    return $query->row_array();
                }
            } else {
                if($resultArray === false){
                    return $query->result();
                }elseif($resultArray === true){
                    return $query->result_array();
                }
            }
        } else {
            return $this->cruiseDb->error();
        }

    }

    /**
     * @param string $tbl
     * @param $data
     * @param $where
     * @param bool $single
     * @param string $like
     * @param string $field
     * @param string $value
     * @param string $group_by
     * @param string $order_by
     * @return array
     */
    function select_fields_where($tbl = '', $data, $where, $single = FALSE, $like = '', $field = '', $value = '',$group_by = '',$order_by = '',$array = false)
    {
        if(is_array($data) && isset($data[1])){
            $this->cruiseDb->select($data[0],$data[1]);
        }else{
            $this->cruiseDb->select($data);
        }

        $this->cruiseDb->from($tbl);
        if ($like != '') {
            $this->cruiseDb->like('LOWER(' . $field . ')', strtolower($value));
            $this->cruiseDb->like($like);
        }
        $this->cruiseDb->where($where);
        if($group_by != ''){
            $this->cruiseDb->group_by($group_by);
        }
        if($order_by !== ''){
            if(is_array($order_by)){
                $this->cruiseDb->order_by($order_by[0],$order_by[1]);
            }else{
                $this->cruiseDb->order_by($order_by);
            }
        }
        $query = $this->cruiseDb->get();
//return $this->cruiseDb->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                if($array === true){
                    return $query->row_array();
                }else{
                    return $query->row();
                }
            } else {
                if($array === true){
                    return $query->result_array();
                }else{
                    return $query->result();
                }
            }
        } else {
// query returned no results
            return FALSE;
        }
    }

    function select_fields_where_like($tbl = '', $data, $where = '', $single = FALSE, $field, $value,$group_by = '',$order_by = '')
    {
        $this->cruiseDb->select($data);
        $this->cruiseDb->from($tbl);
        $this->cruiseDb->like('LOWER(' . $field . ')', strtolower($value));
        if ($where != '') {
            $this->cruiseDb->where($where);
        }
        if($group_by != ''){
            $this->cruiseDb->group_by($group_by);
        }
        if($order_by !== ''){
            if(is_array($order_by)){
                $this->cruiseDb->order_by($order_by[0],$order_by[1]);
            }else{
                $this->cruiseDb->order_by($order_by);
            }
        }
        $query = $this->cruiseDb->get();
//return $this->cruiseDb->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
// query returned no results
            return FALSE;
        }
    }

    function select_fields_where_like_orLikes($tbl = '', $data, $where = '', $single = FALSE, $field, $value, $orLikes = '',$group_by = '')
    {
        $this->cruiseDb->select($data);
        $this->cruiseDb->from($tbl);
        $this->cruiseDb->like('LOWER(' . $field . ')', strtolower($value));
        if($orLikes != '' and is_array($orLikes)){
            foreach($orLikes as $key=>$array){
                $this->cruiseDb->or_like('LOWER('.$array['field'].')', strtolower($array['value']));
            }
        }
        if ($where != '') {
            $this->cruiseDb->where($where);
        }
        if($group_by != ''){
            $this->cruiseDb->group_by($group_by);
        }
        $query = $this->cruiseDb->get();
//return $this->cruiseDb->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
// query returned no results
            return FALSE;
        }
    }

    function select_fields_where_like_join($tbl = '', $data, $joins = '', $where = '', $single = FALSE, $field = '', $value = '',$group_by='',$order_by = '',$limit = '',$array = false)
    {
        if (is_array($data) and isset($data[1])){
            $this->cruiseDb->select($data[0],$data[1]);
        }else{
            $this->cruiseDb->select($data);
        }

        $this->cruiseDb->from($tbl);

        //Fourth Param is For Escaping, i-e CI should use backTicks on a join or not.
        if ($joins != '') {
            foreach ($joins as $k => $v) {
                $this->cruiseDb->join($v['table'], $v['condition'], $v['type'],(isset($v['escape'])?$v['escape']:TRUE));
            }
        }

        if ($value !== '') {
            $this->cruiseDb->like('LOWER(' . $field . ')', strtolower($value));
        }

        if ($where != '') {
            $this->cruiseDb->where($where);
        }
        if($group_by != ''){
            $this->cruiseDb->group_by($group_by);
        }
        if($order_by != ''){
            if(is_array($order_by)){
                $this->cruiseDb->order_by($order_by[0],$order_by[1]);
            }else{
                $this->cruiseDb->order_by($order_by);
            }
        }
        if($limit != ''){
            if(is_array($limit)){
                $this->cruiseDb->limit($limit[0],$limit[1]);
            }else{
                $this->cruiseDb->limit($limit);
            }
        }

        $query = $this->cruiseDb->get();

        if($query === FALSE ){
//            echo 'Database Error(' . $this->cruiseDb->_error_number() . ') - ' . $this->cruiseDb->_error_message();
            return FALSE;
        }

        if ($query->num_rows() !== NULL && $query->num_rows() > 0) {
            if ($single == TRUE) {
                if($array === true){
                    return $query->row_array();
                }else{
                    return $query->row();
                }
            } else {
                if($array === true) {
                    return $query->result_array();
                }else{
                    return $query->result();
                }
            }
        } else {
            return FALSE;
        }
    }

    function select_fields_where_like__orLikes_join($tbl = '', $data, $joins = '', $where = '', $single = FALSE, $field = '', $value = '', $orLikes = '', $group_by='',$order_by = '',$limit = '')
    {
        if (is_array($data) and isset($data[1])){
            $this->cruiseDb->select($data[0],$data[1]);
        }else{
            $this->cruiseDb->select($data);
        }

        $this->cruiseDb->from($tbl);
        if ($joins != '') {
            foreach ($joins as $k => $v) {
                $this->cruiseDb->join($v['table'], $v['condition'], $v['type']);
            }
        }
        if ($value !== '') {
            $this->cruiseDb->like('LOWER(' . $field . ')', strtolower($value));
        }

        if($orLikes != '' and is_array($orLikes)){
            foreach($orLikes as $key=>$array){
                $this->cruiseDb->or_like('LOWER('.$array['field'].')', strtolower($array['value']));
            }
        }

        if ($where != '') {
            $this->cruiseDb->where($where);
        }
        if($group_by != ''){
            $this->cruiseDb->group_by($group_by);
        }
        if($order_by != ''){
            if(is_array($order_by)){
                $this->cruiseDb->order_by($order_by[0],$order_by[1]);
            }else{
                $this->cruiseDb->order_by($order_by);
            }
        }
        if($limit != ''){
            if(is_array($limit)){
                $this->cruiseDb->limit($limit[0],$limit[1]);
            }else{
                $this->cruiseDb->limit($limit);
            }
        }
        $query = $this->cruiseDb->get();
//        return $this->cruiseDb->last_query();
//return $this->cruiseDb->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
// query returned no results
            return FALSE;
        }
    }

//Common AutoComplete Queries
    function get_autoComplete($tbl, $data, $field, $value, $where = '', $group_by = false, $limit = '')
    {
        $this->cruiseDb->select($data);
        $this->cruiseDb->from($tbl);
        if ($where != '') {
            $this->cruiseDb->where($where);
        }
        $this->cruiseDb->like('LOWER(' . $field . ')', strtolower($value));
        if ($group_by == true) {
            $this->cruiseDb->group_by($field);
        }
        if ($limit != '') {
            $this->cruiseDb->limit($limit);
        }
        $query = $this->cruiseDb->get();
        return $query->result();
    }

    function get_autoCompleteJoin($PTable, $joins = '', $where = '', $data, $field, $value, $group_by = false)
    {
        $this->cruiseDb->select($data);
        $this->cruiseDb->from($PTable);
        if ($joins != "") {
            foreach ($joins as $k => $v) {
                $this->cruiseDb->join($v['table'], $v['condition'], $v['type']);
            }
        }
        if ($where != '') {
            $this->cruiseDb->where($where);
        }
        $this->cruiseDb->like('LOWER(' . $field . ')', strtolower($value));
        if ($group_by == true) {
            $this->cruiseDb->group_by($field);
        }
        $query = $this->cruiseDb->get();
//echo $this->cruiseDb->last_query();
        return $query->result();
    }


    //------------------------ insert record queries -----------------------------------
    function insert_record($tbl, $data)
    {
        $this->cruiseDb->insert($tbl, $data);
        return $this->cruiseDb->insert_id();
    }


    //Insert Record If Don't Exist Else Update the Record
    function insert_slash_update($tbl, $data, $field, $id,$where){
        $this->cruiseDb->where($where);
        $q = $this->cruiseDb->get($tbl);
        if ( $q->num_rows() > 0 )
        {
            $this->cruiseDb->where($field,$id);
            $this->cruiseDb->update($tbl,$data);
            $affectedRows = $this->cruiseDb->affected_rows();
            if($affectedRows){
                return TRUE;
            }else{
                return FALSE;
            }
        } else {
            $this->cruiseDb->set($field, $id);
            $this->cruiseDb->insert($tbl,$data);
            $insertedID = $this->cruiseDb->insert_id();
            if($insertedID > 0){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    function insert_multiple($tbl, $data)
    {
        $query = $this->cruiseDb->insert_batch($tbl, $data);
        return $query;
    }

    /**
     * @param $tbl
     * @param $data
     * @return bool
     */
    function insert_multiple_ignore_duplicate($tbl, $data){
        $this->cruiseDb->trans_start();
        foreach ($data as $item) {
            $insert_query = $this->cruiseDb->insert_string($tbl, $item);
            $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
            $this->cruiseDb->query($insert_query);
        }
        $this->cruiseDb->trans_complete();
        if($this->cruiseDb->trans_status() === FALSE){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    //------------------------End of insert record queries -----------------------------------
// Common Update Queries
    function update($tbl, $where, $data)
    { 
        $this->cruiseDb->where($where);
        $this->cruiseDb->update($tbl, $data);
        $affectedRows = $this->cruiseDb->affected_rows();
        if ($affectedRows) {
            return true;
        } else {
            return $this->cruiseDb->error();
        }
    }

    function update_query($tbl, $field, $id, $data)
    {
        $this->cruiseDb->where($field, $id);
        $this->cruiseDb->update($tbl, $data);
        $affectedRows = $this->cruiseDb->affected_rows();
        if ($affectedRows) {
            return TRUE;
        } else {
            return $this->cruiseDb->error();
        }
    }

    function delete($table , $where=NULL)
    {
        if(!empty($where))
        {
            $this->cruiseDb->where($where);
        }
        if($this->cruiseDb->delete($table))
        {
            return $this->cruiseDb->affected_rows();
        }
    }

    function update_query_array($tbl, $fields, $data)
    {
        $this->cruiseDb->where($fields);
        $this->cruiseDb->update($tbl, $data);
        $afftectedRows = $this->cruiseDb->affected_rows();
        if ($afftectedRows) {
            return $afftectedRows;
        } else {
            return $this->cruiseDb->_error_message();
        }
    }
//Common Update Queries End

    //Common DataTables Queries
    function  select_fields_joined_DT($data, $PTable, $joins = '', $where = '',$where_in_column ='', $where_in_data = '', $group_by = '', $addColumn = '', $editColumn = '',$unsetColumn = '')
    {

        if(is_array($data)){
            $this->datatables->select($data[0],$data[1]);
        }else{
            $this->datatables->select($data);
        }

        if ($unsetColumn != '') {
            $this->datatables->unset_column($unsetColumn);
        }
        $this->datatables->from($PTable);
        if ($joins != '') {
            foreach ($joins as $k => $v) {
                $this->datatables->join($v['table'], $v['condition'], $v['type']);
            }
        }
        if ($where != '') {
            if(is_array($where) && array_key_exists("QueryCondition",$where)){
                $this->datatables->where($where["QueryCondition"],$where[0],$where[1]);
            }else{
                $this->datatables->where($where);
            }
        }
        if($where_in_data !== ''){
            $this->datatables->where_in($where_in_column,$where_in_data);
        }
        if($group_by != ''){
            $this->datatables->group_by($group_by);
        }
        if ($addColumn != '') {
            foreach($addColumn as $columnKey=>$columnValue ) {
                if(!is_array($columnValue) && is_string($columnValue)){
                    $this->datatables->add_column($columnKey, $columnValue);
                }else{
                    $this->datatables->add_column($columnKey, $columnValue[0],$columnValue[1]);
                }
            }
        }
        if ($editColumn != ''){
            foreach($editColumn as $arrayKey=>$arrayValue){
                $this->datatables->edit_column($arrayValue[0],$arrayValue[1],$arrayValue[2]);
            }
        }
        $result = $this->datatables->generate();
        return $result;
    }

    //Importing of File Using Import Library Added To The Application..
    function Import_FileImportLibrary_CSV($table,$data){
        $this->cruiseDb->insert($table, $data);
    }

    // Function for run query
    function get_query_record($query)
    {
        $result=$this->cruiseDb->query($query);
        if($result->num_rows() > 0)
        {
            return $result;
        }
    }
    // End



    //Function For DropDowns. Updating The Classic Style From Parexons Company.
    function classic_dropdown($table, $option, $key, $value, $where){
        //Lets Put Little Checks On Required Parameters
        if(!isset($table) || empty($table)){
            return false;
        }
        if(!isset($option) || empty($option)){
            return false;
        }
        if(!isset($key) || empty($key)){
            return false;
        }
        if(!isset($value) || empty($value)){
            return false;
        }

        $this->cruiseDb->select('*');
        $this->cruiseDb->from($table);
        if($where !== ''){
            $this->cruiseDb->where($where);
        }
        $query = $this->cruiseDb->get();
        if($query->num_rows() > 0)
        {
            $data[''] = $option;
            foreach($query->result() as $row)
            {
                $data[$row->$key] = $row->$value;
            }
            return $data;
        }
    }

    /// Dynamic Function For Drop Down With Select Option
    public  function dropdown_wd_option($table, $option, $key, $value, $where)
    {
        $this->cruiseDb->select('*');
        $this->cruiseDb->where($where);
        $query = $this->cruiseDb->get($table);

        if($query->num_rows() > 0)
        {
            $data[''] = $option;
            foreach($query->result() as $row)
            {
                $data[$row->$key] = $row->$value;
            }
            return $data;
        }
    }

    public function insert_else_ignore($table,$data)
    {
        $query = $this->cruiseDb->get_where($table,$data);
        $count = $query->num_rows(); //counting result from query

        if ($count === 0) {

            $this->cruiseDb->insert($table, $data);
            return true;
        }
    }

    public function get_row_where($table,$data)
    {   
				$this->cruiseDb->where($data);
        $query = $this->cruiseDb->get($table);
				//echo "<pre> query = "; print_r( $query  ); echo "</pre>";  
							
        if($query->num_rows() > 0) //counting result from query
        {
            return true;
        }
    }
    function get_row_order_desc($tbl = '', $data, $single = FALSE,$order_by = '')
    {
        $this->cruiseDb->select($data);
        $this->cruiseDb->from($tbl);

        if($order_by !== ''){
            if(is_array($order_by)){
                $this->cruiseDb->order_by($order_by[0],$order_by[1]);
            }else{
                $this->cruiseDb->order_by($order_by);
            }
        }
        $query = $this->cruiseDb->get();
//return $this->cruiseDb->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
// query returned no results
            return FALSE;
        }
    }
    public function get_record_where($table,$where)
    {
        $this->cruiseDb->select('*');
        $this->cruiseDb->from($table);
        $this->cruiseDb->where($where);
        $query = $this->cruiseDb->get();
        if($query->num_rows() > 0) //counting result from query
        {
            return $query->row();
        }

    }
    //End of Common DataTables Queries

    public function count_all_rows($tbl, $where=null){
        $this->cruiseDb->select('COUNT(1)');
        $this->cruiseDb->from($tbl);
        if(!empty($where))
            $this->cruiseDb->where($where);
        return $this->cruiseDb->count_all_results();
    }

    // update mulitple rows

    public function update_batch($tbl, $data, $where){
        $this->cruiseDb->update_batch($tbl, $data, $where);
        $affectedRows = $this->cruiseDb->affected_rows();
        if ($affectedRows) {
            return true;
        } else {
            return $this->cruiseDb->error();
        }
    }

    // count records group by value
    public function count_group_by($tbl, $count_id, $group_by){
        $this->cruiseDb->select('country, COUNT("'.$count_id.'") as total');
        $this->cruiseDb->group_by($group_by);
        $query=$this->cruiseDb->get($tbl);
        return $query->result();
    }
    
}