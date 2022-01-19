<?php
//$data=array(0=>array('name'=>'홍길동','title'=>'홍길동 과제입니다.'));
$data=array(
        0=>array('0-0','0-1'),
        1=>array('1-0','1-1')
      );
$name=$data[1][1];

if(isset($_GET['name'])) $name=$_GET['name'];
else $name="몰라진짜로";

for($i=0;$i<10;$i++){
    echo"<br>$i";
}


$title="3교시";
echo"<table border = 1>
  <tr>
    <td>순번</td>
    <td>제목</td>
    <td>".$data[1][1]."</td>
  </tr>
  <tr>
    <td>1</td>
    <td>1교시</td>
    <td>홍길동</td>
  </tr>
  <tr>
    <td>2</td>
    <td>2교시</td>
    <td>$name</td>
  </tr>
  <tr>
    <td>3</td>
    <td>$title</td>
    <td>$name</td>
  </tr>
  </table>";
?>
