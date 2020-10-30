<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //上传图片
        'api/system/imgupload/',

        //上传文件
        'api/system/fileupload/',

        //上传项目文件
        'api/project/files/upload/',

        //上传聊天文件
        'api/chat/files/upload/',

        //修改项目任务
        'api/project/task/edit/',

        //汇报提交
        'api/report/template/',

        //保存文档
        'api/docs/section/save/',
    ];
}
