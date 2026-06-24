<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--email=admin@snapurl.to} {--password=admin123} {--name=Admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name');

        // Validate email format
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $this->error('Email validation failed: ' . $validator->errors()->first('email'));
            return 1;
        }

        // Check if user already exists
        $user = User::where('email', $email)->first();
        
        if ($user) {
            $this->warn("User with email {$email} already exists. Updating to admin...");
            $user->is_admin = true;
            $user->password = Hash::make($password);
            $user->name = $name;
            $user->email_verified_at = now();
            $user->save();
            $this->info("User {$email} has been updated to admin.");
        } else {
            // Create admin user
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);

            $this->info("Admin user created successfully!");
        }
        
        $this->line("Email: {$email}");
        $this->line("Password: {$password}");
        $this->line("Name: {$name}");

        $this->line("\nAdmin Dashboard: " . url('/admin/dashboard'));

        return 0;
    }
}
