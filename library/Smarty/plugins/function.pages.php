<?php
/**
 * 片段标签
 * $params['id']          片段ID
 */
function smarty_function_pages($params, &$smarty){
	empty($params['href'])?$href='/index':$href=$params['href'];
	if(empty($params['pages']))
	{
		return "";
	}
	$pages = $params['pages'];
	
	$page = $pages["page"];
	$total = $pages["total"];
	$pagesize = $pages["pagesize"];
	$start = ($page - 1) * $pagesize + 1;
	$end = $page * $pagesize;
	if($end > $total){
			$end = $total;
	}
	$totalpage = ceil($pages['total'] / $pages['pagesize']);
	
	$smarty->assign('href', $href);
	$smarty->assign('target', $target);
	$smarty->assign('totalpage', $totalpage);
	$smarty->assign('total', $total);
	$smarty->assign('page', $page);
	$smarty->assign('pagesize', $pagesize);
	$smarty->assign("start", $start);
	$smarty->assign("end", $end);
	$result = $smarty->display($smarty->template_dir.'/pages.html');
	return $result;
}