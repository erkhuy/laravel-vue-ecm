<template lang="">
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-center">
            <h3>Danh sách người dùng</h3>
            <a class="btn btn-outline-info ml-3" title="Thêm mới người dùng" @click="newUser"><i class="fa fa-plus text-danger"></i> Thêm mới</a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user , index) in users.data" :key="index">
                        <td>{{user.id }}</td>
                        <td> <img :src="'/images/users/'+user.image" class="img-fluid" width="50px" height="50px" :alt="user.name"></td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.address }}</td>
                        <td>{{ user.phone }}</td>
                        <td><a class="btn btn-outline-primary" title="cập nhật" @click="editUser(user)"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-outline-dark" title="xóa" @click="deleteUser(user.id)"><i class="fa fa-recycle text-danger"></i></a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div >
  <pagination :data="users" @pagination-change-page="getUser"></pagination>
        </div>
    </div>
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title" id="userModalLabel">{{ (actionUser == 'create') ? 'Thêm mới người dùng':'Cập nhật thông tin'}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="(actionUser == 'create') ? createUser() : updateUser()">
                    <div class="modal-body ">
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input v-model="form.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Điện thoại</label>
                                <input v-model="form.phone" type="text" name="phone" class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                <has-error :form="form" field="phone"></has-error>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" name="image" class="form-control" :class="{ 'is-invalid': form.errors.has('image') }" @change="onChangeFile">
                                <has-error :form="form" field="image"></has-error>
                            </div>
                            <div class="form-group">
                                <img :src="getImage()" class="img-fluid" width="100px" height="100px" alt="">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center" v-if="actionUser=='create'">
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="text" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input v-model="form.password" type="password" name="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label>Quyền</label>

                                <select v-model="form.role_id" class="form-control">
                                    <option value="0">&lt;----Chọn nhóm quyền---- &gt;</option>
                                    <option v-for="(role , index) in roles.data" :key="index" :value="role.id">{{ role.display_name }}</option>
                                </select>

                                <has-error :form="form" field="role_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <br>
                                <input type="radio" id="one" value="0" v-model="form.status" name="status">
                                <label for="one">Dis Active</label>
                                <br>
                                <input type="radio" id="two" value="1" v-model="form.status" name="status">
                                <label for="two">Active</label>

                                <has-error :form="form" field="status"></has-error>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">

                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <textarea v-model="form.address" type="text" name="address" class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                                <has-error :form="form" field="address"></has-error>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">{{ (actionUser == 'create') ? 'Thêm mới' :'Cập nhật' }}</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      users: {},
      roles: {},
      form: new Form({
        id: "",
        name: "",
        address: "",
        role_id: "0",
        phone: "",
        userID: "",
        email: "",
        password: "",
        image: "",
        status: ""
      }),
      actionUser: ""
    };
  },
  methods: {
    getUser(page = 1) {
      axios.get("/api/admin/user?page=" + page).then(response => {
        this.users = response.data;
      });
    },
    updateUser() {
      this.form
        .put("/api/admin/user/" + this.form.id)
        .then(({ data }) => {
          if (data.status == true) {
            $("#userModal").modal("hide");
            this.$emit("AfterCreateUser");
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
    getImage() {
      let image =
        this.form.image.length > 200
          ? this.form.image
          : "/images/users/" + this.form.image;
      return image;
    },
    editUser(user) {
      $("#userModal").modal("show");
      this.actionUser = "edit";
      this.form.fill(user);
      console.log(user);
    },
    deleteUser(id) {
      Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Xác nhận xóa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa nhóm người dùng !",
        cancelButtonText: "Hủy!"
      }).then(result => {
        if (result.value) {
          this.form
            .delete("/api/admin/user/" + id)
            .then(() => {
              this.$emit("AfterCreateUser");
              Swal.fire({
                position: "top-end",
                type: "success",
                title: "Xóa  thành công",
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

    onChangeFile(e) {
      let file = e.target.files[0];
      let reader = new FileReader();
      reader.onloadend = file => {
        this.form.image = reader.result;
      };
      reader.readAsDataURL(file);
    },
    createUser() {
      this.form
        .post("/api/admin/user")
        .then(({ data }) => {
          if (data.status == true) {
            $("#userModal").modal("hide");
            this.$emit("AfterCreateUser");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Thêm mới người dùng thành công",
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
    newUser() {
      $("#userModal").modal("show");
      this.actionUser = "create";
      this.form.clear();
    },
    loadRole() {
      axios.get("/api/admin/role").then(({ data }) => {
        this.roles = data;
      });
    },
    loaduser() {
      axios.get("/api/admin/user").then(({ data }) => {
        this.users = data;
      });
    }
  },
  mounted() {
    console.log("this.mouted");
  },

  created() {
    this.loadRole();
    this.loaduser();
    this.$on("AfterCreateUser", () => {
      this.loadRole();
      this.loaduser();
    });
  }
};
</script>

<style lang="scss" scoped>
.help-block.invalid-feedback {
  display: block;
}
</style>
