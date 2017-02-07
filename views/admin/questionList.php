<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 27.01.17
 * Time: 14:57
 */

include_once ROOT . '/views/modules/header.php';
include_once ROOT . '/views/modules/userInfo.php';

if ($_SESSION['access'] > 1):?>
    <a href="/admin2" id="buttonBack" class="grayButton">&#8592 Назад</a>
<?php endif; ?>


    <main>

        <?php
        if (count($questions) == 0) {
            echo "<h3>Вопросов в базе нет.</h3>";
        } else {
            echo "<h3>Панель управления вопросами</h3>";
            echo "<div id='questionStatistic'><b>Неотвеченных вопросов: " . $unreadCount . "</b><span>Всего вопросов: " . $countQuestion .
                "</span></div>";
        }

        ?>

        <div id="questionList">

            <?php foreach ($questions as $question):
                ?>
                <a href="../questionAnswer/<?php echo $question['id'] ?>">
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
        <?php include_once ROOT . '/views/modules/pages.php'; ?>
    </main>

<?php
include_once ROOT . '/views/modules/footer.php';

