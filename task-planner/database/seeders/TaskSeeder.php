<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Complete Project Documentation',
            'description' => 'Write comprehensive documentation for the task manager application',
            'status' => 'in-progress',
            'priority' => 'high',
            'category' => 'Work',
            'due_date' => now()->addDays(2),
        ]);

        Task::create([
            'title' => 'Fix Layout Issues',
            'description' => 'Address responsive design problems on mobile devices',
            'status' => 'pending',
            'priority' => 'medium',
            'category' => 'Development',
            'due_date' => now()->addDays(1),
        ]);

        Task::create([
            'title' => 'Prepare Presentation',
            'description' => 'Create slides for client meeting',
            'status' => 'completed',
            'priority' => 'high',
            'category' => 'Meeting',
            'due_date' => now()->subDay(),
        ]);

        Task::create([
            'title' => 'Learn Laravel',
            'description' => 'Complete all tutorials on Laravel 10',
            'status' => 'in-progress',
            'priority' => 'medium',
            'category' => 'Education',
            'due_date' => now()->addWeek(),
        ]);

        Task::create([
            'title' => 'Review Code',
            'description' => 'Perform code review for team members',
            'status' => 'pending',
            'priority' => 'low',
            'category' => 'Work',
            'due_date' => now()->addDays(3),
        ]);
    }
}
