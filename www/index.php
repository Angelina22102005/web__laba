<!DOCTYPE html>
<html>
<head>
    <title>Lab 2 - PHP Test</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        .info { background: #ecf0f1; padding: 15px; border-radius: 5px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class='header'>
        <h1>Р›Р°Р±РѕСЂР°С‚РѕСЂРЅР°СЏ СЂР°Р±РѕС‚Р° в„–2</h1>
        <h2>Nginx + PHP-FPM + Docker</h2>
        <p><strong>РЎС‚СѓРґРµРЅС‚:</strong> Р›СЋР±Р°РЅСЃРєР°СЏ РђРЅРіРµР»РёРЅР° Р’Р°Р»РµСЂСЊРµРІРЅР° | <strong>Р“СЂСѓРїРїР°:</strong> 3РњРћ-1</p>
    </div>
    
    <div class='info'>
        <h3>PHP СѓСЃРїРµС€РЅРѕ СЂР°Р±РѕС‚Р°РµС‚!</h3>
        <p>РўРµРєСѓС‰Р°СЏ РґР°С‚Р° Рё РІСЂРµРјСЏ РЅР° СЃРµСЂРІРµСЂРµ: <?php echo date('Y-m-d H:i:s'); ?></p>
        <p>Р’РµСЂСЃРёСЏ PHP: <?php echo phpversion(); ?></p>
    </div>

    <nav>
        <h3>Р”РѕСЃС‚СѓРїРЅС‹Рµ СЃС‚СЂР°РЅРёС†С‹:</h3>
        <ul>
            <li><a href='/index.php'>Р“Р»Р°РІРЅР°СЏ (PHP)</a></li>
            <li><a href='/phpinfo.php'>phpinfo()</a></li>
            <li><a href='/form.html'>Р¤РѕСЂРјР° СЂРµРіРёСЃС‚СЂР°С†РёРё</a></li>
        </ul>
    </nav>

    <?php
    echo '<div class=\"info\">';
    echo '<h4>РРЅС„РѕСЂРјР°С†РёСЏ Рѕ СЃРµСЂРІРµСЂРµ:</h4>';
    echo '<p>РРјСЏ СЃРµСЂРІРµСЂР°: ' . $_SERVER['SERVER_NAME'] . '</p>';
    echo '<p>РџРѕСЂС‚: ' . $_SERVER['SERVER_PORT'] . '</p>';
    echo '<p>Software: ' . $_SERVER['SERVER_SOFTWARE'] . '</p>';
    echo '</div>';
    ?>
</body>
</html>

