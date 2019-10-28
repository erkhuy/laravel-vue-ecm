<template lang="">
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-center">
            <h3>Danh sách sản phẩm </h3>
            <a class="btn btn-outline-info ml-3" title="Thêm mới người dùng" @click="newProduct"><i class="fa fa-plus text-danger"></i> Thêm mới</a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên SP</th>
                        <th>Giá cả</th>
                        <th>Trạng thái</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product , index) in products.data" :key="index">
                        <td>{{ product.id }}</td>
                        <td> <img :src="'/images/products/'+product.image" class="img-fluid" width="50px" height="50px" :alt="product.name"></td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ (product.status ==0 )?'Không hiện thị':'Hiện thị' }}</td>
                        <td><a class="btn btn-outline-primary" title="cập nhật" @click="editProduct(product)"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-outline-dark" title="xóa" @click="deleteProduct(product.id)"><i class="fa fa-recycle text-danger"></i></a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div>
            <pagination :data="products" @pagination-change-page="getProduct"></pagination>
        </div>
    </div>
    <div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="ProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title" id="ProductModalLabel">{{ (actionProduct == 'create') ? 'Thêm mới sản phẩm':'Cập nhật thông tin'}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="(actionProduct == 'create') ? createProduct() : updateProduct()">
                    <div class="modal-body ">
                        <div class="d-flex justify-content-center">
                            <div class="form-group ">
                                <label>Tên sản phẩm</label>
                                <input v-model="product.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': product.errors.has('name') }">
                                <has-error :form="product" field="name"></has-error>
                            </div>
                            <div class="form-group ">
                                <label>Giá cả</label>
                                <input v-model="product.price" type="text" name="price" class="form-control" :class="{ 'is-invalid': product.errors.has('price') }" placeholder="VND">
                                <has-error :form="product" field="price"></has-error>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file" name="image" class="form-control" :class="{ 'is-invalid': product.errors.has('image') }" @change="onChangeFile">
                                <has-error :form="product" field="image"></has-error>
                            </div>
                            <div class="form-group">
                                <img :src="getImage()" class="img-fluid" width="100px" height="100px" alt="">
                            </div>
                        </div>
                        <div class="wrap-box">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex product-size">
                                    <label for="size" class="mr-5">Kích cỡ</label>
                                    <div class="form-group">
                                        <div class="form-check mr-3" v-for="(size , index) in sizes.data">
                                            <input type="checkbox" class="form-check-input" :value="size" name="sizes[]" v-model="product.sizes" />
                                            <label class="form-check-label">{{ size.size}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-color">
                                    <label for="color" class="mr-5">Chọn màu</label>
                                    <div class="form-check d-flex m-1 mt-0" v-for="(color , index) in colors.data">
                                        <input type="checkbox" class="form-check-input" :value="color" name="colors[]" v-model="product.colors" />
                                        <div class="box-color  bd-black " :style="{background:color.color}">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Chọn category</label>
                                    <select class="form-control" name="categories[]" v-model="product.categories" multiple>
                                        <option v-for="(category , index ) in categories.data" :key="index" :value="category">{{ category.name }}</option>
                                    </select>

                                </div>
                                <div>
                                    <has-error :form="product" field="categories"></has-error>
                                    <has-error :form="product" field="colors"></has-error>
                                    <has-error :form="product" field="sizes"></has-error>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label>Sale</label>
                                <input v-model="product.sale" type="text" name="sale" class="form-control" :class="{ 'is-invalid': product.errors.has('sale') }" placeholder='%'>
                                <has-error :form="product" field="sale"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input v-model="product.amount" type="text" name="amount" class="form-control" :class="{ 'is-invalid': product.errors.has('amount') }" placeholder='%'>
                                <has-error :form="product" field="amount"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <br>
                                <input type="radio" id="one" value="0" v-model="product.status" name="status">
                                <label for="one">Không hiện thị</label>
                                <br>
                                <input type="radio" id="two" value="1" v-model="product.status" name="status">
                                <label for="two">Hiện thị</label>

                                <has-error :form="product" field="status"></has-error>
                            </div>
                        </div>
                        <div class=" justify-content-center">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea v-model="product.description" type="text" name="description" class="form-control" :class="{ 'is-invalid': product.errors.has('description') }"></textarea>
                                <has-error :form="product" field="description"></has-error>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <has-error :form="product" field="images"></has-error>
                            <div class="form-group">
                                <label>Chọn các ảnh</label>
                                <input type="file" name="images[]" @change="selectMultiFile" multiple>
                            </div>
                            <div class="product-image-show d-flex">
                                <div v-for="(img , index) in product.images" :key="index">
                                    <div class="m-1 box-img" v-if="actionProduct == 'create'">
                                        <a @click.prevent="removeImg(index)" title="Xóa ảnh này" class="deleteImg"><i class="fa fa-times text-danger"></i></a>
                                        <img :src="getImages(img)" class="img-fluid" width="100px" height="100px" alt="">
                                    </div>
                                    <div class="m-1 box-img" v-else>
                                        <a @click.prevent="removeImg(index)" title="Xóa ảnh này" class="deleteImg"><i class="fa fa-times text-danger"></i></a>
                                        <img :src="(img.image ==undefined) ?getImages(img):getImages(img.image)" class="img-fluid" width="100px" height="100px" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">{{ (actionProduct == 'create') ? 'Thêm mới' :'Cập nhật' }}</button>
                    </div>
                </form>

            </div>
            <button @click="chenge">change</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      sizes: {},
      colors: {},
      products: {},
      categories: {},
      product: new Form({
        id: "",
        name: "",
        description: "",
        image: "",
        status: "",
        price: "",
        sale: "0",
        amount: "",
        categories: [],
        sizes: [],
        images: [],
        colors: []
      }),
      actionProduct: ""
    };
  },
  methods: {
    chenge() {},
    removeImg(index) {
      this.product.images.splice(index, 1);
    },
    getProduct(page = 1) {
      axios.get("/api/admin/product?page=" + page).then(response => {
        this.products = response.data;
      });
    },
    updateProduct() {
      this.product
        .put("/api/admin/product/" + this.product.id)
        .then(({ data }) => {
          if (data.status == true) {
            $("#ProductModal").modal("hide");
            this.$emit("AfterCreateProduct");
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
              text: "Có lỗi xảy ra! </br>" + data
            });
          }
        })
        .catch(err => {});
    },
    getImage() {
      let image =
        this.product.image.length > 200
          ? this.product.image
          : "/images/products/" + this.product.image;
      return image;
    },
    getImages(img) {
      let image = String(img).length > 200 ? img : "/images/products/" + img;
      return image;
    },
    editProduct(Product) {
      $("#ProductModal").modal("show");
      this.actionProduct = "edit";
      this.product.fill(Product);
    },
    deleteProduct(id) {
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
          this.product
            .delete("/api/admin/product/" + id)
            .then(data => {
              console.log(data);
              if (data.status == 200) {
                this.$emit("AfterCreateProduct");
                Swal.fire({
                  position: "top-end",
                  type: "success",
                  title: "Xóa  thành công",
                  showConfirmButton: false,
                  timer: 1000
                });
              } else {
                Swal.fire({
                  type: "error",
                  title: "Oops...",
                  text: "Có lỗi xảy ra!",
                  footer: "<a href>Thử lại sau ?</a>"
                });
              }
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
        this.product.image = reader.result;
      };
      reader.readAsDataURL(file);
    },
    selectMultiFile(e) {
      console.log(this.product.images);
      let files = e.target.files;
      for (let i = 0; i < files.length; i++) {
        let file = files[i];
        let reader = new FileReader();
        reader.onloadend = file => {
          this.product.images.push(reader.result);
        };
        reader.readAsDataURL(file);
      }
    },
    createProduct() {
      this.product
        .post("/api/admin/product")
        .then(({ data }) => {
          if (data.status == true) {
            $("#ProductModal").modal("hide");
            this.$emit("AfterCreateProduct");
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
              text: "Có lỗi xảy ra! </br>" + data
            });
          }
        })
        .catch(err => {});
    },
    newProduct() {
      $("#ProductModal").modal("show");
      this.actionProduct = "create";
      this.product.reset();
    },
    loadCategory() {
      axios.get("/api/admin/category").then(({ data }) => {
        this.categories = data;
      });
    },
    loadProduct() {
      axios.get("/api/admin/product").then(({ data }) => {
        this.products = data;
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
    }
  },
  mounted() {
    console.log("this.mouted");
  },

  created() {
    this.loadCategory();
    this.loadProduct();
    this.$on("AfterCreateProduct", () => {
      this.loadCategory();
      this.loadProduct();
      this.loadSizes();
      this.loadColors();
    });
    this.loadSizes();
    this.loadColors();
  }
};
</script>

<style lang="scss" scoped>
.box-img {
  position: relative;
  cursor: pointer;

  .deleteImg {
    position: absolute;
    font-size: 20px;
    top: -10%;
    right: -5%;

    &:hover {
      i {
        color: rgba(218, 13, 13, 0.315);
      }
    }
  }
}

.help-block.invalid-feedback {
  display: block;
}

.bd-black {
  border: 1px solid #000;
}

.bg-f06 {
  background-color: #f06;
}

.bg-ff0 {
  background-color: #ff0;
}

.bg-f3c {
  background-color: #f3cf;
}

.bg-f90 {
  background-color: #f90;
}
</style>
