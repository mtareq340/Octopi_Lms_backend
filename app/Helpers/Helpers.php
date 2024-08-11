<?php
if (!function_exists('responseJson')) {
    function responseJson($status, $message, $data=null) {
        return [
            "status" => $status,
            "message" => $message,
            "data" => $data
        ];
    }
}
if (!function_exists('returnPageNum')) {

    function getOffsetData($pageNum, $perPage) {
        $offset = ($pageNum - 1) * $perPage;
        return $offset;
    }
}
?>
