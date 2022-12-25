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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $webstat->c_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $webstat->c_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Webstat'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="webstat form content">
            <?= $this->Form->create($webstat) ?>
            <fieldset>
                <legend><?= __('Edit Webstat') ?></legend>
                <?php
                    echo $this->Form->control('c_ip');
                    echo $this->Form->control('c_nation');
                    echo $this->Form->control('c_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
