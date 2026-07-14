<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class AdditionalSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            [
                'category' => 'Cybersecurity',
                'category_emoji' => '🛡️',
                'name' => 'Vulnerability Assessment',
                'level' => 85,
                'color' => '#ef4444',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'category' => 'Cybersecurity',
                'category_emoji' => '🛡️',
                'name' => 'Black-Box Testing',
                'level' => 85,
                'color' => '#dc2626',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'category' => 'Cybersecurity',
                'category_emoji' => '🛡️',
                'name' => 'Anomaly Detection',
                'level' => 80,
                'color' => '#b91c1c',
                'sort_order' => 12,
                'is_active' => true,
            ],
            [
                'category' => 'Design',
                'category_emoji' => '🎨',
                'name' => 'UI/UX Design',
                'level' => 85,
                'color' => '#8b5cf6',
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'category' => 'Design',
                'category_emoji' => '🎨',
                'name' => 'Graphic & Logo Design',
                'level' => 80,
                'color' => '#a855f7',
                'sort_order' => 21,
                'is_active' => true,
            ],
            [
                'category' => 'Architecture',
                'category_emoji' => '🏗️',
                'name' => 'System Architecture',
                'level' => 85,
                'color' => '#3b82f6',
                'sort_order' => 30,
                'is_active' => true,
            ],
            [
                'category' => 'Hardware',
                'category_emoji' => '🖥️',
                'name' => 'Hardware Analysis',
                'level' => 75,
                'color' => '#64748b',
                'sort_order' => 40,
                'is_active' => true,
            ],
            [
                'category' => 'Management',
                'category_emoji' => '📋',
                'name' => 'Project Management & Proposal Writing',
                'level' => 85,
                'color' => '#10b981',
                'sort_order' => 50,
                'is_active' => true,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
