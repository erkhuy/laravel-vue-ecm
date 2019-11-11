<template>
  <div>
    <aside class="container">
      <div v-if="status" class="row p-bg mt-3 mb-3">
        <div class="col-lg-12 col-md-12-col-sm-12">
          <p>Sản phẩm mã số :{{ product.id }}</p>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-6 product-detail__image">
          <a href :title="'Sản phẩm mã sỗ'+product.name">
            <img :src="productimg" alt />
          </a>
          <carousel
            :per-page="3"
            :autoplay="true"
            :autoplayTimeout="2000"
            :loop="true"
            paginationPosition="bottom-overlay"
            class="slide-response"
          >
            <slide v-for="(img , index) in product.images" :key="index">
              <a href :title="product.name" @click.prevent="setimg(img.image)">
                <img
                  :src="'/images/products/'+img.image"
                  :alt="product.name"
                  class="slide-img__item"
                />
              </a>
            </slide>
          </carousel>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-6 product-detail__info">
          <div class="product-detail__wrap">
            <p>Tên sản phẩm{{ product.name }}</p>
            <p>Mã số sản phẩm:{{ product.id }}</p>
            <div>
              <label for="qty">Chọn số lượng</label>
              <select name="qty" v-model="productcart.qty">
                <option v-for="(am , i) in product.amount" :key="i" :value="am">{{ am }}</option>
              </select>
              <label for="size">Chọn kích cỡ</label>
              <select name="size" v-model="productcart.size">
                <option
                  v-for="(size , i) in product.sizes"
                  :key="i"
                  :value="size.size"
                >{{ size.size }}</option>
              </select>
            </div>

            <div>
              <p>Chọn màu</p>
              <div class="color-box__wrap">
                <div
                  class="box-color"
                  v-for="(color , i) in product.colors"
                  :key="i"
                  :style="{ background:color.color }"
                >
                  <input
                    type="checkbox"
                    class="checkcolor"
                    :value="color.color"
                    v-model="productcart.color"
                  />
                </div>
              </div>
            </div>
            <p>Khuyễn mãi {{ product.sale }} %</p>
            <p v-if="product.sale >0">
              Giá tiền:
              <span
                style="text-decoration: line-through;"
              >{{product.price |currency('VND', 0, { symbolOnLeft: false }) }}</span>
              <span>{{ (product.price-product.price*(product.sale/100)) |currency('VND', 0, { symbolOnLeft: false }) }}</span>
            </p>
            <p v-else>Giá tiền:{{ product.price |currency('VND', 0, { symbolOnLeft: false }) }}</p>
            <div class="btn-box__wrap">
              <a
                class="btn btn-outline-primary"
                title="Thêm vào giỏ hàng"
                @click.prevent="addToCart"
              >
                <i class="fa fa-cart-plus"></i> Thêm vào giỏ
              </a>
              <a class="btn btn-outline-dark ml-2" title="Mua ngay">
                <i class="fa fa-money-bill-alt"></i> Mua ngay
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12-col-sm-12 product-detail__des">
          <h4>Thông tin về sản phẩm:{{ product.name }}</h4>
          <p>{{ product.description }}</p>
        </div>
      </div>
      <div v-else class="row">
        <p>page not found</p>
      </div>
    </aside>
    <aside class="slide-product">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12-col-sm-12">
            <h3>Sản phẩm mới</h3>
            <carousel
              :per-page="5"
              :autoplay="true"
              :autoplayTimeout="2000"
              :loop="true"
              paginationPosition="bottom-overlay"
            >
              <slide v-for="(pro , index) in products" :key="index">
                <div class="slide-product__item">
                  <div class="slide-product__item__img">
                    <a href :title="pro.name">
                      <img :src="'/images/products/'+pro.image" alt />
                    </a>
                  </div>
                  <div class="slide-product__item__des">
                    <span>
                      {{ pro.price
                      }}
                    </span>
                    <a href>
                      <i class="fa fa-cart-plus"></i>
                    </a>
                    <a href>
                      <i class="fa fa-money-bill-alt"></i>
                    </a>
                  </div>
                </div>
              </slide>
            </carousel>
          </div>
        </div>
      </div>
    </aside>
  </div>
</template>
<script>
export default {
  data() {
    return {
      product: {},
      products: {},
      proID: "",
      status: null,
      productimg: "",
      productcart: {
        name: "",
        id: "",
        price: "",
        image: "",
        color: [],
        size: "",
        qty: ""
      }
    };
  },
  methods: {
    getProduct() {},
    getProducts() {},
    setimg(img) {
      this.productimg = "/images/products/" + img;
    },
    addToCart() {
      $("#cartList").modal("show");
      this.$store.commit("addToCart", this.productcart);
    }
  },
  created() {
    this.getProduct();
    this.getProducts();
  },
  beforeMount() {
    this.getProduct();
    this.getProducts();
  },

  mounted() {
    let self = this;
    let id1 = self.$route.params.id;
    self.proID = id1;
    axios
      .get("/api/getProduct/" + id1)
      .then(resp => {
        this.product = resp.data;
        this.status = true;
        this.productcart.name = resp.data.name;
        this.productcart.id = resp.data.id;
        this.productcart.price = resp.data.price;
        this.productcart.sale = resp.data.sale;
        this.productcart.qty = 1;
        this.productcart.size = resp.data.sizes[0].size;
        this.productcart.color.push(resp.data.colors[0].color);
        this.productcart.image = resp.data.image;
      })
      .catch(err => {
        this.status = false;
      });
    axios
      .get("/api/getNewProduct")
      .then(res => {
        this.products = res.data;
        this.productimg = "/images/products/" + this.product.image;
      })
      .catch(err => {
        console.error(err);
      });
  }
};
</script>
<style lang="scss" scoped>
.product-detail__info {
  p {
    font-weight: bold;
  }
}
.fn-w {
  font-weight: bold;
}
.p-bg {
  background: #77777738;
}
.slide-product__item {
  display: flex;
  flex-direction: column;
  padding: 3%;
  &__img {
    a {
      img {
        width: 100%;
        max-width: 150px;
        max-height: 130px;
      }
    }
  }
}
.product-detail__wrap {
  padding-left: 3%;
}
.product-detail__des {
  h4 {
    border-bottom: 1px solid #333;
  }
}
.product-detail__image {
  cursor: pointer;
  img {
    max-width: 100%;
    height: auto;
  }
  .slide-img__item {
    padding: 5%;
  }
}
.box-color {
  width: 30px;
  height: 30px;
  position: relative;
  border-radius: 3px;
  margin: 0 2%;
  &:hover,
  &:active,
  &:focus {
    border: 1px solid rgb(6, 22, 238);
  }
  .checkcolor {
    position: absolute;

    height: 50%;
    width: 100%;
    bottom: 25%;
  }
}
.color-box__wrap,
.btn-box__wrap {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
</style>
