<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Investor[]|\Cake\Collection\CollectionInterface $investors
 */
?>
<div class="investors index content">
    <?= $this->Html->link(__('Dodaj inwestora'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Inwestorzy') ?></h3>
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
                <?php foreach ($investors as $investor): ?>
                <tr>
                    <td><?= h($investor->nazwa) ?></td>
                    <td><?= h($investor->adres_ulica) ?></td>
                    <td><?= h($investor->adres_miasto) ?></td>
                    <td><?= h($investor->telefon) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $investor->id]) ?>
                        <?= $this->Html->link(__('Edytuj'), ['action' => 'edit', $investor->id]) ?>
                        <?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $investor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $investor->id)]) ?>
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
