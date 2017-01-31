<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 27.01.17
 * Time: 14:57
 */

include_once ROOT . '/views/layouts/header.php';
?>
    <div id="userInfo">
        <span id="userName">
        <?php echo $userInfo['FIO'] ?>
        </span>
        <br>
        <div id="userExtra">
            <?php echo $userInfo['position'] ?>
            <br>

            <?php echo $userRegion ?>
        </div>
        <a href="../auth" id="logoutButton" class="redButton">Выйти</a>

    </div>

    <main>
        <?php
        if (count($questions) == 0) {
            echo "<h3>Вопросов в базе нет.</h3>";
        }else{
            echo"<h3>Панель управления вопросами</h3>";
            echo "<div>Неотвеченных вопросов: ".$unreadCount."<br>Всего вопросов: ".$countQuestion."</div>";
        }

        ?>
        <div id="questionList">

            <?php foreach ($questions as $question):
                ?>
                <a href="#">
                    <div class="questionItem <?php if ($question["status"] == 0) echo "unRead"; ?>">
                        <div
                            class="questionListTime"><?php echo strftime("%e %B %R", strtotime($question['dateTime'])); ?></div>
                        <div class="questionListName">
                            <?php
                            echo mb_substr($question['name'], 0, 15, 'UTF-8');
                            if (mb_strlen($question['name'], 'UTF-8') > 15)
                                echo "...";
                            ?>
                        </div>
                        <div class="questionListText">
                            <?php
                            echo mb_substr($question['question'], 0, 60, 'UTF-8');
                            if (mb_strlen($question['question'], 'UTF-8') > 60)
                                echo "...";
                            ?>
                        </div>
                    </div>
                </a>
                <?php
            endforeach;
            ?>
        </div>
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
    </main>

<?php
include_once ROOT . '/views/layouts/footer.php';

