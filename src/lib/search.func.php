<?php


function splitKeyWords($delimiters,$strkeys){
	
	if ($strkeys) {
		$keys[]=$strkeys;
		$keywords=splitstring($delimiters,$keys);
	}
	
	return $keywords;
}

/**
 * 对 多键字 按照 多分隔符 进行拆分
 * @param array $delimiters
 * @param array $strs
 * @return array
 */
function splitstring($delimiters,$strs){
	foreach ($delimiters as $delimiter){
		foreach ($strs as $str)	{
			$values=explode($delimiter,$str);
			foreach ($values as $val){
				$val=trim($val);
				if($val=="" || $val==$delimiter)
					continue;
				$key[]=$val;
			}
		}
		$strs=$key;
		$key=null;
	}

	return $strs;
}

/**
 * 高亮显示字符串中的keywords
 * @param unknown $str_src
 * @param unknown $keyword
 * @return unknown|string
 */
function hightlightkeyword($str_src, $keyword) {
	$offset = 0;
	$starpos = 0;
	$newname = "";
	$backstr = "";
	$len = strlen ( $keyword );

	//若关键字不在字符串中，直接返回源字符串，不做任何处理
	if(stripos ( $str_src, $keyword, $offset )===false)
		return $str_src;

	while ( ! (($pos = stripos ( $str_src, $keyword, $offset )) === false) ) {
		$str = substr ( $str_src, $pos, $len );
		($pos - $starpos) == 0 ? $frontstr = "" : $frontstr = substr ( $str_src, $starpos, ($pos - $starpos) );
		$backstr = substr ( $str_src, $pos + $len );
		$starpos = $pos + $len;
		$hstr = "<font color='red'>" . $str . "</font>";
		$newname .= $frontstr . $hstr;

		$offset = ($pos + $len);
	}
	return $newname . $backstr;
}














