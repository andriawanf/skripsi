<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetSaldoCutiEveryYear extends Command
{
    protected $signature = 'cuti:reset';
    protected $description = 'Reset guru cuti saldo to 12 every year';

    public function handle()
    {
        $gurus = User::all();

        foreach ($gurus as $guru) {
            $guru->saldo_cuti = 12;
            $guru->save();
        }

        $this->info('Cuti saldo has been reset to 12 for all gurus.');
    }
}
