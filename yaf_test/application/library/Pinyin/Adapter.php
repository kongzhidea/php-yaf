<?php
/**
 * 汉字转拼音
 * @author  luq
 * @date    2014-11-12
*/

require "Pinyin.php";
use \Overtrue\Pinyin\Pinyin;

class Pinyin_Adapter
{
 
    protected $settings = array(
        'delimiter'    => ' ',//分隔符
        'traditional'  => false,
        'accent'       => false,
        'letter'       => false,
        'only_chinese' => false,
    );

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
    }
 
    /**
    * chinese to pinyin
    *
    * @param string $string  source string.
    * @param array  $settings settings.
    *
    * @return string
    */
    public function pinyin($string){
        $result = "";
        $result = Pinyin::pinyin($string, $this->settings);

        return $result;
    }

    /**
     * get first letters of chars
     *
     * @param string $string    source string.
     * @param string $delimiter delimiter for letters.
     *
     * @return string
     */
    public function letter($string, $delimiter = "")
    {
        $result = "";
        $result = Pinyin::letter($string, $delimiter);

        return $result;
    }

}

?>
