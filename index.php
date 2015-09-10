<?php
/**
 * Created by PhpStorm.
 * User: Я
 * Date: 06.09.2015
 * Time: 15:43
 */
function formats ($type){
    $formats = array(
        ".pdf"          =>      "application/pdf",
        ".sig"          =>      "application/pgp-signature",
        ".spl"          =>      "application/futuresplash",
        ".class"        =>      "application/octet-stream",
        ".ps"           =>      "application/postscript",
        ".torrent"      =>      "application/x-bittorrent",
        ".dvi"          =>      "application/x-dvi",
        ".gz"           =>      "application/x-gzip",
        ".pac"          =>      "application/x-ns-proxy-autoconfig",
        ".swf"          =>      "application/x-shockwave-flash",
        ".tar.gz"       =>      "application/x-tgz",
        ".tgz"          =>      "application/x-tgz",
        ".tar"          =>      "application/x-tar",
        ".zip"          =>      "application/zip",
        ".mp3"          =>      "audio/mpeg",
        ".m3u"          =>      "audio/x-mpegurl",
        ".wma"          =>      "audio/x-ms-wma",
        ".wax"          =>      "audio/x-ms-wax",
        ".ogg"          =>      "application/ogg",
        ".wav"          =>      "audio/x-wav",
        ".gif"          =>      "image/gif",
        ".jpg"          =>      "image/jpeg",
        ".jpeg"         =>      "image/jpeg",
        ".png"          =>      "image/png",
        ".xbm"          =>      "image/x-xbitmap",
        ".xpm"          =>      "image/x-xpixmap",
        ".xwd"          =>      "image/x-xwindowdump",
        ".css"          =>      "text/css",
        ".html"         =>      "text/html",
        ".htm"          =>      "text/html",
        ".js"           =>      "text/javascript",
        ".asc"          =>      "text/plain",
        ".c"            =>      "text/plain",
        ".cpp"          =>      "text/plain",
        ".log"          =>      "text/plain",
        ".conf"         =>      "text/plain",
        ".text"         =>      "text/plain",
        ".txt"          =>      "text/plain",
        ".spec"         =>      "text/plain",
        ".dtd"          =>      "text/xml",
        ".xml"          =>      "text/xml",
        ".mpeg"         =>      "video/mpeg",
        ".mpg"          =>      "video/mpeg",
        ".mov"          =>      "video/quicktime",
        ".qt"           =>      "video/quicktime",
        ".avi"          =>      "video/x-msvideo",
        ".asf"          =>      "video/x-ms-asf",
        ".asx"          =>      "video/x-ms-asf",
        ".wmv"          =>      "video/x-ms-wmv",
        ".bz2"          =>      "application/x-bzip",
        ".tbz"          =>      "application/x-bzip-compressed-tar",
        ".tar.bz2"      =>      "application/x-bzip-compressed-tar",
        ".odt"          =>      "application/vnd.oasis.opendocument.text",
        ".ods"          =>      "application/vnd.oasis.opendocument.spreadsheet",
        ".odp"          =>      "application/vnd.oasis.opendocument.presentation",
        ".odg"          =>      "application/vnd.oasis.opendocument.graphics",
        ".odc"          =>      "application/vnd.oasis.opendocument.chart",
        ".odf"          =>      "application/vnd.oasis.opendocument.formula",
        ".odi"          =>      "application/vnd.oasis.opendocument.image",
        ".odm"          =>      "application/vnd.oasis.opendocument.text-master",
        ".ott"          =>      "application/vnd.oasis.opendocument.text-template",
        ".ots"          =>      "application/vnd.oasis.opendocument.spreadsheet-template",
        ".otp"          =>      "application/vnd.oasis.opendocument.presentation-template",
        ".otg"          =>      "application/vnd.oasis.opendocument.graphics-template",
        ".otc"          =>      "application/vnd.oasis.opendocument.chart-template",
        ".otf"          =>      "application/vnd.oasis.opendocument.formula-template",
        ".oti"          =>      "application/vnd.oasis.opendocument.image-template",
        ".oth"          =>      "application/vnd.oasis.opendocument.text-web",
        # make the default mime type application/octet-stream.
        "."              =>      "text/html",
        ".php"          =>      "php"
    );
    foreach ($formats as $k => $v){
        if ($k === $type) return $v;
    }
}
function Replacing_key_names($head){
    $mass = explode("\n",$head);
    $http = array_shift($mass);
    foreach ($mass as $k => $v){
        $pos = strpos($v,":");
        $sub1 = substr($v,0,$pos);
        $sub2 = substr($v,$pos+1,strlen($v));
        $mass[$sub1] = $sub2;
        unset($mass[$k]);
    }
    $mass["http"] = $http;
    return $mass;
}
function sub_input ($head,$ot,$do){
    $strlen = strlen($ot);
    $pos_ot = strpos($head,$ot)+$strlen;
    $pos_do = strpos($head,$do,$pos_ot);
    $lenght = $pos_do-$pos_ot;
    $sub = substr($head,$pos_ot,$lenght);
    return $sub;
}



