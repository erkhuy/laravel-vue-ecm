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
            <h5 class="modal-title" id="cartListLabel">My bag</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
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
                      :src="item.productImg"
                      class="mr-3"
                      width="60px "
                      height="60px"
                    />
                    <div class="media-body">
                      <h5 class="mt-0">{{ item.productName }}</h5>
                      <p>Price:{{ item.productprice | currency }}</p>
                      <p>Quality : {{ item.qty }}</p>
                      <p>
                        Total : {{ (item.qty * item.productprice) | currency }}
                      </p>
                    </div>
                  </div>
                  <span class="deleteitem" @click="deleteItem(item)">X</span>
                </li>
              </ul>
            </nav>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Continue shopping
            </button>
            <button @click="checkout" class="btn btn-primary">Check out</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Minicart",
  props: {
    msg: String
  },
  methods: {
    checkout() {
      $("#cartList").modal("hide");
      this.$router.push("/checkout");
    },
    deleteItem(item) {
      this.$store.commit("removeFromcart", item).then(status => {});
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
