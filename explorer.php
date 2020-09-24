<?php

class Folder
{
    public static function run($path = '\\')
    {
        preg_match('/^([a-zA-Z]:)/', $path, $matches, PREG_OFFSET_CAPTURE);
        $driveName = $matches[1][0] ? $matches[1][0] : '\\';

        $path = $_GET['target'] ? $_GET['target'] : $path;
        $data = [
            'files' => self::getFiles($path),
            'path' => $path,
            'driver' => [
                'name' => $driveName,
                'free' => disk_free_space($driveName),
                'total' => disk_total_space($driveName),
            ],
            'drives' => explode(' ',mb_substr(exec('fsutil fsinfo drives'),8))
        ];
        self::render($data);
    }

    public static function getFiles($path)
    {
        if (!file_exists($path)) {
            return null;
        }
        $files = [];
        $dir = new DirectoryIterator($path);
        foreach ($dir as $item) {
            try {
                $memory = $item->getSize();
                $target = $item->getLinkTarget();
                $created = date("d.m.Y H:i:s", $item->getCTime());
                $modified = date("d.m.Y H:i:s", $item->getMTime());
            } catch (Exception $e) {
//                echo $e.PHP_EOL;
            }
            $type = ($item->isDir() ? 'dir' : '') . ($item->isFile() ? 'file' : '') . ($item->isLink() ? 'link' : '');
            $name = $item->getFilename();
            $short = mb_substr($name, 0, 25);
            $files[] = [
                'name' => $name,
                'short' => mb_strlen($name) > 25 ? $short . '...' : $name,
                'type' => $type,
                'ext' => $item->getExtension(),
                'mode' => ($item->isReadable() ? 'read_' : '') . ($item->isWritable() ? 'write_' : '') . ($item->isExecutable() ? 'excute_' : ''),
                'dot' => $item->isDot(),
                'memory' => $memory,
                'target' => $target,
                'created' => $created,
                'modified' => $modified
            ];
        }
        return $files;
    }

    public static function render($data)
    {
        ob_start();
        extract($data);
        require_once('explorer.tpl.php');
        echo ob_get_clean();
    }
}

