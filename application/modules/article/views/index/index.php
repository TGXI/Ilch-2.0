<?php
$articles = $this->get('articles');
$categoryMapper = $this->get('categoryMapper');
$commentMapper = $this->get('commentMapper');
$userMapper = $this->get('userMapper');

if ($articles != ''):
    foreach ($articles as $article):
        $date = new \Ilch\Date($article->getDateCreated());
        $commentsCount = $commentMapper->getCountComments('article/index/show/id/'.$article->getId());
        $image = $article->getArticleImage();
        $imageSource = $article->getArticleImageSource();
        $articlesCats = $categoryMapper->getCategoryById($article->getCatId());
        ?>
        <div class="col-lg-12 hidden-xs" style="padding-left: 0px;">
            <div class="col-lg-8" style="padding-left: 0px;">
                <h4><a href="<?=$this->getUrl(['controller' => 'cats', 'action' => 'show', 'id' => $article->getCatId()]) ?>"><?=$this->escape($articlesCats->getName()) ?></a></h4>
            </div>
            <div class="col-lg-4 text-right" style="padding-right: 0px;">
                <h4><a href="<?=$this->getUrl(['controller' => 'archive', 'action' => 'show', 'year' => $date->format("Y", true), 'month' => $date->format("m", true)]) ?>"><?=$date->format('d. F Y', true) ?></a></h4>
            </div>
        </div>
        <h3><a href="<?=$this->getUrl(['action' => 'show', 'id' => $article->getId()]) ?>"><?=$this->escape($article->getTitle()) ?></a></h3>
        <?php if (!empty($image)): ?>
            <figure>
                <img class="article_image" src="<?=$this->getBaseUrl($image) ?>">
                <?php if (!empty($imageSource)): ?>
                    <figcaption class="article_image_source"><?=$this->getTrans('imageSource') ?>: <?=$imageSource ?></figcaption>
                <?php endif; ?>
            </figure>
        <?php endif; ?>

        <?php $content = $article->getContent(); ?>

        <?php if (strpos($content, '[PREVIEWSTOP]') !== false): ?>
            <?php $contentParts = explode('[PREVIEWSTOP]', $content); ?>
            <?=reset($contentParts) ?>
            <br />
            <a href="<?=$this->getUrl(['action' => 'show', 'id' => $article->getId()]) ?>" class="pull-right"><?=$this->getTrans('readMore') ?></a>
        <?php else: ?>
            <?=$content ?>
        <?php endif; ?>
        <hr />
        <div>
            <?php if ($article->getAuthorId() != ''): ?>
                <?php $user = $userMapper->getUserById($article->getAuthorId()); ?>
                <?php if ($user != ''): ?>
                    <i class="fa fa-user" title="<?=$this->getTrans('author') ?>"></i> <a href="<?=$this->getUrl(['module' => 'user', 'controller' => 'profil', 'action' => 'index', 'user' => $user->getId()]) ?>"><?=$this->escape($user->getName()) ?></a>&nbsp;&nbsp;
                <?php endif; ?>
            <?php endif; ?>
            <i class="fa fa-calendar" title="<?=$this->getTrans('date') ?>"></i> <a href="<?=$this->getUrl(['controller' => 'archive', 'action' => 'show', 'year' => $date->format("Y", true), 'month' => $date->format("m", true)]) ?>"><?=$date->format('d. F Y', true) ?></a>
            &nbsp;&nbsp;<i class="fa fa-clock-o" title="<?=$this->getTrans('time') ?>"></i> <?=$date->format('H:i', true) ?>
            &nbsp;&nbsp;<i class="fa fa-folder-open-o" title="<?=$this->getTrans('cats') ?>"></i> <a href="<?=$this->getUrl(['controller' => 'cats', 'action' => 'show', 'id' => $article->getCatId()]) ?>"><?=$this->escape($articlesCats->getName()) ?></a>
            &nbsp;&nbsp;<i class="fa fa-comment-o" title="<?=$this->getTrans('comments') ?>"></i> <a href="<?=$this->getUrl(['action' => 'show', 'id' => $article->getId().'#comment']) ?>"><?=$commentsCount ?></a>
            &nbsp;&nbsp;<i class="fa fa-eye" title="<?=$this->getTrans('hits') ?>"></i> <?=$article->getVisits() ?>
        </div>
        <br /><br /><br />
    <?php endforeach; ?>
    <div class="pull-right">
        <?=$this->get('pagination')->getHtml($this, ['action' => 'index']) ?>
    </div>
<?php else: ?>
    <?=$this->getTrans('noArticles') ?>
<?php endif; ?>
