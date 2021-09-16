<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class clearUnActiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clears users from database by last_visited_at field';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deletedEmails = [];

        $users = DB::table('users')
            ->get(['id', 'last_visited_at', 'delete_account_after']);

        foreach ($users as $user) {

            $isNotActive = Carbon::parse($user->last_visited_at)
                ->addMonths($user->delete_account_after)
                ->lessThan(now());

            if ($isNotActive) {
                $email = DB::table('users')
                    ->where('id', $user->id)->first('email')->email;

                $deletedEmails[] = $email;

                DB::table('users')
                    ->where('id', $user->id)
                    ->delete();
            }
        }

        foreach ($deletedEmails as $email) {
            $this->info('deleted email: ' . $email);
        }

        if(count($deletedEmails) === 0){
            $this->info('all of the users are active.');
        }

        return 0;
    }
}
