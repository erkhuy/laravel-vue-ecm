<template>
  <div class="checkout container">
    <div class="row">
      <div class="col-md-9 m-3">
        <h3>Thanh toán</h3>
        <nav>
          <ul class="list-group">
            <li
              v-for="(item, index) in this.$store.state.cart"
              :key="index"
              class="list-group-item"
            >
              <div class="media">
                <img :src="item.productImg" class="mr-3" width="60px " height="60px" />
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
        <div>
          <p>Tổng cộng</p>
          <div>
            <p>Nhập mã giảm giá</p>
            <div>
              <input type="text" placeholder="Nhập mã giảm giá" />
              <a href>
                <i>Áp dụng</i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <h5>Tiến hành thanh toán</h5>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "checkout"
};
</script>

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
