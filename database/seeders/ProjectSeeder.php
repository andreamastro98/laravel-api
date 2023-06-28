<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datiProjects = config('db.projects');

        foreach($datiProjects as $elem ){
            $newProject = new Project();
            $newProject->title = $elem['title'];
            $newProject->customer = $elem['customer'];
            $newProject->slug = Str::slug( $newProject->title,'-' );
            $newProject->description = $elem['description'];
            $newProject->cover_image = $elem['cover_image'];
            $newProject->save();

        }
    }
}
