<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tower[]|\Cake\Collection\CollectionInterface $towers
 */
?>
<div class="towers index content">
    <?= $this->Html->link(__('Dodaj wieżę'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3>Wieże</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nr_stacji') ?></th>
                    <th><?= $this->Paginator->sort('miejscowosc', ['label' => 'Miejscowość']) ?></th>
                    <th class="actions">Działania</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($towers as $tower) : ?>
                    <tr>
                        <td><?= h($tower->nr_stacji) ?></td>
                        <td><?= h($tower->miejscowosc) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $tower->id]) ?>
                            <?= $this->Html->link(__('Edytuj'), ['action' => 'edit', $tower->id]) ?>
                            <?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $tower->id], ['confirm' => "Czy napewno chcesz skasować wieżę " . $tower->nr_stacji . "?"]) ?>
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
            <?= $this->Paginator->next(__('nastepna') . ' >') ?>
            <?= $this->Paginator->last(__('ostatnia') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Strona {{page}} z {{pages}}')) ?></p>
    </div>
</div>