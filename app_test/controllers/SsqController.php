<?php
namespace test\controllers;

use Yii;
use yii\web\Controller;

/**
 * 中华人民共和国国家统计局抓取省市区社区
 *
 * Class SsqController
 * @package test\controllers
 */
class SsqController extends Controller
{
    public $base_url = 'http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm';
    public $version_year = 2016;

    //        不使用布局
    public $layout = false;

    /**
     * 省
     */
    public function actionProvince()
    {
        //http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2016/index.html
        $url_province = $this->base_url.'/'.$this->version_year.'/index.html';
        $html_province = file_get_contents($url_province);
        $html_province = iconv("gb2312", "utf-8", $html_province);
//        echo $html_province;

        //{{匹配标题
        $pattern_title = "/<strong>(.+)<\/strong>/";
        preg_match($pattern_title, $html_province, $match);

        $title = $match[0];
//        var_dump($title);
        //}}

        //{{匹配省
        $pattern_privince = "/<td><a href='(\d+).html'>([\\x{4e00}-\\x{9fa5}]+)<br\/><\/a><\/td>/u";
        preg_match_all($pattern_privince, $html_province, $match);
//        var_dump($match);
        $province_page_id = $match[1];
        $province_name = $match[2];
//        var_dump($province_page_id, $province_name);die;
        $provice_list = [];
        $count = count($province_page_id);
        for ($i = 0; $i < $count; $i++){
            $provice_list[$province_page_id[$i]]['page'] = $province_page_id[$i];
            $provice_list[$province_page_id[$i]]['code'] = $province_page_id[$i];
            $provice_list[$province_page_id[$i]]['name'] = $province_name[$i];
            $provice_list[$province_page_id[$i]]['path'][] = $province_page_id[$i];

            $provice_list[$province_page_id[$i]]['level'] = 1;
        }
        var_dump($provice_list);
        //}}

        foreach ($provice_list as $key=>$val){
//            $city_data = $this->getCity($val);
        }
    }

    public function actionCity($province = null)
    {
        $province = [
            'page' => 44,
            'code' => 44,
            'name' => '广东省',
            'path' => [
                '44'
            ],
        ];

        //http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2016/44.html
        $url_city = $this->base_url.'/'.$this->version_year.'/'.$province['path'][0].'.html';
        $html_city = file_get_contents($url_city);
        $html_city = iconv("gb2312", "utf-8", $html_city);

//        echo $html_city;

        //{{匹配省
        $pattern_city = "/<tr class='citytr'><td><a href='{$province['path'][0]}\/(\d+).html'>(\d+)<\/a><\/td><td><a href='{$province['path'][0]}\/\d+.html'>([\\x{4e00}-\\x{9fa5}]+)<\/a><\/td><\/tr>/u";
        preg_match_all($pattern_city, $html_city, $match);
//        var_dump($match);
        $city_page_id = $match[1];
        $city_code = $match[2];
        $city_name = $match[3];

        $city_list = [];

        $count = count($city_page_id);
        for ($i = 0; $i < $count; $i++){
            $city_list[$city_page_id[$i]]['page'] = $city_page_id[$i];
            $city_list[$city_page_id[$i]]['code'] = $city_code[$i];
            $city_list[$city_page_id[$i]]['name'] = $city_name[$i];
            $city_list[$city_page_id[$i]]['path'] = $province['path'];
            $city_list[$city_page_id[$i]]['path'][] = substr($city_page_id[$i], strlen(end($province['path'])));

            $city_list[$city_page_id[$i]]['level'] = 2;
        }
        //}}

        var_dump($city_list);

        foreach ($city_list as $key=>$val){

        }
    }

    public function actionDistrict($city = null)
    {
        $city = [
            'page' => 4403,
            'code'=> 440300000000,
            'name'=> '深圳市',
            'path'=> [
                '44',
                '03'
            ],
        ];

        //http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2016/44/4403.html
        $url_district = $this->base_url.'/'.$this->version_year.'/'.$city['path'][0].'/'.$city['page'].'.html';
        $html_district = file_get_contents($url_district);
        $html_district = iconv("gb2312", "utf-8", $html_district);
//        echo $html_district;

        //{{匹配省
        $pattern_district = "/<tr class='countytr'><td><a href='\d+\/(\d+).html'>(\d+)<\/a><\/td><td><a href='\d+\/\d+.html'>([\\x{4e00}-\\x{9fa5}]+)<\/a><\/td><\/tr>/u";
        preg_match_all($pattern_district, $html_district, $match);
//        var_dump($match);
        $district_page_id = $match[1];
        $district_code = $match[2];
        $district_name = $match[3];

        $district_list = [];

        $count = count($district_page_id);
        for ($i = 0; $i < $count; $i++){
            $district_list[$district_page_id[$i]]['page'] = $district_page_id[$i];
            $district_list[$district_page_id[$i]]['code'] = $district_code[$i];
            $district_list[$district_page_id[$i]]['name'] = $district_name[$i];
            $district_list[$district_page_id[$i]]['path'] = $city['path'];
            $district_list[$district_page_id[$i]]['path'][] = substr($district_page_id[$i], end($city['path']) + 1);

            $district_list[$district_page_id[$i]]['level'] = 3;
        }
        var_dump($district_list);

        foreach ($district_list as $key=>$val){

        }
    }

