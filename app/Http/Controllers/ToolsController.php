<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ToolsController
{
    //生成订单编号
    public function getNo()
    {
        return 'LB_' . substr(time(), -10);
    }

    //生成验证码
    public function getCode($length = 4)
    {
        $code = substr(md5(time()), 0, $length);
        session(['email_code' => $code]);
        return $code;
    }

    //单文件上传
    public function fileUpdate(Request $request, $name = 'file')
    {
        $file = $request->file($name);
        if ($file->isValid()) {
            $ext = $file->getClientOriginalExtension(); // 扩展名
            if (!in_array($ext, ['pdf', 'doc', 'docx', 'txt', 'jpg', 'png'])) {
                return [false, 'Unsupported file suffix'];
            }

            // 上传文件
            $filename = date('YmdH_i_s') . '_' . uniqid() . '.' . $ext;
            $movePath = $file->move(storage_path('app\uploads'), $filename);

            $savePath = $movePath->getPath() . $filename;

            return [true, $savePath];
        } else {
            return [false, 'Did not pass the file detection'];
        }
    }
}
