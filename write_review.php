<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>MYFLIX</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
function checkbox(num) {
   $('#checkbox'+num).click();
}

function check(wht, num, maxn) {
   for (var i = 1; i < maxn+1; i++) {
      $('#bt_'+wht+'_'+i).attr('class', 'checkButton');
   
   }
   $('#bt_'+wht+'_'+num).attr('class', 'checkButtonOn');
   $('#n'+wht).val(num);
}

function register() {
      if ($("input[name=title]").val() == "")
         alert("제목을 입력하세요");
      else if ($("#n1").val() == "")
         alert("스포일러 여부를 선택하세요");
      else if ($("#n2").val() == "")
         alert("공개 여부를 선택하세요");
      else if ($("textarea[name=analysis]").val() == "")
         alert("분석글 내용을 써주세요");
      else
         document.sendForm.submit();
}
</script>
<style>
   .checkButton {
      font-size: 12px;
      display: inline-block;
      background-color: rgba(226, 226, 226, 1);
      border:1px solid rgba(0, 0, 0, 1);
      padding: 5px 10px 5px 10px;
   }

   .checkButtonOn {
      font-size: 12px;
      padding: 5px 10px 5px 10px;
      display: inline-block;
      background-color: rgba(255, 127, 127, 1);
      border:1px solid rgba(0, 0, 0, 1);
   }
</style>
</head>

<body>

<!--분석글-->
<form name = "sendForm" method="POST">
<div id="analysis">
   <!--제목입력-->
   제목 : <input type="text" name="title" placeholder="제목을 입력하세요" size="200"><br><br>

   <!--스포일러선택-->
   <input type="hidden" value name="n1" id="n1">
   스포일러 <div class="checkButton" onclick="check('1', '1', 2)" id="bt_1_1">있음</div> 
             <div class="checkButton" onclick="check('1', '2', 2)" id="bt_1_2">없음</div><br><br>



   <textarea name="analysis" cols="100" rows="30"></textarea>
</div>
<br><br><br>
<!--등록버튼--!>
<div style="text-align:center">
   <input type="button" value="등록하기" onclick="register()">
</div>
</form>
</body>
</html>