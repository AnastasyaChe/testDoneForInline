
<?php

if(is_array($search_result)): ?>
<?foreach ($search_result as $row): ?>
    <h1><?=$row['title']?></h1>
     <p><?=$row['body']?></p>
 <?endforeach;?>
 <?php elseif($search_result === null):?>
    <div><p>Задан пустой поисковый запрос.</p></div>
<?php else: ?>
    <div><?=$search_result?></div>
<?php endif; ?>
