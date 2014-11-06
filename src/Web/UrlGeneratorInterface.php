<?php

namespace FluxBB\Web;

interface UrlGeneratorInterface
{
    public function toRoute($handler, $parameters = []);

    public function toAsset($path);

    public function canonical();
}
