<?php


namespace ninenight\Export;


use ninenight\export\logic\phpbrowserExport;
use ninenight\export\logic\phpspreadsheetExport;
use ninenight\export\logic\phpxlsxwriterExport;

class exportFactory
{
    public static function export($type, $data, $filetype, ...$extend)
    {
        switch ($type) {
            case 1:
                return phpxlsxwriterExport::export($data, $filetype, $extend);
                break;
            case 2:
                return phpspreadsheetExport::export($data, $filetype, $extend);
                break;
            case 3:
                return phpbrowserExport::export($data, $filetype, $extend);
                break;
            default:
                break;
        }

        return false;
    }
}
