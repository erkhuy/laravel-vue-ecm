<template>
  <div>
    <aside class="container">
      <div v-if="status" class="row p-bg">
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
              <select name="qty">
                <option v-for="(am , i) in product.amount" :key="i" :value="am">{{ am }}</option>
              </select>
              <label for="size">Chọn kích cỡ</label>
              <select name="size">
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
                ></div>
              </div>
            </div>
            <p>Khuyễn mãi {{ product.sale }} %</p>
            <div class="btn-box__wrap">
              <Addtocart></Addtocart>
              <button>
                <i class="fa fa-money-bill-alt"></i> Mua ngay
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12-col-sm-12 product-detail__des">
          <p>Thông tin về sản phẩm:{{ product.name }}</p>
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
            <p>Sản phẩm mới</p>
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
      productimg: ""
    };
  },
  methods: {
    getProduct() {},
    getProducts() {},
    setimg(img) {
      this.productimg = "/images/products/" + img;
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
      }
    }
  }
}
.product-detail__wrap {
  padding-left: 3%;
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

  border-radius: 3px;
  margin: 0 2%;
  &:hover,
  &:active,
  &:focus {
    border: 1px solid rgb(6, 22, 238);
  }
}
.color-box__wrap,
.btn-box__wrap {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
</style>
