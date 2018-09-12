<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/9 0009
 * Time: 下午 8:53
 */
header("content-type:text/html;charset:utf-8");
$dns="mysql:host=127.0.0.1;port=3306;dbname=words;charset=utf8";
$name="root";
$passwd="root";
$words=(string)$_GET['words'];
try {
    $pdo = new PDO($dns, $name, $passwd);

    if(!$pdo){
        throw new PDOException("数据库连接失败!请重试！");
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e){

    echo $e->getMessage();
    exit();

}

$sql="select * from words where Word = :words";

try {

    $pdostatement = $pdo->prepare($sql);

    if(!$pdostatement){
        throw new PDOException("查询失败！请重试！");
    }

    $pdostatement->bindParam(':words', $words);

    $pdostatement->execute();

    $rel = $pdostatement->fetch(PDO::FETCH_ASSOC);

    if($rel===false){
        throw new PDOException("查询结果为空！");
    }

    echo
    $rel["meaning"]."~".$rel["GQS"]."~".$rel["GQFC"]."~".$rel["XZFC"]."~".$rel["FS"]."~".$rel["lx"];

}catch (PDOException $exception){

    echo $exception->getMessage();

    exit();

}

