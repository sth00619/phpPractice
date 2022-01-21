<?php
if(isset($_POST['db'])){
  if(!$_POST['writer']){
      echo"<p>이름을 입력하세요</p>";
      exit;
  }
  else{
  var_dump($_POST);
  }
  //$name=$_POST['writer']};
}

$titles=array('제목1','제목2','제목3','제목4','제목5');
$names=array('글쓴이1','글쓴이2','글쓴이3','글쓴이4','글쓴이5');


function cut($str, $len){

  if(strlen($str) > $len) $str=substr($str,0,$len)."...";

  else $str=$str;

  return $str;
}


$tr="";
for($i=0;$i<5;$i++){
  $n=$i+1;

  $names[$i]=cut($names[$i], 9);

  $tr=$tr."<tr>
        <td class='td1'>$n</td>
        <td class='td1'>$titles[$i]</td>
        <td class='td1'>$names[$i]</td>
      </tr>
  ";
}
echo"
<style>
.td1{
  width:100px;height:30px;border:solid 1px;
  }
</style>

<form name=form1 method='post' formenctype=\"multipart/form-data\" action='?'>
<p style='text-align:center;font-size:20px;'>글쓰기</p>
  글쓴이 :<input type=\"text\" name=\"writer\" value=\"\"><br>
  제목 :<input type=\"text\" name=\"subject\" value=\"\"><br>
  공지 :<input type=\"checkbox\" name=\"notice\" value=\"y\"checked><br>
  공개 :<input type=\"radio\" name=\"open\" value=\"\">   비공개 :<input type=\"radio\" name=\"open\" value=\"n\"><br>
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

<!--
<table style='width:500px:height:300px;'>
  <tr>
      <td>순번</td>
      <td>제목</td>
      <td>글쓴이</td>
      </tr>
      $tr
      </table>
-->
";

?>
