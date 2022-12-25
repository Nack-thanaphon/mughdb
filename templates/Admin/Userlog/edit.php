<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Userlog $userlog
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userlog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userlog->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Userlog'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userlog form content">
            <?= $this->Form->create($userlog) ?>
            <fieldset>
                <legend><?= __('Edit Userlog') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
