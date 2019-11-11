<template>
  <div class="add-to-cart">
    <a class="btn btn-outline-primary" title="Thêm vào giỏ hàng" @click.prevent="addToCart">
      <i class="fa fa-cart-plus"></i> Thêm vào giỏ
    </a>
  </div>
</template>

<script>
export default {
  name: "Addtocart",
  props: {
    id: Number,
    name: String,
    image: String,
    qty: Number,
    size: String,
    color: Array,
    sale: Number
  },
  data() {
    return {
      item: {
        id: this.id,
        name: this.name,
        image: this.image,
        qty: this.qty,
        size: this.size,
        color: this.color,
        sale: this.sale
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
