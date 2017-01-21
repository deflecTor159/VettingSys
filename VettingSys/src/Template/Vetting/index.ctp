<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vetting'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vetting index large-9 medium-8 columns content">
    <h3><?= __('Vetting') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_Vetting') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comments') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Client') ?></th>
                <th scope="col"><?= $this->Paginator->sort('User') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vetting as $vetting): ?>
            <tr>
                <?php
                $mysqli1 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
                $query1 = "select name from clients where id_Client = $vetting->id_Client";
                $result1 = $mysqli1->query($query1);
                $row1 = mysqli_fetch_assoc($result1);
                $client_name=$row1["name"];
                ?>

                <?php
                $mysqli = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
                $query = "select username from users where idUser = $vetting->id_User";
                $result = $mysqli->query($query);
                $row = mysqli_fetch_assoc($result);
                $user_name=$row["username"];
                ?>
                <td><?= $this->Number->format($vetting->id_Vetting) ?></td>
                <td><?= h($vetting->date) ?></td>
                <td><?= h($vetting->comments) ?></td>
                <td><?= h($client_name) ?></td>
                <td><?= h($user_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vetting->id_Vetting]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vetting->id_Vetting]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vetting->id_Vetting], ['confirm' => __('Are you sure you want to delete # {0}?', $vetting->id_Vetting)]) ?>
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
