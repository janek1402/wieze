<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Representative[]|\Cake\Collection\CollectionInterface $representatives
 */
?>
<div class="representatives index content">
    <?= $this->Html->link(__('Dodaj przedstawiciela'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Przedstawiciele') ?></h3>
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
                <?php foreach ($representatives as $representative): ?>
                <tr>
                    <td><?= h($representative->nazwa) ?></td>
                    <td><?= h($representative->adres_ulica) ?></td>
                    <td><?= h($representative->adres_miasto) ?></td>
                    <td><?= h($representative->telefon) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $representative->id]) ?>
                        <?= $this->Html->link(__('Edytuj'), ['action' => 'edit', $representative->id]) ?>
                        <?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $representative->id], ['confirm' => __('Are you sure you want to delete # {0}?', $representative->id)]) ?>
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
