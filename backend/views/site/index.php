<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\UserAction;
use common\models\UserStageScore;
?>

<table class="table table-bordered">
    <thead>
        <td>Наменование</td>
        <td>За сутки</td>
        <td>За всё время</td>
    </thead>

    <tr>
        <td>Количество шэрингов</td>
        <td><?=$shareCountLastDay;?></td>
        <td><?=$shareCount;?></td>
    </tr>

    <tr>
        <td>Приход и регистрация по рефераллу</td>
        <td><?=$refRegisterCountLastDay;?></td>
        <td><?=$refRegisterCount;?></td>
    </tr>
        
    <tr>
        <td>Ввод промокода по рефераллу</td>
        <td><?=$refCodeCountLastDay;?></td>
        <td><?=$refCodeCount;?></td>
    </tr>
        
    <tr>
        <td>Общее кол-во участников, активировавших коды</td>
        <td><?=$userActivatedCodeCountLastDay;?></td>
        <td><?=$userActivatedCodeCount;?></td>
    </tr>
        
    <tr>
        <td>Количество активированных кодов</td>
        <td><?=$activatedCodeCountLastDay;?></td>
        <td><?=$activatedCodeCount;?></td>
    </tr>
        
    <tr>
        <td>Среднее количество кодов на одного пользователя</td>
        <td><?=$userActivatedCodeCountLastDay ? round($activatedCodeCountLastDay / $userActivatedCodeCountLastDay, 5) : '';?></td>
        <td><?=round($activatedCodeCount / $userActivatedCodeCount, 5);?></td>
    </tr>
        
    <tr>
        <td>Кол-во игроков в раннер / среднее время на одну игру пользователя / общее количество игр
        <td><?=$runnerTotalUsersLastDay;?> / 
            <?php if($runnerTotalUsersLastDay > 0) {
                $t = new DateTime; 
                $t->setTimestamp($runnerTotalTimeLastDay / $runnerTotalUsersLastDay);
                echo $t->format('m:s');
            } ?> 
            / 
            <?=$runnerTotalGamesLastDay;?>
        </td>
        <td><?=$runnerTotalUsers;?> / 
            <?php if($runnerTotalUsers > 0) {
                $t = new DateTime; 
                $t->setTimestamp($runnerTotalTime / $runnerTotalUsers);
                echo $t->format('m:s');
            }?>
            / 
            <?=$runnerTotalGames;?>
         </td>
    </tr>
</table>

<h2>Кодов за день</h2>
<table class="table table-bordered">
    <thead>
        <td>Дата</td>
        <?php foreach ($codesCountPerDate as $day => $c):?>
            <td><?=$day;?></td>
        <?php endforeach;?>
    </thead>

    <tr>
        <td>Кол-во</td>
        <?php foreach ($codesCountPerDate as $day => $c):?>
            <td><?=$c;?></td>
        <?php endforeach;?>
    </tr>
</table>

<h2>Шерингов за день</h2>
<table class="table table-bordered">
    <thead>
        <td>Дата</td>
        <?php foreach ($sharesCountPerDate as $day => $c):?>
            <td><?=$day;?></td>
        <?php endforeach;?>
    </thead>

    <tr>
        <td>Кол-во</td>
        <?php foreach ($sharesCountPerDate as $day => $c):?>
            <td><?=$c;?></td>
        <?php endforeach;?>
    </tr>
</table>

<h2>Регистраций за день</h2>
<table class="table table-bordered">
    <thead>
        <td>Дата</td>
        <?php foreach ($usersCountPerDate as $day => $c):?>
            <td><?=$day;?></td>
        <?php endforeach;?>
    </thead>

    <tr>
        <td>Кол-во</td>
        <?php foreach ($usersCountPerDate as $day => $c):?>
            <td><?=$c;?></td>
        <?php endforeach;?>
    </tr>
</table>

