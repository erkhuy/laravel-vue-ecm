<template>
  <div class="row list-product">
    <div class="list-product__title col-lg-12 col-md-12-col-sm-12">
      <h3>Sản phẩm mới</h3>
    </div>
    <div class="list-product__wrap col-lg-12 col-md-12-col-sm-12">
      <!-- product item -->
      <div class="product-item">
        <div class="product-item__wrap">
          <div class="product-item__image">
            <a href="#" title="#">
              <img :src="'/images/slides/1572963608.jpeg'" alt="#" />
            </a>
          </div>
          <div class="product-item__des">
            <span class="product-item__des__name">Hàng abcd</span>
            <span class="product-item__des__price">120VND</span>
            <p
              class="product-item__des__des"
            >hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjábnfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>
          </div>
          <div class="product-item__btn">
            <a href title="Chi tiết">
              <i class="fa fa-eye"></i>
            </a>
            <a href title="Mua ngay">
              <i class="fa fa-money-bill-alt"></i>
            </a>
            <a href title="Thêm vào giỏ hàng">
              <i class="fa fa-cart-plus"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- endproduc item -->
      <!-- product item -->
      <div class="product-item">
        <div class="product-item__wrap">
          <div class="product-item__image">
            <a href="#" title="#">
              <img :src="'/images/slides/1572963608.jpeg'" alt="#" />
            </a>
          </div>
          <div class="product-item__des">
            <span class="product-item__des__name">Hàng abcd</span>
            <span class="product-item__des__price">120VND</span>
            <p
              class="product-item__des__des"
            >hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjábnfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>
          </div>
          <div class="product-item__btn">
            <a href title="Chi tiết">
              <i class="fa fa-eye"></i>
            </a>
            <a href title="Mua ngay">
              <i class="fa fa-money-bill-alt"></i>
            </a>
            <a href title="Thêm vào giỏ hàng">
              <i class="fa fa-cart-plus"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- endproduc item -->
      <!-- product item -->
      <div class="product-item">
        <div class="product-item__wrap">
          <div class="product-item__image">
            <a href="#" title="#">
              <img :src="'/images/slides/1572963608.jpeg'" alt="#" />
            </a>
          </div>
          <div class="product-item__des">
            <span class="product-item__des__name">Hàng abcd</span>
            <span class="product-item__des__price">120VND</span>
            <p
              class="product-item__des__des"
            >hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjábnfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>
          </div>
          <div class="product-item__btn">
            <a href title="Chi tiết">
              <i class="fa fa-eye"></i>
            </a>
            <a href title="Mua ngay">
              <i class="fa fa-money-bill-alt"></i>
            </a>
            <a href title="Thêm vào giỏ hàng">
              <i class="fa fa-cart-plus"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- endproduc item -->
      <!-- product item -->
      <div class="product-item">
        <div class="product-item__wrap">
          <div class="product-item__image">
            <a href="#" title="#">
              <img :src="'/images/slides/1572963608.jpeg'" alt="#" />
            </a>
          </div>
          <div class="product-item__des">
            <span class="product-item__des__name">Hàng abcd</span>
            <span class="product-item__des__price">120VND</span>
            <p
              class="product-item__des__des"
            >hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjábnfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>
          </div>
          <div class="product-item__btn">
            <a href title="Chi tiết">
              <i class="fa fa-eye"></i>
            </a>
            <a href title="Mua ngay">
              <i class="fa fa-money-bill-alt"></i>
            </a>
            <a href title="Thêm vào giỏ hàng">
              <i class="fa fa-cart-plus"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- endproduc item -->
      <!-- product item -->
      <div class="product-item">
        <div class="product-item__wrap">
          <div class="product-item__image">
            <a href="#" title="#">
              <img :src="'/images/slides/1572963608.jpeg'" alt="#" />
            </a>
          </div>
          <div class="product-item__des">
            <span class="product-item__des__name">Hàng abcd</span>
            <span class="product-item__des__price">120VND</span>
            <p
              class="product-item__des__des"
            >hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjábnfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>
          </div>
          <div class="product-item__btn">
            <a href title="Chi tiết">
              <i class="fa fa-eye"></i>
            </a>
            <a href title="Mua ngay">
              <i class="fa fa-money-bill-alt"></i>
            </a>
            <a href title="Thêm vào giỏ hàng">
              <i class="fa fa-cart-plus"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- endproduc item -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      productsNew: {}
    };
  },
  methods: {
    getNewproduct() {
      axios
        .get("/api/getNewProduct")
        .then(res => {
          this.productsNew = res.data;
        })
        .catch(err => {
          console.error(err);
        });
    }
  },
  computed: {},
  beforeMount() {
    this.getNewproduct();
  }
};
</script>

<style lang="scss" scoped>
.list-product {
  &__title {
    & > h3 {
      padding: 2% 0;
      border-bottom: 1px solid #737373;
      font-style: italic;
    }
  }
  &__wrap {
    width: 100%;
    display: flex;

    .product-item {
      padding: 1%;
      &__wrap {
        display: flex;
        flex-direction: column;
      }
      width: 25%;
      &__image {
        img {
          max-width: 100%;
          height: auto;
        }
      }
      &__des {
        p {
          //   width: 100%;
          overflow: hidden;
          text-overflow: ellipsis;
          //   line-height: 10px;
          //   -webkit-line-clamp: 2;
          //   height: 50px;
          //   display: -webkit-box;
          //   -webkit-box-orient: vertical;
        }
      }
      &__btn {
        display: flex;
        flex-direction: row;
        justify-content: center;
        a {
          width: 30%;
          border: 1px solid;
          justify-content: center;
          text-align: center;
          margin: 0 2%;
          transition: all 1s ease;
          i {
            transition: all 1s ease;
          }
          &:hover i {
            transform: translate(1.2);
          }
          &:hover {
            background-color: #737373;
          }
        }

        a:last-child {
          margin-right: 0;
        }
        a:first-child {
          margin-left: 0;
        }
      }
    }
  }
}
</style>
