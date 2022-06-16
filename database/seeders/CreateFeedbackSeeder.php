<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feedback = [
            'body' => 'test comments',
            'reviewer_id' => '3',
            'feedbackable_type' => 'App\Models\User',
            'feedbackable_id' => '5'
        ];
        Feedback::create($feedback);
    }
}