<h2>Действия по этапам</h2>
<table class="table table-bordered">
    <thead>
        <td>Наменование</td>
        <?php foreach ($stages as $s):?>
            <td><?=$s->name;?></td>
        <?php endforeach;?>
    </thead>
    <tr>
        <td>Количество кодов за Xbox</td>
        <?php foreach ($actionsStages as $stage => $as):?>
            <td>
                <?php if(isset($as[UserAction::TYPE_ADD_CODE]) && isset($as[UserAction::TYPE_ADD_CODE][UserStageScore::CONSOLE_XBOX])) {
                    echo $as[UserAction::TYPE_ADD_CODE][UserStageScore::CONSOLE_XBOX];
                } ?>
            </td>
        <?php endforeach;?>
    </tr>
    <tr>
        <td>Количество кодов за PS4</td>
        <?php foreach ($actionsStages as $stage => $as):?>
            <td>
                <?php if(isset($as[UserAction::TYPE_ADD_CODE]) && isset($as[UserAction::TYPE_ADD_CODE][UserStageScore::CONSOLE_PS])) {
                    echo $as[UserAction::TYPE_ADD_CODE][UserStageScore::CONSOLE_PS];
                } ?>
            </td>
        <?php endforeach;?>
    </tr>
    <tr>
        <td>Регистраций по реферальной ссылке</td>
        <?php foreach ($actionsStages as $stage => $as):?>
            <td>
                <?php if(isset($as[UserAction::TYPE_REFERRER_REGISTER])) {
                    echo $as[UserAction::TYPE_REFERRER_REGISTER];
                } ?>
            </td>
        <?php endforeach;?>
    </tr>
    <tr>
        <td>Промо-кодов по реферальной ссылке</td>
        <?php foreach ($actionsStages as $stage => $as):?>
            <td>
                <?php if(isset($as[UserAction::TYPE_REFERRER_FIRST_CODE])) {
                    echo $as[UserAction::TYPE_REFERRER_FIRST_CODE];
                } ?>
            </td>
        <?php endforeach;?>
    </tr>
    <tr>
        <td>Шеринги</td>
        <?php foreach ($actionsStages as $stage => $as):?>
            <td>
                <?php if(isset($as[UserAction::TYPE_SHARE])) {
                    echo $as[UserAction::TYPE_SHARE];
                } ?>
            </td>
        <?php endforeach;?>
    </tr>
    <tr>
        <td>Лидеры (топ-3) по количеству кодов за Xbox</td>
        <?php foreach ($userCodeLeaders as $stage => $stageLeaders):?>
            <td>
                <?php if(isset($stageLeaders[UserStageScore::CONSOLE_XBOX])) {
                    $res = [];
                    foreach ($stageLeaders[UserStageScore::CONSOLE_XBOX] as $l) {
                        $res[] = Html::a($l['user_id'].' - '.$l['count'], Url::toRoute(['user/view', 'id' => $l['user_id']]));
                    }

                    echo implode('<br>', $res);
                } ?>
            </td>
        <?php endforeach;?>
    </tr>
    <tr>
        <td>Лидеры (топ-3) по количеству кодов за PS4</td>
        <?php foreach ($userCodeLeaders as $stage => $stageLeaders):?>
            <td>
                <?php if(isset($stageLeaders[UserStageScore::CONSOLE_PS])) {
                    $res = [];
                    foreach ($stageLeaders[UserStageScore::CONSOLE_PS] as $l) {
                        $res[] = Html::a($l['user_id'].' ('.$l['count'].')', Url::toRoute(['user/view', 'id' => $l['user_id']]));
                    }

                    echo implode('<br>', $res);
                } ?>
            </td>
        <?php endforeach;?>
    </tr>
</table>

<h2>
    Победители игры по этапам 
    <a class="btn btn-info" href="<?=Url::toRoute(['site/game-winners-export']);?>">Экспорт в Excel</a>
    <a class="btn btn-info" href="<?=Url::toRoute(['site/game-winners-export', 'withoutBanned' => false]);?>">Экспорт без учета баннов игр</a>
</h2>
<table class="table table-bordered">
    <thead>
        <td>Этап</td>
        <td>Победители</td>
    </thead>

    <?php foreach ($gameStages as $s):?>
        <tr>
            <td><?=$s->name;?></td>
            <td>
                <?php if(isset($runnerWinners[$s->id])) {
                    $res = [];
                    foreach ($runnerWinners[$s->id] as $key => $w) {
                        $res[] = ($key + 1).'. '.Html::a($w['user_id'].' ('.$w['sumScore'].')', Url::toRoute(['user/view', 'id' => $w['user_id']]));
                    }

                    echo implode(' ', $res);
                }?>
            </td>
        </tr>
    <?php endforeach;?>
</table>

<dl>
    <dt>Колво пришедших людей, с неактивированными кодами</dt>
    <dd><?=$usersShownLastChancePopup;?></dd>
</dl>