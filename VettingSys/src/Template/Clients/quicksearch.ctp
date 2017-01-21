<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Client'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clients index large-9 medium-8 columns content">
    <h3><?= __('Clients') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_Client') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_Country') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
            <tr>
                <?php
                $mysqli1 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
                $query1 = "select name from country where id_Country = $client->id_Country";
                $result1 = $mysqli1->query($query1);
                $row1 = mysqli_fetch_assoc($result1);
                $country_name=$row1["name"];
                ?>
                <td><?= $this->Number->format($client->id_Client) ?></td>
                <td><?= h($client->name) ?></td>
                <td><?= h($client->email) ?></td>
                <td><?= h($client->status) ?></td>
                <td><?= h($country_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $client->id_Client]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $client->id_Client]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $client->id_Client], ['confirm' => __('Are you sure you want to delete # {0}?', $client->id_Client)]) ?>
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
