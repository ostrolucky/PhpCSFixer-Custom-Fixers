<?php

namespace tests\UseCase;

use PedroTroller\CS\Fixer\CodingStyle\LineBreakBetweenMethodArgumentsFixer;
use tests\UseCase;

class LineBreakBetweenMethodsWithNoReformatting implements UseCase
{
    /**
     * {@inheritdoc}
     */
    public function getFixer()
    {
        $fixer = new LineBreakBetweenMethodArgumentsFixer();

        $fixer->configure([
            'automatic-argument-merge' => false,
        ]);

        return $fixer;
    }

    /**
     * {@inheritdoc}
     */
    public function getRawScript()
    {
        return <<<'PHP'
<?php

namespace Project\TheNamespace;

class TheClass
{
    public function fun1($arg1, array $arg2 = [], \ArrayAccess $arg3 = null, $foo = 'bar')
    {
        return;
    }

    public function fun2(
        $arg1,
        array $arg2 = []
    ) {
        return;
    }

    public function fun3()
    {
    }

    public function fun4(
        $foo,
        $bar,
        $bar,
        $boolean = true,
        $integer = 1,
        $string = 'string'
    ) {
    }

    public function php70($arg1, array $arg2 = [], \ArrayAccess $arg3 = null, $foo = 'bar'): bool
    {
    }

    public function php71($arg1, array $arg2 = [], \ArrayAccess $arg3 = null, $foo = 'bar'): ? bool
    {
    }
}
PHP;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpectation()
    {
        return <<<'PHP'
<?php

namespace Project\TheNamespace;

class TheClass
{
    public function fun1(
        $arg1,
        array $arg2 = [],
        \ArrayAccess $arg3 = null,
        $foo = 'bar'
    ) {
        return;
    }

    public function fun2(
        $arg1,
        array $arg2 = []
    ) {
        return;
    }

    public function fun3()
    {
    }

    public function fun4(
        $foo,
        $bar,
        $bar,
        $boolean = true,
        $integer = 1,
        $string = 'string'
    ) {
    }

    public function php70(
        $arg1,
        array $arg2 = [],
        \ArrayAccess $arg3 = null,
        $foo = 'bar'
    ): bool {
    }

    public function php71(
        $arg1,
        array $arg2 = [],
        \ArrayAccess $arg3 = null,
        $foo = 'bar'
    ): ? bool {
    }
}
PHP;
    }

    /**
     * {@inheritdoc}
     */
    public function getMinSupportedPhpVersion()
    {
        return 70100;
    }
}
