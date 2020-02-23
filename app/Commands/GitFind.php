<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Librevlad\Basilisk\Git\Dumper;
use Librevlad\Basilisk\Git\Finder;

class GitFind extends Command {
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'git:find {input_file}
    {--o|output= : If provided, successful URLs will be written to this file}
    {--t|threads=10 : Number of threads}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Find git repositories in the list of URLs';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        $urls   = array_map( 'trim', file( $this->argument( 'input_file' ) ) );
        $finder = new Finder( $urls, $this->option( 'threads' ) );
        $finder->setCommand( $this );
        $res = $finder->find( function ( $request ) {
        } );

        if ( $o = $this->option( 'output' ) ) {
            file_put_contents( $o, implode( PHP_EOL, $res[ 'success' ] ) );
        }

    }

    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    public function schedule( Schedule $schedule ): void {

    }
}
