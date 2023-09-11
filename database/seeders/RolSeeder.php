<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles del sistema
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Entrenador']);

        //Permisos del sistema
        Permission::create(['name' => 'usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.nuevo'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'jugadores'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'jugadores.nuevo'])->syncRoles([$role1]);
        Permission::create(['name' => 'jugadores.editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'jugadores.eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'temporadas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'temporadas.nuevo'])->syncRoles([$role1]);
        Permission::create(['name' => 'temporadas.editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'temporadas.eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'categorias'])->syncRoles([$role1, $role2]);;
        Permission::create(['name' => 'categorias.nuevo'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias.editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias.eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'inscripciones'])->syncRoles([$role1, $role2]);;
        Permission::create(['name' => 'inscripciones.nuevo'])->syncRoles([$role1]);
        Permission::create(['name' => 'inscripciones.editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'inscripciones.eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'asistencia'])->syncRoles([$role1, $role2]);;
        Permission::create(['name' => 'asistencia.nuevo'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'asistencia.editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'asistencia.eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'pagos'])->syncRoles([$role1, $role2]);;
        Permission::create(['name' => 'pagos.nuevo'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'pagos.editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'pagos.eliminar'])->syncRoles([$role1]);

    }
}
