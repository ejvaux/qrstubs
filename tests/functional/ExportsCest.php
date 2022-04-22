<?php

use App\Exports\TransactionsCutOffExport;
use App\Exports\TransactionsExport;
use App\Exports\UsersCreditExport;

class ExportsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function TransactionsExportTest(FunctionalTester $I)
    {
        Excel::fake();

        (new TransactionsExport(Date('Y-m-d H:i:s'),Date('Y-m-d H:i:s'),1))->download('filename.xlsx');

        Excel::assertDownloaded('filename.xlsx');
    }

    public function TransactionsCutOffExportTest(FunctionalTester $I)
    {
        Excel::fake();

        (new TransactionsCutOffExport(Date('Y-m-d H:i:s'),Date('Y-m-d H:i:s'),1))->store('filename.xlsx','public');

        Excel::assertStored('filename.xlsx', 'public');
    }

    public function UsersCreditExportTest(FunctionalTester $I)
    {
        Excel::fake();

        (new UsersCreditExport)->download("User's Credits.xlsx");

        Excel::assertDownloaded("User's Credits.xlsx");
    }
}
