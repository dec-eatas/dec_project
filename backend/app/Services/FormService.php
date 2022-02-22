<?php

namespace App\Services;

class FormService
{
    /* 
    
    disp_codeは情報を確認欄に表示するかどうかを決めるコード。
    0が非表示、1が表示。配列の順番に合わせる必要あり。
    例えば [ id,sub_id,title,contents ] なら、idは表示しなくていいので 0011 となる
    
    */
    public static function get_confirm($param,$logical_name,$disp_code){

        $contents = [];
        $Phydical_names = array_keys($param);
        $disp_code = wordwrap($disp_code,1,'.',true);
        $disp_codes = explode('.',$disp_code);

        for($i=0; $i<count($param); $i++){
            $contents[$i] = [
                'p_name'  => $Phydical_names[$i],
                'l_name'  => $logical_name[$i],
                'display' => ($disp_codes[$i] == 1),
                'value'   => $param[$Phydical_names[$i]]
            ];
        }

        return $contents;

    }

}
    
?>

