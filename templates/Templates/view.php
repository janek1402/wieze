<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Template $template
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="templates view content">
            <h3><?= h($template->nazwa) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nazwa') ?></th>
                    <td><?= h($template->nazwa) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
