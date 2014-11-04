<?php

namespace FluxBB\Web;

interface UrlGeneratorInterface
{
    public function toRoute($handler, $parameters = []);

    public function canonical();
}
