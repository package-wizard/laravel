<?php

namespace Helldar\PackageWizardTemplate\Steppers;

use Helldar\PackageWizard\Steppers\BaseStepper;

final class PackageStepper extends BaseStepper
{
    protected array $require = [
            'php' => '^8.0',

        'illuminate/support' => '^8.0',
    ];

    protected array $require_dev = [
        'mockery/mockery'     => '^1.0',
        'orchestra/testbench' => '^6.0',
        'phpunit/phpunit'     => '^9.0',
    ];
}
