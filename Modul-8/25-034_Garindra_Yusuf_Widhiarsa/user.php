<?php
$cfg = ['title'=>'Data User','table'=>'user','pk'=>'id_user','fields'=>[
  'username'=>['Username','text'],'password'=>['Password','password'],'nama'=>['Nama','text'],
  'level'=>['Level','select',[1=>'Owner',2=>'Kasir']]]];
include '_crud.php';
