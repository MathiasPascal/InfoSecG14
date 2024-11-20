<?php
//connect to the user account class
include("../classes/general_class.php");

//sanitize data

// function add_user_ctr($a,$b,$c,$d,$e,$f,$g){
// 	$adduser=new customer_class();
// 	return $adduser->add_user($a,$b,$c,$d,$e,$f,$g);
// }


Function add_brand_ctr($brandName)
{
$addbrand = new general_class();
return $addbrand->add_brand($brandName);
}   


function get_all_brands_ctr()
{
    $brand = new general_class();
    return $brand->get_all_brands();
}

function delete_brand_ctr($brand_id)
{
    $brand = new general_class();
    return $brand->delete_brand($brand_id);
}

//--DELETE--//

?>