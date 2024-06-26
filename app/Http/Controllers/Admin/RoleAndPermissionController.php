<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
     use ResponseTrait;

     public function GetAllPermissions()
     {
          $permissions = Permission::all();

          return $this->ReturnData("permissions", PermissionResource::collection($permissions), "successfully get all permissions.");
     }


     public function GetAllPermissionsForAdmin($id)
     {
          $user = User::find($id);
          if (!$user) {
               return $this->ReturnError("user not found.", 404);
          }
          if (!$user->hasRole("Admin")) {
               return $this->ReturnError("user does not have Admin role.", 422);
          }
          $permissions = $user->getAllPermissions();

          return $this->ReturnData("permissions", PermissionResource::collection($permissions), "successfully get all permissions for Admin.");
     }

     public function AssignAllPermissionsToAdmin($id)
     {
          $user = User::find($id);
          if (!$user) {
               return $this->ReturnError("user not found.", 404);
          }
          if (!$user->hasRole("Admin")) {
               return $this->ReturnError("user does not have Admin role.", 422);
          }
          $user->syncPermissions(["Roles and permissions management", "Booking management", "Services and rooms management"]);

          return $this->ReturnSuccess("successfully assign all Permissions to Admin.");
     }

     public function RevokeAllPermissionsFromAdmin($id)
     {
          $user = User::find($id);
          if (!$user) {
               return $this->ReturnError("user not found.", 404);
          }
          if (!$user->hasRole("Admin")) {
               return $this->ReturnError("user does not have Admin role.", 422);
          }
          $user->syncPermissions([]);

          return $this->ReturnSuccess("successfully revoke all Permissions from Admin.");
     }


     public function AssignPermissionToAdmin(AdminPermissionRequest $request)
     {
          $request->validated();

          $user = User::find($request->user_id);
          if (!$user->hasRole("Admin")) {
               return $this->ReturnError("user does not have Admin role.", 422);
          }
          $perm = Permission::findById($request->permission_id);

          if ($user->hasDirectPermission($perm->name)) {
               return $this->ReturnError("Admin already has permission.", 422);
          }
          $user->givePermissionTo($perm->name);

          return $this->ReturnSuccess("Successfully assign  Permission to Admin");
     }

     public function RevokePermissionFromAdmin(AdminPermissionRequest $request)
     {
          $request->validated();

          $user = User::find($request->user_id);
          if (!$user->hasRole("Admin")) {
               return $this->ReturnError("user does not have Admin role.", 422);
          }
          $perm = Permission::findById($request->permission_id);

          if (!$user->hasDirectPermission($perm->name)) {
               return $this->ReturnError("user does not have permission.", 422);
          }
          $user->revokePermissionTo($perm->name);

          return $this->ReturnSuccess("Successfully revoke Permission from Admin.");
     }


     public function UpdateToAdminRole($id)
     {
          $user = User::find($id);
          if (!$user) {
               return $this->ReturnError("user not found.", 404);
          }
          if ($user->hasRole("Admin")) {
               return $this->ReturnError("user already has Admin role.", 422);
          }
          $user->syncRoles(["Admin"]);

          return $this->ReturnSuccess("successfully updated to Admin role.");
     }

     public function UpdateToUserRole($id)
     {
          $user = User::find($id);
          if (!$user) {
               return $this->ReturnError("user not found.", 404);
          }
          if ($user->hasRole("User")) {
               return $this->ReturnError("user already has User role.", 422);
          }
          $user->syncRoles(["User"]);

          return $this->ReturnSuccess("successfully updated to User role.");
     }
}
