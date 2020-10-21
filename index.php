<!DOCTYPE html>
<html lang="en">
<?php include 'plan.php' ?>
<?php $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<?php

$name = $target = $place = $time = "";
$nameErr = $targetErr = $placeErr = $timeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = 0;
    $time = test_input(time());

    if (empty($_POST['fname'])) {
        $nameErr = "Nom est requis";
        $error = 1;
    } else {
        $name = test_input($_POST["fname"]);
    }

    if (empty($_POST['ftarget'])) {
        $targetErr = "La cible est requise";
        $error = 1;
    } else {
        $target = test_input($_POST["ftarget"]);
    }

    if (empty($_POST['fplace'])) {
        $placeErr = "L'endroit est requis";
        $error = 1;
    } else {
        $place = test_input($_POST["fplace"]);
    }

    if ($error === 0) {
        $filename = __DIR__ . DIRECTORY_SEPARATOR . 'kill.txt';
        file_put_contents($filename, "\n$name;$target;$place;$time", FILE_APPEND);
        header("Refresh:0");
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = ucfirst(strtolower(trim($data)));
    return $data;
}

$phrases = [
    'Posez-vous les bonnes questions !',
    'Vous allez vous faire balayer dans 5sec...',
    'Parfait!',
    'On clean Discord quand on joue svp',
    'Lootez le corps qu\'on puisse le dépecer'
]

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Softmur.it - Among Us </title>


    <meta name="msapplication-TileColor" content="#222222">
    <meta name="theme-color" content="#222222">
    <meta name="description" content="Softmur.it is a soft-reserve utility for planning your target on Among Us game">
    <meta name="keywords" content="AmongUs, Soft-reserve, softreserve, softres">
    <style>
        body {
            background-color: #222;
        }
    </style>

    <meta name="theme-color" content="#4DBA87">
    <meta name="apple-mobile-web-app-capable" content="no">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="softmur">
    <meta name="msapplication-TileColor" content="#000000">
    <link rel="stylesheet" href="public/reset.css">
    <link rel="stylesheet" href="public/icofont.min.css">
    <link rel="stylesheet" href="public/style.css">
</head>

<body>
    <header class="top">
        <div id="logo-icon"></div>
        <h1 id="logo">Softmurder.it</h1>
        <ul class="nav">
            <li><a href="#">Changelog</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Weakaura</a></li>
            <li><a href="#">Stats</a></li>
        </ul>
    </header>
    <div class="msg"><?= $phrases[rand(0, count($phrases) - 1)]; ?></div>
    <div class="content">
        <header class="header">
            <div class="col intro">
                <h1>Among Us</h1>
                <h2><span class="emp"><?php echo $resa ?></span> have reserved their murder</h2>
                <ul class="tags">
                    <li>Alliance</li>
                    <li>Player limit: 10</li>
                    <li class="gray">murder-limit per player: unlimited</li>
                </ul>

                <div class="info">
                    <p>See soft-murder ingame by using weakaura</p>
                    <a href="#"><i class="icofont-question-circle"></i> Weakaura Guide</a>
                    <a href="#"><i class="icofont-french-fries"></i> Copy Weakaura +<?php echo $resa ?> murder-resa</a>
                </div>
            </div>

            <div class="col link">
                <p>
                    Soft-reserve URL. Share this with raiders
                </p>
                <input type="text" value="<?= $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
            </div>
        </header>

        <form class="reserve" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h2>Murder-reserve</h2>
            <div class="row">
                <div class="col">
                    <label for="fname">Name: <span class="error"><?= $nameErr; ?></span></label>
                    <input type="text" name="fname" id="fname" placeholder="Character name" value="<?= $name ?>">
                </div>
                <div class="col">
                    <label for="fnote">Note: </label>
                    <input type="text" name="fnote" id="fnote" disabled placeholder="Character note (Optional)">
                </div>
            </div>

            <div>
                <label for="ftarget">Target: <span class="error"><?= $targetErr; ?></span></label>
                <input type="text" name="ftarget" id="ftarget" placeholder="Select target" value="<?= $target ?>">
            </div>

            <div>
                <label for="fplace">Place of murder <span class="error"><?= $placeErr; ?></label>
                <select name="fplace" id="fplace">
                    <option selected disabled>Choose the place to kill</option>
                    <option value="cafeteria">Cafeteria</option>
                    <option value="reactor">Reactor</option>
                    <option value="security">Security</option>
                    <option value="electrical">Electrical</option>
                    <option value="storage">Storage</option>
                    <option value="communication">Communication</option>
                    <option value="admin">Admin</option>
                    <option value="shields">Shields</option>
                    <option value="o2">O2</option>
                    <option value="navigation">Navigation</option>
                    <option value="weapons">Weapons</option>
                </select>
            </div>

            <div class="action">
                <button class="cancel" onclick="this.form.reset();"><i class=" icofont-ui-reply"></i> Cancel</button>
                <button class="soft-murder">
                    <div class="dead"></div> Kill him!
                </button>

            </div>
        </form>

        <table>
            <h3><span class="emp"><?php echo $resa ?></span> Murder<?php echo $resa > 1 ? 's' : '' ?> planned</h3>
            <input type="text" id="search" placeholder="Search" disabled>
            <tr>
                <th>Name</th>
                <th>Target</th>
                <th>Position</th>
            </tr>

            <?php foreach ($murders as $m) : ?>
                <tr class="pair">
                    <td><?= $m['name']; ?></td>
                    <td><?= $m['target']; ?></td>
                    <td class="target">
                        <?= $m['place']; ?> <br>
                        <time>
                            <?= date('j. M Y H:i', $m['time']); ?> GMT+2
                        </time>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

        <footer class="footer">
            <div class="item-row mt-3">Voidberg &lt;<span class="text-danger">Guardians of Azeroth</span>&gt; @ Sulfuron-FR</span></div><a href="#" rel="noopener" target="_blank" class="btn mt-2 mb-3 mr-2 btn-outline-warning">🍺 Buy me a beer! (in game)</a>
        </footer>

    </div>
    <!-- <script src="bundle.js"></script> -->
</body>

</html>