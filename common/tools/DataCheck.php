<?php
/**
 * 类的介绍：DataCheck类。用户提交数据合法性检查的工具类。
 * 类的详细介绍（可选）：对所有用户提交的数据都进行合法性检查，包括下列列表、选择框中提交的数据。
 * @author    马杰
 * @editor    马杰
 * @version   V0.1.0
 * @team TurboSnail
 */
class DataCheck{

    /**
     * 在服务器端检查用户名、密码、验证码的合法性。
     * @param $name
     * @param $pwd
     * @param $captcha
     * @return string 'FAIL'/'PASS' 不通过/通过
     */
    public static function checkAdminInfo($name,$pwd,$captcha){
        $status = 'FAIL';
        /*预处理收到的值*/
        $name = trim($name);
        $pwd = trim($pwd);
        $captcha = trim($captcha);
        /*数据合法性检查,只有当用户名、密码、验证码同时都不为空时，才进行验证*/
        if($name != '' && $pwd != '' && $captcha != ''){
            $reg_name = '/^[a-zA-Z]\w{4,15}$/';   //用户名以字母开头，长度在5-16之间，只能包含大小写字母、数字和下划线。
            $reg_pwd = '/^\w{4,15}$/';   //密码长度在5-16之间，只能包含大小写字母、数字和下划线。
            $reg_captcha='/^[A-Za-z1-9]{4}$/';    //验证码长度为4，只能包含大小写字母、数字1-9
           if((preg_match($reg_name,$name)) && (preg_match($reg_pwd,$pwd)) && (preg_match($reg_captcha,$captcha))){
                $status = 'PASS';
            }
        }
        return $status;
    }

    /**
     * 在服务器端检查新闻信息的合法性。
     * @param $title
     * @param $littleTitle
     * @return string 'FAIL'/'PASS' 不通过/通过
     */
    public static function checkNewsInfo($title,$content,$releaseTime){
        //【Q 补全参数列表，并进行验证】
        $status = 'FAIL';
        /*预处理收到的值*/
        $title = trim($title);
        $content = trim($content);
        $releaseTime = trim($releaseTime);
        /*数据合法性检查,只有当标题、内容、时间同时都不为空时，才进行验证*/
        if($title !='' && $content != '' && $releaseTime!=''){
            $reg_title = "^.{0,60}$";
            if(preg_match($reg_title,$title))
            {
            $status = 'PASS';
            }
        }
        return $status;
    }


    /**
     * 在服务器端检查Email地址的合法性。
     * @param  $email
     * @return boolean true表示验证通过
     */
    public static function checkEmail($email){
        $reg_email='[\w!#$%&\'*+/=?^_`{|}~-]+(?:\.[\w!#$%&\'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?';
        $email = trim($email);
        if (empty($email) || !preg_match($reg_email,$email)){
            return false;
        }
         return true;
    }
//【T1：以下代码参照上面进行修改，并添加注释】
//    //域名验证
//    public static function checkUrl($realm_name){
//        $reg_realm = '[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(/.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+/.?';
//        if (empty($realm_name)){
//            return false;
//        }else{
//
//            if (preg_match($reg_realm,$realm_name)==false){
//                return false;
//            }else{
//                return true;
//            }
//        }
//    }
//
//    //InternetURL验证
//    public static function checkInterneturl($url){
//        if (empty($url)){
//            return false;
//        }else{
//            $reg_url = '[a-zA-z]+://[^\s]* 或 ^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$';
//            if (preg_match($reg_url,$url)==false){
//                return false;
//            }else{
//                return true;
//            }
//        }
//    }
//
//    //手机号验证
//    public static function checkPhone($phone){
//        if (empty($phone)){
//            return false;
//        }else{
//            $reg_phone = '^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$';
//            if (preg_match($reg_phone,$phone)==false){
//                return false;
//            }else{
//                return true;
//            }
//        }
//    }
//
//    //身份证验证
//    public static function checkCard($card){
//        if (empty($card)){
//            return false;
//        }else{
//            $reg_card = '^\d{18}$';
//            if (preg_match($reg_card,$card)==false){
//                return false;
//            }else{
//                return true;
//            }
//        }
//    }
//
//    //账号验证
//    public static function checkId($id){
//        if (empty($id)){
//            return false;
//        }else{
//            $reg_id = '^[a-zA-Z][a-zA-Z0-9_]{4,15}$';//字母开头，长度在5-16之间，允许字母数字下划线
//            if (preg_match($reg_id,$id)==false){
//                return false;
//            }else{
//                return true;
//            }
//        }
//    }
//
//    //验证QQ号码
//    public static function checkQQ($QQ){
//        if (empty($QQ)){
//            return false;
//        }else{
//            $reg_qq = '[1-9][0-9]{4,}';
//            if (preg_match($reg_qq,$QQ)==false){
//                return false;
//            }else{
//                return true;
//            }
//        }
//    }
//
//    //验证中国邮政编码
//    public static function checkCode($code){
//        if (empty($code)){
//            return false;
//        }else{
//            $reg_code = '[1-9]\d{5}(?!\d) ';
//            if (preg_match($reg_code,$code)==false){
//                return false;
//            }else{
//                return true;
//            }
//        }
//    }
//
//    //验证汉字
//    public static function checkChinese($chinese){
//        if (empty($chinese)){
//            return false;
//        }else{
//            $reg_chinese = ' [\u4e00-\u9fa5]';
//            if (preg_match($reg_chinese,$chinese)==false){
//                return false;
//            }else{
//                return true;
//            }
//        }
//    }
}