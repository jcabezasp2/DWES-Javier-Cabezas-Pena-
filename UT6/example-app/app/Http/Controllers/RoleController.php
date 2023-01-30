<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(5);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role;
        $title = _('Crear rol');
        $textButton= _('Crear rol');
        $route = 'roles.store';
        $method = 'POST';
        $guards = ['web', 'api'];
        $permissions = Permission::all();
        return view('roles.form', compact('role', 'title', 'textButton', 'route', 'guards', 'permissions', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $role = Role::create($request->only(['name', 'guard_name']));
        $role->syncPermissions($request->permissions);
        return redirect(route('roles.index'))
            ->with('success',_("¡Rol creado!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $title = _('Editar rol');
        $textButton= _('Editar rol');
        $route = 'roles.update';
        $method = 'PUT';
        /* $guards = DB::table('roles')->select('guard_name')->distinct()->get(); */
        $guards = ['web', 'api'];
        $permissions = Permission::all();
        return view('roles.form', compact('role', 'title', 'textButton', 'route', 'guards', 'permissions', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->only(['name', 'guard_name']));
        $role->syncPermissions($request->permissions);
        return redirect(route('roles.index'))
            ->with('success',_("¡Rol creado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success', _('¡Rol eliminado!'));
    }
}
