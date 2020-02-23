<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Librevlad\Basilisk\Git\Extractor;

class GitExtract extends Command {
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'git:extract {src : Source folder containing .git} {dest? : Destination folder. If not provided, source folder will be used}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Extract a dumped git repository';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $extractor = new Extractor( $this->argument( 'src' ), $this->argument( 'dest' ) );
        $extractor->setCommand( $this );
        $extractor->extract();
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
