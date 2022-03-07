<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Manager[]|\Cake\Collection\CollectionInterface $managers
 */
?>
<div class="managers index content">
    <?= $this->Html->link(__('Dodaj kierownika'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Kierownicy') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nazwa') ?></th>
                    <th><?= $this->Paginator->sort('adres_ulica') ?></th>
                    <th><?= $this->Paginator->sort('adres_miasto') ?></th>
                    <th><?= $this->Paginator->sort('telefon') ?></th>
                    <th><?= $this->Paginator->sort('nr_uprawnien') ?></th>
                    <th class="actions"><?= __('Działania') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($managers as $manager): ?>
                <tr>
                    <td><?= h($manager->nazwa) ?></td>
                    <td><?= h($manager->adres_ulica) ?></td>
                    <td><?= h($manager->adres_miasto) ?></td>
                    <td><?= h($manager->telefon) ?></td>
                    <td><?= h($manager->nr_uprawnien) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $manager->id]) ?>
                        <?= $this->Html->link(__('Edytuj'), ['action' => 'edit', $manager->id]) ?>
                        <?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $manager->id], ['confirm' => __('Are you sure you want to delete # {0}?', $manager->id)]) ?>
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
