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
<?php
if (count($questions) == 0)
    echo "<h1>Вопросов в базе нет.</h1>";
?>
    <main>

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
        <?php
        if ($page != 1) {
            $prevPage = "<a href= ./1>1</a><a href= ./" . ($page - 1) . ">...</a>";
            echo $prevPage;
        } else {
            $prevPage = "";
        }
        ?>
    </main>

<?php
include_once ROOT . '/views/layouts/footer.php';

