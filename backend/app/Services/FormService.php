<?php

namespace App\Services;

class FormService
{
    /* 
    
    disp_codeは情報を確認欄に表示するかどうかを決めるコード。
    0が非表示、1が表示。配列の順番に合わせる必要あり。
    例えば [ id,sub_id,title,contents ] なら、idは表示しなくていいので 0011 となる
    
    */
    public static function get_confirm($param,$logical_name,$disp_code,$change_keys){

        $contents = [];
        $before_param_names = array_keys($param);
        $after_param_names = array_keys($param);
        $change_names = array_keys($change_keys);
        $disp_code = wordwrap($disp_code,1,'.',true);
        $disp_codes = explode('.',$disp_code);

        for($i=0; $i<count($change_names); $i++){
            for($j=0; $j<count($before_param_names); $j++){
                if($before_param_names[$j] === $change_names[$i]){
                    $after_param_names[$j] = $change_keys[$change_names[$i]];
                    continue;
                }
            }
        }

        for($i=0; $i<count($param); $i++){
            $contents[$i] = [
                'p_name'  => ($after_param_names[$i]),
                'l_name'  => $logical_name[$i],
                'display' => ($disp_codes[$i] == 1),
                'value'   => $param[$before_param_names[$i]]
            ];
        }

        return $contents;

    }

    public static function sharp_search($search_material){

        $search_material['keyword'] = mb_convert_kana($search_material['keyword'],'s', 'UTF-8');
        $search_material['keyword'] = preg_split('/[\s,]+/',$search_material['keyword']);

        $tags = $search_material['keyword'];

        for($i=0; $i<count($tags); $i++){
            $tags[$i] = addcslashes($tags[$i],'%_\\').'%';
        }

        $category_id = ($search_material['category_id'] == 0) ? [1,2,3,4,5,6,7,8,9] : [$search_material['category_id']];

        return [
            'tags' => $tags,
            'keyword' => $search_material['keyword'],
            'category_id' => $category_id
        ];

    }

}
    
?>

