<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Librevlad\Basilisk\Git\Dumper;

class GitDump extends Command {
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'git:dump {url : (http://)example.com(/.git/(HEAD))} {dest : Destination folder}
    {--t|threads=3 : Number of threads}
    {--c|cache= : Cache folder}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Download a git repository';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $dumper = new Dumper( $this->argument( 'url' ), $this->argument( 'dest' ), $this->option( 'threads' ) );
        $dumper->setCommand( $this );
        $dumper->dump();
    }

    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    public function schedule( Schedule $schedule ): void {
        // $schedule->command(static::class)->everyMinute();
    }
}
