<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Organization'), ['action' => 'edit', $organization->id_Organization]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Organization'), ['action' => 'delete', $organization->id_Organization], ['confirm' => __('Are you sure you want to delete # {0}?', $organization->id_Organization)]) ?> </li>
        <li><?= $this->Html->link(__('List Organizations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="organizations view large-9 medium-8 columns content">
    <h3><?= h($organization->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($organization->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($organization->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Organization') ?></th>
            <td><?= $this->Number->format($organization->id_Organization) ?></td>
        </tr>
        <tr>
            <?php
            $mysqli1 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
            $query1 = "select name from country where id_Country = $organization->id_Country";
            $result1 = $mysqli1->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $country_name=$row1["name"];
            ?>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($country_name) ?></td>
        </tr>
    </table>
</div>
