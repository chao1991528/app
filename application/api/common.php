<?php
/**
* 通用化API接口数据输出
* @param int $status 业务状态码
* @param string $message 信息提示
* @param [] $data 数据
* @param int $http_code http状态码
* @return json
*/
function responseData($status, $message, $data = [], $http_code = 200){
	$newData = [
		'status' => $status,
		'message' => $message,
		'data' => $data
	];
	return json($newData, $http_code);
}
