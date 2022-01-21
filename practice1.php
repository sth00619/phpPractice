<?php

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
<table>
  <tr>
      <td>순번</td>
      <td>제목</td>
      <td>글쓴이</td>
      </tr>
      $tr
      </table>";
?>
