<?php

namespace Netgen\HybridApproachBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use eZ\Bundle\EzPublishLegacyBundle\LegacyBundles\LegacyBundleInterface;

class NetgenHybridApproachBundle extends Bundle implements LegacyBundleInterface
{
    public function getLegacyExtensionsNames()
    {
        return array('nghybridworkshop');
    }
}
