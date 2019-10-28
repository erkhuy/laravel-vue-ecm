<template>
  <div class="row">
    <div class="col-md-6 col-lg-6">
      <div class="d-flex justify-content-center">
        <h3>Danh sách tên mục</h3>
        <a class="btn btn-outline-info ml-3" title="Thêm mới người quyền" @click="newCategory">
          <i class="fa fa-plus text-danger"></i> Thêm mới
        </a>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Cha</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(category , index) in categories.data" :key="index">
              <template v-if="category.id !=0">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>{{ category.parent_id.name }}</td>
                <td class="d-flex">
                  <a
                    @click.prevent="editCategory(category)"
                    class="btn btn-outline-primary"
                    title="Cập nhật"
                  >
                    <i class="fa fa-edit text-dark"></i>
                  </a>
                  <a
                    @click.prevent="deleteCategory(category.id)"
                    title="Xóa"
                    class="btn btn-outline-dark"
                  >
                    <i class="fa fa-recycle text-danger"></i>
                  </a>
                </td>
              </template>
            </tr>
          </tbody>
        </table>
        <div>
          <pagination :data="categories" @pagination-change-page="getCategories"></pagination>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="CategoryModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="CategoryModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3
              class="modal-title"
              id="CategoryModalLabel"
            >{{ (actionCategory == 'create') ? 'Thêm mới ' : 'Cập nhật ' }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            @submit.prevent="(actionCategory == 'create') ? createCategory() : updateCategory()"
          >
            <div class="modal-body">
              <div class="d-flex justify-content-center">
                <div class="form-group">
                  <label>Tên</label>
                  <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                  />
                  <has-error :form="form" field="name"></has-error>
                </div>
                <div class="form-group" v-if="actionCategory == 'create'">
                  <label>Category cha</label>

                  <select v-model="form.parent_id" class="form-control">
                    <option value="0">&lt;----Chọn category cha---- &gt;</option>
                    <!-- <option value="0">Home</option> -->
                    <option
                      v-for="(category , index) in categories.data"
                      :key="index"
                      :value="category.id"
                    >{{ category.name }}</option>
                  </select>

                  <has-error :form="form" field="parent_id"></has-error>
                </div>
                <div class="form-group" v-else>
                  <label>Category cha</label>

                  <select v-model="form.parent_id.id" class="form-control">
                    <option value>&lt;----Chọn category cha---- &gt;</option>
                    <!-- <option value="0">Home</option> -->
                    <template>
                      <option
                        v-for="(category , index) in categories.data"
                        :key="index"
                        :value="category.id"
                      >{{ category.name}}</option>
                    </template>
                  </select>

                  <has-error :form="form" field="parent_id"></has-error>
                </div>
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
              <button
                type="submit"
                class="btn btn-primary"
              >{{ (actionCategory == 'create') ?'Thêm mới ': 'Cập nhật '}}</button>
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
      categories: {},
      actionCategory: "",
      form: new Form({
        id: "",
        name: "",
        parent_id: 0
      })
    };
  },
  methods: {
    getCategories(page = 1) {
      axios.get("/api/admin/category?page=" + page).then(response => {
        this.categories = response.data;
      });
    },
    loadCategory() {
      axios.get("/api/admin/category").then(({ data }) => {
        this.categories = data;
      });
    },
    createCategory() {
      this.form
        .post("/api/admin/category")
        .then(({ data }) => {
          if (data.status == true) {
            $("#CategoryModal").modal("hide");
            this.$emit("AfterCreated");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Thêm  mới thành công",
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
    newCategory() {
      $("#CategoryModal").modal("show");
      this.actionCategory = "create";
      this.form.reset();
    },
    editCategory(category) {
      $("#CategoryModal").modal("show");
      this.actionCategory = "edit";
      this.form.fill(category);
    },
    updateCategory() {
      this.form
        .put("/api/admin/category/" + this.form.id)
        .then(({ data }) => {
          if (data.status == true) {
            $("#CategoryModal").modal("hide");
            this.$emit("AfterCreated");
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
              text: "Có lỗi xảy ra! <'br>" + data.satatus
            });
          }
        })
        .catch(err => {});
    },
    deleteCategory(id) {
      Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Xác nhận xóa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa  !",
        cancelButtonText: "Hủy!"
      }).then(result => {
        if (result.value) {
          this.form
            .delete("/api/admin/category/" + id)
            .then(() => {
              this.$emit("AfterCreated");
              Swal.fire({
                position: "top-end",
                type: "success",
                title: "Xóa    thành công",
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
    this.loadCategory();
    this.$on("AfterCreated", () => {
      this.loadCategory();
    });
  },
  mounted() {
    console.log("this.mouted");
  }
};
</script>

<style lang="scss">
</style>
