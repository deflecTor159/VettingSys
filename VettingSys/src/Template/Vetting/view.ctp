<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vetting'), ['action' => 'edit', $vetting->id_Vetting]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vetting'), ['action' => 'delete', $vetting->id_Vetting], ['confirm' => __('Are you sure you want to delete # {0}?', $vetting->id_Vetting)]) ?> </li>
        <li><?= $this->Html->link(__('List Vetting'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vetting'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vetting view large-9 medium-8 columns content">
    <h3><?= h($vetting->id_Vetting) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Comments') ?></th>
            <td><?= h($vetting->comments) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Vetting') ?></th>
            <td><?= $this->Number->format($vetting->id_Vetting) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Client') ?></th>
            <td><?= $this->Number->format($vetting->id_Client) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id User') ?></th>
            <td><?= $this->Number->format($vetting->id_User) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($vetting->date) ?></td>
        </tr>
    </table>
</div>
