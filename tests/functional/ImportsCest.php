<?php

use App\Imports\CreditsImport;

class ImportsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CreditsImportTest(FunctionalTester $I)
    {
        Excel::fake();

        (new CreditsImport('SPI202201A'))->import('filename.xlsx');

        Excel::assertImported('filename.xlsx');
    }
}
