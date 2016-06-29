<?php


use app\ext\User\UserIdentity;
use app\modules\backend\models\ArticleCrud\ArticleCrudSave;

class ArticleTest extends \Codeception\TestCase\Test
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    /** @var \yii\web\User */
    private $user;

    protected function _before()
    {
        $this->user = Yii::$app->user;
    }

    protected function _after()
    {
    }

    // tests
    public function testCreatingNew()
    {
        $identity = UserIdentity::findOne(['username' => 'user2']);
        $this->user->login($identity);

        $article = new ArticleCrudSave();
        $article->title = "fake fake";
        $article->author_id = $identity->getId();
        $article->short_text = md5(uniqid('', true));
        $article->save();

        $this->assertNotEmpty($article->primaryKey);
    }

    public function testUpdating()
    {
        $article = ArticleCrudSave::findOne(2);
        $article->enabled = 0;

        $res = $article->save();

        $this->assertTrue($res, "not saved");
    }
}