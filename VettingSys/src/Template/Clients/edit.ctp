<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $client->id_Client],
                ['confirm' => __('Are you sure you want to delete # {0}?', $client->id_Client)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="clients form large-9 medium-8 columns content">
    <?= $this->Form->create($client) ?>
    <fieldset>
        <legend><?= __('Edit Client') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
        echo $this->Form->label('Status: ');
        echo '<select name="status">';
        echo '<option>Vetted</option>';
        echo '<option>Not Vetted</option>';
        echo '</select>';

        echo $this->Form->label('Country / Region: ');
        $mysqli = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
        $query = "Select * from country;";
        $result = $mysqli->query($query);
        if (!$result) {
            $message = 'Invalid query: ' . mysqli_connect_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }

        echo '<select name="id_Country">';
        $i=1;
        while($row=mysqli_fetch_assoc($result)) {
            echo '<option value='.$i++.' >'.$row['name'].'</option>';
        }
        echo '</select>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
