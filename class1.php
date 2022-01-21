<?php
//$data=array(0=>array('name'=>'홍길동','title'=>'홍길동 과제입니다.'));

$names=array('손님1','손님2','손님3');
$titles=array('제목','제목2','제목345');

file_put_contents("my_file.csv", "1,2,3,4");

function cut($str, $len){

  if(strlen($str) > $len) $str=substr($str,0,$len)."...";

  else $str=$str;

  return $str;
}


$title="3교시";
$tr="";
for($i=0;$i<3;$i++){
    $n=$i+1;

    $titles[$i]=cut($titles[$i], 6);

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
    width:100px;height:30px;border:solid 1px #ff0000;
   }
</style>
<table style='width:500px:height:300px;'>
  <tr>
    <td class='td1'>순번</td>
    <td class='td1'>제목</td>
    <td class='td1'>글쓴이</td>
    </tr>
    $tr
    </table>";
