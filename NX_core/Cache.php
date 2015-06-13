<?php

class CSSCache {

    private $filenames = array();
    private $cwd;

    public function __construct() {
        
    }

    public function start($i_filename_arr) {
        if (!is_array($i_filename_arr))
            $i_filename_arr = array($i_filename_arr);

        $this->filenames = $i_filename_arr;
        $this->cwd = getcwd() . DIRECTORY_SEPARATOR;

        if ($this->style_changed())
            $expire = -72000;
        else
            $expire = 3200;

        header('Content-Type: text/css; charset: UTF-8');
        header('Cache-Control: must-revalidate');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expire) . ' GMT');
    }

    public function dump_style() {
        ob_start('ob_gzhandler');

        foreach ($this->filenames as $filename)
            $this->dump_cache_contents($filename);

        ob_end_flush();
    }

    private function get_cache_name($filename, $wildcard = FALSE) {
        $stat = stat($filename);
        return $this->cwd . '.' . $filename . '.' .
                ($wildcard ? '*' : ($stat['size'] . '-' . $stat['mtime'])) . '.cache';
    }

    private function style_changed() {
        foreach ($this->filenames as $filename)
            if (!is_file($this->get_cache_name($filename)))
                return TRUE;
        return FALSE;
    }

    private function compress($buffer) {
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  '), '', $buffer);
        $buffer = str_replace('{ ', '{', $buffer);
        $buffer = str_replace(' }', '}', $buffer);
        $buffer = str_replace('; ', ';', $buffer);
        $buffer = str_replace(', ', ',', $buffer);
        $buffer = str_replace(' {', '{', $buffer);
        $buffer = str_replace('} ', '}', $buffer);
        $buffer = str_replace(': ', ':', $buffer);
        $buffer = str_replace(' ,', ',', $buffer);
        $buffer = str_replace(' ;', ';', $buffer);
        return $buffer;
    }

    private function dump_cache_contents($filename) {
        $current_cache = $this->get_cache_name($filename);

        // the cache exists - just dump it
        if (is_file($current_cache)) {
            include($current_cache);
            return;
        }

        // remove any old, lingering caches for this file
        if ($dead_files = glob($this->get_cache_name($filename, TRUE), GLOB_NOESCAPE))
            foreach ($dead_files as $dead_file)
                unlink($dead_file);

        $compressed = $this->compress(file_get_contents($filename));
        file_put_contents($current_cache, $compressed);

        echo $compressed;
    }

}

class PHPCache {

    //-- Tên biến mặc định khi tạo dữ liệu PSON
    //
	var $strDataName = 'strPsonData';
    //-- Ký hiệu để xuống hàng
    //-- Thiết lập bằng rỗng nếu muốn tiết kiệm bộ nhớ, nhưng sẽ khó đọc...
    //
	var $chrBreak = "\n";
    //-- Ký hiệu để đẩy tab
    //-- Thiết lập bằng rỗng nếu muốn tiết kiệm bộ nhớ, nhưng sẽ khó đọc...
    //
	var $chrTab = "\t";
    var $story = false;

    //-- Construction, truyền biến để thay đổi tên biến mặc định của dữ liệu PSON nếu thích
    //-- Gọi khởi tạo theo dạng: $P = new PSON('my_pson_data');
    //
	function PSON($strVar = '') {
        if ($strVar)
            $this->strDataName = $strVar;
    }

    function set_story() {

        $this->story = true;
    }

    function encode_pgc($strText) {
        if (get_magic_quotes_runtime() || get_magic_quotes_gpc()) {
            $strText = stripcslashes($strText);
        }
        //return $strText;        
        if ($this->story) {
            return str_replace(array("'", '\\'), array('&#39;', '&#92;'), $strText);
        }
        return str_replace(array('"', "'", '\\'), array('&quot;', '&#39;', '&#92;'), $strText);
    }

    //-- Chuyển biến dạng array thành một chuỗi có khai báo giá trị đúng như biến mảng
    //-- Ví dụ: $a = array(1, 2, 3); => $data = "array(1, 2, 3);";
    //
function _pson_arr2str($arrVar, $intLevel = 0) {
        if (!is_array($arrVar))
            return false;

        $strTab = str_repeat($this->chrTab, $intLevel);

        $strHtml = 'array' . $this->chrBreak . $strTab . '(' . $this->chrBreak;

        foreach ($arrVar as $strKey => $mixVal) {


            if (is_array($mixVal)) {
                $strHtml .= $strTab . $this->chrTab . (is_int($strKey) ? '\'' . $strKey . '\' => ' : '\'' . $this->encode_pgc($strKey) . '\' => ') . $this->_pson_arr2str($mixVal, ++$intLevel);
                --$intLevel;
            } else {
                if (!is_int($strKey)) {
                    $strHtml .= $strTab . $this->chrTab . '\'' . $this->encode_pgc($strKey) . '\' => \'' . $this->encode_pgc($mixVal) . '\',' . $this->chrBreak;
                } else {

                    $strHtml .= $strTab . $this->chrTab . '\'' . $strKey . '\' => \'' . $this->encode_pgc($mixVal) . '\',' . $this->chrBreak;
                }
            }
        }

        $strHtml .= $strTab . ')';

        if ($intLevel) {
            $strHtml .= ',' . $this->chrBreak;
        } else {
            $strHtml = '$' . $this->strDataName . ' = ' . $strHtml . ';';
        }

        return $strHtml;
    }

    function arr2str($arrVar) {
        return $this->_pson_arr2str($arrVar);
    }

    //-- Đọc file dữ liệu và trả về biến mảng
    //
	function pson_load($strFileName) {
        if (file_exists($strFileName))
            include $strFileName;
        else
            return false;

        $strValName = $this->strDataName;
        $arrData = $$strValName;

        return $arrData;
    }

    function pson_save($arrVal, $strFileName) {
        if ($f = @fopen($strFileName, 'wb')) {
            if (@fwrite($f, '<?php' . "\n" . $this->_pson_arr2str($arrVal) . "\n" . '$time=' . time() . ';?>')) {
                if (@fclose($f)) {
                    return true;
                }
            }
        }

        return false;
    }

    function get_data($file_name) {
        if (!IS_CACHE) {
            return false;
        }
        $strPsonData = '';
        $time = 0;
        @include $file_name;
        if ($time + TIME_CACHE_DB < time()) {
            return false;
        }

        return $strPsonData;
    }

}

class Cache {

    public function __construct() {
        $this->php_cache = &new PHPCache();
        $this->css_cache = &new CSSCache();
    }

}
