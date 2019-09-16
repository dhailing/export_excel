<?php
/**
 * Created by Dh106
 * User: Dh106
 * Email: 206989662@qq.com
 * Date: 2019/9/16
 * Time: 23:56
 */

namespace ninenight\export\library;


interface exportLibrary
{
    public static function export(array $data = [], string $filetype = '', ...$extend);
}
