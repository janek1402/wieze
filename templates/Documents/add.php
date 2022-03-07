<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Document $document
 * @var \Cake\Collection\CollectionInterface|string[] $towers
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="documents form content">
            <?= $this->Form->create($document, ['url' => ['action' => 'add', $tower['id']], 'type' => 'file']) ?>
            <fieldset>
                <h3><?= __('Dodawanie dokumentów') ?></h3>
                <?php
                echo $this->Form->control('name', ['label' => 'Nazwa dokumentu']);
                ?>
                <?= $this->Form->control('file', ['type' => 'file', 'required','label' => 'Pliki']); ?>

            </fieldset>
            <?= $this->Form->button(__('Dodaj')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>