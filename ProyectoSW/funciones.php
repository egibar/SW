<?php
/**
 * Created by PhpStorm.
 * User: egibar
 * Date: 23/09/2016
 * Time: 12:06
 */
function getBD(){

  //  return (mysqli_connect("localhost","root","","Quiz"));
    return mysqli_connect("mysql.hostinger.es","u566940088_asier","egibar","u566940088_quiz");
}