<template>
  <div class="footer">
    <aside class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
          <div class="footer__infor">
            <p>Địa chỉ: Hà Nội</p>
            <a class href="mailto:haqhuy.wd@gmail.com" title="Gmail">
              <i class="fa fa-envelope"></i> haqhuy.wd@gmail.com
            </a>
            <a class href="tel:+84 33 71 72 888" title="Phone">
              <i class="fa fa-phone-alt"></i> +84 337 172 888
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
          <nav class="footer__menu">
            <h3>Thời trang nam</h3>
            <ul>
              <li>
                <a href="#" title="#">thoi trang nam 1</a>
              </li>
              <li>
                <a href="#" title="#">thoi trang nam 2</a>
              </li>
              <li>
                <a href="#" title="#">thoi trang nam 3</a>
              </li>
              <li>
                <a href="#" title="#">thoi trang nam 4</a>
              </li>
              <li>
                <a href="#" title="#">thoi trang nam 5</a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
          <nav class="footer__menu">
            <h3>Thời trang nữ</h3>
            <ul>
              <li>
                <a href="#" title="#">thoi trang nam 1</a>
              </li>
              <li>
                <a href="#" title="#">thoi trang nam 2</a>
              </li>
              <li>
                <a href="#" title="#">thoi trang nam 3</a>
              </li>
              <li>
                <a href="#" title="#">thoi trang nam 4</a>
              </li>
              <li>
                <a href="#" title="#">thoi trang nam 5</a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
          <div class="footer-menu__sosial">
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
    <aside class="footer-foot">
      <p>
        Hà Nội {{ }} &copy; By
        <span>Hạ Huy</span>
      </p>
    </aside>
  </div>
</template>

<script>
export default {};
</script>
<style lang="scss">
.footer {
  background: #333;

  li {
    list-style: none;
  }
  &__menu {
    ul {
      padding-left: 0;
    }
  }
  &__infor,
  &__menu {
    color: #e4d5d5b0;
    padding-top: 10%;
    display: flex;
    flex-direction: column;
  }
  npm run watx a {
    text-decoration: none;
    color: #e4d5d5b0;
  }
  &-foot {
    background: #211b1b;
    border-top: 1px solid #737373;
    text-align: center;
    color: #fff;
    p {
      padding: 1%;
    }
  }
}
.footer-menu__sosial {
  padding-top: 10% !important;
}
</style>
