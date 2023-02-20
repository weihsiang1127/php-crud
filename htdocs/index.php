<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>crud</title>

  <!--css-->
  <link rel='stylesheet' href='./css/bootstrap.min.css'/>
  <style>
    .rotate {
      -moz-transform:scaleY(-1);
      -webkit-transform:scaleY(-1);
      -o-transform:scaleY(-1);
      transform:scaleY(-1);
    }

    table thead {
        border-bottom: 2px solid #666;
    }

    .user_ins>div {
        padding-top: 5px;
        padding-bottom: 5px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row my-2">
      <div class="col-6 d-flex">
        <input type="text" id="user_number_search" name="user_number_search" value="" placeholder="輸入欲搜尋的帳號">　
        <button type="button" class="btn btn-secondary search_btn">搜尋</button>
      </div>
      <div class="text-end col-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#exampleModal">新增</button>
      </div>
		</div>

    <div class="text-center" id="user_data"></div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="post" id="user_form">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">帳號新增</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row text-center user_ins">
                <div class="col-2">帳號</div>
                <div class="col-10">
                  <input type="hidden" id="user_number_temp" name="user_number_temp" value="">
                  <input type="text" class="w-100" id="user_number" name="user_number" required/>
                </div>
                <div class="col-2">姓名</div>
                <div class="col-10">
                  <input type="text" class="w-100" id="user_name" name="user_name" required/>
                </div>
                <div class="col-2">性別</div>
                <div class="col-10 text-start">
                  <input type="radio" id="sex_m" name="user_sex" value="1" checked/>男　
                  <input type="radio" id="sex_f" name="user_sex" value="0"/>女
                </div>
                <div class="col-2">生日</div>
                <div class="col-10">
                  <input type="date" class="w-100" id="user_btd" name="user_btd" required/>
                </div>
                <div class="col-2">信箱</div>
                <div class="col-10">
                  <input type="email" class="w-100" id="user_email" name="user_email" required/>
                </div>
                <div class="col-2">備註</div>
                <div class="col-10">
                  <textarea class="w-100" id="user_remark" name="user_remark"></textarea>
                </div>
              </div>              
            </div>
            <div class="modal-footer">
              <input type="hidden" id="action" name="action" value="insert">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
              <input type="submit" class="btn btn-primary" id="modal_submit" name="modal_submit" value="確認"/>
            </div>
          </form>
        </div>
      </div>
    </div>
	
  </div>

  <!--js-->
  <script src='./js/jquery.min.js' ></script>
  <script src='./js/bootstrap.min.js'></script>
  <script>
    $(document).ready(function() {
      load_data();

      function load_data(search){
        if(search){
          $.ajax({
            url: "list.php",
            method: "POST",
            data:{id:search},
            success: function(data) {
              $('#user_data').html(data);
            }
          });
        }else{
          var url = new URL(location.href);
          var page = url.searchParams.get('page');
          
          var rotate = "asc";
          if($(".sort>svg").hasClass("rotate")){
            rotate = "desc";
          }
          if(page){
            $.ajax({
              url: "list.php",
              method: "GET",
              data:{page:page, rotate:rotate},
              success: function(data) {
                $('#user_data').html(data);
              }
            });
          }else{
            $.ajax({
              url: "list.php",
              method: "POST",
              data:{rotate:rotate},
              success: function(data) {
                $('#user_data').html(data);
              }
            });
          }
        }
        
      }

      function form_clear(){
        $("#user_number_temp").val("");
        $("#user_number").val("");
        $("#user_number").prop("disabled", false);
        $("#user_name").val("");
        $('input[name="user_sex"]')[0].checked = true;
        $("#user_btd").val("");
        $("#user_email").val("");
        $("#user_remark").val("");
        $("#action").val("insert");
        $("#exampleModalLabel").html("帳號新增");
      }

      $(document).on('click', '.search_btn', function(){
        var user_number_search = $("#user_number_search").val();
        if(user_number_search == ""){
          $("#user_number_search").focus();
        }else{
          load_data(user_number_search.toLowerCase());
        }
      })

      $(document).on('click', '.add', function(){
        form_clear();
      })

      $('#user_form').on('submit', function(event){
        var type ="";
        switch ($("#action").val()){
          case "insert":
            type = "新增";
            break;
          case "update_ok":
            type = "修改";
            break;  
        }

        if (confirm('確認要' + type + '嗎?')){
          if (confirm('點擊後立即' + type + ',請再次確認?')){
            var form_data = $(this).serialize();
            $.ajax({
              url: "action.php",
              method: "POST",
              data:form_data,
              success: function(data) {
                $("#exampleModal").modal('hide');
                load_data();
                form_clear();
              }
            });
          }
        }
        return false;
      })

      $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        var action = "update";
        $.ajax({
          url: "action.php",
          method: "POST",
          data:{id:id, action:action},
          dataType:"json",
          success: function(data) {
            $("#user_number_temp").val(id);
            $("#user_number").val(id);
            $("#user_number").prop("disabled", true);
            $("#user_name").val(data.user_name);
            if(data.user_sex == "1"){
              $('input[name="user_sex"]')[0].checked = true;
            }else{
              $('input[name="user_sex"]')[1].checked = true;
            }
            
            $("#user_btd").val(data.user_btd);
            $("#user_email").val(data.user_email);
            $("#user_remark").val(data.user_remark);
            $("#action").val("update_ok");
            $("#exampleModalLabel").html("資料修改");
            $("#exampleModal").modal('show');
          }
        });
      })

      $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        var action = "delete";
        if (confirm('確認要刪除嗎?')){
          if (confirm('點擊後立即刪除,請再次確認?')){
            $.ajax({
              url: "action.php",
              method: "POST",
              data:{id:id, action:action},
              success: function(data) {
                load_data();
              }
            });  
          }
        }
      })

      $(document).on('click', '.sort', function(){
        if($(".sort>svg").hasClass("rotate")){
          $(".sort>svg").removeClass("rotate");
        }else{
          $(".sort>svg").addClass("rotate");
        }
        load_data();
        return false;
      })

    })
  </script>
</body>

</html>