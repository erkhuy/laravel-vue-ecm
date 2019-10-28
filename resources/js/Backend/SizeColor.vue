<template>
  <div class="row">
    <div class="col-md-6 col-sm-12">
      <div class="d-flex">
        <h3>Danh sách kích cỡ</h3>
        <button @click="newSize" class="btn btn-outline-dark ml-3">
          Thêm mới
          <i class="fa fa-plus"></i>
        </button>
      </div>
      <div>
        <table class="table">
          <tr>
            <th>Id</th>
            <th>Kích cỡ</th>
            <th>Tùy chọn</th>
          </tr>
          <tr v-for="(size , index) in sizes.data" :key="index">
            <td>{{ size.id }}</td>
            <td>{{ size.size }}</td>
            <td>
              <a title="Xóa " class="btn btn-outline-danger" @click="deleteSize(size.id)">
                <i class="fa fa-recycle"></i>
              </a>
            </td>
          </tr>
        </table>
        <pagination :data="sizes" @pagination-change-page="getSizes"></pagination>
      </div>
    </div>
    <div class="col-md-6 col-sm-12">
      <div class="d-flex">
        <h3>Danh sách màu</h3>
        <button @click="newColor" class="btn btn-outline-primary ml-2">
          Thêm mới
          <i class="fa fa-plus"></i>
        </button>
      </div>
      <div>
        <table class="table">
          <tr>
            <th>Id</th>
            <th>Màu</th>
            <th>Tùy chọn</th>
          </tr>
          <tr v-for="(color , index) in colors.data" :key="index">
            <td>{{ color.id }}</td>
            <td>
              <div class="box" :style="{ background:color.color }"></div>
            </td>
            <td>
              <a title="Xóa " class="btn btn-outline-danger" @click="deleteColor(color.id)">
                <i class="fa fa-recycle"></i>
              </a>
            </td>
          </tr>
        </table>
        <pagination :data="colors" @pagination-change-page="getColors"></pagination>
      </div>
    </div>
    <!-- size model -->
    <div
      class="modal fade"
      id="sizecolormodal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="sizecolormodalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="sizecolormodalLabel"
            >{{ (actionModal =="size") ? 'Thêm mới kích cỡ':'Thêm mới màu'}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="(actionModal=='size')?addSize():addColor()">
            <div class="modal-body">
              <div v-if="actionModal =='size'">
                <div class="form-group">
                  <label for>Kích cõ</label>
                  <input
                    v-model="size.size"
                    type="text"
                    name="size"
                    class="form-control"
                    :class="{ 'is-invalid': size.errors.has('size') }"
                  />
                  <has-error :form="size" field="size"></has-error>
                </div>
              </div>
              <div v-else>
                <div class="form-group">
                  <label for>Chọn màu</label>
                  <input
                    v-model="color.color"
                    type="color"
                    name="color"
                    class="form-control"
                    :class="{ 'is-invalid': color.errors.has('color') }"
                  />
                  <has-error :form="color" field="color"></has-error>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-secondary m-3" data-dismiss="modal">Hủy bỏ</button>
            <button type="submit" class="btn btn-primary m-3">Thêm mới</button>
          </form>
        </div>
      </div>
    </div>
    <!-- color modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      actionModal: "size",
      sizes: {},
      colors: {},
      size: new Form({
        id: "",
        size: null
      }),
      color: new Form({
        id: "",
        color: null
      })
    };
  },
  methods: {
    newSize() {
      $("#sizecolormodal").modal("show");
      this.actionModal = "size";
      this.size.reset();
    },
    newColor() {
      $("#sizecolormodal").modal("show");
      this.actionModal = "color";
      this.color.reset();
    },
    addSize() {
      this.size
        .post("/api/admin/size")
        .then(({ data }) => {
          if (data.status == true) {
            $("#sizecolormodal").modal("hide");
            this.$emit("AfterCreateSize");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Thêm mới  thành công",
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
    addColor() {
      this.color
        .post("/api/admin/color")
        .then(({ data }) => {
          if (data.status == true) {
            $("#sizecolormodal").modal("hide");
            this.$emit("AfterCreateColor");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Thêm mới  thành công",
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
    getColors(page = 1) {
      axios.get("/api/admin/color?page=" + page).then(response => {
        this.colors = response.data;
      });
    },
    getSizes(page = 1) {
      axios.get("/api/admin/size?page=" + page).then(response => {
        this.sizes = response.data;
      });
    },
    loadSizes() {
      axios.get("/api/admin/size").then(({ data }) => {
        this.sizes = data;
      });
    },
    loadColors() {
      axios.get("/api/admin/color").then(({ data }) => {
        this.colors = data;
      });
    },
    deleteSize(id) {
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
          this.size
            .delete("/api/admin/size/" + id)
            .then(() => {
              this.$emit("AfterCreateSize");
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
    deleteColor(id) {
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
          this.color
            .delete("/api/admin/color/" + id)
            .then(() => {
              this.$emit("AfterCreateColor");
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
    }
  },
  created() {
    this.loadSizes();
    this.loadColors();
    this.$on("AfterCreateSize", () => {
      this.loadSizes();
    });
    this.$on("AfterCreateColor", () => {
      this.loadColors();
    });
  }
};
</script>

<style lang="scss" scoped>
.box {
  width: 30px;
  height: 30px;
  border: 1px solid #000;
}
</style>
