<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\Achievement\GrantAchievementService;
use Illuminate\Console\Command;

class GrantAchievementForOneYearSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'point:one-year-subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('created_at', '<=', now()->subYear())->get();

        $this->withProgressBar($users, function(User $user) {
            GrantAchievementService::oneYearMemberShip($user);
        });

        $this->newLine();
        $this->info("Successfully granted achievent for one year membership to ". count($users) ."users");
    }
}
