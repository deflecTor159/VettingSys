<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $country->id_Country],
                ['confirm' => __('Are you sure you want to delete # {0}?', $country->id_Country)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Country'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="country form large-9 medium-8 columns content">
    <?= $this->Form->create($country) ?>
    <fieldset>
        <legend><?= __('Edit Country') ?></legend>
        <?php
            echo $this->Form->input('country_code');
            echo $this->Form->input('name');
            echo $this->Form->input('code');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
