<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Document[]|\Cake\Collection\CollectionInterface $documents
 */

use Cake\Controller\Controller;

?>
<div class="documents index content">
    <div class="column-responsive column-100">
        
            <?= $this->Form->create(null, ['url' => ['action' => 'toShowTower']]) ?>
            <fieldset>
                <h3>Wybierz wieżę z listy aby zobaczyć dokumenty</h3>
                <?php
                echo $this->Form->control('tower_id', ['label' => 'Wieża', 'options' => $towers, 'required', 'empty' => 'wybierz wieżę']);
                ?>
            </fieldset>
            <?= $this->Form->button('Wybierz') ?>
            <?= $this->Form->end() ?>
        
    </div>
</div>