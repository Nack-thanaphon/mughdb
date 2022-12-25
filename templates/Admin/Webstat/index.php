<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Webstat> $webstat
 */
?>
<div class="webstat index content">
    <?= $this->Html->link(__('New Webstat'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Webstat') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('c_id') ?></th>
                    <th><?= $this->Paginator->sort('c_nation') ?></th>
                    <th><?= $this->Paginator->sort('c_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($webstat as $webstat): ?>
                <tr>
                    <td><?= $this->Number->format($webstat->c_id) ?></td>
                    <td><?= h($webstat->c_nation) ?></td>
                    <td><?= h($webstat->c_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $webstat->c_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $webstat->c_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $webstat->c_id], ['confirm' => __('Are you sure you want to delete # {0}?', $webstat->c_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
