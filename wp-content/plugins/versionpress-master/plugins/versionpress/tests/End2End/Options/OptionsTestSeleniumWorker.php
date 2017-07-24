<?php

namespace VersionPress\Tests\End2End\Options;

use VersionPress\Tests\End2End\Utils\SeleniumWorker;

class OptionsTestSeleniumWorker extends SeleniumWorker implements IOptionsTestWorker
{

    public function prepare_changeOption()
    {
        $this->url('wp-admin/options-general.php');
    }

    public function changeOption()
    {
        $this->byCssSelector('#blogname')->value(' edit');
        $this->byCssSelector('#submit')->click();
        $this->waitAfterRedirect();
    }

    public function prepare_changeTwoOptions()
    {
        $this->url('wp-admin/options-general.php');
    }

    public function changeTwoOptions()
    {
        $this->byCssSelector('#blogname')->value(' edit');
        $this->byCssSelector('#blogdescription')->value(' edit');

        $this->byCssSelector('#submit')->click();
        $this->waitAfterRedirect();
    }
}
