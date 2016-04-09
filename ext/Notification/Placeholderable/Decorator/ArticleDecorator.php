<?php
namespace app\ext\Notification\Placeholderable\Decorator;

use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;
use app\models\Article;

class ArticleDecorator extends BaseDecorator
{
    /**
     * @var Article
     */
    private $article;

    public function __construct(TextPlaceholderProcessor $textPlaceholderProcessor, Article $article)
    {
        parent::__construct($textPlaceholderProcessor);
        $this->article = $article;
    }


    protected function replacePlaceholders($text)
    {
        return strtr($text,
            [
                '{articleName}' => $this->article->title,
                '{articleShortText}' => $this->article->short_text,
                '{articleUrl}' => "/article/5",
            ]
        );
    }
}
