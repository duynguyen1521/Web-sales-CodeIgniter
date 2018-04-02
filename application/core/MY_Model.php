<?php
Class MY_Model extends CI_Model
{
    public $table;

    //Khoa chinh cua table dang su dung, VD: id hoac user_id
    public $key = "id";

    public $order = "";

    public $select = "";


    //Them 1 record
    public function create($data = array())
    {
        if($this->db->insert($this->table, $data))
        {
            return TRUE;
        }
        return FALSE;
    }


    //Update tu id
    public function update_id($id, $data = array())
    {
        if(!$id)
        {
            return FALSE;
        }

        $where = array($this->key => $id);

        if($this->update($where, $data))
        {
            return TRUE;
        }

        return FALSE;
    }

    public function update($where = array(), $data = array())
    {
        if(!$where)
        {
            return FALSE;
        }

        $this->db->where($where);

        if($this->db->update($this->table, $data))
        {
            return TRUE;
        }

        return FALSE;
    }


    //Xoa tu id
    public function delete_id($id)
    {
        if(!$id){
            return FALSE;
        }

        if(is_numeric($id))
        {
            $where = array($this->key => $id);                  //chi gom 1 id, VD: $id = 7
        }else{
            $where = $this->key . " IN (". $id .") ";           //VD id = 1, 2, 3   ==> Xoa nhieu ban ghi
        }

        if($this->delete($where))
        {
            return TRUE;
        }

        return FALSE;
    }

    public function delete($data = array())
    {
        if(!$data)
        {
            return FALSE;
        }

        $this->db->where($data);

        if($this->db->delete($this->table))
        {
            return TRUE;
        }

        return FALSE;
    }


    //Truy van SQL bat ky
    public function query($sql, $type_result = 'obj')
    {
        $query = $this->db->query($sql);
        if(!$query)
        {
            return FALSE;
        }

        if($type_result == 'obj')
        {
            return $query->result();
        }else{
            return $query->result_array();
        }
    }


    //Get cac truong cua record theo id
    public function get_info_id($id, $field = '')
    {
        if(!$id)
        {
            return FALSE;
        }

        $where = array($this->key => $id);
        return $this->get_info($where, $field);
    }

    //Chi lay ra 1 ban ghi
    public function get_info($where = array(), $field = '*')              //field co dang 'name' hoac 'id, name, ...'
    {
        $this->db->select($field);
        $this->db->where($where);
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0)
        {
            return $query->row();                           //$query có thể là 1 mang cac doi tuong, nhưng ta chỉ lấy 1
        }

        return FALSE;
    }


    public function get_list($input = array())
    {
        if(isset($input))
        {
            $this->get_list_set_input($input);
            $query = $this->db->get($this->table);
            return $query->result();
        }
    }

    //Kết hợp nhiều điều kiện
    /*
        $input = array();

        $input['where'] = array(
            "email" => "xxx@gmail.com",
            "age" => 22
        );
        $input['where_in'] = array("id", array(1, 2, 3, 4 ,5));
        $input['limit'] = array(5, 0);
        $input['order'] = array("name", "DESC");
        $input['like'] = array("email", "xxx@gmail.com");
    */
    public function get_list_set_input($input = array())
    {
        if(isset($input['where']) && $input['where'])
        {
            $this->db->where($input['where']);
        }

        if(isset($input['where_in']) && $input['where_in'])
        {
            $this->db->where_in($input['where_in'][0], $input['where_in'][1]);
        }

        if(isset($input['like']) && $input['like'])
        {
            $this->db->like($input['like'][0], $input['like'][1]);
        }

        if(isset($input['order']) && isset($input['order'][0]) && isset($input['order'][1]))
        {
            $this->db->order_by($input['order'][0], $input['order'][1]);
        }else{
            $order = ($this->order == '') ? array($this->table . '.' . $this->key, 'DESC') : $this->order;
            $this->db->order_by($order[0], $order[1]);
        }

        if(isset($input['limit']) && $input['limit'])
        {
            $this->db->limit($input['limit'][0], $input['limit'][1]);
        }
    }


    //Dem so ban ghi phu hop voi dieu kien dau vao
    public function get_total($input = array())
    {
        if(isset($input))
        {
            $this->get_list_set_input($input);
            $query = $this->db->get($this->table);
            return $query->num_rows();
        }
    }


    //Kiem tra co ton tai record phu hop dieu kien hay khong
    public function check_exists($where = array())
    {
        $this->db->where($where);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0)
        {
            return TRUE;
        }

        return FALSE;
    }
}