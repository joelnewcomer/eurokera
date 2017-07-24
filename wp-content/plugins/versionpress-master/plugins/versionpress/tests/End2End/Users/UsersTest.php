<?php

namespace VersionPress\Tests\End2End\Users;

use VersionPress\Tests\End2End\Utils\End2EndTestCase;
use VersionPress\Tests\Utils\CommitAsserter;
use VersionPress\Tests\Utils\DBAsserter;

class UsersTest extends End2EndTestCase
{

    /** @var IUsersTestWorker */
    private static $worker;

    private static $testUser = [
        'login' => 'JohnTester',
        'email' => 'john.tester@example.com',
        'password' => 'password',
        'first-name' => 'John',
        'last-name' => 'Tester',
    ];

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$worker->setTestUser(self::$testUser);
    }

    /**
     * @test
     * @testdox Adding users creates 'user/create' action
     */
    public function addingUserCreatesUserCreateAction()
    {
        self::$worker->prepare_createUser();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->createUser();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction("user/create");
        $commitAsserter->assertCommitTag("VP-User-Login", self::$testUser['login']);
        $commitAsserter->assertCommitPath("A", "%vpdb%/users/%VPID%.ini");
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Editing user's email creates 'user/edit' action
     * @depends addingUserCreatesUserCreateAction
     */
    public function editingUserCreatesUserEditAction()
    {
        self::$worker->prepare_editUser();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->editUser();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction("user/edit");
        $commitAsserter->assertCommitTag("VP-User-Login", self::$testUser['login']);
        $commitAsserter->assertCommitPath("M", "%vpdb%/users/%VPID%.ini");
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Editing user's name creates 'usermeta/edit' action
     * @depends addingUserCreatesUserCreateAction
     */
    public function editingUsermetaCreatesUsermetaEditAction()
    {
        self::$worker->prepare_editUsermeta();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->editUsermeta();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction("usermeta/edit");
        $commitAsserter->assertCommitTag("VP-User-Login", self::$testUser['login']);
        $commitAsserter->assertCommitPath("M", "%vpdb%/users/%VPID(VP-User-Id)%.ini");
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Deleting user creates 'user/delete' action
     * @depends editingUserCreatesUserEditAction
     */
    public function deletingUserCreatesUserDeleteAction()
    {
        self::$worker->prepare_deleteUser();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->deleteUser();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction("user/delete");
        $commitAsserter->assertCommitTag("VP-User-Login", self::$testUser['login']);
        $commitAsserter->assertCommitPath("D", "%vpdb%/users/%VPID%.ini");
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Editing multiple users creates bulk action
     */
    public function editingMultipleUsersCreatesBulkAction()
    {
        self::$worker->prepare_editTwoUsers();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->editTwoUsers();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertBulkAction("user/edit", 2);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Deleting multiple users creates bulk action
     */
    public function deletingMultipleUsersCreatesBulkAction()
    {
        self::$worker->prepare_deleteTwoUsers();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->deleteTwoUsers();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertBulkAction("user/delete", 2);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }


    /**
     * @test
     * @testdox Editing multiple usermeta creates bulk action
     */
    public function editingMultipleUsermetaCreatesBulkAction()
    {
        self::$worker->prepare_editTwoUsermeta();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->editTwoUsermeta();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertBulkAction("usermeta/edit", 2);
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    /**
     * @test
     * @testdox Deleting usermeta creates multiple usermeta creates 'usermeta/delete' action
     */
    public function deletingUsermetaCreatesUsermetaDeleteAction()
    {
        self::$worker->prepare_deleteUsermeta();

        $commitAsserter = new CommitAsserter($this->gitRepository);

        self::$worker->deleteUsermeta();

        $commitAsserter->assertNumCommits(1);
        $commitAsserter->assertCommitAction("usermeta/delete");
        $commitAsserter->assertCommitTag("VP-User-Login", self::$testUser['login']);
        $commitAsserter->assertCommitPath("M", "%vpdb%/users/%VPID(VP-User-Id)%.ini");
        $commitAsserter->assertCleanWorkingDirectory();
        DBAsserter::assertFilesEqualDatabase();
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
        self::$worker->tearDownAfterClass();
    }
}
