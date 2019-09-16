<?php
/**
 * Created by Dh106
 * User: Dh106
 * Email: 206989662@qq.com
 * Date: 2019/9/17
 * Time: 0:01
 */

namespace ninenight\export\logic;


use ninenight\Export\library\exportLibrary;

class phpxlsxwriterExport implements exportLibrary
{
    public static function export(array $data = [], string $filetype = '', ...$extend)
    {
        // TODO: Implement export() method.
        $title = $data['title'];
        $body = $data['body'];

        //设置 header，用于浏览器下载
        header('Content-disposition: attachment; filename="'.$filename.'"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $writer = new XLSXWriter();
        $fields = [];
        $datalen = 0;
        foreach ($export_date as $key  => $value) {
            $k=$key+1;
            if(is_array($value) && $k == 1) {
                foreach ($value as $ik=>$iv) {
                    $fields[] = $ik;
                }
                $datalen = count($value);
            }

            if($fields) {
                foreach ($fields as $fieditem) {
                    $data_array[$k][] = $export_date[$key][$fieditem];
                    //对每列指定数据类型，对应单元格的数据类型
                    $col_style[] = is_float($export_date[$key][$fieditem]) ? 'price' : 'string';
                }
            }

        }

        //工作簿名称
        $sheet1 = 'sheet1';
        $widths = [];

        for ($i=0;$i<$datalen;$i++) {
            $widths[$i] = 20;
        }
        //设置列格式，suppress_row: 去掉会多出一行数据；widths: 指定每列宽度
        $writer->writeSheetHeader($sheet1, $col_style, ['suppress_row'=>true,'widths'=> $widths] );
        //写入第二行的数据，顺便指定样式
        $writer->writeSheetRow($sheet1, [$filename],
            ['height'=>28,'font-size'=>16,'font-style'=>'bold','halign'=>'center','valign'=>'center']);

        /*设置标题头，指定样式*/
        $styles1 = array( 'font'=>'微软雅黑','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee',
            'halign'=>'center', 'border'=>'left,right,top,bottom');
        $writer->writeSheetRow($sheet1, $title_list, $styles1);
        // 最后是数据，foreach写入
        foreach ($data_array as $value) {
            foreach ($value as $item) { $temp[] = $item;}
            $rows[] = $temp;
            unset($temp);
        }

        $styles2 = ['height'=>16];

        foreach($rows as $row){
            $writer->writeSheetRow($sheet1, $row,$styles2);
        }

        //合并单元格，第一行的大标题需要合并单元格
        $writer->markMergedCell($sheet1, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = $datalen);
        //输出文档
        $writer->writeToStdOut();
        exit(0);
    }
}
