<?php
    include("db.php");
    $sql = "select * from `account_info`";
    
    if(isset($_POST["id"])){
        $sql .=" where `帳號` like '%" . $_POST["id"] . "%'"; 
    }

    $sel = mysqli_query($link, $sql);

    $data_nums = mysqli_num_rows($sel); //統計總比數
    $per = 10; //每頁顯示項目數量
    $pages = ceil($data_nums/$per); //計算總頁數
    if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
        $page=1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
        if($page > $pages ){
            $page--;
        }
    }
    
    $start = ($page-1)*$per; //計算每一頁開始的資料位置
    $sql .= 'LIMIT '.$start.', '.$per;
    
    $rotate = "";
    if(isset($_GET["rotate"])){
        $sql = "SELECT * from (" . $sql . ") as a order by `帳號` " . $_GET["rotate"];
        if($_GET["rotate"] == "desc"){
            $rotate = "rotate";
        } 
    }

    $sel = mysqli_query($link, $sql);

    $output = '
    <table class="table table-striped w-100">
        <thead>
            <tr>
              <th>
                帳號
                <a href="" class="sort">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill '.$rotate.'" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                </a>
              </th>
              <th>姓名</th>
              <th>性別</th>
              <th>生日</th>
              <th>信箱</th>
              <th>備註</th>
              <th>功能</th>
            </tr>
        </thead>
        <tbody>
    ';
    if($data_nums > 0){
        foreach($sel as $row){
            $output .= '
            <tr>
                <td>' . $row["帳號"] . '</td>
                <td>' . $row["姓名"] . '</td>
            ';
            $sex = "";
            if($row["性別"] == '1'){
                $sex = "男";
            }else{
                $sex = "女";
            }
            $output .= '    
                <td>' . $sex . '</td>
            '; 
            $btd = date("Y年n月j日", strtotime($row["生日"]));

            $output .= '     
                <td>' . $btd . '</td>
                <td>' . $row["信箱"] . '</td>
                <td>' . $row["備註"] . '</td>
                <td>
                    <button type="button" name="edit" class="btn btn-primary edit" id="'.$row["帳號"].'">編輯</button>
                    <button type="button" name="delete" class="btn btn-danger delete" id="'.$row["帳號"].'">刪除</button>
                </td>
            </tr>
            ';
        }
    }else{
        $output .= '
        <tr>
	    	<td colspan="7" align="center">查無資料</td>
	    </tr>
        ';
    }
    $output .= '
        </tbody>
    </table>
    <div>
    ';
    
    $output .='共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    $output .='<br /><a href=?page=1>首頁</a> ';
    $output .='第 ';
        for( $i=1 ; $i<=$pages ; $i++ ) {
            if ( $page-3 < $i && $i < $page+3 ) {
                $output .= "<a href=?page=".$i.">".$i."</a> ";
            }
        } 
        $output .= " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";

    $output .= '</div>';
    echo $output;
