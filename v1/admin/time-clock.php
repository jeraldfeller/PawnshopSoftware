<?php
require '../Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Time Clock';

$adminClass = new Admin();
$userClass = new Users();
$view = new adminView();

if(isset($_POST['change'])){
    $userClass->updateTimeClockPeriod();
}


$month = date('m');
$year = date('Y');


$time_clock_period = $userClass->getTimeClockPeriod();
if($time_clock_period[0]['no_days'] == 7){
    $week = 'last week';
}else{
    $week = 'previous week';
}
$no_days = $time_clock_period[0]['no_days'] - 1;
$start = date("Y-m-d",strtotime($time_clock_period[0]['starting_day'] . $week));
$end = date('Y-m-d', strtotime($start . ' + ' . $no_days . ' days'));

if(isset($_GET['date_start'])){
    $start = $_GET['date_start'];
    $end = $_GET['date_end'];
}else{

    if($time_clock_period[0]['no_days'] == 7){
        $week = 'last week';
    }else{
        $week = 'previous week';
    }
    $start = date("Y-m-d",strtotime($time_clock_period[0]['starting_day'] . $week));
    $end = date('Y-m-d', strtotime($start . ' + ' . $no_days . ' days'));
}

$dateRange = $adminClass->createDateRangeArray($start, $end);


foreach($dateRange as $key => $range){
    $dateArr[] =  $range;
}

if(isset($_POST['staff'])){
    if($_POST['staff'] == 'all'){
        $_SESSION['vertical'] = 0;
        $_SESSION['panel_heading'] = "Employee Activity";
        $_SESSION['user'] = $userClass->getAllUsers();
        $users = $_SESSION['user'];
        $attendance = $userClass->getAllUserAttendance($start, $end);
        $_SESSION['staff_select'] = 'all';

    }else{
        $_SESSION['vertical'] = 1;
        $_SESSION['user'] = $userClass->getUserById($_POST['staff']);
        $users = $_SESSION['user'];
        $_SESSION['panel_heading'] = $users[0]['first_name'] . ' ' . $users[0]['last_name'];
        $attendance = $userClass->getAllUserAttendanceById($users[0]['id'], $start, $end);
        $_SESSION['staff_select'] = $users[0]['id'];

    }

}else{

    $panel_heading = "Employee Activity";
    $users = $userClass->getAllUsers();
    $attendance = $userClass->getAllUserAttendance($start, $end);
}
if(!isset($_SESSION['staff_select'])){
    $staff_select = 'all';
}else{
    $staff_select = $_SESSION['staff_select'];
}
if(!isset($_SESSION['user'])){
    $users = $userClass->getAllUsers();
}else{
    $users = $_SESSION['user'];
}
if(!isset($_SESSION['vertical'])){
    $vertical = 0;
}else{
    $vertical = $_SESSION['vertical'];
}
if(!isset($_SESSION['panel_heading'])){
    $panel_heading = 'Employee Activity';
}else{
    $panel_heading = $_SESSION['panel_heading'];
}



$arr = array();
foreach($users as $user){
    $inArr = array();
    $outArr = array();
    $date = array();
    foreach($attendance as $row){
        if($row['user_id'] == $user['id']){
            $date[$row['date']] = array('time_in' => $row['time_in'], 'time_out' => $row['time_out']);
        }
    }
    $arr[$user['id']] = $date;
}

$usersSelect = $userClass->getAllUsers();


