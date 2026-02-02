<?php
namespace App\Models;

use App\Models\Model;

class ProductFiles extends Model{
    protected $table = "product_files";

    public function fileType()
    {
        $query = $this->db->getPDO()->query("SHOW COLUMNS FROM product_files LIKE 'file_type' ");
        $row = $query->fetch();
        // var_dump($row);die();
        $enum_value = str_replace("'", "", substr($row->Type, 5, (strlen($row->Type)-6)));
        $enum_array = explode(',', $enum_value);
        // var_dump(strlen($enum_array));die();
        $i = 0;
        foreach($enum_array as $r){
        //    var_dump($r);
                $i++;
        }
        array_pop($enum_array);
        // var_dump($enum_array);die();
        
        return $enum_array; 
    }
}