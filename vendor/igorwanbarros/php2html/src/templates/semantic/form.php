<?php
$size = [
    1   => 'one wide',
    2   => 'two wide',
    3   => 'three wide',
    4   => 'four wide',
    5   => 'five wide',
    6   => 'six wide',
    7   => 'seven wide',
    8   => 'eight wide',
    9   => 'nine wide',
    10  => 'ten wide',
    11  => 'eleven wide',
    12  => 'twelve wide',
    13  => 'thirteen wide',
    14  => 'fourteen wide',
    15  => 'fifteen wide',
    16  => 'sixteen wide',
];
$countDivFields = 0;
?>
<form method="<?php echo $form->getMethod()?>"
      action="<?php echo $form->getAction()?>"
      <?php echo $form->renderAttributes()?>>

    <div class="fields">
    <?php foreach ($form->getFields() as $field):?>
        <?php if ($field->getType() == 'hidden'):?>
            <?php echo $field?>
            <?php continue;?>
        <?php endif;?>

        <?php
            $countDivFields += $field->getSize();
        ?>

    <?php if ($countDivFields > 16):?>
    </div>
    <div class="fields">
    <?php $countDivFields = $field->getSize()?>
    <?php endif;?>

        <div class="<?php echo array_key_exists($field->getSize(), $size) ? $size[$field->getSize()] : ''?> field">
            <?php if ($field->getLabel()):?>
            <label for="<?php echo $field->getId()?>">
                <?php echo $field->getLabel() ?>
            </label>
            <?php endif;?>
            <?php echo $field?>
        </div>

    <?php endforeach;?>
    </div>

    <div class="fields">

    </div>
</form>
