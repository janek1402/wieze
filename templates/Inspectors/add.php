<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inspector $inspector
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="inspectors form content">
            <?= $this->Form->create($inspector) ?>
            <fieldset>
                <h3>Dodawanie inspektora</h3>
                <?php
                    echo $this->Form->control('nazwa');
                    echo $this->Form->control('adres_ulica');
                    echo $this->Form->control('adres_miasto');
                    echo $this->Form->control('telefon');
                    echo $this->Form->control('uprawnienia');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Dodaj')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
