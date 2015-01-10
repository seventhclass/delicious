<?php

define("DEVELOPMENT_MODE","dev");	//Development Mode
//define("DEVELOPMENT_MODE","rel");	//Release Mode

//define("DEVELOPMENT_MODE","c9");	//Development by c9 env
define("DB_HOST","127.0.0.1");

//define("DB_HOST", "localhost");

define("DB_USER", "lehu3000");
define("DB_PWD", "");
define("DB_DBNAME", "delicious");

/*
if(DEVELOPMENT_MODE=="dev"){	
	define("DB_USER", "root");
	define("DB_PWD", "root"); 
	define("DB_DBNAME", "7thclass_delicious");
}else{
	define("DB_USER", "adminjBgZCk8");
	define("DB_PWD", "xbdwsnmQVYi_");
	define("DB_DBNAME", "delicious");
}
*/
define("DB_CHARSET", "utf8");
