<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Investor $investor
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="investors form content">
            <?= $this->Form->create($investor) ?>
            <fieldset>
                <h3>Dodawanie inwestora</h3>
                <?php
                    echo $this->Form->control('nazwa');
                    echo $this->Form->control('adres_ulica');
                    echo $this->Form->control('adres_miasto');
                    echo $this->Form->control('telefon');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Dodaj')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
