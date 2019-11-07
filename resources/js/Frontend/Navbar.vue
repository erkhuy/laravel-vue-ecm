<template>
  <div>
    <section class="header">
      <aside class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-lg-8 col-sm-10 col-9 p-0">
              <nav class="nav header__top">
                <a class="nav-link" href="mailto:haqhuy.wd@gmail.com.com" title="Gmail">
                  <i class="fa fa-envelope"></i> haqhuy.wd@gmail.com.com
                </a>
                <a class="nav-link" href="tel:+84 33 71 72 888" title="Phone">
                  <i class="fa fa-phone-alt"></i> +84 337 172 888
                </a>
              </nav>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-2 col-3 p-0">
              <ul class="nav justify-content-end">
                <li class="nav-item">
                  <a class="nav-link active" href="#" title="Facebook">
                    <i class="fab fa-facebook"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" title="Instagram">
                    <i class="fab fa-instagram"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="mailto:haqhuy.wd@gmail.com.com" title="Gmail">
                    <i class="fa fa-envelope"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </aside>
      <aside class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12-col-sm-12 header__banner">
            <!-- Image and text -->
            <nav class="navbar navbar-light p-0">
              <a class="navbar-brand" href="#">
                <img
                  src="/docs/4.3/assets/brand/bootstrap-solid.svg"
                  width="30"
                  height="30"
                  class="d-inline-block align-top"
                  alt
                />
                Bootstrap
              </a>
              <ul class="nav justify-content-end">
                <li class="nav-item pr-2">
                  <router-link class="nav-link text-dark" title="Login" :to="{name:'Category'}">
                    <i class="fa fa-lock pr-1"></i>Login
                  </router-link>
                </li>
                <li class="nav-item pr-2">
                  <router-link class="nav-link text-dark" title="LogOut" :to="{name:'Category'}">
                    <i class="fa fa-power-off pr-1"></i>Logout
                  </router-link>
                </li>
                <li class="nav-item pr-2">
                  <router-link class="nav-link text-dark" title="Check Out" :to="{name:'Category'}">
                    <i class="fa fas fa-money-bill-alt pr-1"></i>CheckOut
                  </router-link>
                </li>

                <li class="nav-item">
                  <router-link class="nav-link text-dark" title="Cart" :to="{name:'Category'}">
                    <i class="fa fa-lock pr-1"></i>Cart(0)
                  </router-link>
                </li>
              </ul>
            </nav>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-md-12-col-sm-12 header__menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light pl-0 pr-0">
              <a class="navbar-brand" href="#">Navbar</a>
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item" v-for="(cate , index ) in categories" :key="index">
                    <router-link
                      class="nav-link"
                      title="Check Out"
                      :to="{name:'Category'}"
                      v-show="cate.parent_id.id==0"
                    >{{cate.name}}</router-link>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                  <input
                    class="form-control mr-sm-2"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
              </div>
            </nav>
          </div>
        </div>
      </aside>
    </section>
  </div>
</template>
<script>
export default {
  data() {
    return {
      categories: {}
    };
  },
  methods: {
    getCategory() {
      axios
        .get("/api/getCategories")
        .then(res => {
          this.categories = res.data.data;
        })
        .catch(err => {
          console.error(err);
        });
    }
  },
  created() {
    this.getCategory();
  }
};
</script>
<style lang="scss" scoped>
.nav-link {
  padding: 0.5rem 0.5rem !important;
  white-space: nowrap;
  &:first-child {
    padding-left: 0 !important;
  }
  &:last-child {
    padding-right: 0 !important;
  }
  &:hover {
    color: #e40f0f !important;
  }
}
.navbar-nav {
  li.nav-item {
    margin: 0 6% !important;
  }
}
.header {
  &__top {
    background: #333;
  }
  &__menu {
    background: #2222220a;
  }
}
</style>
