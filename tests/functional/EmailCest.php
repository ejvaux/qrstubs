<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Mail\TransactionsReport;
use App\Mail\TransactionsCutoffReport;
use App\Mail\TransactionCompleted;
use App\Mail\TaskFailed;
use Carbon\Carbon;

class EmailCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function TransactionDailyEmailTest(FunctionalTester $I)
    {
        Mail::fake();

        Mail::to('ejvaux12@gmail.com')
                    ->send(new TransactionsReport('EJ','TEST',date('Y-m-d H:i:s')));

        // Assert that no mailables were sent...
        Mail::assertNothingSent();

        Mail::assertQueued(TransactionsReport::class);

    }

    public function TransactionCutoffEmailTest(FunctionalTester $I)
    {
        Mail::fake();

        Mail::to('ejvaux12@gmail.com')
                    ->send(new TransactionsCutoffReport('path',date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));

        // Assert that no mailables were sent...
        Mail::assertNothingSent();

        Mail::assertQueued(TransactionsCutoffReport::class);

    }

    public function TransactionCutoffCanteenEmailTest(FunctionalTester $I)
    {
        Mail::fake();

        Mail::to('ejvaux12@gmail.com')
                ->send(new TransactionsCutoffReport('path/',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),1));

        // Assert that no mailables were sent...
        Mail::assertNothingSent();

        Mail::assertQueued(TransactionsCutoffReport::class);

    }

    public function TransactionConfirmEmailTest(FunctionalTester $I)
    {
        Mail::fake();

        Mail::to('ejvaux12@gmail.com')
                ->send(new TransactionCompleted([],[]));

        // Assert that no mailables were sent...
        Mail::assertNothingSent();

        Mail::assertQueued(TransactionCompleted::class);

    }

    public function TaskFailedEmailTest(FunctionalTester $I)
    {
        Mail::fake();

        Mail::to('ejvaux12@gmail.com')
                    ->send(new TaskFailed([]));

        // Assert that no mailables were sent...
        Mail::assertNothingSent();

        Mail::assertQueued(TaskFailed::class);

    }
}
