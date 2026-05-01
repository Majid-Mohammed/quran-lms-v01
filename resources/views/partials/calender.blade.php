{{-- 

 <div class="side-calendars-container col-3 border rounded-3 p-1 bg-body-tertiary">

    <style type="text/css">
        .side-calendars-container {
            position: fixed;
            left: 10px;
            top: auto;
			padding-top: 10px;
            width: 270px;
            z-index: 1000;
            display: flex;
            flex-direction: column; /* ترتيب عمودي */
            gap: 15px; /* مسافة بين التقويمين */
            max-height: 95vh;
            overflow-y: auto; /* إضافة تمرير إذا كانت الشاشة صغيرة */
        }

        /* تنسيق عام مشترك للتقويمات */
        .calendar-box {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            font-family: 'Segoe UI', Arial, sans-serif;
            border: 1px solid #e1e4e8;
        }

        .calendar-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .calendar-header { padding: 12px; text-align: center; color: #fff; font-weight: bold; }
        .day-name { font-size: 10px; font-weight: bold; padding: 8px 0; text-align: center; background: #f8f9fa; }
        .calendar-table td { height: 35px; text-align: center; font-size: 13px; }
        
        /* تقويم هجري (أخضر) */
        .hijri-style .calendar-header { background-color: #1a4731; }
        .hijri-style .is-today { background-color: #2e7d32; color: #fff; border-radius: 50%; width: 28px; height: 28px; margin: auto; display: flex; align-items: center; justify-content: center; }

        /* تقويم ميلادي (أزرق) */
        .gregorian-style .calendar-header { background-color: #2c3e50; }
        .gregorian-style .is-today { background-color: #3182ce; color: #fff; border-radius: 50%; width: 28px; height: 28px; margin: auto; display: flex; align-items: center; justify-content: center; }

        .sun-text { color: #e53e3e !important; }
        a { text-decoration: none; color: inherit; display: block; }
    </style>

    <?php 
    // دالة التحويل للهجري
    function toHijri($d, $m, $y) {
        if ($m < 3) { $y -= 1; $m += 12; }
        $a = floor($y / 100); $b = 2 - $a + floor($a / 4);
        $jd = floor(365.25 * ($y + 4716)) + floor(30.6001 * ($m + 1)) + $d + $b - 1524.5;
        $z = $jd + 0.5; $cyc = floor(($z - 1948440) / 10631);
        $l = $z - 1948440 - $cyc * 10631; $j = floor(($l - 0.1) / 354.366);
        $res_l = $l - floor($j * 354.366 + 0.5); $res_m = floor(($res_l - 1) / 29.5);
        $res_d = $res_l - floor($res_m * 29.5 + 0.5); $res_y = $cyc * 30 + $j;
        return [$res_d, $res_m + 1, $res_y];
    }

    $today = getdate();
    $day = $today['mday']; $mon = $today['mon']; $year = $today['year'];

    // بيانات الهجري
    list($hD, $hM, $hY) = toHijri($day, $mon, $year);
    $hMonths = [1=>"محرم","صفر","ربيع الأول","ربيع الآخر","جمادى الأولى","جمادى الآخرة","رجب","شعبان","رمضان","شوال","ذو القعدة","ذو الحجة"];
    
    // بيانات الميلادي
    $gMonths = [1=>"يناير","فبراير","مارس","أبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر"];
    ?>

    <div class="calendar-box hijri-style">
        <div class="calendar-header"><?php echo $hMonths[$hM] . " " . $hY . " هـ"; ?></div>
        <table class="calendar-table">
            <tr class="day-name-row">
                <?php foreach(["أحد","إثنين","ثلاثاء","أربعاء","خميس","جمعة","سبت"] as $index => $dn) 
                      echo "<td class='day-name ".($index==5?'sun-text':'')."'>$dn</td>"; ?>
            </tr>
            <tr>
                <?php
                $firstH = strtotime("-" . ($hD - 1) . " days");
                $startW = date('w', $firstH);
                for($i=0; $i<$startW; $i++) echo "<td></td>";
                $currCol = $startW;
                $daysH = ($hM==12 || $hM%2!=0)?30:29;
                for($d=1; $d<=$daysH; $d++) {
                    $todayClass = ($d==$hD) ? "is-today" : "";
                    echo "<td><div class='$todayClass'>$d</div></td>";
                    $currCol++;
                    if($currCol > 6 && $d < $daysH) { echo "</tr><tr>"; $currCol = 0; }
                }
                while($currCol <= 6 && $currCol > 0) { echo "<td></td>"; $currCol++; }
                ?>
            </tr>
        </table>
    </div>

    <div class="calendar-box gregorian-style">
        <div class="calendar-header"><?php echo $gMonths[$mon] . " " . $year; ?></div>
        <table class="calendar-table">
            <tr class="day-name-row">
                <?php foreach(["أحد","إثنين","ثلاثاء","أربعاء","خميس","جمعة","سبت"] as $index => $dn) 
                      echo "<td class='day-name ".($index==5?'sun-text':'')."'>$dn</td>"; ?>
            </tr>
            <tr>
                <?php
                $firstG = mktime(0,0,0,$mon,1,$year);
                $startW = date('w', $firstG);
                $daysG = date('t', $firstG);
                for($i=0; $i<$startW; $i++) echo "<td></td>";
                $currCol = $startW;
                for($d=1; $d<=$daysG; $d++) {
                    $todayClass = ($d==$day) ? "is-today" : "";
                    echo "<td><div class='$todayClass'>$d</div></td>";
                    $currCol++;
                    if($currCol > 6 && $d < $daysG) { echo "</tr><tr>"; $currCol = 0; }
                }
                while($currCol <= 6 && $currCol > 0) { echo "<td></td>"; $currCol++; }
                ?>
            </tr>
        </table>
    </div>
</div> --}}

<style type="text/css">
    /* تحسين حاوية التقويمات لتكون متجاوبة */
    .side-calendars-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        z-index: 1000;
    }
    /* normal  screen */
    @media (min-width: 992px) {
        .side-calendars-container {
            position: fixed;
            left: 20px;
            top: 80px;
            width: 280px; /* زدنا العرض قليلاً لاستيعاب الأسماء الطويلة */
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }
        .main-content-wrapper {
            margin-left: 310px; 
        }
    }

    @media (max-width: 991.98px) {
        .side-calendars-container {
            position: static;
            width: 100%;
            margin-top: 20px;
            order: 2;
        }
        .main-content-wrapper { margin-right: 0;position: relative; order: 1;width: 100%; }
    }

    .calendar-box {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid #e1e4e8;
    }
    .calendar-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .calendar-header { padding: 10px; text-align: center; color: #fff; font-weight: bold; font-size: 0.95rem; }
    
    /* تعديل تنسيق اسم اليوم ليستوعب الكلمات الطويلة */
    .day-name { 
        font-size: 9px; /* صغرنا الخط قليلاً */
        font-weight: normal; 
        padding: 5px 0; 
        text-align: center; 
        background: #f8f9fa; 
        white-space: nowrap; /* منع انقسام الكلمة لسطرين */
    }
    
    .calendar-table td { height: 20px; text-align: center; font-size: 13px; }
    .hijri-style .calendar-header { background-color: #1a4731; }
    .hijri-style .is-today { background-color: #2e7d32; color: #fff; border-radius: 50%; width: 28px; height: 28px; margin: auto; display: flex; align-items: center; justify-content: center; }
    .gregorian-style .calendar-header { background-color: #2c3e50; }
    .gregorian-style .is-today { background-color: #3182ce; color: #fff; border-radius: 50%; width: 28px; height: 28px; margin: auto; display: flex; align-items: center; justify-content: center; }
    .sun-text { color: #e53e3e !important; }
    .calendar-table { border-collapse: separate; border-spacing: 2px; table-layout: fixed; }
    .day-cell { 
        width: 28px; height: 28px; line-height: 28px; 
        margin: 2px auto; font-size: 0.8rem; border-radius: 50%;
    }
    .is-today { font-weight: bold; }
    .calendar-header { font-size: 0.85rem; }
</style>

<div class="col-12 col-lg-3 side-calendars-container">
    <?php 
        use Alkoumi\LaravelHijriDate\Hijri;
        use Illuminate\Support\Carbon;

        // بيانات اليوم (ميلادي)
        $today = Carbon::now();
        
        // الحصول على التاريخ الهجري كـ String ثم تحويله لمصفوفة
        // المكتبة توفر دالة Hijri::Date() التي تعيد التاريخ الحالي
        $hDateString = Hijri::Date('Y/m/d'); // مثال: 1447/08/05
        $hParts = explode('/', $hDateString);
        
        $hY = (int)$hParts[0];
        $hM = (int)$hParts[1];
        $hD = (int)$hParts[2];

        // مصفوفات الأسماء
        $hMonths = [1=>"محرم","صفر","ربيع الأول","ربيع الآخر","جمادى الأولى","جمادى الآخرة","رجب","شعبان","رمضان","شوال","ذو القعدة","ذو الحجة"];
        $gMonths = [1=>"يناير","فبراير","مارس","أبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر"];
        $fullDays = ["الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"];
        
        $hMonthName = $hMonths[$hM];
    ?>

    {{-- التقويم الهجري --}}
    <div class="calendar-box hijri-style mb-1 shadow-sm border-0">
        <div class="calendar-header bg-success text-white text-center p-2 rounded-top fw-bold">
            <i class="bi bi-moon-stars-fill me-1"></i>
            {{ $hMonthName }} {{ $hY }} هـ
        </div>
        <table class="calendar-table w-100 text-center bg-white rounded-bottom">
            <tr class="day-name-row bg-light text-muted small">
                <?php foreach($fullDays as $dn) echo "<td class='py-1'>$dn</td>"; ?>
            </tr>
            <tr>
                <?php
                // حساب بداية الشهر الهجري: نرجع للخلف بعدد الأيام المنقضية من الشهر
                $firstDayTimestamp = strtotime("-" . ($hD - 1) . " days");
                $startW = date('w', $firstDayTimestamp); 

                for($i=0; $i<$startW; $i++) echo "<td></td>";
                
                $currCol = $startW;
                $daysInMonth = ($hM % 2 != 0) ? 30 : 29; 

                for($d=1; $d<=$daysInMonth; $d++) {
                    $isToday = ($d == $hD) ? "is-today bg-success text-white shadow" : "";
                    echo "<td><div class='day-cell $isToday'>$d</div></td>";
                    $currCol++;
                    if($currCol > 6 && $d < $daysInMonth) { echo "</tr><tr>"; $currCol = 0; }
                }
                while($currCol <= 6 && $currCol > 0) { echo "<td></td>"; $currCol++; }
                ?>
            </tr>
        </table>
    </div>

    {{-- التقويم الميلادي --}}
    <div class="calendar-box gregorian-style shadow-sm border-0">
        <div class="calendar-header bg-dark text-white text-center p-2 rounded-top fw-bold">
            <i class="bi bi-calendar3 me-1"></i>
            {{ $gMonths[$today->month] }} {{ $today->year }}
        </div>
        <table class="calendar-table w-100 text-center bg-white rounded-bottom">
            <tr class="day-name-row bg-light text-muted small">
                <?php foreach($fullDays as $dn) echo "<td class='py-1'>$dn</td>"; ?>
            </tr>
            <tr>
                <?php
                $daysInG = $today->daysInMonth;
                $startWG = $today->copy()->startOfMonth()->dayOfWeek;
                
                for($i=0; $i<$startWG; $i++) echo "<td></td>";
                $currColG = $startWG;
                for($d=1; $d<=$daysInG; $d++) {
                    $isTodayG = ($d == $today->day) ? "is-today bg-primary text-white shadow" : "";
                    echo "<td><div class='day-cell $isTodayG'>$d</div></td>";
                    $currColG++;
                    if($currColG > 6 && $d < $daysInG) { echo "</tr><tr>"; $currColG = 0; }
                }
                while($currColG <= 6 && $currColG > 0) { echo "<td></td>"; $currColG++; }
                ?>
            </tr>
        </table>
    </div>
</div>

