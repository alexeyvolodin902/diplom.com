<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 01.02.17
 * Time: 12:28
 */
?>
<!--Необходимо общее количество вопросов в базе, номер страницы-->
<div class="pages">
    <?php
    $countPage = intval(($countQuestion - 1) / 5) + 1;
    $pagination = "";
    if (($page - 3) > 0) {
        $pagination .= "<a href= './1'>&#8592</a>";
    }
    for ($i = -2; $i < 0; $i++) {
        if (($page + $i) > 0) {
            $pagination .= "<a href= './" . ($page + $i) . "'>" . ($page + $i) . "</a>";
        }
    }
    if ($countPage != 1)
        $pagination .= "<a href= './" . $page . "' class = 'active'>" . $page . "</a>";
    for ($i = 1; $i < 3; $i++) {
        if (($page + $i) <= $countPage) {
            $pagination .= "<a href= './" . ($page + $i) . "'>" . ($page + $i) . "</a>";
        }
    }
    if (($page + 3) <= $countPage) {
        $pagination .= "<a href= './" . ($page + 3) . "'> &#8594</a>";
    }
    echo $pagination;
    ?>
</div>
