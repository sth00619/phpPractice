<?php

$mysqli = new mysqli("localhost","root","songan1002","my_db");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
$db=1;

if(isset($_GET['dnum'])){
  $sql='delete from bbs where num=$_GET[dnum]';
  $re=mysqli_query($mysqli, $sql);
}

if(isset($_POST['db'])){
  if(!$_POST['writer']){
      echo"<p>이름을 입력하세요</p>";
      exit;
  }
if(isset($_POST['db'])){
  if(!$_POST['subject']){
        echo"<p>제목을 입력하세요</p>";
        exit;
      }
  }
if(isset($_POST['num'])){//수정하기
    $sql="update bbs set writer='$_POST[writer]',
                         subject='$_POST[subject]',
                         content='$_POST[content]'
          where num=$_POST[num]";
    mysqli_query($mysqli, $sql);
  }
  else{//새 글 쓰기

    //var_dump($_POST);
    $date=date('Y-m-d H:i:s');
    $sql="insert into bbs (writer, subject, content, date) values ('$_POST[writer]','$_POST[subject]','$_POST[content]','$date')";
    mysqli_query($mysqli, $sql);
  }
  //$name=$_POST['writer'];
}

$titles=array('제목1','제목2','제목3','제목4','제목5');
$names=array('작성자1','작성자2','작성자3','작성자4','작성자5');


function cut($str, $len){

  if(strlen($str) > $len) $str=substr($str,0,$len)."...";

  else $str=$str;

  return $str;
 }


if(isset($_GET))

if(isset($_GET['sort'])) $sort_query="order by $_GET[sort]";
else $sort_query="order by date desc";

$sql="select * from bbs where num>0 $sort_query limit 0, 10";

$data=mysqli_query($mysqli, $sql);
// mysql_query(query, connection);
// mysqli_query(connection, query);
if(!$data)echo"존재하지 않는 값입니다. $sql";
$tr="";
$n=0;
while($row=mysqli_fetch_array($data)){
  $n++;
  $row['date']=substr($row['date'],0,10);
  $tr.="<tr>
    <td class='td1'>$n</td>
    <td class='td1'>$row[writer]</td>
    <td class='td1'>$row[subject]</td>
    <td class='td1'>$row[content]</td>
    <td class='td1'>$row[date]</td>
    <td class='td1'><a href='./class3.php?num=$row[num]'>[수정]</a> <a href='./class3.php?dnum=$row[num]'>[삭제]</a></td>

    </tr>";

}
$sql="select * from bbs where num='$_GET[num]'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_assoc($result);


//오류 방지 확인용으로 query 부분에 직접 입력하지 않음


//hidden으로 수정되는 과정을 통제하기
echo"

<!-- form name=form1 method='post' formenctype=\"multipart/form-data\" action='?'>
  <input type='hidden' name='num' value='$_GET[num]'>
  <input type='hidden' name='db' value='$db'>
<p style='text-align:center;font-size:30px;'><공지사항></p>
  작성자 :<input type=\"text\" name=\"writer\" value=\"$row[writer]\"><br>
  제목 :<input type=\"text\" name=\"subject\" value=\"$row[subject]\"><br>
  공지 :<input type=\"checkbox\" name=\"notice\" value=\"y\"checked><br>
  공개 :<input type=\"radio\" name=\"open\" value=\"\">
  비공개 :<input type=\"radio\" name=\"open\" value=\"n\"><br>
  학년 :<select name=\"grade\">
          <option value=\"1\" selected>1학년</option>
          <option value=\"2\">2학년</option>
          <option value=\"3\">3학년</option>
        </select><br><br>
  내용:<textarea name='content' style='width:500px; height:300px;'>
  </textarea><br><br>
  첨부 :<input type='file' name='my_file'><br><br><br>
  <input type='hidden' name='db' value='$db'>
  <input type=submit value='저장하기'>
</form -->


<script>
  document.form1.writer.focus();
</script>

<style>
 .td1{
    width:150px;height:100px;border:solid 1px #ff0000;
  }
</style>
<table class='all-table' style='width:500px:height:300px;'>
  <tr>
      <td><a href='?sort=num'>순번</a></td>
      <td><a href='?sort=writer'>작성자</a></td>
      <td><a href='?sort=subject'>제목</a></td>
      <td>내용</td>
      <td>시간</td>
      <td>수정</td>
      </tr>
      $tr
      </table>

";
//게시판을 구분하기 위해서 db 값을 미리 설정($db=1)
//동일한 db를 사용할 때는 게시판을 구별하기 위한 장치가 필요하다.(id값으로 구별, 그러나 보안에 취약)
