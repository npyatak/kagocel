<?php
namespace common\fixtures;

use Yii;
use common\models\Post;
use yii\test\ActiveFixture;

class PostFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Post';
    public $depends = ['common\fixtures\UserFixture'];
}