<?php

$mysqli = new mysqli("localhost","root","songan1002","my_db");
//어디에서 값을 참조할 것인지

if ($mysqli -> connect_errno){
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error
  exit();
}
//Check connection
//만약 연결한 mysqli가 연결 오류가 발생한 경우

if(isset($_POST['db'])){
  if(!$_POST['writer']){
    echo"<p>이름을 입력하세요</p>";
    exit;
  }
//POST변수의 db에서 만약 writer변수의 값이 없는 경우
  else{
    //var_dump($_POST);
    //var_dump:값을 출력하는 함수 중에 하나
    $date=date('Y-m-d H:i:s');
    //우리가 만들 bbs라는 표에 넣을 항목에 대한 설정을 하는 부분
    //date는 날짜와 관련된 변수로서 'Y-m-d H:i:s'라고 설정 시 자동으로 데이터를 입력하는 시간을 입력해줌
    $sql="insert into bbs (writer, subject, content, date) values ('$_POST[writer]','$_POST[subject]','$_POST[content]', '$date')";
    //bbs라는 표에 넣을 키 값의 이름과 각 키에 어떤 종류의 데이터 값을 넣을 것인지 설정
    mysqli_query($mysqli, $sql);
    //query는 데이터베이스에 정보를 요청하는 것이다.
    //웹 서버에 특정한 정보를 요구하는 웹 클라이언트에 요청(주로 문자열을 기반으로) 의한 처리
  }
  //$name=$_POST['writer']
}
//db의 항목 중 writer가 있는 경우 나머지 값들은 어떻게 작성되는지

$titles=array('제목1','제목2','제목3','제목4','제목5');
$names=array('글쓴이1','글쓴이2','글쓴이3','글쓴이4','글쓴이5');

function cut($str, $len){
  //첫 번째 변수: 어떤 값을 대상으로 하는지
  //두 번째 변수: 자를 길이를 설정
  if(strlen($str) > $len) $str=substr($str,0,$len)."...";
  /*
  strlen은 입력한 string의 길이를 측정하는 내장 함수
  만약 입력한 string의 길이가 설정한 길이보다 길다면 문자열의 일부분을 추출하는 함수인 substr을 이용
  substr($str,0,$len)
  $str:추출의 대상이 되는 문자열
  0:추출을 시작하는 위치(인덱스 값과 동일)
  $len:추출할 문자의 개수, 값이 없으면 문자열 끝까지 추출.
       음수일 때는 위치를 뜻하고, 그 위치 앞까지의 문자를 추출
  ex) substr('abcdefg', -3, 2);  => ef
      substr('abcdefg', -3, -1); => ef

  */
  else $str=$str;
  //정해둔 길이보다 길지 않은 경우 그대로 출력
  return $str;
  //입력한 string을 반환(출력)
}

$sql="select * from bbs where num>0 order by date desc limit 0,10";
//select * 은 모두 선택하겠다는 뜻
//입력받은 데이터 값을 내림차순(desc)으로 표시
$data=mysqli_query($mysqli, $sql);
// mysql_query(query, connection);
// mysqli_query(connection, query);
//$mysqli은 가장 윗 줄에 선언되어있는데, 그 db와 연결하여 bbs에서 값을 불러오는 sql을 저장
//mysql_query 함수는 mysqli_connect를 통해 연결된 객체를 이용하여 MySQL query를 실행시키는 함수
//mysqli_query([연결 객체],[쿼리]);
if(!$data)echo"값이 없습니다. $sql";
$tr="";
//tr:table row
$n=0;
while($row=mysqli_fetch_array($data)){
  /*
  mysqli_fetch_array 함수는 mysqli_query를 통해 얻은 result set에서 record를 하나씩 리턴해주는 함수
  한 개씩 리턴해주는 것은 mysqli_fetch_row나 mysqli_fecth_assoc과 동일하지만 배열의 형태가 다르다.
  mysqli_fecth_array는 순번을 키로 하는 일반 배열과 column명을 키로 하는 연관 배열 둘 모두 값으로 갖는 배열을 리턴
  mysqli_fecth__row는 일반 배열, mysqli_fecth_assoc는 연관 배열을 리턴
  */
  $n++;
  $row['date']=substr($row['date'],0,10);
  /*$date=date('Y-m-d H:i:s');라고 할 경우 초 단위까지 표시가 되는데
  미리 설정해두었던 cut 함수의 원리와 비슷하게 한 줄씩 들어가는 $row['date']의 값을 인덱스 0부터 시작하여 10번째까지 표시하고 짜른다
  */
  $tr.="<tr>
    <td>$n</td>
    <td>$row[writer]</td>
    <td>$row[subject]</td>
    <td>$row[content]</td>
    <td>$row[date]</td>
    </tr>";
    //td:table data
    //표에 순서대로 나타낼 값
}



