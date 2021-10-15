<?php

namespace MageSquare\Base\Model\ComponentList\Loader;

interface LoaderInterface
{
    /**
     * Retrieve mapping rules, to use while filling resulting array
     *
     * @return array
     */
    public function getMapping();

    /**
     * Retrieve array of magesquare components:
     * [
     *     [name, [config]]
     *     ...
     * ]
     *
     * @return \Traversable
     */
    public function getComponentsInfo();
}