require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Time Clock</li>
                                </ul>
                                <h4>Time Clock</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->

                        <div class="row">
                            <div class="col-lg-12">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="row">
                                <div class="col-lg-2">
                                <h4 class="box-heading">Pay Period</h4>
                                    <div class="input-group col-lg-12">
                                        <select name="period" class="form-control">
                                            <?php
                                            if($time_clock_period[0]['period'] == 'weekly'){
                                                $weeklySelect = 'selected';
                                            }else{
                                                $weeklySelect = ' ';
                                            }
                                            if($time_clock_period[0]['period'] == 'biweekly'){
                                                $biWeeklySelect = 'selected';
                                            }else{
                                                $biWeeklySelect = ' ';
                                            }
                                            ?>
                                            <option value="weekly" <?php echo $weeklySelect; ?>>Weekly</option>
                                            <option value="biweekly" <?php echo $biWeeklySelect; ?>>Biweekly</option>
                                        </select>
                                    </div>
                                    <div class="mbl"></div>
                                </div>
                                <div class="col-lg-2">
                                    <h4 class="box-heading">Starting day</h4>
                                    <div class="input-group col-lg-12">
                                        <select name="starting_day" class="form-control">
                                            <?php
                                            if($time_clock_period[0]['starting_day'] == 'monday'){
                                                $monSelect = 'selected';
                                            }else{
                                                $monSelect = ' ';
                                            }
                                            if($time_clock_period[0]['starting_day'] == 'tuesday'){
                                                $tueSelect = 'selected';
                                            }else{
                                                $tueSelect = ' ';
                                            }
                                            if($time_clock_period[0]['starting_day'] == 'wednesday'){
                                                $wedSelect = 'selected';
                                            }else{
                                                $wedSelect = ' ';
                                            }
                                            if($time_clock_period[0]['starting_day'] == 'thursday'){
                                                $thuSelect = 'selected';
                                            }else{
                                                $thuSelect = ' ';
                                            }
                                            if($time_clock_period[0]['starting_day'] == 'friday'){
                                                $friSelect = 'selected';
                                            }else{
                                                $friSelect = ' ';
                                            }
                                            if($time_clock_period[0]['starting_day'] == 'saturday'){
                                                $satSelect = 'selected';
                                            }else{
                                                $satSelect = ' ';
                                            }
                                            if($time_clock_period[0]['starting_day'] == 'sunday'){
                                                $sunSelect = 'selected';
                                            }else{
                                                $sunSelect = ' ';
                                            }
                                            ?>
                                            <option value="monday" <?php echo $monSelect; ?>>Monday</option>
                                            <option value="tuesday" <?php echo $tueSelect; ?>>Tuesday</option>
                                            <option value="wednesday" <?php echo $wedSelect; ?>>Wednesday</option>
                                            <option value="thursday" <?php echo $thuSelect; ?>>Thursday</option>
                                            <option value="friday" <?php echo $friSelect; ?>>Friday</option>
                                            <option value="saturday" <?php echo $satSelect; ?>>Saturday</option>
                                            <option value="sunday" <?php echo $sunSelect; ?>>Sunday</option>
                                        </select>
                                    </div>
                                    <div class="mbl"></div>
                                </div>

                                <div class="col-lg-2">
                                    <h4 class="box-heading"># of Days</h4>
                                    <div class="input-group col-lg-12">
                                        <select name="no_days" class="form-control">
                                            <?php
                                            if($time_clock_period[0]['no_days'] == '7'){
                                                $sevenSelect = 'selected';
                                            }else{
                                                $sevenSelect = ' ';
                                            }
                                            if($time_clock_period[0]['no_days'] == '14'){
                                                $fourtheenSelect = 'selected';
                                            }else{
                                                $fourtheenSelect = ' ';
                                            }
                                            ?>

                                            <option value="7" <?php echo $sevenSelect; ?>>7</option>
                                            <option value="14" <?php echo $fourtheenSelect; ?>>14</option>
                                        </select>
                                    </div>
                                    <div class="mbl"></div>
                                </div>
                                <div class="col-lg-2">
                                    <h4 class="box-heading">&nbsp;</h4>
                                    <div class="input-group col-lg-12">
                                        <input type="hidden" name="id" value="<?php echo $time_clock_period[0]['id']; ?>">
                                        <button type="submit" name="change" class="btn btn-primary">Change</button>
                                    </div>
                                    <div class="mbl"></div>
                                </div>
                            </div>
                        </form>
                                <br>

                                <div class="col-lg-12">
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <div class="row">
                            <div class="input-group  col-lg-7">
                                  <span class="input-group-btn">
                                      <?php
                                        echo '<a class="btn btn-default" href="' . $_SERVER["PHP_SELF"] . '?date_start=' . date("Y-m-d", strtotime($start . ' - 7 days')) . '&date_end=' . date('Y-m-d', strtotime($end . ' - 7 days')) . '"><i class="fa fa-arrow-left"></i></a>';
                                        if($start == date("Y-m-d",strtotime('monday this week'))){
                                            echo '<a><button class="btn btn-primary" disabled><i class="fa fa-arrow-right"></i></button></a>';
                                        }else{
                                            echo '<a class="btn btn-default" href="' . $_SERVER["PHP_SELF"] . '?date_start=' . date("Y-m-d", strtotime($start . ' + 7 days')) . '&date_end=' . date('Y-m-d', strtotime($end . ' + 7 days')) . '"><i class="fa fa-arrow-right"></i></a>';
                                        }
                                        ?>
                                      </span>
                                  <input type="text" class="form-control" value="<?php echo date('D, F d Y', strtotime($start)) . ' - ' . date('D, F d Y', strtotime($end)); ?>" disabled>

                                <span class="input-group-btn" style="opacity: 0;">
                                    <button class="btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                                      </span>



                                <select class="form-control" name="staff">
                                    <option value="all">All</option>
                                    <?php
                                    foreach($usersSelect as $user){
                                        if($staff_select == $user['id']){
                                            $select = 'selected';
                                        }else{
                                            $select = '';
                                        }
                                        echo '<option value="' . $user['id'] . '" ' . $select . '>' . $user['first_name'] . ' ' . $user['last_name'] . '</option>';
                                    }
                                    ?>
                                </select>

                                <span class="input-group-btn">
                                    <button style="height: 38px;"  type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                      </span>


                            </div>





                        </div>
                        </form>

                                <br>

                        <div class="row">
                            <div class="table-responsive">
                            <table class="table table-hover table-primary mb30">
                                            <thead>
                                            <tr>
                                                <?php if($vertical == 0) { ?>


                                                <th>Employee</th>
                                                <?php
                                                foreach($dateArr as $key => $range) {
                                                    echo '<th>' . date('D, M d', strtotime($range)) . '</th>';
                                                }

                                                ?>
                                                <th>Weekly Total</th>
                                            <?php }else { ?>
                                                <th>Date</th>
                                                <th>Hours rendered</th>
                                            <?php } ?>
                                            </tr>
                                            </thead>
                                            <tbody class="align-center" id="displayAttendance">
                                              <?php echo $view->displayUserAttendanceInitial($arr, $dateArr, $userClass, $vertical); ?>
                                            </tbody>
                                        </table>
                                </div>

                    </div>


                    </div> <!-- end of col-lg-12-->
                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>