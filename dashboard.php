<?php
    
    session_start();
    if (!isset($_SESSION['Username'])) {
        header("Location: index.php");
        exit();
    }
    include 'includes/database.php';
    include 'includes/action.php';

    $sql = "SELECT * FROM Employee";
    $res = $databaseObject->connect()->query($sql);

    $formattedRemainingBirds = number_format((float) ($remainingBirds ?? 0));
    $formattedTotalBirds = number_format((float) ($totalNumberOfBirds ?? 0));
    $formattedMortalityRate = number_format((float) ($mortalityRate ?? 0), 1);
    $formattedTotalEggs = number_format((float) ($totalNumberOfEggs ?? 0));
    $formattedEmployees = number_format((int) ($totalNumberOfEmployees ?? 0));
    $formattedRemainingEggs = number_format((float) max($remainingEggs ?? 0, 0));
    $formattedTotalWages = number_format((float) ($totalWages ?? 0), 2);
    $formattedSales = number_format((float) ($sales ?? 0), 2);
    $formattedFeedQuantity = number_format((float) max($remainingFeed ?? 0, 0));
    $feedAlertClass = ($remainingFeed ?? 0) <= 0 ? ' resource-status__item--alert' : '';
    $eggsAlertClass = ($remainingEggs ?? 0) <= 0 ? ' resource-status__item--alert' : '';
?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_head.php";?>
<body id="body">
    <div class="container">
        <!-- top navbar -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_top_navbar.php";?>
        <main>
            <div class="main__container">
                <section class="dashboard-overview">
                    <div class="dashboard-header">
                        <div class="dashboard-header__content">
                            <span class="dashboard-header__tag">Farm snapshot</span>
                            <h1 class="dashboard-header__title">Hello<?php echo ', ' . $_SESSION["Username"] . '.';?></h1>
                            <p class="dashboard-header__subtitle">Welcome to your dashboard</p>
                        </div>
                        <div class="dashboard-header__meta">
                            <p class="dashboard-header__date">Refreshed on <?php echo date('F j, Y'); ?></p>
                            <ul class="dashboard-actions">
                                <li><a href="birdsPurchase.php">Record birds purchase</a></li>
                                <li><a href="production.php">Log egg production</a></li>
                                <li><a href="feedPurchase.php">Add feed purchase</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="summary-grid">
                        <article class="summary-card summary-card--birds">
                            <div class="summary-card__header">
                                <span class="summary-card__icon"><i class="fa fa-paw" aria-hidden="true"></i></span>
                                <span class="summary-card__label">Active birds</span>
                            </div>
                            <p class="summary-card__value"><?php echo $formattedRemainingBirds; ?></p>
                            <p class="summary-card__note">Purchased to date: <?php echo $formattedTotalBirds; ?></p>
                        </article>

                        <article class="summary-card summary-card--mortality">
                            <div class="summary-card__header">
                                <span class="summary-card__icon"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                                <span class="summary-card__label">Mortality rate</span>
                            </div>
                            <p class="summary-card__value"><?php echo $formattedMortalityRate; ?><span class="summary-card__unit">%</span></p>
                            <p class="summary-card__note">Monitoring flock wellbeing</p>
                        </article>

                        <article class="summary-card summary-card--eggs">
                            <div class="summary-card__header">
                                <span class="summary-card__icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></span>
                                <span class="summary-card__label">Eggs collected</span>
                            </div>
                            <p class="summary-card__value"><?php echo $formattedTotalEggs; ?></p>
                            <p class="summary-card__note">Available for sale: <?php echo $formattedRemainingEggs; ?></p>
                        </article>

                        <article class="summary-card summary-card--team">
                            <div class="summary-card__header">
                                <span class="summary-card__icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <span class="summary-card__label">Team members</span>
                            </div>
                            <p class="summary-card__value"><?php echo $formattedEmployees; ?></p>
                            <p class="summary-card__note">Supporting daily operations</p>
                        </article>
                    </div>

                    <div class="dashboard-insights">
                        <section class="insight-card insight-card--payroll">
                            <div class="insight-card__header">
                                <div>
                                    <h2 class="insight-card__title">Payroll visualization</h2>
                                    <p class="insight-card__subtitle">Job titles and their respective salaries</p>
                                </div>
                                <span class="insight-card__icon"><i class="fa fa-money" aria-hidden="true"></i></span>
                            </div>
                            <div id="piechart_3d" class="dashboard-chart"></div>
                        </section>

                        <aside class="insight-sidebar">
                            <div class="insight-panel">
                                <div class="insight-panel__header">
                                    <h3 class="insight-panel__title">Financial summary</h3>
                                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                                </div>
                                <ul class="insight-panel__stats">
                                    <li>
                                        <span class="insight-panel__label">Total wages</span>
                                        <span class="insight-panel__value"><?php echo 'GHC ' . $formattedTotalWages; ?></span>
                                    </li>
                                    <li>
                                        <span class="insight-panel__label">Sales revenue</span>
                                        <span class="insight-panel__value"><?php echo 'GHC ' . $formattedSales; ?></span>
                                    </li>
                                </ul>
                            </div>

                            <div class="insight-panel insight-panel--status">
                                <div class="insight-panel__header">
                                    <h3 class="insight-panel__title">Resource status</h3>
                                    <i class="fa fa-leaf" aria-hidden="true"></i>
                                </div>
                                <div class="resource-status">
                                    <div class="resource-status__item<?php echo $feedAlertClass; ?>">
                                        <div class="resource-status__label">Feed remaining</div>
                                        <?php if(($remainingFeed ?? 0) > 0){ ?>
                                            <div class="resource-status__value"><?php echo $formattedFeedQuantity . ' Kg'; ?></div>
                                            <p class="resource-status__hint">Keep monitoring stock levels.</p>
                                        <?php } else { ?>
                                            <div class="resource-status__value resource-status__value--alert">Please refill the feed stock!</div>
                                        <?php } ?>
                                    </div>
                                    <div class="resource-status__item<?php echo $eggsAlertClass; ?>">
                                        <div class="resource-status__label">Eggs available</div>
                                        <?php if(($remainingEggs ?? 0) > 0){ ?>
                                            <div class="resource-status__value"><?php echo $formattedRemainingEggs; ?></div>
                                            <p class="resource-status__hint">Ready to fulfil customer orders.</p>
                                        <?php } else { ?>
                                            <div class="resource-status__value resource-status__value--alert">Nothing to sell!</div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="insight-panel insight-panel--actions">
                                <div class="insight-panel__header">
                                    <h3 class="insight-panel__title">Quick links</h3>
                                    <i class="fa fa-external-link" aria-hidden="true"></i>
                                </div>
                                <ul class="quick-links">
                                    <li><a href="birdsMortality.php">Update mortality records</a></li>
                                    <li><a href="feedConsumption.php">Track feed consumption</a></li>
                                    <li><a href="sales.php">Capture egg sales</a></li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </section>
            </div>
        </main>
        <!-- sidebar nav -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_side_bar.php";?>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Employee', 'Salary'],
                <?php
                    while($row=$res->fetch_assoc()){
                        echo "['".$row['Job']."',".$row['Salary']."],";
                    }
                ?>   
            ]);
            var options = {
                title: 'Titles and Salaries',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
    <script src="script.js"></script>
</body>
</html>
