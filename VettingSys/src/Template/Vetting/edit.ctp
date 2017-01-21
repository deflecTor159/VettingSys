<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vetting->id_Vetting],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vetting->id_Vetting)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vetting'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="vetting form large-9 medium-8 columns content">
    <?= $this->Form->create($vetting) ?>
    <fieldset>
        <legend><?= __('Edit Vetting') ?></legend>
        <?php
            echo $this->Form->input('date');
            echo $this->Form->input('comments');
        echo $this->Form->label('Client: ');
        $mysqli = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
        $query = "Select * from clients;";
        $result = $mysqli->query($query);
        if (!$result) {
            $message = 'Invalid query: ' . mysqli_connect_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }

        echo '<select name="id_Client">';

        while($row=mysqli_fetch_assoc($result)) {
            echo '<option value='.$row['id_Client'].' >'.$row['name'].'</option>';
        }
        echo '</select>';


        echo $this->Form->label('User: ');
        $mysqli1 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
        $query1 = "Select * from users;";
        $result1 = $mysqli1->query($query1);
        if (!$result1) {
            $message1 = 'Invalid query: ' . mysqli_connect_error() . "\n";
            $message1 .= 'Whole query: ' . $query1;
            die($message1);
        }

        echo '<select name="id_User">';

        while($row1=mysqli_fetch_assoc($result1)) {
            echo '<option value='.$row1['idUser'].' >'.$row1['username'].'</option>';
        }
        echo '</select>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
