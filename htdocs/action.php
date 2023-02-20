<?php
    include("db.php");

    if($_POST["action"] == "insert"){
        $sql = "insert into `account_info`(`帳號`,`姓名`,`性別`,`生日`,`信箱`,`備註`) values('".strtolower($_POST["user_number"])."','".$_POST["user_name"]."','".$_POST["user_sex"]."','".$_POST["user_btd"]."','".$_POST["user_email"]."','".$_POST["user_remark"]."')";
        mysqli_query($link,$sql);
    }else if($_POST["action"] == "update"){
        $sel = mysqli_query($link, "select * from `account_info` where `帳號`='".$_POST["id"]."'");
        foreach($sel as $row){
            $output["user_name"] = $row["姓名"];
			$output['user_sex'] = $row['性別'];
            $output['user_btd'] = $row['生日'];
            $output['user_email'] = $row['信箱'];
            $output['user_remark'] = $row['備註'];
        }
        echo json_encode($output);
    }else if($_POST["action"] == "update_ok"){
        $sql = "update `account_info` set `姓名`='".$_POST["user_name"]."',`性別`='".$_POST["user_sex"]."',`生日`='".$_POST["user_btd"]."',`信箱`='".$_POST["user_email"]."',`備註`='".$_POST["user_remark"]."' where `帳號`='".$_POST["user_number_temp"]."'";
        mysqli_query($link,$sql);
    }else if($_POST["action"] == "delete"){
        $sql = "delete from `account_info` where `帳號`='".$_POST["id"]."'";
        mysqli_query($link,$sql);
    }

?>