<template>
  <div>
    <div
      class="modal fade"
      id="cartList"
      tabindex="-1"
      role="dialog"
      aria-labelledby="cartListLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cartListLabel">Giỏi hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <nav>
              <ul class="list-group">
                <li
                  v-for="(item, index) in this.$store.state.cart"
                  :key="index"
                  class="list-group-item mt-3"
                >
                  <div class="media">
                    <img
                      :src="'/images/products/'+item.image"
                      class="mr-3"
                      width="60px "
                      height="60px"
                    />
                    <div class="media-body">
                      <h5 class="mt-0">Tên sản phăm:{{ item.name }}</h5>
                      <p>
                        GIá cả:
                        <span>{{ (item.sale>0)?(item.price-item.price*(item.sale/100)):item.price |currency('VND', 0, { symbolOnLeft: false }) }}</span>
                      </p>
                      <p>Số lượng : {{ item.qty }}</p>
                      <p>Tổng cộng : {{ (item.qty * item.price) |currency('VND', 0, { symbolOnLeft: false }) }}</p>
                    </div>
                  </div>
                  <span class="deleteitem" @click="deleteItem(item)">X</span>
                </li>
              </ul>
            </nav>
          </div>
          <div class="modal-footer">
            <a
              title="Tiếp tục mua hàng"
              class="btn btn-outline-dark"
              @click.prevent="goBack"
              data-dismiss="modal"
            >Tiếp tục mua hàng</a>
            <a
              title="Thanh toán"
              @click.prevent="checkout"
              class="btn btn-outline-primary"
            >Thanh toán</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Minicart",

  methods: {
    checkout() {
      $("#cartList").modal("hide");
      this.$router.push("/checkout");
    },
    deleteItem(item) {
      this.$store.commit("removeFromcart", item);
    },
    goBack() {
      this.$router.go(1);
    },
    checkout() {
      this.$router.push({ name: "CheckOut" });
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style lang="scss" scoped>
.list-group-item {
  cursor: pointer;
  position: relative;

  .deleteitem {
    position: absolute;
    top: -15px;
    color: red;
    right: -7px;
    font-size: 20px;
  }
}
</style>
