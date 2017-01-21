<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Client'), ['action' => 'edit', $client->id_Client]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Client'), ['action' => 'delete', $client->id_Client], ['confirm' => __('Are you sure you want to delete # {0}?', $client->id_Client)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clients view large-9 medium-8 columns content">
    <h3><?= h($client->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($client->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($client->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($client->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Client') ?></th>
            <td><?= $this->Number->format($client->id_Client) ?></td>
        </tr>
        <tr>
            <?php
            $mysqli1 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
            $query1 = "select name from country where id_Country = $client->id_Country";
            $result1 = $mysqli1->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $country_name=$row1["name"];
            ?>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($country_name) ?></td>
        </tr>
    </table>
</div>
