<?php
// Used to output lists of errors as alerts when signing up or posting
function checkCondition($condition, $text) {
    if($condition) {
        echo "-" . $text . "\n";
    }
    return $condition;
}
?>
