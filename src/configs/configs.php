<?php

define("DEVELOPMENT_MODE","dev");	//Development Mode
//define("DEVELOPMENT_MODE","rel");	//Release Mode

define("DB_HOST", "127.0.0.1");

if(DEVELOPMENT_MODE=="dev"){	
	define("DB_USER", "root");
	define("DB_PWD", "root"); 
	define("DB_DBNAME", "delicious");
}else{
	define("DB_USER", "adminjBgZCk8");
	define("DB_PWD", "xbdwsnmQVYi_");
	define("DB_DBNAME", "delicious");
}

define("DB_CHARSET", "utf8");
