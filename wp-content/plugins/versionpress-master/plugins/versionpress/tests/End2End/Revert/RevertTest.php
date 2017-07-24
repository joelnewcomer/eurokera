<?php

namespace VersionPress\Tests\End2End\Revert;

use VersionPress\Cli\VPCommandUtils;
use VersionPress\Tests\End2End\Utils\End2EndTestCase;
use VersionPress\Tests\Utils\CommitAsserter;
use VersionPress\Tests\Utils\DBAsserter;

class RevertTest extends End2EndTestCase
{

    /** @var IRevertTestWorker */
    private static $worker;

    /**
     * @test
     * @testdox Undo reverts changes in given commit
     */
    public function undoRevertChangesInGivenCommit()
    {
        $changes = self::$worker->prepare_undoLastCommit();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->undoLastCommit();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction('versionpress/undo');
        $commitAsserter->assertCountOfAffectedFiles(count($changes));
        $commitAsserter->assertCommitPaths($changes);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Undo reverts only one commit
     */
    public function undoRevertsOnlyOneCommit()
    {
        $changes = self::$worker->prepare_undoSecondCommit();
        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->undoSecondCommit();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction('versionpress/undo');
        $commitAsserter->assertCountOfAffectedFiles(count($changes));
        $commitAsserter->assertCommitPaths($changes);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Undo commit can be also reverted.
     */
    public function undoCommitCanBeAlsoReverted()
    {
        $changes = self::$worker->prepare_undoRevertedCommit();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->undoLastCommit();
        self::$worker->undoLastCommit();

        $commitAsserter->assertNumCommits(2);
        $commitAsserter->assertCommitAction('versionpress/undo');
        $commitAsserter->assertCountOfAffectedFiles(count($changes));
        $commitAsserter->assertCommitPaths($changes);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Comment deletion cannot be reverted if the commented post no longer exists
     */
    public function entityWithMissingReferenceCannotBeRestoredWithRevert()
    {
        self::$worker->prepare_tryRestoreEntityWithMissingReference();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->tryRestoreEntityWithMissingReference();
        $commitAsserter->assertNumCommits(0);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Rollback reverts all changes made after chosen commit
     */
    public function rollbackRevertsAllChangesMadeAfterChosenCommit()
    {
        $changes = self::$worker->prepare_rollbackMoreChanges();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->rollbackMoreChanges();
        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction('versionpress/rollback');
        $commitAsserter->assertCountOfAffectedFiles(count($changes));
        $commitAsserter->assertCommitPaths($changes);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Clicking on Cancel only hides the popup
     */
    public function clickingOnCancelOnlyHidesThePopup()
    {
        self::$worker->prepare_clickOnCancel();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->clickOnCancel();

        $commitAsserter->assertNumCommits(0);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox OK button is disabled if the working directory is not clean
     */
    public function undoDoesNothingIfTheWorkingDirectoryIsNotClean()
    {
        self::$worker->prepare_undoWithNotCleanWorkingDirectory();

        $commitAsserter = new CommitAsserter($this->gitRepository);
        touch(self::$testConfig->testSite->path . '/revert-test-file');

        self::$worker->undoLastCommit();

        $commitAsserter->assertNumCommits(0);
        unlink(self::$testConfig->testSite->path . '/revert-test-file');
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     */
    public function rollbackWorksWithMergeCommits()
    {
        $commitHash = $this->gitRepository->getLastCommitHash();
        $sitePath = self::$testConfig->testSite->path;

        VPCommandUtils::exec('git branch test', $sitePath);
        self::$wpAutomation->createOption('vp_option_master', 'foo');
        VPCommandUtils::exec('git checkout test', $sitePath);
        self::$wpAutomation->createOption('vp_option_test', 'foo');
        VPCommandUtils::exec('git checkout master', $sitePath);
        VPCommandUtils::exec('git merge test', $sitePath);
        VPCommandUtils::exec('git branch -d test', $sitePath);

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$wpAutomation->runWpCliCommand('vp', 'rollback', [$commitHash]);

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCleanWorkingDirectory();
        $commitAsserter->assertCountOfAffectedFiles(2);
        $commitAsserter->assertCommitPath('D', '%vpdb%/options/vp/vp_option_master.ini');
        $commitAsserter->assertCommitPath('D', '%vpdb%/options/vp/vp_option_test.ini');
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Undo to the same state should not do anything
     */
    public function undoToTheSameStateDoesNothing()
    {
        self::$worker->prepare_undoToTheSameState();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->undoSecondCommit();

        $commitAsserter->assertNumCommits(0);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Rollback to the same state should not do anything
     */
    public function rollbackToTheSameStateDoesNothing()
    {
        self::$worker->prepare_rollbackToTheSameState();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->rollbackToTheSameState();

        $commitAsserter->assertNumCommits(0);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Undo multiple commits should create one commit
     */
    public function undoMultipleCommitsCreatesOneCommit()
    {
        $changes = self::$worker->prepare_undoMultipleCommits();
        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->undoMultipleCommits();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction('versionpress/undo');
        $commitAsserter->assertCountOfAffectedFiles(count($changes));
        $commitAsserter->assertCommitPaths($changes);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     */
    public function undoMultipleCommitsDetectsMissingReferencesCorrectly()
    {
        $changes = self::$worker->prepare_undoMultipleDependentCommits();
        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->undoMultipleDependentCommits();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction('versionpress/undo');
        $commitAsserter->assertCountOfAffectedFiles(count($changes));
        $commitAsserter->assertCommitPaths($changes);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Undo multiple commits should do nothing id one change cannot be reverted
     */
    public function undoMultipleCommitsDoesNothingIfOneChangeCannotBeReverted()
    {
        self::$worker->prepare_undoMultipleCommitsThatCannotBeReverted();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->undoMultipleCommitsThatCannotBeReverted();
        $commitAsserter->assertNumCommits(0);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Non-DB change doesn't break the database
     */
    public function undoOfNonDbChangeDoesntBreakDatabase()
    {
        $changes = self::$worker->prepare_undoNonDbChange();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->undoNonDbChange();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction('versionpress/undo');
        $commitAsserter->assertCountOfAffectedFiles(count($changes));
        $commitAsserter->assertCommitPaths($changes);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }
}