echo"

<form name=form1 method='post' formenctype=\"multipart/form-data\" action='?'>
<p style='text-align:center;font-size:20px;'>글쓰기</p>
  글쓴이 :<input type=\"text\" name=\"writer\" value=\"\"><br>
  제목 :<input type=\"text\" name=\"subject\" value=\"\"><br>
  공지 :<input type=\"checkbox\" name=\"notice\" value=\"y\"checked><br>
  공개 :<input type=\"radio\" name=\"open\" value=\"\">
  비공개 :<input type=\"radio\" name=\"open\" value=\"n\"><br>
  학년 :<select name=\"grade\">
          <option value=\"1\">1학년</option>
          <option value=\"2\" selected>2학년</option>
          <option value=\"3\">3학년</option>
        </select><br><br>
  내용 :<textarea name='content' style='width:500px; height:300px;'>
  </textarea><br><br>
  첨부 :<input type='file' name='my_file'><br><br><br>
  <input type='hidden' name='db' value='$names[0]'>
  <input type=submit value='저장하기'>
</form>

<script>
  document.form1.writer.focus();
</script>


<table style='width:500px:height:300px;'>
  <tr>
      <td>순번</td>
      <td>글쓴이</td>
      <td>제목</td>
      </tr>
      $tr
      </table>

";
/*
-button tag의 formenctype 속성은 form data가 서버로 제출될 때 해당 데이터가 인코딩되는 방식을 명시함
button 요소의 type 속성 값이 'submit'인 경우에만 사용할 수 있으며, <form> 요소의 enctype 속성값을 재정의함
-속성값:multipart/form-data인 경우 모든 문자를 인코딩하지 않음을 명시함, <form>요소가 파일이나 이미지를 서버로 전송할 때 주로 사용
()이 부분은 style tag라기보다는 내용 및 학년, 공개 여부 등에서 대한 기능들을 구현하는 부분임.)
-input type=hidden 의 개념에 대해서는 추가적으로 공부
-focus 기능은 웹 페이지 진입 시 focus가 해당 항목에 자동적으로 focus가 맞춰지도록 함.
-<table style>부분부터는 사용자가 정보를 입력하고 DB에 저장한 후, 이를 페이지 화면에 나타낼 때, 어떤 형식을 따르는지에 대한 설명임
<tr> tag로 묶여있고 줄마다 <tr> tag로 표시되어 있는데, 테이블 안에서 어떤 항목명을 가지고 어떤 데이터가 한 줄씩 출력되는지에 대한 설명
마지막 부분에 $tr 부분을 echo(출력)한다는 것이 핵심
참고로 $tr은 우리가 앞서
$tr.="<tr>
    <td>$n</td>
    <td>$row[writer]</td>
    <td>$row[subject]</td>
    <td>$row[content]</td>
    <td>$row[date]</td>
    </tr>" 라고 선언해두었던 부분으로
$sql의 형식에 맞추어 유저가 입력한 데이터를 DB(mysqli)를 통해서 받고 데이터가 잘 입력되었는지를 화면에 출력해주는 부분이다.

*/
