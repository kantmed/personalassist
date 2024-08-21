<?php

namespace App\Service;

use Nucleos\DompdfBundle\Factory\DompdfFactoryInterface;
use Nucleos\DompdfBundle\Wrapper\DompdfWrapperInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfGenerateur
{

    public function __construct(private DompdfFactoryInterface $factory, private DompdfWrapperInterface $wrapper) {}

    public function output(string $html): string
    {
        $pdf = $this->factory->create();
        $pdf->loadHtml($html);
        $pdf->render();
        return $pdf->output();
    }

    public function stream(string $html, string $filename): StreamedResponse
    {
        return $this->wrapper->getStreamResponse($html, $filename);
    }
}
