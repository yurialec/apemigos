<?php

namespace App\Services\Admin;

use App\Repositories\Admin\PermissionRepository;
use Illuminate\Support\Facades\Route;

class ValidRouteService
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAllRoutes()
    {
        $route_name = [];

        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            if (array_key_exists('as', $action)) {
                $route_name[] = ['name' => $action['as']];
            }
        }

        $removeItems = [
            "ignition.healthCheck",
            "ignition.executeSolution",
            "ignition.shareReport",
            "ignition.scripts",
            "ignition.styles",
            "sanctum.csrf-cookie",
            "ignition.updateConfig",
            "login",
            "logout",
            "register",
            "password.request",
            "password.email",
            "password.reset",
            "password.update",
            "password.confirm",
            "home",
            "menus",
            "profile",
            "profile.view",
            "modules.list",
            "valid.routes.index",
            "users.index",
            "users.edit",
            "users.create",
            "roles.index",
            "roles.create",
            "roles.edit",
            "permissions.create",
            "permissions.index",
            "permissions.edit"
        ];

        $route_name = array_filter($route_name, function ($route) use ($removeItems) {
            return !in_array($route['name'], $removeItems);
        });

        $permissions = $this->permissionRepository->all();

        foreach ($permissions as $permission) {
            $permissionsIndexed[] = $permission->name;
        }

        $route_names = array_column($route_name, 'name');

        $routes_diff = array_diff($route_names, $permissionsIndexed);

        $routes = array_map(function ($route) {
            return ['name' => $route];
        }, $routes_diff);

        return $routes;
    }
}