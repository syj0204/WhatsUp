<?php

function SQL_injection($String){
$String = str_replace("%", " ",$String);
$String = str_replace(";", " ",$String);
$String = str_replace("'", " ",$String);
//$String = str_replace("""", " ",$String);
$String = str_replace("--", " ",$String);
$String = str_replace("#", " ",$String);
$String = str_replace("(", " ",$String);
$String = str_replace(")", " ",$String);
$String = str_replace(">", " ",$String);
$String = str_replace("<", " ",$String);
$String = str_replace("=", " ",$String);
$String = str_replace("*/", " ",$String);
$String = str_replace("/*", " ",$String);
$String = str_replace("+", " ",$String);
$String = str_replace("union", "q-union",$String);
$String = str_replace("select", "q-select",$String);
$String = str_replace("insert", "q-insert",$String);
$String = str_replace("drop", "q-drop",$String);
$String = str_replace("update", "q-update",$String);
$String = str_replace("delete", "q-delete",$String);
$String = str_replace("and", "q-and",$String);
$String = str_replace("or", "q-or",$String);
$String = str_replace("if", "q-if",$String);
$String = str_replace("join", "q-join",$String);
$String = str_replace("subString", "q-subString",$String);
$String = str_replace("from", "q-from",$String);
$String = str_replace("where", "q-where",$String);
$String = str_replace("declare", "q-declare",$String);
$String = str_replace("openrowset", "q-openrowset",$String);
$String = str_replace("xp_", "q-xp_",$String);
$String = str_replace("shutdown", "q-shutdown",$String);
$String = str_replace("sysobjects", "q-sysobjects",$String);
$String = str_replace("syscolumns", "q-syscolumns",$String);



return $String;
}