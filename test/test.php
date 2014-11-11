<?php
$str = 'Nguyễn Hải Nam';
echo html_entity_decode( htmlentities($str, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'cp1252') . '<br />';
echo htmlentities($str, ENT_QUOTES, 'cp1252') . '<br />';