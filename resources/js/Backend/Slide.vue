<template lang="">
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-center">
            <h3>Danh sách side</h3>
            <a class="btn btn-outline-info ml-3" title="Thêm mới người dùng" @click="newSlide"><i class="fa fa-plus text-danger"></i> Thêm mới</a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Status</th>
                        <th>Mô tả</th>

                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(slide , index) in slides.data" :key="index">
                        <td>{{ slide.id }}</td>
                        <td> <img :src="'/images/slides/'+slide.image" class="img-fluid" width="50px" height="50px" :alt="slide.description"></td>
                         <td>{{ (slide.status==1)?"Hiện thị" :"Không hiện thị" }}</td>
                        <td>{{ slide.description }}</td>
                        <td><a class="btn btn-outline-primary" title="cập nhật" @click="editSlide(slide)"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-outline-dark" title="xóa" @click="deleteSlide(slide.id)"><i class="fa fa-recycle text-danger"></i></a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div >
  <pagination :data="slides" @pagination-change-page="getSlide"></pagination>
        </div>
    </div>
    <div class="modal fade" id="SlideModal" tabindex="-1" role="dialog" aria-labelledby="SlideModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title" id="SlideModalLabel">{{ (actionSlide == 'create') ? 'Thêm mới slide':'Cập nhật thông tin'}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="(actionSlide == 'create') ? createSlide() : updateSlide()">
                    <div class="modal-body ">

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

                        <div class="d-flex justify-content-center">

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
                                <label>Mô tả</label>
                                <textarea v-model="form.description" type="text" name="description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">{{ (actionSlide == 'create') ? 'Thêm mới' :'Cập nhật' }}</button>

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
      slides: {},
      form: new Form({
        id: "",
        image: "",
        status: "",
        description: ""
      }),
      actionSlide: ""
    };
  },
  methods: {
    getSlide(page = 1) {
      axios.get("/api/admin/slide?page=" + page).then(response => {
        this.slides = response.data;
      });
    },
    updateSlide() {
      this.form
        .put("/api/admin/slide/" + this.form.id)
        .then(({ data }) => {
          if (data.status == true) {
            $("#SlideModal").modal("hide");
            this.$emit("AfterCreateSlide");
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
          : "/images/slides/" + this.form.image;
      return image;
    },
    editSlide(slide) {
      $("#SlideModal").modal("show");
      this.actionUser = "edit";
      this.form.fill(slide);
    },
    deleteSlide(id) {
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
            .delete("/api/admin/slide/" + id)
            .then(() => {
              this.$emit("AfterCreateSlide");
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
    createSlide() {
      this.form
        .post("/api/admin/slide")
        .then(({ data }) => {
          if (data.status == true) {
            $("#SlideModal").modal("hide");
            this.$emit("AfterCreateSlide");
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
    newSlide() {
      $("#SlideModal").modal("show");
      this.actionSlide = "create";
      this.form.reset();
    },
    loadSlide() {
      axios.get("/api/admin/slide").then(({ data }) => {
        this.slides = data;
      });
    }
  },
  mounted() {
    console.log("this.mouted");
  },

  created() {
    this.loadSlide();
    this.loadSlide();
    this.$on("AfterCreateSlide", () => {
      this.loadSlide();
    });
  }
};
</script>

<style lang="scss" scoped>
.help-block.invalid-feedback {
  display: block;
}
</style>
