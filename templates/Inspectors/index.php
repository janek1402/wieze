<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inspector[]|\Cake\Collection\CollectionInterface $inspectors
 */
?>
<div class="inspectors index content">
    <?= $this->Html->link(__('Dodaj inspektora'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Inspektorzy') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nazwa') ?></th>
                    <th><?= $this->Paginator->sort('adres_ulica') ?></th>
                    <th><?= $this->Paginator->sort('adres_miasto') ?></th>
                    <th><?= $this->Paginator->sort('telefon') ?></th>
                    <th class="actions"><?= __('Działania') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inspectors as $inspector): ?>
                <tr>
                    <td><?= h($inspector->nazwa) ?></td>
                    <td><?= h($inspector->adres_ulica) ?></td>
                    <td><?= h($inspector->adres_miasto) ?></td>
                    <td><?= h($inspector->telefon) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $inspector->id]) ?>
                        <?= $this->Html->link(__('Eytuj'), ['action' => 'edit', $inspector->id]) ?>
                        <?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $inspector->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inspector->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('pierwsza')) ?>
            <?= $this->Paginator->prev('< ' . __('poprzednia')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('następna') . ' >') ?>
            <?= $this->Paginator->last(__('ostatnia') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Strona {{page}} z {{pages}}')) ?></p>
    </div>
</div>
