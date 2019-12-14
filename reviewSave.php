<?php
    $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");
 

    @session_start();

    $MOVIETITLE=$_POST['MOVIETITLE'];
    $TITLE=$_POST['TITLE'];
    $CONTENTS=$_POST['CONTENT'];
    //$SPOIL=$_POST['n1'];
    $WRITER=$_SESSION['NICKNAME'];
    $DATE= time();

    $ip = getenv("REMOTE_ADDR");

    echo $MOVIETITLE.$TITLE.$CONTENTS.$WRITER.$DATA;


    $img_dir = $_SERVER['DOCUMENT_ROOT']; //저장 디렉토리
$img_tmp = $_FILES['upfile']['tmp_name']; //임시 파일명
$img_type = $_FILES['upfile']['type']; //저장가능 이미지 타입
$img_name = $_FILES['upfile']['name']; //파일명(ex: xxxx.jpg)
 
$filename = explode(".",$img_name); //파일명 및 확장자를 분리한 배열
$extension = strtoupper($filename[sizeof($filename)-1]); //확장자 추출
 
// 기존의 파일과 이름이 같을 경우 filename 을 2_filename 과 같이 rename
$now_count = 0;
$echo_now_count = "";
$original_file_name = $img_name;
 
while( 1 )
{
    $up_filename = $echo_now_count.$original_file_name; // 파일이름 변경
    if(!file_exists("$img_dir/$up_filename")) break;
      
    if($now_count) $now_count++;
        else $now_count=2;
    $echo_now_count = $now_count."_";
}
 
$save_name = $img_dir."/".$up_filename; //copy시 전체경로 및 파일명
 
if(copy($img_tmp, $save_name)) { //파일 업로드
    unlink($img_tmp); //임시파일삭제
}
else {
    unlink($img_tmp);
    echo("
            <script>
            window.alert('파일 저장시 오류가 발생하였습니다.\\n감사합니다.');
            history.go(-1);
            </script>
            ");
    exit;
}
################파일 업로드를 위해 추가된 부분 : 끝 #########################

$sql = "INSERT INTO Review (TITLE, WRITER, CONTENT, file_name1, s_file_name1, MOVIETITLE, IP) VALUES('{$TITLE}', '{$WRITER}', '{$CONTENTS}','{$save_name}', '{$up_filename}','{$MOVIETITLE}','{$ip}');";

$result = mysqli_query($connect,$sql);


    if(!$result){

?>
		<script>
                        alert("오류가 발생하였습니다.");
                        location.replace("./review_list.php");
                </script>

<?php
        
    }else
?>
		<script>
                        alert("게시글 작성이 완료되었습니다.");
                        location.replace("./review_list.php");
                </script>