$sock = socket_create(AF_INET,SOCK_STREAM,0);
socket_bind($sock,'127.0.0.1',80);
socket_listen($sock,10);
socket_set_nonblock($sock);


$http['connects'] = array ();
$http['fopens'] = array();
$http['types'] = array();
$http['size_lefts'] = array();
$http['dataToconnects'] = array();
$http['posInPoint'] = array();
$http['DownloadSpeed'] = array();
$files = "C:\Users\Я\Desktop\server_eLaiL\htdocs\\";

$con_i = 0;
$pointer = 0;

while(true) {
    $present = null;
    $connect = @socket_accept($sock);//Проверяем новое подключение
    if ($connect !== false) {
        $input_data = @socket_read($connect, 1024);
        if ($input_data !== false) {

            $filename = @sub_input($input_data, "GET /", " ");
            $ip_xosta = @sub_input($input_data, "Referer: ", "\n");
            $data_paketa = $ip_xosta . "," . $filename;
            $dirrr = $files . $filename;
            $exist = file_exists($dirrr);
            if ($exist !== false) {

                $kays_datu = array_keys($http['dataToconnects']);
                foreach ($kays_datu as $k => $value) {
                    $mass_paketov = $http['dataToconnects'][$value];
                    if ($data_paketa === $mass_paketov) {
                        $http['connects'][$value][] = $connect;
                        $present = true;
                    }
                }
                if ($present === false or $present === null) {//Если такого нету
                    $http['connects'][$con_i][] = $connect;
                    $http['dataToconnects'][$con_i] = $data_paketa;
                    $http['posInPoint'][$con_i] = 0;
                    if ($filename === '1.mp3'){
                        $http['DownloadSpeed'][$con_i] = 1024;
                    }else{
                        $http['DownloadSpeed'][$con_i] = 1024*2;
                    }
                }
                $filesize = filesize($dirrr);
                $pos = strpos($filename, '.');
                $sub = substr($filename, $pos, strlen($filename));
                $type = formats($sub);

                if ($present !== null) {
                    $http['fopens'][$value][] = fopen($dirrr, 'r');
                    $http['types'][$value][] = $type;
                    $mass_replaced_kays = Replacing_key_names($input_data);

                    if (isset($mass_replaced_kays['Range'])) {
                        $pos = strpos($mass_replaced_kays['Range'], "=");
                        $pos2 = strpos($mass_replaced_kays['Range'], "-") - 1;
                        $len = $pos2 - $pos;
                        $range_bytes = substr($mass_replaced_kays['Range'], $pos + 1, $len);
                        $filesize = $filesize - $range_bytes;
                        $http['size_lefts'][$value][] = $filesize;
                        $count = count($http['size_lefts'][$value]);
                        fseek($http['fopens'][$value][$count], $range_bytes);
                        echo 'connection ' . $con_i . " seek $range_bytes.\r\n";
                    }
                } else {
                    $http['fopens'][$con_i][] = fopen($dirrr, 'r');
                    $http['types'][$con_i][] = $type;
                }
            } else {
                $error_file = $file . 'error_404.html';
                $error_size = filesize($error_file);
                date_default_timezone_set('Europe/Kiev');
                $time = date('r');
                $scrypt = 'HTTP/1.1 404 Not Found' . "\r\n";
                $scrypt .= 'Date: ' . $time . "\r\n";
                $scrypt .= 'Server: eLaiL' . "\r\n";
                $scrypt .= 'Content-Length:' . $error_size . "\r\n";
                $scrypt .= 'Keep-Alive: timeout=5, max=100' . "\r\n";
                $scrypt .= 'Connection: close' . "\r\n";
                $scrypt .= 'Content-Type: text/html' . "\r\n";
                $scrypt .= "\r\n";
                $scrypt .= file_get_contents($error_file);
                socket_write($connect, $scrypt);
                socket_close($connect);
            }
            //inpute data file browser

            date_default_timezone_set('Europe/Kiev');
            $time  = date('r');
            $scrypt = 'HTTP/1.1 200 OK'."\r\n";
            $scrypt .= 'Date: '.$time."\r\n";
            $scrypt .= 'Server: eLaiL'."\r\n";
            $scrypt .= 'Accept-Ranges: bytes'."\r\n";
            $scrypt .= 'Content-Length: '.$filesize."\r\n";
            $scrypt .= 'Keep-Alive: timeout=5, max=100'."\r\n";
            $scrypt .= 'Connection: Keep-Alive'."\r\n";
            $scrypt .= 'Content-Type: '.$type."\r\n";
            $scrypt .= "\r\n";
            socket_write($connect,$scrypt);
            echo 'connection '.$con_i." start download $dirrr.\r\n";
            $con_i++;
        }
    }

    if (isset($http['connects'][$pointer])){
        $input_data = @socket_read($http['connects'][$pointer][$http['posInPoint'][$pointer]], 1024);
        $err = socket_last_error();
        if ($err === 10054) { // Если соединение прервано
            socket_close($http['connects'][$pointer][$http['posInPoint'][$pointer]]);
            unset($http['connects'][$pointer][$http['posInPoint'][$pointer]], $http['fopens'][$pointer][$http['posInPoint'][$pointer]], $http['types'][$pointer][$http['posInPoint'][$pointer]],$http['posInPoint'][$pointer]);
            echo 'connection ' . " closed.\r\n";
        }
        if (isset($http['size_lefts'][$pointer][$http['posInPoint'][$pointer]]) and $http['size_lefts'][$pointer][$http['posInPoint'][$pointer]] <= 0) {
            if (isset($http['fopens'][$pointer][$http['posInPoint'][$pointer]])) fclose($http['fopens'][$pointer][$http['posInPoint'][$pointer]]);
            unset($http['posInPoint'][$pointer],$http['fopens'][$pointer][$http['posInPoint'][$pointer]], $http['types'][$pointer][$http['posInPoint'][$pointer]], $http['size_lefts'][$pointer][$http['posInPoint'][$pointer]]);
            echo 'filesend end ' . "\r\n";
        }
    }
    if (isset($http['types'][$pointer])) {
        if ($http['types'][$pointer][$http['posInPoint'][$pointer]] === 'php') {
            ob_start();
            include("$dirrr");
            $out1 = ob_get_contents();
            ob_clean();
            @socket_write($http['connects'][$pointer][$http['posInPoint'][$pointer]], $out1);
        }
    }
    if (isset($http['types'][$pointer])) {
        if ($http['types'][$pointer][$http['posInPoint'][$pointer]] === 'text/plain' or $http['types'][$pointer][$http['posInPoint'][$pointer]] === 'audio/mpeg') {
            $fred = fread($http['fopens'][$pointer][$http['posInPoint'][$pointer]], $http['DownloadSpeed'][$pointer]);
            $bytes = @socket_write($http['connects'][$pointer][$http['posInPoint'][$pointer]], $fred, $http['DownloadSpeed'][$pointer]);

            if ($bytes === 0 or $bytes === false) {
                $f = ftell($http['fopens'][$pointer][$http['posInPoint'][$pointer]]);
                fseek($http['fopens'][$pointer][$http['posInPoint'][$pointer]], $f - $http['DownloadSpeed'][$pointer]);
            } else {
                if (isset($http['size_lefts'][$pointer][$http['posInPoint'][$pointer]])) $http['size_lefts'][$pointer][$http['posInPoint'][$pointer]] = $http['size_lefts'][$pointer][$http['posInPoint'][$pointer]] - $bytes;
            }

            $http['posInPoint'][$pointer]++;
            $pointer++;

            //Все щетчики сумируются в конце
            $kays = array_keys($http['connects']);
            if ($pointer >= count($kays)) {
                $pointer = $kays[0];
                usleep(1000000);
            } else {
                $pointer = $kays[$pointer];
            }


            $in_kays = array_keys($http['connects'][$pointer]);
            if ($http['posInPoint'][$pointer] >= count($in_kays)) {
                $http['posInPoint'][$pointer] = $in_kays[0];
            } else {
                $http['posInPoint'][$pointer] = $in_kays[$http['posInPoint'][$pointer]];
            }
        }
    }

    if(!isset($http['fopens'][$pointer])){
        usleep(500000);
    }
}
?>

