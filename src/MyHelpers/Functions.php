<?php

namespace App\MyHelpers;

use Authorization\IdentityInterface;

class Functions
{
    public static $stages = [
        0 => 'Rozpoczęcie prac',
        1 => 'Fundamenty',
        2 => 'Zagospodarowanie terenu',
        3 => 'Montaż poziomy',
        4 => 'Montaż pionowy',
        5 => 'System antenowy',
        6 => 'Prace elektryczne',
        7 => 'Poprawki',
        8 => 'Rozbudowa',
        9 => 'Prace dodatkowe',
    ];

    public static function isAdmin(IdentityInterface $user)
    {
        return $user['role'] == 'admin';
    }

    public static function isBiurowy(IdentityInterface $user)
    {
        return $user['role'] == 'pracownik_biurowy';
    }

    public static function isPolowy(IdentityInterface $user)
    {
        return $user['role'] == 'pracownik_polowy';
    }

    public static function getImageExtension($mime)
    {
        $type = "";

        switch ($mime) {
            case IMAGETYPE_GIF:
                $type = "gif";
                break;
            case IMAGETYPE_JPEG:
                $type = "jpg";
                break;
            case IMAGETYPE_PNG:
                $type = "png";
                break;
        }

        return $type;
    }

    public static function getFileExtension($file_name)
    {
        $index = strripos($file_name, '.');
        $extension = strtolower(substr($file_name, $index + 1));
        return $extension;
    }

    public static function createTempFileWithTumb($directory, $prefix, $extension)
    {
        if (!in_array(substr($directory, -1), ["/", "\\"])) {
            $directory .= '/';
        }
        while (true) {
            $allchars = "abcdefghijklmnopqrstuvwxyz0123456789";
            $subname = substr(str_shuffle($allchars), 0, 10);
            $name = "$directory$prefix" . "_" . $subname . ".$extension";
            $tumb_name = "$directory" . "/tumb/" . "$prefix" . "_" . $subname . ".$extension";
            if (!is_file($name)) {
                touch($name);
                break;
            }
        }
        return [$name, $tumb_name];
    }

    public static function createTempFileName($directory, $prefix, $extension)
    {
        if (!in_array(substr($directory, -1), ["/", "\\"])) {
            $directory .= '/';
        }
        while (true) {
            $allchars = "abcdefghijklmnopqrstuvwxyz0123456789";
            $subname = substr(str_shuffle($allchars), 0, 10);
            $name = "$directory$prefix" . "_" . $subname . ".$extension";
            if (!is_file($name)) {
                touch($name);
                break;
            }
        }
        return [$name, $prefix . "_" . $subname . ".$extension"];
    }

    public static function createTumb($image, $tumb, $thumbHeight = 100)
    {
        $sourceImage = imagecreatefromjpeg($image);
        $orgWidth = imagesx($sourceImage);
        $orgHeight = imagesy($sourceImage);
        $thumbWidth = floor($orgWidth * ($thumbHeight / $orgHeight));
        $destImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($destImage, $sourceImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $orgWidth, $orgHeight);
        imagejpeg($destImage, $tumb);
        imagedestroy($sourceImage);
        imagedestroy($destImage);
    }

    public static function zipData($source, $destination)
    {
        if (extension_loaded('zip')) {
            if (file_exists($source)) {
                $zip = new \ZipArchive();
                if ($zip->open($destination, \ZIPARCHIVE::CREATE)) {
                    $source = realpath($source);
                    if (is_dir($source)) {
                        $iterator = new \RecursiveDirectoryIterator($source);
                        // skip dot files while iterating 
                        $iterator->setFlags(\RecursiveDirectoryIterator::SKIP_DOTS);
                        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = $file->getPathname();
                            if (is_dir($file)) {
                                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                            } else if (is_file($file)) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    } else if (is_file($source)) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            }else{
                return false;
            }
        }
        return false;
    }
}