    public function actionSubdistrict($district = null)
    {
        $district = [
            'page'=>440305,
            'code'=>440305000000,
            'name'=>'南山区',
            'path'=>[
                '44',
                '03',
                '05'
            ]
        ];

        //http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2016/44/03/440305.html
        $url_sub_district = $this->base_url.'/'.$this->version_year.'/'
            .$district['path'][0].'/'.$district['path'][1].'/'.$district['page'].'.html';
        $html_sub_district = file_get_contents($url_sub_district);
        $html_sub_district = iconv("gb2312", "utf-8", $html_sub_district);
//        echo $html_sub_district;

        $pattern_subdistrict = "/<tr class='towntr'><td><a href='\d+\/(\d+).html'>(\d+)<\/a><\/td><td><a href='\d+\/\d+.html'>([\\x{4e00}-\\x{9fa5}]+)<\/a><\/td><\/tr>/u";
        preg_match_all($pattern_subdistrict, $html_sub_district, $match);
//        var_dump($match);
        $subdistrict_page_id = $match[1];
        $subdistrict_code = $match[2];
        $subdistrict_name = $match[3];

        $subdistrict_list = [];

        $count = count($subdistrict_page_id);
        for ($i = 0; $i < $count; $i++){
            $subdistrict_list[$subdistrict_page_id[$i]]['page'] = $subdistrict_page_id[$i];
            $subdistrict_list[$subdistrict_page_id[$i]]['code'] = $subdistrict_code[$i];
            $subdistrict_list[$subdistrict_page_id[$i]]['name'] = $subdistrict_name[$i];
            $subdistrict_list[$subdistrict_page_id[$i]]['path'] = $district['path'];// [$subdistrict_page_id[$i]]);
            $subdistrict_list[$subdistrict_page_id[$i]]['path'][] = substr($subdistrict_page_id[$i], end($district['path']) + 1);

            $subdistrict_list[$subdistrict_page_id[$i]]['level'] = 4;
        }
        var_dump($subdistrict_list);

        foreach ($subdistrict_list as $key=>$val){

        }
    }

    public function actionCommunity($subdistrict = null)
    {
        $subdistrict = [
            'page'=>440305002,
            'code'=>440305002000,
            'name'=>'南山街道办事处',
            'path'=>[
                '44',
                '03',
                '05',
                '002'
            ]
        ];

        //http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2016/44/03/05/440305002.html
        $url_community = $this->base_url.'/'.$this->version_year.'/'
            .$subdistrict['path'][0].'/'.$subdistrict['path'][1].'/'.$subdistrict['path'][2].'/'.$subdistrict['page'].'.html';
        $html_community = file_get_contents($url_community);
        $html_community = iconv("gb2312", "utf-8", $html_community);
//        echo $html_community;

        $pattern_community = "/<tr class='villagetr'><td>(\d+)<\/td><td>(\d+)<\/td><td>([\\x{4e00}-\\x{9fa5}]+)<\/td><\/tr>/u";
        preg_match_all($pattern_community, $html_community, $match);
//        var_dump($match);
        $community_code = $match[1];
        $community_type = $match[2];
        $community_name = $match[3];

        $community_list = [];

        $count = count($community_code);
        for ($i = 0; $i < $count; $i++){
            $community_list[$community_code[$i]]['type'] = $community_type[$i];
            $community_list[$community_code[$i]]['code'] = $community_code[$i];
            $community_list[$community_code[$i]]['name'] = $community_name[$i];
            $community_list[$community_code[$i]]['path'] = $subdistrict['path'];
            $community_list[$community_code[$i]]['path'][] = substr($community_code[$i],
                strlen($subdistrict['path'][0].$subdistrict['path'][1].$subdistrict['path'][2].$subdistrict['path'][3]));

            $community_list[$community_code[$i]]['level'] = 5;
        }
        var_dump($community_list);

        foreach ($community_list as $key=>$val){

        }
    }
}
