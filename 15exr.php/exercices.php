<?php

session_start();


if (!file_exists(__DIR__ . '/uploads')) {
    mkdir(__DIR__ . '/uploads', 0755, true);
} 

$selected = $_POST['exo'] ?? null;
$action = $_POST['action'] ?? null;
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>سلسلة تمارين PHP — ديناميكي</title>
<style>
    body { font-family: "Tahoma","Arial"; background:#f3f6fb; margin:0; padding:20px; direction:rtl; }
    .container { max-width:980px; margin:0 auto; }
    header { text-align:center; margin-bottom:18px; }
    select,input,textarea { padding:8px; font-size:15px; border-radius:6px; border:1px solid #cfd8e3; }
    .panel { background:#fff; padding:18px; border-radius:10px; box-shadow:0 6px 18px rgba(20,30,60,0.06); margin-bottom:16px; }
    .row { display:flex; gap:12px; flex-wrap:wrap; align-items:center; }
    label { min-width:140px; font-weight:600; }
    button { padding:10px 14px; border-radius:8px; border:0; background:#2b8cff; color:#fff; cursor:pointer; }
    pre { background:#f0f4ff; padding:12px; border-radius:6px; overflow:auto; }
    .small { font-size:13px; color:#666; }
</style>
</head>
<body>
<div class="container">
<header>
    <h1>سلسلة تمارين PHP للمبتدئين — (ديناميكي)</h1>
    <p class="small">اختر رقم التمرين ثم أدخل القيم المطلوبة وسيظهر الحل أدناه.</p>
</header>

<div class="panel">
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <label>اختر التمرين:</label>
            <select name="exo" onchange="this.form.submit()">
                <option value="">-- اختر --</option>
                <?php for($i=1;$i<=15;$i++): ?>
                    <option value="<?= $i ?>" <?= ($selected == $i) ? 'selected' : '' ?>>تمرين <?= $i ?></option>
                <?php endfor; ?>
            </select>
            <span class="small">(الصفحة واحدة، جميع التمارين ديناميكية)</span>
        </div>
    </form>
</div>

<?php if($selected): ?>
<div class="panel">
    <h3>حل التمرين رقم <?= htmlspecialchars($selected) ?></h3>

    <?php
    // ========== تمرين 1: طباعة نص ومتحولات ==========
    if($selected == 1):
        // فورم ديناميكي لإدخال الاسم والرسالة
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==1 && isset($_POST['name'])){
            $name = trim($_POST['name']);
            echo "<p>النتيجة: مرحباً يا " . htmlspecialchars($name) . "!</p>";
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="1">
            <div class="row">
                <label>أدخل الاسم:</label>
                <input type="text" name="name" placeholder="مثال: Ali" required>
                <button type="submit">طباعة الترحيب</button>
            </div>
        </form>
    <?php
        }
    endif;
    // ========== تمرين 2: العمليات الحسابية ==========
    if($selected == 2):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==2 && isset($_POST['a'])){
            $a = (float)$_POST['a']; $b = (float)$_POST['b'];
            echo "<pre>";
            echo "a = $a, b = $b\n";
            echo "الجمع = " . ($a+$b) . "\n";
            echo "الطرح = " . ($a-$b) . "\n";
            echo "الضرب = " . ($a*$b) . "\n";
            echo "القسمة = " . (($b!=0)?($a/$b):'خطأ - قسمة على صفر') . "\n";
            echo "الباقي = " . ((int)$a % (int)$b) . "\n";
            echo "</pre>";
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="2">
            <div class="row">
                <label>العدد الأول (a):</label>
                <input type="number" step="any" name="a" required>
                <label>العدد الثاني (b):</label>
                <input type="number" step="any" name="b" required>
                <button type="submit">احسب</button>
            </div>
        </form>
    <?php
        }
    endif;

    // ========== تمرين 3: موجب/سالب/صفر ==========
    if($selected == 3):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==3 && isset($_POST['n'])){
            $n = (float)$_POST['n'];
            if($n>0) $res = "العدد موجب";
            elseif($n<0) $res = "العدد سالب";
            else $res = "العدد يساوي صفر";
            echo "<p>الرقم: " . htmlspecialchars($_POST['n']) . " → <strong>$res</strong></p>";
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="3">
            <div class="row">
                <label>أدخل رقم:</label>
                <input type="number" step="any" name="n" required>
                <button type="submit">تحقق</button>
            </div>
        </form>
    <?php
        }
    endif;

    
    if($selected == 4):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==4 && isset($_POST['d'])){
            $d = (int)$_POST['d'];
            $names = [1=>'الاثنين',2=>'الثلاثاء',3=>'الأربعاء',4=>'الخميس',5=>'الجمعة',6=>'السبت',7=>'الأحد'];
            $out = $names[$d] ?? "غير معروف";
            echo "<p>الرقم $d = <strong>$out</strong></p>";
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="4">
            <div class="row">
                <label>أدخل رقم من 1 إلى 7:</label>
                <input type="number" name="d" min="1" max="7" required>
                <button type="submit">عرض اليوم</button>
            </div>
        </form>
    <?php
        }
    endif;
    if($selected == 5):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==5 && isset($_POST['num'])){
            $num = (int)$_POST['num'];
            echo "<h4>جدول الضرب للعدد $num</h4><pre>";
            for($i=1;$i<=10;$i++) echo "$num x $i = " . ($num*$i) . "\n";
            echo "</pre>";
            echo "<h4>العد التنازلي من 10 إلى 1</h4><pre>";
            for($i=10;$i>=1;$i--) echo "$i ";
            echo "</pre>";
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="5">
            <div class="row">
                <label>أدخل رقم لجدول الضرب:</label>
                <input type="number" name="num" required>
                <button type="submit">عرض</button>
            </div>
        </form>
    <?php
        }
    endif;

  
    if($selected == 6):
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==6 && isset($_POST['add'])){
            $name = trim($_POST['add']);
            $list = $_POST['list'] ?? [];
            
            if(!isset($_SESSION['students'])) $_SESSION['students'] = ["Ali","Sara","Mounir","Nada","Hassan"];
            if($name!=="") $_SESSION['students'][] = $name;
            $students = $_SESSION['students'];
            echo "<p>عدد الطلاب: " . count($students) . "</p>";
            echo "<pre>" . implode("\n", $students) . "</pre>";
        } else {
            if(!isset($_SESSION['students'])) $_SESSION['students'] = ["Ali","Sara","Mounir","Nada","Hassan"];
            $students = $_SESSION['students'];
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="6">
            <div class="row">
                <label>أضف اسم طالب:</label>
                <input type="text" name="add" placeholder="مثال: Samir">
                <button type="submit">أضف</button>
            </div>
        </form>
        <p>قائمة الطلاب الحالية (مخزنة في الجلسة):</p>
        <pre><?= implode("\n", $students) ?></pre>
    <?php
        }
    endif;
    if($selected == 7):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==7 && isset($_POST['nom'])){
            $nom = htmlspecialchars(trim($_POST['nom']));
            $age = (int)$_POST['age'];
            $filiere = htmlspecialchars(trim($_POST['filiere']));
            echo "<p>$nom عمره $age سنة ويتخصص في $filiere</p>";
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="7">
            <div class="row">
                <label>الاسم:</label><input type="text" name="nom" required>
                <label>العمر:</label><input type="number" name="age" required>
                <label>التخصص:</label><input type="text" name="filiere" required>
                <button type="submit">عرض</button>
            </div>
        </form>
    <?php
        }
    endif;
    if($selected == 8):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==8 && isset($_POST['notes'])){
            $raw = $_POST['notes'];
            $parts = array_filter(array_map('trim', explode(',', $raw)), fn($v)=>$v!=='' );
            $nums = array_map('floatval', $parts);
            if(count($nums)==0) echo "<p>لم تدخل أي علامات.</p>";
            else {
                $moy = array_sum($nums)/count($nums);
                echo "<p>العلامات: " . implode(", ", $nums) . "</p>";
                echo "<p>المتوسط = <strong>" . round($moy,2) . "</strong></p>";
            }
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="8">
            <div class="row" style="align-items:flex-start;">
                <label>أدخل العلامات مفصولة بفواصل:</label>
                <textarea name="notes" rows="2" cols="50" placeholder="مثال: 12,15,18,10" required></textarea>
            </div>
            <div class="row"><button type="submit">احسب المتوسط</button></div>
        </form>
    <?php
        }
    endif;
    if($selected == 9):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==9 && isset($_POST['text'])){
            $t = $_POST['text'];
            echo "<p>النص: " . htmlspecialchars($t) . "</p>";
            echo "<p>الطول: " . mb_strlen($t, 'UTF-8') . "</p>";
            echo "<p>حروف كبيرة: " . mb_strtoupper($t, 'UTF-8') . "</p>";
            echo "<p>استبدال (أدخل كلمة وسيطة):</p>";
            $from = $_POST['from'] ?? '';
            $to = $_POST['to'] ?? '';
            if($from!=='' ) {
                echo "<p>بعد الاستبدال: " . htmlspecialchars(str_replace($from, $to, $t)) . "</p>";
            }
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="9">
            <div class="row" style="flex-direction:column; align-items:flex-end;">
                <label>أدخل نصًا:</label>
                <textarea name="text" rows="3" cols="60" required></textarea>
                <div class="row">
                    <label>استبدال كلمة:</label>
                    <input type="text" name="from" placeholder="الكلمة القديمة">
                    <label>بالكلمة:</label>
                    <input type="text" name="to" placeholder="الكلمة الجديدة">
                </div>
                <button type="submit">تعالج النص</button>
            </div>
        </form>
    <?php
        }
    endif;

    if($selected == 10):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==10 && isset($_POST['name10'])){
            $n = htmlspecialchars(trim($_POST['name10']));
            $e = htmlspecialchars(trim($_POST['email10']));
            $m = htmlspecialchars(trim($_POST['msg10']));
            if($n=='' || $e=='' || $m=='') {
                echo "<p style='color:darkred'>يجب تعبئة كل الحقول.</p>";
            } else {
                echo "<p>✅ تم استلام النموذج بنجاح:</p>";
                echo "<pre>الاسم: $n\nالبريد: $e\nالرسالة: $m</pre>";
            }
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="10">
            <div class="row" style="flex-direction:column; align-items:flex-end;">
                <label>الاسم:</label><input type="text" name="name10" required>
                <label>البريد الإلكتروني:</label><input type="email" name="email10" required>
                <label>الرسالة:</label><textarea name="msg10" rows="3" cols="50" required></textarea>
                <button type="submit">أرسل</button>
            </div>
        </form>
    <?php
        }
    endif;
    if($selected == 11):
        // فورم رفع صورة
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==11 && isset($_FILES['file11'])){
            $f = $_FILES['file11'];
            if($f['error'] !== UPLOAD_ERR_OK){
                echo "<p style='color:red'>خطأ بالرفع.</p>";
            } else {
                // تحقق بسيط من النوع والحجم (<=2MB)
                $allowed = ['image/jpeg','image/png'];
                if($f['size'] <= 2*1024*1024 && in_array($f['type'],$allowed)){
                    $target = __DIR__ . '/uploads/' . basename($f['name']);
                    move_uploaded_file($f['tmp_name'],$target);
                    echo "<p>✅ تم حفظ الملف باسم: " . htmlspecialchars(basename($f['name'])) . "</p>";
                    echo "<p><img src='uploads/" . rawurlencode(basename($f['name'])) . "' alt='img' style='max-width:300px;border-radius:8px'></p>";
                } else {
                    echo "<p style='color:red'>نوع الملف أو حجمه غير مقبول. (PNG/JPEG ≤ 2MB)</p>";
                }
            }
        } else {
    ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="exo" value="11">
            <div class="row">
                <label>اختر صورة (PNG/JPEG ≤ 2MB):</label>
                <input type="file" name="file11" accept="image/png, image/jpeg" required>
                <button type="submit">ارفع</button>
            </div>
        </form>
    <?php
        }
    endif;

    
    if($selected == 12):
        $file = __DIR__ . '/data.txt';
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==12 && isset($_POST['append'])){
            $line = trim($_POST['append']);
            $line = ($line === '') ? "سطر فارغ" : $line;
            $entry = $line . " — " . date("Y-m-d H:i:s") . PHP_EOL;
            file_put_contents($file, $entry, FILE_APPEND);
            echo "<p> تمت الإضافة.</p>";
        }
        
        $content = file_exists($file) ? file_get_contents($file) : '';
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="12">
            <div class="row" style="flex-direction:column; align-items:flex-end;">
                <label>أضف سطراً إلى data.txt:</label>
                <input type="text" name="append" placeholder="نص للإضافة">
                <button type="submit">أضف</button>
            </div>
        </form>
        <h4>محتوى الملف:</h4>
        <pre><?= htmlspecialchars($content) ?></pre>
    <?php
    endif;
    if($selected == 13):
        // تعيين الاسم و "تذكرني"
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==13 && isset($_POST['name13'])){
            $n = trim($_POST['name13']);
            $_SESSION['name13'] = $n;
            if(isset($_POST['remember'])) {
                setcookie('remember_name', $n, time()+7*24*3600);
            }
            echo "<p>✅ تم حفظ الاسم في الجلسة.</p>";
        }
        // عرض الاسم الحالي إذا موجود
        $sessName = $_SESSION['name13'] ?? null;
        $cookieName = $_COOKIE['remember_name'] ?? null;
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="13">
            <div class="row">
                <label>أدخل الاسم للترحيب:</label>
                <input type="text" name="name13" value="<?= htmlspecialchars($sessName ?? $cookieName ?? '') ?>">
                <label><input type="checkbox" name="remember"> تذكرني (كوكي لمدة أسبوع)</label>
                <button type="submit">حفظ</button>
            </div>
        </form>
        <p>الاسم في الجلسة: <strong><?= htmlspecialchars($sessName ?? 'غير موجود') ?></strong></p>
        <p>الاسم في الكوكي: <strong><?= htmlspecialchars($cookieName ?? 'غير موجود') ?></strong></p>
    <?php
    endif;


    if($selected == 14):
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==14 && isset($_POST['x'])){
            $x = (float)$_POST['x']; $y = (float)$_POST['y'];
            try {
                if($y == 0) throw new Exception("لا يمكن القسمة على صفر");
                $res = $x / $y;
                echo "<p>$x ÷ $y = <strong>$res</strong></p>";
            } catch(Exception $e){
                echo "<p style='color:red'>خطأ: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="14">
            <div class="row">
                <label>المقسوم (x):</label><input type="number" step="any" name="x" required>
                <label>المقسوم عليه (y):</label><input type="number" step="any" name="y" required>
                <button type="submit">اقسم</button>
            </div>
        </form>
    <?php
        }
    endif;

    if($selected == 15):
        // تعريف الكلاس داخل الصفحة (تعليمي)
        class Produit {
            private $nom;
            private $prix; // HT
            public function __construct($nom, $prix){
                $this->nom = $nom;
                $this->prix = (float)$prix;
            }
            public function getPrixTTC($taux=19){
                return $this->prix * (1 + $taux/100);
            }
            public function getNom(){ return $this->nom; }
            public function getPrix(){ return $this->prix; }
        }
        // مخزن المنتجاتل
        if(!isset($_SESSION['produits'])) {
            $_SESSION['produits'] = [
                ['nom'=>'حاسوب','prix'=>50000],
                ['nom'=>'هاتف','prix'=>30000],
                ['nom'=>'سماعات','prix'=>5000],
            ];
        }
        // إضافة منتج جديد
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exo']) && $_POST['exo']==15 && isset($_POST['pnom'])){
            $pnom = trim($_POST['pnom']);
            $pprix = (float)$_POST['pprix'];
            if($pnom !== '' && $pprix > 0) {
                $_SESSION['produits'][] = ['nom'=>$pnom,'prix'=>$pprix];
                echo "<p> تم إضافة المنتج: " . htmlspecialchars($pnom) . "</p>";
            } else {
                echo "<p style='color:red'>أدخل اسمًا وسعرًا صالحًا.</p>";
            }
        }
       
        $tva = isset($_POST['tva']) ? (float)$_POST['tva'] : 19;
    ?>
        <form method="post">
            <input type="hidden" name="exo" value="15">
            <div class="row">
                <label>اسم المنتج:</label><input type="text" name="pnom" placeholder="مثال: طابعة">
                <label>السعر HT:</label><input type="number" step="any" name="pprix" placeholder="مثال: 12000">
                <label>نسبة TVA %:</label><input type="number" step="any" name="tva" value="<?= htmlspecialchars($tva) ?>">
                <button type="submit">أضف المنتج واحسب TTC</button>
            </div>
        </form>
        <h4>قائمة المنتجات:</h4>
        <pre>
<?php
        foreach($_SESSION['produits'] as $p){
            $prod = new Produit($p['nom'],$p['prix']);
            echo $prod->getNom() . " | HT = " . $prod->getPrix() . " | TTC (" . $tva . "%) = " . round($prod->getPrixTTC($tva),2) . "\n";
        }
?>
        </pre>
    <?php
    endif;
    ?>
</div>
<?php endif; ?>

<footer style="text-align:center; margin-top:10px;" class="small">
    هذه صفحة تعليمية — للتطوير أضف حماية ضد XSS و تحقق ملفات قبل نشرها على الانترنت.
</footer>
</div>
</body>
</html>
