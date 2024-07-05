<ol <?php echo $breadcrumbs->renderAttributes();?>>
    <?php foreach ($breadcrumbs->getItens() as $url => $linkName):?>

    <?php if ($breadcrumbs->getActive() == $url):?>
    <li class="active">
        <?php echo $linkName;?>
    </li>
    <?php else:?>
    <li>
        <a href="<?php echo $url;?>">
            <?php echo $linkName;?>
        </a>
    </li>
    <?php endif;?>
    <?php endforeach;?>
</ol>
