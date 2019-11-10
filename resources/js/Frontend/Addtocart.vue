<template>
  <div class="add-to-cart">
    <button class="btn btn-primary" @click="addToCart">
      <i class="fa fa-cart-plus"></i> Thêm vào giỏ
    </button>
  </div>
</template>

<script>
export default {
  name: "Addtocart",
  props: {
    name: String,
    price: String,
    productId: String,
    image: String
  },
  data() {
    return {
      item: {
        productName: this.name,
        productprice: this.price,
        product_id: this.productId,
        productImg: this.image,
        qty: 1
      }
    };
  },
  methods: {
    addToCart() {
      $("#cartList").modal("show");
      this.$store.commit("addToCart", this.item);
    }
  }
};
</script>

<style scoped lang="scss"></style>
