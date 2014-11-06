<?php

namespace FluxBB\Web\Assets;

interface ContainerInterface
{
    /**
     * Include the given asset file and remember it under the given name.
     *
     * @param string $name
     * @param string $path
     * @return \FluxBB\Web\Assets\ContainerInterface
     */
    public function load($name, $path);

    /**
     * Forget the given named asset.
     *
     * @param string $name
     * @return \FluxBB\Web\Assets\ContainerInterface
     */
    public function forget($name);
}
