<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleBlogger = Role::create(['name' => 'Blogger']);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver el dashboard'])->syncRoles([$roleAdmin, $roleBlogger]);

        Permission::create([
            'name' => 'admin.users.index',
            'description' => 'Ver listado de usuarios'
        ])->syncRoles([$roleAdmin]);

        Permission::create([
            'name' => 'admin.users.edit',
            'description' => 'Asignar roles'
        ])->syncRoles([$roleAdmin]);

        Permission::create([
            'name' => 'admin.categories.index',
            'description' => 'Ver listado de categorias'
        ])->syncRoles([$roleAdmin, $roleBlogger]);
        Permission::create([
            'name' => 'admin.categories.create',
            'description' => 'Crear categorías'
        ])->syncRoles([$roleAdmin]);
        Permission::create([
            'name' => 'admin.categories.edit',
            'description' => 'Editar categorías'
        ])->syncRoles([$roleAdmin]);
        Permission::create([
            'name' => 'admin.categories.destroy',
            'description' => 'Eliminar categorías'
        ])->syncRoles([$roleAdmin]);

        Permission::create([
            'name' => 'admin.tags.index',
            'description' => 'Ver listado de etiquetas'
        ])->syncRoles([$roleAdmin, $roleBlogger]);
        Permission::create([
            'name' => 'admin.tags.create',
            'description' => 'Crear etiquetas'
        ])->syncRoles([$roleAdmin]);
        Permission::create([
            'name' => 'admin.tags.edit',
            'description' => 'Editar etiquetas'
        ])->syncRoles([$roleAdmin]);
        Permission::create([
            'name' => 'admin.tags.destroy',
            'description' => 'Eliminar etiquetas'
        ])->syncRoles([$roleAdmin]);

        Permission::create([
            'name' => 'admin.posts.index',
            'description' => 'Ver listado de posts'
        ])->syncRoles([$roleAdmin, $roleBlogger]);
        Permission::create([
            'name' => 'admin.posts.create',
            'description' => 'Crear posts'
        ])->syncRoles([$roleAdmin, $roleBlogger]);
        Permission::create([
            'name' => 'admin.posts.edit',
            'description' => 'Editar posts'
        ])->syncRoles([$roleAdmin, $roleBlogger]);
        Permission::create([
            'name' => 'admin.posts.destroy',
            'description' => 'Eliminar posts'
        ])->syncRoles([$roleAdmin, $roleBlogger]);
    }
}
