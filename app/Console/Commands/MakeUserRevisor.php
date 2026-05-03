<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

class MakeUserRevisor extends Command
{
    /**
    * Execute the console command.
    */
    
    protected $signature = 'app:make-user-revisor {email}';
    protected $description = 'Rende un utente revisore';
    
    public function handle()
    {
        $user = User::where('email', $this->argument ('email')) ->first();
        if (!$user) {
            $this->error('Utente non trovato');
            return;
        }
        $user->is_revisor = true;
        $user->save();
        $this->info("1'utente ($user->name} è ora revisore");
    }
}
    