<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Template $template
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="templates form content">
            <?= $this->Form->create($template, ['type' => 'file']) ?>
            <fieldset>
                <h3>Dodawanie wzoru pisma</h3>
                <?php
                    echo $this->Form->control('nazwa');
                ?>
                <?= $this->Form->control('file', ['type' => 'file', 'required', 'accept' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);?>
            </fieldset>
            <?= $this->Form->button(__('Dodaj')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
