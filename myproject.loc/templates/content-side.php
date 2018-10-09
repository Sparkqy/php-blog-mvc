<div class="col-md-4 content-right">
    <div class="recent">
        <h3>Топ комментаторы:</h3>
        <ul>
            <?php $i = 1 ?>
            <?php foreach ($topCommentators as $topCommentator): ?>
            <li style="padding-left: 10px;"><?= $i?>) <?= ucfirst($topCommentator->getName()) ?></li>
            <?php $i++ ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="categories">
        <h3>Категории:</h3>
        <ul>
            <?php foreach ($categories as $category): ?>
            <li style="padding-left: 10px;">
                <a href="/category/<?= $category->getId()?>"><?= $category->getName() ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>