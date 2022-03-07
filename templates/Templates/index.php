<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Template[]|\Cake\Collection\CollectionInterface $templates
 */
?>
<div class="templates index content">
    <?= $this->Html->link(__('Dodaj wzór'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3>Wzory pism</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nazwa') ?></th>
                    <th class="actions">Działania</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($templates as $template): ?>
                <tr>
                    <td><?= h($template->nazwa) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $template->id]) ?>
                        <?= $this->Html->link(__('Edytuj'), ['action' => 'edit', $template->id]) ?>
                        <?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $template->id], ['confirm' => __('Are you sure you want to delete # {0}?', $template->id)]) ?>
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
