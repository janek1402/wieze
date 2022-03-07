<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Representative $representative
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="representatives form content">
            <?= $this->Form->create($representative) ?>
            <fieldset>
                <h3>Edycja informacji o przedstawicielu</h3>
                <?php
                    echo $this->Form->control('nazwa');
                    echo $this->Form->control('adres_ulica');
                    echo $this->Form->control('adres_miasto');
                    echo $this->Form->control('telefon');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Zatwierdź')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
