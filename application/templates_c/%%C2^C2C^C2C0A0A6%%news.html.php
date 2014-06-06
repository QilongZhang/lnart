<?php /* Smarty version 2.6.25, created on 2011-03-13 00:40:30
         compiled from upload/news.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>上传新闻</title>
</head>
<body>
<h1>上传新闻</h1>
<form name="news" method="POST" action="upload/news/add">
	<table>
		<tr>
			<td>标题:</td>
			<td><input type="text" name="title"/></td>
		</tr>
		<tr>
			<td>分类:</td>
			<td>
				<input type="radio" value="0" name="class"/>岭南新闻
				<input type="radio" value="1" name="class"/>学校公告
				<input type="radio" value="2" name="class"/>视频教学
				<input type="radio" value="3" name="class"/>学生活动
			</td>
		</tr>
		<tr>
			<td>内容:</td>
			<td><textarea name="content">请在此输入内容</textarea></td>
		</tr>
		<tr>
			<td><input type="reset" value="重置"/></td>
			<td><input type="submit" value="提交"/></td>
		</tr>
	</table>
</form>
</body>
</html>