<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"><div>    <?php if (isset($player)): ?>        <table class="table table-responsive table-bordered">            <thead>            <tr>                <th>คะแนน</th>                <th>เวลาที่เหลือ</th>            </tr>            </thead>            <tbody>            <?php foreach ($player as $k => $v): ?>                <tr>                    <td><?= $v['scores']; ?></td>                    <td><?= $v['times']; ?></td>                </tr>            <?php endforeach; ?>            </tbody>        </table>    <?php endif; ?></div><div>    <a class="btn btn-block" href="<?= \yii\helpers\Url::to(['/game/game-all?user_id=' . $user_id]) ?>"></a></div><?php \appxq\sdii\widgets\CSSRegister::begin() ?><style>    body {        background: url(<?= \yii\helpers\Url::to('@web/img/bggame.png')?>) center;        background-attachment: fixed;        background-size: cover;        padding: 20px;    }</style><?php \appxq\sdii\widgets\CSSRegister::end(); ?>