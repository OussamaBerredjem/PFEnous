<form action="<?php echo $form->getAction(); ?>"
      method="<?php echo $form->getMethod(); ?>"
    <?php echo $form->renderAttributes(); ?>>

    <?php foreach ($form->getFields() as $field) : ?>
        <?php if ($field->getType() == 'hidden'): ?>

            <?php echo $field; ?>

        <?php else: ?>

            <?php if ($field->getType() == 'submit'): ?>
            <div class="col-sm-12">
            <?php else: ?>
            <div class="form-group col-sm-<?php echo $field->getSize() ?: 4?>">
                <label for="<?php echo $field->getId(); ?>">
                    <?php echo $field->getLabel(); ?>
                </label>
                <?php $field->addAttribute('class', 'form-control'); ?>
            <?php endif; ?>
                <?php echo $field; ?>
            </div>

        <?php endif; ?>

    <?php endforeach; ?>

</form>
