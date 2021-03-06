<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Article\Boxes;

use Modules\Article\Mappers\Article as ArticleMapper;

class Archive extends \Ilch\Box
{
    public function render()
    {
        $articleMapper = new ArticleMapper();

        $this->getView()->set('articleMapper', $articleMapper)
            ->set('archive', $articleMapper->getArticleDateList($this->getConfig()->get('article_box_archiveLimit')));
    }
}
