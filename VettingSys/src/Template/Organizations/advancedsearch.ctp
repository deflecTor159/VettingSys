<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="organizations index large-9 medium-8 columns content">
    <h3><?= __('Search Results') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id_Organization') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('Country') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($organizations as $organization): ?>
            <tr>
                <?php
                $mysqli1 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
                $query1 = "select name from country where id_Country = $organization->id_Country";
                $result1 = $mysqli1->query($query1);
                $row1 = mysqli_fetch_assoc($result1);
                $country_name=$row1["name"];
                ?>
                <td><?= $this->Number->format($organization->id_Organization) ?></td>
                <td><?= h($organization->name) ?></td>
                <td><?= h($organization->status) ?></td>
                <td><?=  h($country_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $organization->id_Organization]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $organization->id_Organization]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $organization->id_Organization], ['confirm' => __('Are you sure you want to delete # {0}?', $organization->id_Organization)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
