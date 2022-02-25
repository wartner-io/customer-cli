<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Humbug\SelfUpdate\Updater;

class UpdateApplicationCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'update';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $updater = new Updater();
        $updater->setStrategy(Updater::STRATEGY_GITHUB);
        $updater->getStrategy()->setPackageName('wartner-io/customer-cli');
        $updater->getStrategy()->setPharName('customer.phar');
        $updater->getStrategy()->setCurrentLocalVersion('v1.0.1');
        try {
            $result = $updater->hasUpdate();
            if ($result) {
                printf(
                    'The current stable build available remotely is: %s',
                    $updater->getNewVersion()
                );
            } elseif (false === $updater->getNewVersion()) {
                echo "There are no stable builds available.\n";
            } else {
                echo "You have the current stable build installed.\n";
            }
        } catch (\Exception $e) {
            echo "Well, something happened! Either an oopsie or something involving hackers.\n";
            exit(1);
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
