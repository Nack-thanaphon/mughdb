<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Webstat $webstat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Webstat'), ['action' => 'edit', $webstat->c_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Webstat'), ['action' => 'delete', $webstat->c_id], ['confirm' => __('Are you sure you want to delete # {0}?', $webstat->c_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Webstat'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Webstat'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="webstat view content">
            <h3><?= h($webstat->c_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('C Nation') ?></th>
                    <td><?= h($webstat->c_nation) ?></td>
                </tr>
                <tr>
                    <th><?= __('C Id') ?></th>
                    <td><?= $this->Number->format($webstat->c_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('C Date') ?></th>
                    <td><?= h($webstat->c_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('C Ip') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($webstat->c_ip)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
