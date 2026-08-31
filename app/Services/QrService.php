<?php

namespace App\Services;

use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class QrService
{
    public function pngDataUri(string $text, int $size = 240): string
    {
        // BaconQrCode v3.1 uses GDLibRenderer for PNG output
        $renderer = new GDLibRenderer($size, 4);
        $writer = new Writer($renderer);

        return 'data:image/png;base64,'.base64_encode($writer->writeString($text));
    }
}
