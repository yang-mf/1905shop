<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

/**
 * @deprecated Use the `TestHook` interfaces instead
 */
interface TestListener
{
    /**
     * An error occurred.
     *
     * @deprecated Use `AfterTestErrorHook::executeAfterTestError` instead
     */
    public function addError(Test $test, \Throwable $t, float $time): void;

    /**
     * A warning occurred.
     *
     * @deprecated Use `AfterTestWarningHook::executeAfterTestWarning` instead
     */
    public function addWarning(Test $test, Warning $e, float $time): void;

    /**
     * A failure occurred.
     *
     * @deprecated Use `AfterTestFailureHook::executeAfterTestFailure` instead
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time): void;

    /**
     * Incomplete Test.
     *
     * @deprecated Use `AfterIncompleteTestHook::executeAfterIncompleteTest` instead
     */
    public function addIncompleteTest(Test $test, \Throwable $t, float $time): void;

    /**
     * Risky Test.
     *
     * @deprecated Use `AfterRiskyTestHook::executeAfterRiskyTest` instead
     */
    public function addRiskyTest(Test $test, \Throwable $t, float $time): void;

    /**
     * Skipped Test.
     *
     * @deprecated Use `AfterSkippedTestHook::executeAfterSkippedTest` instead
     */
    public function addSkippedTest(Test $test, \Throwable $t, float $time): void;

    /**
     * A Test suite started.
     */
    public function startTestSuite(TestSuite $suite): void;

    /**
     * A Test suite ended.
     */
    public function endTestSuite(TestSuite $suite): void;

    /**
     * A Test started.
     *
     * @deprecated Use `BeforeTestHook::executeBeforeTest` instead
     */
    public function startTest(Test $test): void;

    /**
     * A Test ended.
     *
     * @deprecated Use `AfterTestHook::executeAfterTest` instead
     */
    public function endTest(Test $test, float $time): void;
}
