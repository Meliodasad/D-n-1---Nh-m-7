<?php
if($result){
    $query ="SELECT * FROM tbl _product ORDER BY product_id DESC LIMIT 1";
    $result = $this ->db ->$result['product_id'];
    $filename = $_FILES['product_img_desc']['name'];

    foreach($filename as $key =>$value){
        $query = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUE ('$product_id','$value ')'";
        $result = $this ->db-> insert($query);
    }
    return $result;
}
?>