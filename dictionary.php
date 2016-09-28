<?php

class dictionary{

    public $api;

    public $key;

    function __construct($w)
    {
        $this->key = 'E0F0D336AF47D3797C68372A869BDBC5';
        $this->api = 'http://dict-co.iciba.com/api/dictionary.php?';
        return $this->translate($w);
    }

    public function translate($w)
    {
        $params = 'key='.$this->key.'&w='.$w.'&type=json';
        $url = $this->api.$params;
        $response = $this->getResponse($url);
        $result = $this->show($response);
        return $result;
        die(print_r($response));
    }

    private function getResponse($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);            //设置访问的url地址
        //curl_setopt($ch,CURLOPT_HEADER,1);            //是否显示头部信息
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);           //设置超时
        //curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);   //用户访问代理 User-Agent
        //curl_setopt($ch, CURLOPT_REFERER,_REFERER_);        //设置 referer
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);      //跟踪301
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    private function show($data)
    {
        //todo 格式化数据输出
        $data = json_decode($data, true);
        return $data['0']['parts']['0']['means'];

    }

}

unset($argv[0]);
if (!isset($argv[1]))  die("请输入要查询的单词");
$world = join(" ",$argv);

new dictionary($world);


