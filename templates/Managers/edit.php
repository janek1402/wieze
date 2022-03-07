<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Manager $manager
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="managers form content">
            <?= $this->Form->create($manager) ?>
            <fieldset>
                <h3>Edycja kierownika</h3>
                <?php
                    echo $this->Form->control('nazwa');
                    echo $this->Form->control('adres_ulica');
                    echo $this->Form->control('adres_miasto');
                    echo $this->Form->control('telefon');
                    echo $this->Form->control('nr_uprawnien');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Zatwierdź')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
