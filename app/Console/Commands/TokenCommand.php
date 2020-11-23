<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;

class TokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:generate {id}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Get the ID from the argument
        $id = $this->argument('id');

        $user = User::find($id);

        //Authorized user
        \Auth::setUser($user);

        $console = new ConsoleOutput();

        $console->writeln($user->createToken('admin')->accessToken);
    }
}
