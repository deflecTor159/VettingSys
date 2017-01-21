<?php
namespace App\Controller;

/**
 * Stats Controller
 *
 *
 */
class StatsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public $totalClients;

    public function showStats()
    {
        $this->showClients();
        $this->showOrgs();
    }

        function showClients(){
        //****************************CLIENTS ALL************************************************
        //Connection to DB

        $mysqli = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");

        /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        $query = "call sp_getClientsTotal()";
        $result = $mysqli->query($query);
        if (!$result) {
            $message = 'Invalid query: ' . mysqli_connect_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $dataTotal[] = array(
                "totalVetted" => $row["totalVetted"],
                "totalNotVetted" => $row["totalNotVetted"]
            );
        }
        $totalVetted = $dataTotal[0]['totalVetted'];
        $totalNotVetted = $dataTotal[0]['totalNotVetted'];
        $totalClients = $totalVetted + $totalNotVetted;
        $mysqli->close();
        ?>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Total'],
                    ['Vetted',<?php echo $totalVetted?>],
                    ['Not Vetted',<?php echo $totalNotVetted?>]
                ])
                var options = {
                    title: 'Clients'
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechartClients'));
                chart.draw(data, options);
            }

        </script>
        <?php

        //****************************CLIENTSXCOUNTRY************************************************
        //Connection to DB

        $mysqli2 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");

        // check connection
        if ($mysqli2->connect_errno) {
            printf("Connect failed: %s\n", $mysqli2->connect_error);
            exit();
        }
//***************************************Vetted*********************
//Data from Vetted Clients
        $query2 = "call sp_getClientsStats('Vetted');";
        $result2 = $mysqli2->query($query2);
        if (!$result2) {
            $message2 = 'Invalid query: ' . mysqli_connect_error() . "\n";
            $message2 .= 'Whole query: ' . $query2;
            die($message2);
        }

        while ($row2 = mysqli_fetch_assoc($result2)) {
            $dataVetted[] = array(
                "Country" => $row2["country"],
                "Total" => $row2["total"]

            );
        }

//$co=array_values((array_values($dataVetted)[0]))[0];
//print_r($co);

//***************************************Not Vetted*********************
        $mysqli3 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
//Data from Vetted Clients
        $query3 = "call sp_getClientsStats('Not Vetted');";
        $result3 = $mysqli3->query($query3);

        if (!$result3) {
            $message3 = 'Invalid query: ' . mysqli_connect_error() . "\n";
            $message3 .= 'Whole query: ' . $query3;
            die($message3);
        }

        while ($row3 = mysqli_fetch_assoc($result3)) {
            $dataNotVetted[] = array(
                "Country" => $row3["country"],
                "Total" => $row3["total"]
            );
        }


        ?>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Country', 'Total'],<?php
                        $finalString="";
                    for ($i = 0; $i < sizeof($dataVetted); $i++) {
                        $co = array_values((array_values($dataVetted)[$i]))[0];
                        $coTotal = array_values((array_values($dataVetted)[$i]))[1];
                        $finalString = $finalString . "['" . $co . "'," . $coTotal . "],";
                    }
                    echo $finalString;
                    ?>

                ])
                var options = {
                    title: 'Clients Vetted X Country'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechartClientsXCountry'));

                chart.draw(data, options);

            }


        </script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Country', 'Total'],<?php
                    $finalString1="";
                    for ($i = 0; $i < sizeof($dataNotVetted); $i++) {
                        $co1 = array_values((array_values($dataNotVetted)[$i]))[0];
                        $coTotal1 = array_values((array_values($dataNotVetted)[$i]))[1];
                        $finalString1 = $finalString1 . "['" . $co1 . "'," . $coTotal1 . "],";
                    }
                    echo $finalString1;
                    ?>
                ])

                var options = {
                    title: 'Clients Not Vetted X Country'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechartClientsNotXCountry'));

                chart.draw(data, options);

            }
        </script>
        <?php
        $mysqli3->close();
        $mysqli2->close();
    }
        function showOrgs()
        {

            //****************************Organizations ALL************************************************
//Connection to DB

            $mysqli1 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");

            /* check connection */
            if ($mysqli1->connect_errno) {
                printf("Connect failed: %s\n", $mysqli1->connect_error);
                exit();
            }

            $query1 = "call sp_getOrgsTotal()";
            $result1 = $mysqli1->query($query1);
            if (!$result1) {
                $message1 = 'Invalid query: ' . mysqli_connect_error() . "\n";
                $message1 .= 'Whole query: ' . $query1;
                die($message1);
            }
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $dataTotal1[] = array(
                    "totalVetted" => $row1["totalVetted"],
                    "totalNotVetted" => $row1["totalNotVetted"]
                );
            }
            $totalVetted1 = $dataTotal1[0]['totalVetted'];
            $totalNotVetted1 = $dataTotal1[0]['totalNotVetted'];

            $mysqli1->close();
            ?>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Status', 'Total'],
                        ['Vetted',<?php echo $totalVetted1?>],
                        ['Not Vetted',<?php echo $totalNotVetted1?>]
                    ])
                    var options = {
                        title: 'Organizations'
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechartOrgs'));
                    chart.draw(data, options);
                }
            </script>

            <?php

            //****************************ORGSXCOUNTRY************************************************
            //Connection to DB

            $mysqli4 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");

            // check connection
            if ($mysqli4->connect_errno) {
                printf("Connect failed: %s\n", $mysqli4->connect_error);
                exit();
            }
//***************************************Vetted*********************
//Data from Vetted Orgs
            $query4 = "call sp_getOrgsStats('Vetted');";
            $result4 = $mysqli4->query($query4);
            if (!$result4) {
                $message4 = 'Invalid query: ' . mysqli_connect_error() . "\n";
                $message4 .= 'Whole query: ' . $query4;
                die($message4);
            }

            while ($row4 = mysqli_fetch_assoc($result4)) {
                $dataOrgsVetted[] = array(
                    "Country" => $row4["country"],
                    "Total" => $row4["total"]

                );
            }


            //***************************************Not Vetted*********************
//Data from Not Vetted Orgs
            $mysqli = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
            $query = "call sp_getOrgsStats('Not Vetted');";
            $result = $mysqli->query($query);
            if (!$result) {
                $message = 'Invalid query: ' . mysqli_connect_error() . "\n";
                $message .= 'Whole query: ' . $query;
                die($message);
            }

            while ($row = mysqli_fetch_assoc($result4)) {
                $dataOrgsNotVetted[] = array(
                    "Country" => $row["country"],
                    "Total" => $row["total"]

                );
            }

            ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Country', 'Total'],<?php
            $finalString="";
            for ($i = 0; $i < sizeof($dataOrgsVetted); $i++) {
                $co = array_values((array_values($dataOrgsVetted)[$i]))[0];
                $coTotal = array_values((array_values($dataOrgsVetted)[$i]))[1];
                $finalString = $finalString . "['" . $co . "'," . $coTotal . "],";
            }
            echo $finalString;

            ?>

        ])
        var options = {
            title: 'Organizations Vetted X Country'
        };


        var chart = new google.visualization.PieChart(document.getElementById('piechartOrgsXCountry'));

        chart.draw(data, options);
    }


</script>

<?php
            $mysqli4->close();

        }

}

