<?php
session_start();

	if (isset($_COOKIE['username']) ) {
	   setcookie('username','',time()-3600,'/','localhost');
	   	//根据传过来的值判断跳转
	   
        echo "<script>alert('已成功退出');
        location.href='/view/loor.html'</script>";	  
    }else {
        echo "<script>alert('请登录');
        location.href='/view/loor.html'</script>";
  }


