<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="title">
            Music
        </div>
        <div class="search-block">
            <form action="" method="get">
                <input type="text" class="search-field" name="search" value="<?=$_GET['search']; ?>">
                <input type="submit" class="search-button" value="Search">
            </form>
        </div>
    </header>
    <main>
        <div class="tracks-list">
            <?php require_once('simple_html_dom.php');
            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Cookie: zvAuth=1\r\n"
                )
            );
            $context = stream_context_create($opts);
            $url = 'https://z1.fm/';
            if(isset($_GET['search'])){
                $url = 'https://z1.fm/mp3/search?keywords='.$_GET['search'];
            }
            $html = file_get_contents($url, false, $context);
            $dom = str_get_html($html);
            $sounds = $dom->find('#container span.song-play');
            
            foreach($sounds as $element) : 
                $sound_data = explode(' — ', $element->attr["data-title"]);
                $sound_author = $sound_data[0]; 
                $sound_title = $sound_data[1];
                $sound_url = $element->attr['data-url'];
                $sound_id = $element->attr['data-sid']; ?>
                <div class="track-block">
                    <div class="track-description-block">
                        <span class="track-author"><?=$sound_author; ?></span>
                        <span class="track-title"><?=$sound_title; ?></span>
                    </div>
                    <div class="track-controls-block">
                        <a href="https://z1.fm<?=$sound_url; ?>" class="track-save-link" data-id="<?=$sound_id; ?>">
                            <div class="track-save-button"><i class="icon-save"></i></div>
                        </a>
                        <div class="track-play-button" data-id="<?=$sound_id; ?>"><i class="icon-play"></i></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./script.js"></script>
</body>
</html>