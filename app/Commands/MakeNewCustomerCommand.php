<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeNewCustomerCommand extends Command
{
    private $directories = [
        'Documents', 'Invoices', 'Payments', 'Receipts', 'Reports', 'Quotes'
    ];

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'new';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a new customer';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is the customer name?');

        $this->createCustomerDirectory($name);
        $this->createSubDirectories($name);
    }

    private function createCustomerDirectory($customer)
    {
        Storage::makeDirectory(Str::slug($customer));
    }

    private function createSubDirectories($customer)
    {
        collect($this->directories)->each(function ($directory) use ($customer) {
            Storage::makeDirectory(Str::slug($customer) . '/' . $directory);
        });
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
