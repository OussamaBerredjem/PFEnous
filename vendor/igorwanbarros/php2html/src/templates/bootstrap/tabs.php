<ul class="nav <?php echo $tabs->getClass(); ?>">

    <?php foreach ($tabs->getTitles() as $name => $title) : ?>

        <li class="<?php echo $tabs->getActive() == $name ? 'active' : ''; ?>">
            <?php $attributes = '';?>

            <?php if (is_array($title) && array_key_exists('title', $title)):?>
                <?php
                    $myTitle = $title['title'];
                    unset($title['title']);
                ?>
                <?php foreach ($title as $attr => $value):?>
                    <?php $attributes .= "{$attr}=\"{$value}\" "?>
                <?php endforeach;?>
                <?php $title = $myTitle;?>
            <?php endif;?>

            <a data-toggle="tab" href="#<?php echo $name; ?>" <?php echo $attributes;?>>
                <?php echo $title; ?>
            </a>
        </li>

    <?php endforeach; ?>

</ul>

<div class="tab-content">

    <?php foreach ($tabs->getContents() as $titleName => $content) : ?>

    <div id="<?php echo $titleName; ?>"
         class="tab-pane <?php echo $tabs->getActive() == $titleName ? 'active' : ''; ?>">

        <?php echo $content; ?>

    </div>

    <?php endforeach; ?>

</div>
