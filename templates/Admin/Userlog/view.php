<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Userlog $userlog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Userlog'), ['action' => 'edit', $userlog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Userlog'), ['action' => 'delete', $userlog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userlog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Userlog'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Userlog'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userlog view content">
            <h3><?= h($userlog->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $userlog->has('user') ? $this->Html->link($userlog->user->name, ['controller' => 'Users', 'action' => 'view', $userlog->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userlog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($userlog->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated') ?></th>
                    <td><?= h($userlog->updated) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
