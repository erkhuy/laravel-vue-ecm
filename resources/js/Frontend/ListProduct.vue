<template>
  <div class="row list-product">
    <div class="list-product__title col-lg-12 col-md-12-col-sm-12">
      <h3>Sản phẩm khuyễn mãi</h3>
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
            <p class="product-item__des__des">
              hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjáb
              nfffffffffffffffffffffffffffffffffffffffff
              ffffffffffffffffffffffffff
            </p>
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
            <p class="product-item__des__des">
              hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjá
              bnffffffffffffffffffffffffffffffffffffff
              fffffffffffffffffffffffffffff
            </p>
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
            <p class="product-item__des__des">
              hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjáb
              nffffffffffffffffffffffffffffffffffffffff
              fffffffffffffffffffffffffff
            </p>
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
            <p class="product-item__des__des">
              hàdh;ahf;ahn;fhna;fn;abna;jfá;jfjná;fjáfffffffffffffffffffffff
              bgfsgsdfffffffffffffffffffffffffffffffffffffffffnffffffffffffff
              fffffff
              ffffffffffffffffffffffffffffffffffffffffffffff
            </p>
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

<style lang="scss" >
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
    flex-wrap: wrap;

    .product-item {
      padding: 1%;
      position: relative;
      transition: all 1s ease;

      &:after {
        position: absolute;
        content: "";
        top: 0;
        width: 100%;
        z-index: 20;
        height: 0%;
        transition: all 1s ease;
        left: 0;
        opacity: 0;
      }
      &:hover {
        &:after {
          border: 1px solid #737373;
          height: 100%;
          opacity: 1;
          background-color: rgba(95, 84, 83, 0.171);
        }
        .product-item__btn {
          opacity: 1;
          pointer-events: all;
        }
      }

      &__wrap {
        display: flex;
        flex-direction: column;
        position: relative;
      }
      width: 25%;
      &__image {
        img {
          max-width: 100%;
          height: auto;
        }
      }
      &__des {
        &__des {
          width: 100%;
          overflow: hidden;
          text-overflow: ellipsis;
          -webkit-line-clamp: 2;
          display: -webkit-box;
          -webkit-box-orient: vertical;
        }
      }
      &__btn {
        position: absolute;
        display: flex;
        flex-direction: row;
        align-self: center;
        width: 95%;
        bottom: 50%;
        z-index: 23;
        opacity: 0;
        pointer-events: none;
        transition: all 1s ease;

        a {
          width: 30%;
          justify-content: center;
          text-align: center;
          margin: 0 2%;
          transition: all 1s ease;
          border-radius: 5px;
          color: #1f2d3d;
          background: rgba(96, 210, 152, 0.75);
          &:hover {
            background-color: #0cf565c2;
          }
        }

        a:last-child {
          margin-right: 0;
          color: rgba(245, 22, 6, 0.993);
        }
        a:first-child {
          margin-left: 0;
          color: #0c0c0c;
        }
      }
    }
  }
}

@keyframes imageanimate {
  to {
    opacity: 0;
    height: 0;
  }
  from {
    opacity: 1;
    height: 100%;
  }
}
</style>
