<template>
  <div class="row">
    <div class="col-md-6 col-lg-6">
      <div class="d-flex justify-content-center">
        <h3>Danh sách quyền</h3>
        <a class="btn btn-outline-info ml-3" title="Thêm mới người quyền" @click="newPermission">
          <i class="fa fa-plus text-danger"></i> Thêm mới
        </a>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Tên hiện thị</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(per , index) in premissions.data" :key="index">
              <td>{{ per.id }}</td>
              <td>{{ per.name }}</td>
              <td>{{ per.display_name }}</td>
              <td class="d-flex">
                <a
                  @click.prevent="editPermision(per)"
                  class="btn btn-outline-primary"
                  title="Cập nhật"
                >
                  <i class="fa fa-edit text-dark"></i>
                </a>
                <a
                  @click.prevent="deletePermision(per.id)"
                  title="Xóa"
                  class="btn btn-outline-dark"
                >
                  <i class="fa fa-recycle text-danger"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <div>
          <pagination :data="premissions" @pagination-change-page="getPermissions"></pagination>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="PermissionModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="PermissionModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3
              class="modal-title"
              id="PermissionModalLabel"
            >{{ (actionPermission == 'create') ? 'Thêm mới quyền' : 'Cập nhật quyền' }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            @submit.prevent="(actionPermission == 'create') ? createPermission() : updatePermission()"
          >
            <div class="modal-body">
              <div class="d-flex justify-content-center">
                <div class="form-group">
                  <label>Tên</label>
                  <input
                    v-model="permision.name"
                    type="text"
                    name="name"
                    class="form-control"
                    :class="{ 'is-invalid': permision.errors.has('name') }"
                  />
                  <has-error :form="permision" field="name"></has-error>
                </div>
                <div class="form-group">
                  <label>Tên hiển thị</label>
                  <input
                    v-model="permision.display_name"
                    type="text"
                    name="display_name"
                    class="form-control"
                    :class="{ 'is-invalid': permision.errors.has('display_name') }"
                  />
                  <has-error :form="permision" field="display_name"></has-error>
                </div>
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
              <button
                type="submit"
                class="btn btn-primary"
              >{{ (actionPermission == 'create') ?'Thêm mới quyền': 'Cập nhật quyền'}}</button>
            </div>
          </form>
        </div>

        <div class="modal-footer"></div>
      </div>
    </div>
    <!-- nhóm quyền -->
    <div class="col-md-6 col-lg-6">
      <div class="d-flex justify-content-center">
        <h3>Danh sách nhóm quyền</h3>
        <a class="btn btn-outline-info ml-3" title="Thêm mới người quyền" @click="newRole">
          <i class="fa fa-plus text-danger"></i> Thêm mới
        </a>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Tên hiện thị</th>
              <th>Quyền</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(role , index) in roles.data" :key="index">
              <td>{{ role.id }}</td>
              <td>{{ role.name }}</td>
              <td>{{ role.display_name }}</td>
              <td>
                <div v-for="(pe ,i) in role.permissions" :key="i">{{ pe.display_name }},</div>
              </td>

              <td class="d-flex">
                <a @click.prevent="editRole(role)" class="btn btn-outline-primary" title="Cập nhật">
                  <i class="fa fa-edit text-dark"></i>
                </a>
                <a @click.prevent="deleteRole(role.id)" title="Xóa" class="btn btn-outline-dark">
                  <i class="fa fa-recycle text-danger"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <div>
          <pagination :data="roles" @pagination-change-page="getRole"></pagination>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="RoleModalLabel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="RoleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3
              class="modal-title"
              id="RoleModalLabel"
            >{{ (actionRole == 'create') ? 'Thêm mới nhóm quyền' : 'Cập nhật nhóm quyền' }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="(actionRole == 'create') ? createRole() : updateRole()">
            <div class="modal-body">
              <div class="d-flex justify-content-center">
                <div class="form-group">
                  <label>Tên</label>
                  <input
                    v-model="role.name"
                    type="text"
                    name="name"
                    class="form-control"
                    :class="{ 'is-invalid': role.errors.has('name') }"
                  />
                  <has-error :form="role" field="name"></has-error>
                </div>
                <div class="form-group">
                  <label>Tên hiển thị</label>
                  <input
                    v-model="role.display_name"
                    type="text"
                    name="display_name"
                    class="form-control"
                    :class="{ 'is-invalid': role.errors.has('display_name') }"
                  />
                  <has-error :form="role" field="display_name"></has-error>
                </div>
              </div>
              <div>
                <div class="form-group" v-if="actionRole =='create'">
                  <label for="permission">Danh sách quyền</label>
                  <has-error :form="role" field="permissions"></has-error>
                  <div class="form-check" v-for="(per , index) in premissions.data" :key="index">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      :value="per.id"
                      name="permissions[]"
                      v-model="role.permissions"
                    />
                    <label class="form-check-label">{{ per.display_name}}</label>
                  </div>
                </div>
                <div class="form-group" v-else>
                  <label for="permission">Danh sách quyền</label>
                  <has-error :form="role" field="permissions"></has-error>
                  <div class="form-check" v-for="(per , index) in premissions.data" :key="index">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      :value="per"
                      name="permissions[]"
                      v-model="role.permissions"
                    />
                    <label class="form-check-label">{{ per.display_name}}</label>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
              <button
                type="submit"
                class="btn btn-primary"
              >{{ (actionRole == 'create') ?'Thêm mới nhóm quyền': 'Cập nhật nhóm quyền'}}</button>
              <div></div>
            </div>
          </form>
        </div>

        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      actionPermission: "create",
      actionRole: "create",
      premissions: {},
      roles: {},
      permision: new Form({
        id: "",
        name: "",
        display_name: ""
      }),
      role: new Form({
        id: "",
        name: "",
        display_name: "",
        permissions: []
      })
    };
  },
  methods: {
    //   permission
    getPermissions(page = 1) {
      axios.get("/api/admin/permission?page=" + page).then(response => {
        this.premissions = response.data;
      });
    },
    loadPermision() {
      axios.get("/api/admin/permission").then(({ data }) => {
        this.premissions = data;
      });
    },
    createPermission() {
      this.permision
        .post("/api/admin/permission")
        .then(({ data }) => {
          if (data.status == true) {
            $("#PermissionModal").modal("hide");
            this.$emit("AfterCreated");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Thêm quyền mới thành công",
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            Swal.fire({
              type: "error",
              title: "Oops...",
              text: "Có lỗi xảy ra!"
            });
          }
        })
        .catch(err => {});
    },
    newPermission() {
      $("#PermissionModal").modal("show");
      this.actionPermission = "create";
      this.permision.reset();
    },
    editPermision(per) {
      $("#PermissionModal").modal("show");
      this.actionPermission = "edit";
      this.permision.fill(per);
    },
    updatePermission() {
      this.permision
        .put("/api/admin/permission/" + this.permision.id)
        .then(({ data }) => {
          if (data.status == true) {
            $("#PermissionModal").modal("hide");
            this.$emit("AfterCreated");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Cập nhật  quyền thành công",
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            Swal.fire({
              type: "error",
              title: "Oops...",
              text: "Có lỗi xảy ra!"
            });
          }
        })
        .catch(err => {});
    },
    deletePermision(id) {
      Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Xác nhận xóa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa quyền !",
        cancelButtonText: "Hủy!"
      }).then(result => {
        if (result.value) {
          this.permision
            .delete("/api/admin/permission/" + id)
            .then(() => {
              this.$emit("AfterCreated");
              Swal.fire({
                position: "top-end",
                type: "success",
                title: "Xóa   quyền thành công",
                showConfirmButton: false,
                timer: 1000
              });
            })
            .catch(() => {
              Swal.fire({
                type: "error",
                title: "Oops...",
                text: "Có lỗi xảy ra!",
                footer: "<a href>Thử lại sau ?</a>"
              });
            });
        }
      });
    },
    // role
    getRole(page = 1) {
      axios.get("/api/admin/role?page=" + page).then(response => {
        this.premissions = response.data;
      });
    },
    loadRole() {
      axios.get("/api/admin/role").then(({ data }) => {
        this.roles = data;
      });
    },
    createRole() {
      this.role
        .post("/api/admin/role")
        .then(({ data }) => {
          if (data.status == true) {
            $("#RoleModalLabel").modal("hide");
            this.$emit("AfterCreatedRole");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Thêm nhóm  quyền mới thành công",
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            Swal.fire({
              type: "error",
              title: "Oops...",
              text: "Có lỗi xảy ra!"
            });
          }
        })
        .catch(err => {});
    },
    newRole() {
      $("#RoleModalLabel").modal("show");
      this.actionRole = "create";
      this.role.reset();
    },
    editRole(role) {
      $("#RoleModalLabel").modal("show");
      this.actionRole = "edit";

      this.role.fill(role);
    },
    updateRole() {
      this.role
        .put("/api/admin/role/" + this.role.id)
        .then(({ data }) => {
          if (data.status == true) {
            $("#RoleModalLabel").modal("hide");
            this.$emit("AfterCreatedRole");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Cập nhật  thành công",
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            Swal.fire({
              type: "error",
              title: "Oops...",
              text: "Có lỗi xảy ra!"
            });
          }
        })
        .catch(err => {});
    },
    deleteRole(id) {
      Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Xác nhận xóa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa nhóm  quyền !",
        cancelButtonText: "Hủy!"
      }).then(result => {
        if (result.value) {
          this.role
            .delete("/api/admin/role/" + id)
            .then(() => {
              this.$emit("AfterCreatedRole");
              Swal.fire({
                position: "top-end",
                type: "success",
                title: "Xóa nhóm  quyền thành công",
                showConfirmButton: false,
                timer: 1000
              });
            })
            .catch(() => {
              Swal.fire({
                type: "error",
                title: "Oops...",
                text: "Có lỗi xảy ra!",
                footer: "<a href>Thử lại sau ?</a>"
              });
            });
        }
      });
    }
  },
  created() {
    this.loadPermision();
    this.$on("AfterCreated", () => {
      this.loadPermision();
    });
    this.loadRole();
    this.$on("AfterCreatedRole", () => {
      this.loadRole();
    });
  },
  mounted() {
    console.log("this.mouted");
  }
};
</script>

<style lang="scss" scoped>
.help-block.invalid-feedback {
  display: block !important;
}
</style>
