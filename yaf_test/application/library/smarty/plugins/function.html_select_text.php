<?php
function smarty_function_html_select_text($args, &$smarty){
    $result = $args['options'][$args['selected']];
    if($result && strlen($result) > 0){
        return $result;
    }
    return $args['selected'];
}

?>
